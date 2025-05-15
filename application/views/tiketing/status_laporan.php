<?php $this->load->view('layout/header'); ?>

<div class="bg-gradient-to-b from-gray-50 to-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-10 max-w-6xl">
        <div class="mb-10">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 tracking-tight">Status Laporan</h1>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-4 border border-gray-200">
                <div class="flex flex-wrap gap-4">
                    <div class="flex items-center gap-2 px-3 py-1.5 bg-blue-50 text-blue-700 rounded-md border border-blue-100">
                        <i class="fas fa-ticket-alt"></i>
                        <span class="font-medium">Total: <?= count($laporan ?? []) ?></span>
                    </div>

                    <?php if (!empty($laporan)): ?>
                        <?php
                        $ongoing_count = count(array_filter($laporan, function ($lpr) {
                            return $lpr['status'] != 'Selesai';
                        }));
                        $completed_count = count(array_filter($laporan, function ($lpr) {
                            return $lpr['status'] == 'Selesai';
                        }));
                        ?>
                        <div class="flex items-center gap-2 px-3 py-1.5 bg-yellow-50 text-yellow-700 rounded-md border border-yellow-100">
                            <i class="fas fa-spinner"></i>
                            <span class="font-medium">Aktif: <?= $ongoing_count ?></span>
                        </div>
                        <div class="flex items-center gap-2 px-3 py-1.5 bg-green-50 text-green-700 rounded-md border border-green-100">
                            <i class="fas fa-check-circle"></i>
                            <span class="font-medium">Selesai: <?= $completed_count ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if (!empty($laporan)): ?>
            <?php
            $ongoing_reports = array_filter($laporan, function ($lpr) {
                return $lpr['status'] != 'Selesai';
            });
            $completed_reports = array_filter($laporan, function ($lpr) {
                return $lpr['status'] == 'Selesai';
            });

            $status_meta = [
                'Menunggu' => ['icon' => 'fas fa-hourglass-start'],
                'Sedang Proses' => ['icon' => 'fas fa-cogs'],
                'Batal' => ['icon' => 'fas fa-times-circle'],
                'Selesai' => ['icon' => 'fas fa-check-circle']
            ];
            ?>

            <?php if (!empty($ongoing_reports)): ?>
                <section class="mb-12">
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Laporan Aktif</h2>
                        <div class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-800 text-sm font-medium">
                            <?= count($ongoing_reports) ?>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <?php foreach ($ongoing_reports as $lpr_key => $lpr): ?>
                            <?php $meta = $status_meta[$lpr['status']] ?? ['icon' => 'fas fa-question-circle']; ?>

                            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                                <div class="px-5 py-4 border-b border-gray-100">
                                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-semibold text-gray-900">
                                                <?= htmlspecialchars($lpr['subject']) ?>
                                            </h3>
                                            <div class="flex items-center gap-3 text-sm text-gray-500 mt-1">
                                                <span class="flex items-center gap-1.5">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <?= date('d M Y', strtotime($lpr['created_date'])) ?>
                                                </span>
                                                <span class="flex items-center gap-1.5">
                                                    <i class="fas fa-ticket-alt"></i>
                                                    <?= htmlspecialchars($lpr['id_ticket']) ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="mt-2 sm:mt-0">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium bg-gray-100 text-gray-700">
                                                <i class="<?= $meta['icon'] ?> mr-2"></i> <?= htmlspecialchars($lpr['status']) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-5 sm:p-6">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="space-y-6">
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <h4 class="text-md font-semibold text-gray-800 mb-3 flex items-center">
                                                    <i class="fas fa-quote-left mr-2 text-gray-500"></i>
                                                    Deskripsi
                                                </h4>
                                                <p class="text-gray-700 leading-relaxed">
                                                    <?= nl2br(htmlspecialchars($lpr['description'])) ?>
                                                </p>
                                            </div>

                                            <?php if (!empty($lpr['additional_notes'])): ?>
                                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                                    <h4 class="text-md font-semibold text-gray-800 mb-2 flex items-center">
                                                        <i class="fas fa-sticky-note mr-2 text-gray-500"></i>
                                                        Catatan Tambahan
                                                    </h4>
                                                    <p class="text-gray-700 leading-relaxed">
                                                        <?= nl2br(htmlspecialchars($lpr['additional_notes'])) ?>
                                                    </p>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($lpr['attachments'])): ?>
                                                <div>
                                                    <h4 class="text-md font-semibold text-gray-800 mb-3 flex items-center">
                                                        <i class="fas fa-paperclip mr-2 text-gray-500"></i>
                                                        Lampiran
                                                    </h4>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                        <?php foreach (explode(',', $lpr['attachments']) as $file): ?>
                                                            <a href="<?= base_url('uploads/tiket/' . trim(htmlspecialchars($file))) ?>"
                                                                target="_blank"
                                                                class="group flex items-center gap-2 bg-white border border-gray-200 hover:border-blue-300 p-3 rounded-lg hover:shadow-md transition-all overflow-hidden">
                                                                <div class="bg-blue-100 text-blue-600 p-2 rounded">
                                                                    <i class="fas fa-file-alt"></i>
                                                                </div>
                                                                <span class="flex-1 text-sm text-gray-700 truncate">
                                                                    <?= trim(htmlspecialchars($file)) ?>
                                                                </span>
                                                                <i class="fas fa-download text-gray-400 group-hover:text-blue-600"></i>
                                                            </a>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="space-y-6">
                                            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                                                <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                                    <h4 class="font-semibold text-gray-800">Informasi Laporan</h4>
                                                </div>
                                                <div class="divide-y divide-gray-100">
                                                    <div class="flex py-3 px-4">
                                                        <div class="w-36 flex items-center text-gray-500 font-medium">
                                                            <i class="fas fa-folder-open mr-2 w-5 text-center text-gray-500"></i>
                                                            Kategori
                                                        </div>
                                                        <div class="flex-1 text-gray-800">
                                                            <?= htmlspecialchars($lpr['category']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex py-3 px-4">
                                                        <div class="w-36 flex items-center text-gray-500 font-medium">
                                                            <i class="fas fa-exclamation-circle mr-2 w-5 text-center text-gray-500"></i>
                                                            Prioritas
                                                        </div>
                                                        <div class="flex-1 text-gray-800">
                                                            <?= htmlspecialchars($lpr['priority']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex py-3 px-4">
                                                        <div class="w-36 flex items-center text-gray-500 font-medium">
                                                            <i class="fas fa-map-marker-alt mr-2 w-5 text-center text-gray-500"></i>
                                                            Lokasi
                                                        </div>
                                                        <div class="flex-1 text-gray-800">
                                                            <?= htmlspecialchars($lpr['location']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex py-3 px-4">
                                                        <div class="w-36 flex items-center text-gray-500 font-medium">
                                                            <i class="fas fa-map-pin mr-2 w-5 text-center text-gray-500"></i>
                                                            Detail Lokasi
                                                        </div>
                                                        <div class="flex-1 text-gray-800">
                                                            <?= htmlspecialchars($lpr['detail_location']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex py-3 px-4">
                                                        <div class="w-36 flex items-center text-gray-500 font-medium">
                                                            <i class="fas fa-calendar-day mr-2 w-5 text-center text-gray-500"></i>
                                                            Tgl Kejadian
                                                        </div>
                                                        <div class="flex-1 text-gray-800">
                                                            <?= date('d M Y', strtotime($lpr['incident_date'])) ?>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($lpr['visit_schedule'])): ?>
                                                        <div class="flex py-3 px-4">
                                                            <div class="w-36 flex items-center text-gray-500 font-medium">
                                                                <i class="fas fa-clock mr-2 w-5 text-center text-gray-500"></i>
                                                                Jadwal Kunjungan
                                                            </div>
                                                            <div class="flex-1 text-gray-800">
                                                                <?= date('d M Y H:i', strtotime($lpr['visit_schedule'])) ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border border-gray-200 text-sm">
                                                <div class="text-gray-500">
                                                    <i class="fas fa-sync-alt mr-1"></i> Diperbarui: <?= date('d M Y, H:i', strtotime($lpr['update_date'])) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if (!empty($completed_reports)): ?>
                <section class="mt-12">
                    <div class="flex items-center gap-3 mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Laporan Selesai</h2>
                        <div class="px-2.5 py-1 rounded-full bg-gray-100 text-gray-800 text-sm font-medium">
                            <?= count($completed_reports) ?>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <?php foreach ($completed_reports as $lpr_key => $lpr): ?>
                            <?php $meta = $status_meta['Selesai']; ?>

                            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                                <div class="px-5 py-4 border-b border-gray-100">
                                    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-2">
                                        <div class="flex-1">
                                            <h3 class="text-xl font-semibold text-gray-900">
                                                <?= htmlspecialchars($lpr['subject']) ?>
                                            </h3>
                                            <div class="flex items-center gap-3 text-sm text-gray-500 mt-1">
                                                <span class="flex items-center gap-1.5">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <?= date('d M Y', strtotime($lpr['created_date'])) ?>
                                                </span>
                                                <span class="flex items-center gap-1.5">
                                                    <i class="fas fa-ticket-alt"></i>
                                                    <?= htmlspecialchars($lpr['id_ticket']) ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="mt-2 sm:mt-0">
                                            <span class="inline-flex items-center px-3 py-1.5 rounded-md text-sm font-medium bg-gray-100 text-gray-700">
                                                <i class="<?= $meta['icon'] ?> mr-2"></i> <?= htmlspecialchars($lpr['status']) ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-5 sm:p-6">
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        <div class="space-y-6">
                                            <div class="bg-gray-50 rounded-lg p-4">
                                                <h4 class="text-md font-semibold text-gray-800 mb-3 flex items-center">
                                                    <i class="fas fa-quote-left mr-2 text-gray-500"></i>
                                                    Deskripsi
                                                </h4>
                                                <p class="text-gray-700 leading-relaxed">
                                                    <?= nl2br(htmlspecialchars($lpr['description'])) ?>
                                                </p>
                                            </div>

                                            <?php if (!empty($lpr['additional_notes'])): ?>
                                                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                                    <h4 class="text-md font-semibold text-gray-800 mb-2 flex items-center">
                                                        <i class="fas fa-sticky-note mr-2 text-gray-500"></i>
                                                        Catatan Tambahan
                                                    </h4>
                                                    <p class="text-gray-700 leading-relaxed">
                                                        <?= nl2br(htmlspecialchars($lpr['additional_notes'])) ?>
                                                    </p>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (!empty($lpr['attachments'])): ?>
                                                <div>
                                                    <h4 class="text-md font-semibold text-gray-800 mb-3 flex items-center">
                                                        <i class="fas fa-paperclip mr-2 text-gray-500"></i>
                                                        Lampiran
                                                    </h4>
                                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                                        <?php foreach (explode(',', $lpr['attachments']) as $file): ?>
                                                            <a href="<?= base_url('uploads/tiket/' . trim(htmlspecialchars($file))) ?>"
                                                                target="_blank"
                                                                class="group flex items-center gap-2 bg-white border border-gray-200 hover:border-blue-300 p-3 rounded-lg hover:shadow-md transition-all overflow-hidden">
                                                                <div class="bg-blue-100 text-blue-600 p-2 rounded">
                                                                    <i class="fas fa-file-alt"></i>
                                                                </div>
                                                                <span class="flex-1 text-sm text-gray-700 truncate">
                                                                    <?= trim(htmlspecialchars($file)) ?>
                                                                </span>
                                                                <i class="fas fa-download text-gray-400 group-hover:text-blue-600"></i>
                                                            </a>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="space-y-6">
                                            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                                                <div class="px-4 py-3 bg-gray-50 border-b border-gray-200">
                                                    <h4 class="font-semibold text-gray-800">Informasi Laporan</h4>
                                                </div>
                                                <div class="divide-y divide-gray-100">
                                                    <div class="flex py-3 px-4">
                                                        <div class="w-36 flex items-center text-gray-500 font-medium">
                                                            <i class="fas fa-folder-open mr-2 w-5 text-center text-gray-500"></i>
                                                            Kategori
                                                        </div>
                                                        <div class="flex-1 text-gray-800">
                                                            <?= htmlspecialchars($lpr['category']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex py-3 px-4">
                                                        <div class="w-36 flex items-center text-gray-500 font-medium">
                                                            <i class="fas fa-exclamation-circle mr-2 w-5 text-center text-gray-500"></i>
                                                            Prioritas
                                                        </div>
                                                        <div class="flex-1 text-gray-800">
                                                            <?= htmlspecialchars($lpr['priority']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex py-3 px-4">
                                                        <div class="w-36 flex items-center text-gray-500 font-medium">
                                                            <i class="fas fa-map-marker-alt mr-2 w-5 text-center text-gray-500"></i>
                                                            Lokasi
                                                        </div>
                                                        <div class="flex-1 text-gray-800">
                                                            <?= htmlspecialchars($lpr['location']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex py-3 px-4">
                                                        <div class="w-36 flex items-center text-gray-500 font-medium">
                                                            <i class="fas fa-map-pin mr-2 w-5 text-center text-gray-500"></i>
                                                            Detail Lokasi
                                                        </div>
                                                        <div class="flex-1 text-gray-800">
                                                            <?= htmlspecialchars($lpr['detail_location']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="flex py-3 px-4">
                                                        <div class="w-36 flex items-center text-gray-500 font-medium">
                                                            <i class="fas fa-calendar-day mr-2 w-5 text-center text-gray-500"></i>
                                                            Tgl Kejadian
                                                        </div>
                                                        <div class="flex-1 text-gray-800">
                                                            <?= date('d M Y', strtotime($lpr['incident_date'])) ?>
                                                        </div>
                                                    </div>
                                                    <?php if (!empty($lpr['visit_schedule'])): ?>
                                                        <div class="flex py-3 px-4">
                                                            <div class="w-36 flex items-center text-gray-500 font-medium">
                                                                <i class="fas fa-clock mr-2 w-5 text-center text-gray-500"></i>
                                                                Jadwal Kunjungan
                                                            </div>
                                                            <div class="flex-1 text-gray-800">
                                                                <?= date('d M Y H:i', strtotime($lpr['visit_schedule'])) ?>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg border border-gray-200 text-sm">
                                                <div class="text-gray-500">
                                                    <i class="fas fa-sync-alt mr-1"></i> Diperbarui: <?= date('d M Y, H:i', strtotime($lpr['update_date'])) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>

        <?php else: ?>
            <div class="bg-white rounded-xl shadow-md border border-gray-200 p-8 md:p-12 text-center">
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-50 text-gray-500 mb-5">
                        <i class="fas fa-clipboard-list fa-2x"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Laporan</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto leading-relaxed">
                        Anda belum memiliki laporan yang terdaftar. Silakan buat laporan baru untuk melaporkan masalah atau permintaan Anda.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8 max-w-3xl mx-auto text-left">
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-lightbulb mr-2"></i>
                            <h4 class="font-semibold">Cara Membuat Laporan</h4>
                        </div>
                        <p class="text-sm text-gray-600">
                            Klik tombol "Buat Laporan Baru" dan isi detail permasalahan Anda dengan lengkap.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-hourglass-half mr-2"></i>
                            <h4 class="font-semibold">Waktu Respons</h4>
                        </div>
                        <p class="text-sm text-gray-600">
                            Tim kami akan merespons laporan Anda dalam waktu 1-2 hari kerja.
                        </p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <div class="flex items-center text-gray-600 mb-2">
                            <i class="fas fa-question-circle mr-2"></i>
                            <h4 class="font-semibold">Butuh Bantuan?</h4>
                        </div>
                        <p class="text-sm text-gray-600">
                            Hubungi tim dukungan kami di <a href="#" class="text-blue-600 hover:underline">support@example.com</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->load->view('layout/footer'); ?>