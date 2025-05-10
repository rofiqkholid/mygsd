<?php $this->load->view('layout/header'); ?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-6">Status Laporan Saya</h1>
    
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 text-left">ID Ticket</th>
                    <th class="px-4 py-2 text-left">Tanggal</th>
                    <th class="px-4 py-2 text-left">Judul Laporan</th>
                    <th class="px-4 py-2 text-left">Kategori</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($laporan)): ?>
                    <?php foreach($laporan as $lpr): ?>
                    <tr class="border-b">
                        <td class="px-4 py-3"><?= $lpr['id_ticket'] ?></td>
                        <td class="px-4 py-3"><?= date('d M Y', strtotime($lpr['created_date'])) ?></td>
                        <td class="px-4 py-3"><?= $lpr['subject'] ?></td>
                        <td class="px-4 py-3"><?= $lpr['category'] ?></td>
                        <td class="px-4 py-3">
                            <?php 
                            $status_color = [
                                'Menunggu' => 'bg-yellow-100 text-yellow-800',
                                'Sedang Proses' => 'bg-blue-100 text-blue-800',
                                'Selesai' => 'bg-green-100 text-green-800',
                                'Batal' => 'bg-red-100 text-green-800'
                            ];
                            ?>
                            <span class="px-3 py-1 rounded-full text-sm <?= $status_color[$lpr['status']] ?>">
                                <?= $lpr['status'] ?>
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <a href="<?= base_url('laporan/detail/' . $lpr['id_ticket']) ?>" 
                               class="text-blue-600 hover:text-blue-900">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-500">
                            Belum ada laporan yang dibuat
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>