<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Barang Temuan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .form-group>label {
      display: block;
      margin-bottom: 0.5rem;
    }

    .validation-message {
      color: #ef4444;
      font-size: 0.875rem;
      margin-top: 0.25rem;
    }

    .is-invalid {
      border-color: #ef4444 !important;
    }

    .is-invalid:focus {
      box-shadow: 0 0 0 0.2rem rgba(239, 68, 68, 0.25) !important;
    }

    .status-badge {
      display: inline-flex;
      align-items: center;
      padding: 0.25rem 0.75rem;
      font-size: 0.75rem;
      font-weight: 600;
      border-radius: 9999px;
    }

    .table-responsive {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }

    @media (max-width: 1023px) {
      .table-card {
        border: 0;
        box-shadow: none;
      }

      .card-item {
        margin-bottom: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        overflow: hidden;
      }
    }
  </style>
</head>

<body class="bg-gray-100">
  <div class="container mx-auto px-4 py-16 sm:px-6 lg:py-10 lg:px-8">
    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">

      <div class="p-4 md:p-6 lg:p-8 border-b bg-gray-50">
        <h2 class="text-xl md:text-2xl font-bold text-gray-800 flex items-center">
          <i class="bi bi-list-check mr-3 text-blue-600"></i> Status Barang Temuan
        </h2>
      </div>

      <div class="p-4 md:p-6 lg:p-8 space-y-4">
        <?php if ($this->session->flashdata('success')): ?>
          <div class="flex items-center p-4 text-sm text-green-800 rounded-lg bg-green-100 border border-green-200" role="alert">
            <i class="bi bi-check-circle-fill mr-2 flex-shrink-0"></i>
            <div><span class="font-medium">Sukses!</span> <?= $this->session->flashdata('success'); ?></div>
          </div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
          <div class="flex items-center p-4 text-sm text-red-800 rounded-lg bg-red-100 border border-red-200" role="alert">
            <i class="bi bi-exclamation-triangle-fill mr-2 flex-shrink-0"></i>
            <div><span class="font-medium">Error!</span> <?= $this->session->flashdata('error'); ?></div>
          </div>
        <?php endif; ?>
      </div>

      <!-- Filter dan Pencarian -->
      <div class="px-4 md:px-6 lg:px-8 mb-4">
        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex-1">
              <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                  <i class="bi bi-search text-gray-400"></i>
                </div>
                <input type="text" id="searchInput" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Cari barang...">
              </div>
            </div>
            <div class="flex gap-2">
              <select id="statusFilter" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5">
                <option value="">Semua Status</option>
                <option value="Belum diklaim">Belum diklaim</option>
                <option value="Diklaim">Diklaim</option>
                <option value="Karantina">Karantina</option>
              </select>
              <button id="refreshButton" class="flex items-center justify-center bg-blue-100 text-blue-700 hover:bg-blue-200 rounded-lg px-3 py-2.5 transition">
                <i class="bi bi-arrow-clockwise"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="px-4 md:px-6 lg:px-8 pb-8">
        <!-- Desktop view - Table -->
        <div class="hidden lg:block">
          <div class="table-responsive overflow-hidden rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelapor</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($found_items as $item): ?>
                  <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                      <?= $item['id_found']; ?>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center">
                          <i class="bi bi-box text-gray-500"></i>
                        </div>
                        <div class="ml-4">
                          <div class="text-sm font-medium text-gray-900"><?= html_escape($item['item_name']); ?></div>
                          <div class="text-sm text-gray-500 truncate max-w-xs"><?= html_escape(substr($item['description'], 0, 50)) . (strlen($item['description']) > 50 ? '...' : ''); ?></div>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900"><?= html_escape($item['reporter_name']); ?></div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900"><?= date('d M Y', strtotime($item['found_date'])); ?></div>
                      <div class="text-sm text-gray-500"><?= $item['found_time']; ?></div>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <div class="text-sm text-gray-900 max-w-xs truncate" title="<?= html_escape($item['location_found']); ?>"><?= html_escape($item['location_found']); ?></div>
                      <?php if (!empty($item['info'])): ?>
                        <div class="text-xs text-gray-500 italic"><?= html_escape($item['info']); ?></div>
                      <?php endif; ?>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap">
                      <?php if ($this->session->userdata('user_id') == $item['id_user']): ?>
                        <form action="<?= site_url('found/update_status'); ?>" method="post" class="flex items-center space-x-2">
                          <input type="hidden" name="id_found" value="<?= $item['id_found']; ?>">
                          <select name="status" class="text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-1.5">
                            <option value="Belum diklaim" <?= $item['status'] == 'Belum diklaim' ? 'selected' : ''; ?>>Belum diklaim</option>
                            <option value="Diklaim" <?= $item['status'] == 'Diklaim' ? 'selected' : ''; ?>>Diklaim</option>
                            <option value="Karantina" <?= $item['status'] == 'Karantina' ? 'selected' : ''; ?>>Karantina</option>
                          </select>
                          <button type="submit" class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                            Update
                          </button>
                        </form>
                      <?php else: ?>
                        <?php
                        $statusClass = '';
                        $statusIcon = '';

                        switch ($item['status']) {
                          case 'Belum diklaim':
                            $statusClass = 'bg-yellow-100 text-yellow-800';
                            $statusIcon = 'bi-exclamation-circle';
                            break;
                          case 'Diklaim':
                            $statusClass = 'bg-green-100 text-green-800';
                            $statusIcon = 'bi-check-circle';
                            break;
                          case 'Karantina':
                            $statusClass = 'bg-blue-100 text-blue-800';
                            $statusIcon = 'bi-box-seam';
                            break;
                          default:
                            $statusClass = 'bg-gray-100 text-gray-800';
                            $statusIcon = 'bi-question-circle';
                        }
                        ?>
                        <span class="status-badge <?= $statusClass ?>">
                          <i class="bi <?= $statusIcon ?> mr-1"></i>
                          <?= $item['status']; ?>
                        </span>
                      <?php endif; ?>
                    </td>
                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500">
                      <div class="flex space-x-2">
                        <button class="view-details-btn p-1.5 bg-gray-100 text-gray-600 rounded-md hover:bg-gray-200" title="Lihat Detail" data-id="<?= $item['id_found']; ?>">
                          <i class="bi bi-eye"></i>
                        </button>
                        <?php if ($this->session->userdata('user_id') == $item['id_user']): ?>
                          <button class="p-1.5 bg-red-100 text-red-600 rounded-md hover:bg-red-200" title="Hapus">
                            <i class="bi bi-trash"></i>
                          </button>
                        <?php endif; ?>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Mobile view - Cards -->
        <div class="lg:hidden space-y-4">
          <?php foreach ($found_items as $item): ?>
            <div class="card-item bg-white border border-gray-200">
              <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                    <i class="bi bi-box text-gray-500"></i>
                  </div>
                  <div>
                    <h3 class="text-sm font-semibold text-gray-900"><?= html_escape($item['item_name']); ?></h3>
                    <p class="text-xs text-gray-500">ID: <?= $item['id_found']; ?></p>
                  </div>
                </div>
                <?php
                $statusClass = '';
                $statusIcon = '';

                switch ($item['status']) {
                  case 'Belum diklaim':
                    $statusClass = 'bg-yellow-100 text-yellow-800';
                    $statusIcon = 'bi-exclamation-circle';
                    break;
                  case 'Diklaim':
                    $statusClass = 'bg-green-100 text-green-800';
                    $statusIcon = 'bi-check-circle';
                    break;
                  case 'Karantina':
                    $statusClass = 'bg-blue-100 text-blue-800';
                    $statusIcon = 'bi-box-seam';
                    break;
                  default:
                    $statusClass = 'bg-gray-100 text-gray-800';
                    $statusIcon = 'bi-question-circle';
                }
                ?>
                <span class="status-badge <?= $statusClass ?>">
                  <i class="bi <?= $statusIcon ?> mr-1"></i>
                  <?= $item['status']; ?>
                </span>
              </div>
              <div class="p-4 space-y-3">
                <div class="grid grid-cols-2 gap-2">
                  <div>
                    <p class="text-xs text-gray-500">Pelapor</p>
                    <p class="text-sm font-medium"><?= html_escape($item['reporter_name']); ?></p>
                  </div>
                  <div>
                    <p class="text-xs text-gray-500">Tanggal & Waktu</p>
                    <p class="text-sm font-medium"><?= date('d M Y', strtotime($item['found_date'])); ?>, <?= $item['found_time']; ?></p>
                  </div>
                </div>
                <div>
                  <p class="text-xs text-gray-500">Lokasi</p>
                  <p class="text-sm"><?= html_escape($item['location_found']); ?></p>
                  <?php if (!empty($item['info'])): ?>
                    <p class="text-xs text-gray-500 italic"><?= html_escape($item['info']); ?></p>
                  <?php endif; ?>
                </div>
                <div>
                  <p class="text-xs text-gray-500">Deskripsi</p>
                  <p class="text-sm"><?= html_escape(substr($item['description'], 0, 100)) . (strlen($item['description']) > 100 ? '...' : ''); ?></p>
                </div>

                <?php if ($this->session->userdata('user_id') == $item['id_user']): ?>
                  <div class="border-t border-gray-200 pt-3 mt-3">
                    <form action="<?= site_url('found/update_status'); ?>" method="post" class="flex flex-wrap items-center gap-2">
                      <input type="hidden" name="id_found" value="<?= $item['id_found']; ?>">
                      <select name="status" class="flex-1 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 p-2">
                        <option value="Belum diklaim" <?= $item['status'] == 'Belum diklaim' ? 'selected' : ''; ?>>Belum diklaim</option>
                        <option value="Diklaim" <?= $item['status'] == 'Diklaim' ? 'selected' : ''; ?>>Diklaim</option>
                        <option value="Karantina" <?= $item['status'] == 'Karantina' ? 'selected' : ''; ?>>Karantina</option>
                      </select>
                      <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                        <i class="bi bi-save mr-1"></i> Update
                      </button>
                    </form>
                  </div>
                <?php endif; ?>
              </div>
              <div class="px-4 py-3 bg-gray-50 border-t border-gray-200 flex justify-between">
                <span class="text-xs text-gray-500">Dibuat: <?= date('d M Y H:i', strtotime($item['created_at'])); ?></span>
                <div class="flex space-x-2">
                  <button class="view-details-btn p-1.5 bg-gray-100 text-gray-600 rounded-md hover:bg-gray-200" title="Lihat Detail" data-id="<?= $item['id_found']; ?>">
                    <i class="bi bi-eye"></i>
                  </button>
                  <?php if ($this->session->userdata('user_id') == $item['id_user']): ?>
                    <button class="p-1.5 bg-red-100 text-red-600 rounded-md hover:bg-red-200" title="Hapus">
                      <i class="bi bi-trash"></i>
                    </button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <?php if (empty($found_items)): ?>
          <div class="bg-white p-8 text-center rounded-lg border border-gray-200">
            <div class="inline-block p-3 bg-gray-100 rounded-full mb-4">
              <i class="bi bi-search text-gray-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada data</h3>
            <p class="text-gray-500">Belum ada laporan barang ditemukan.</p>
          </div>
        <?php endif; ?>

        <!-- Pagination if needed -->
        <div class="mt-6 flex justify-between items-center">
          <p class="text-sm text-gray-700">
            Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium"><?= count($found_items); ?></span> dari <span class="font-medium"><?= count($found_items); ?></span> item
          </p>
          <div class="flex-1 flex justify-end">
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <i class="bi bi-chevron-left"></i>
              </a>
              <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600 hover:bg-blue-100">
                1
              </a>
              <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Next</span>
                <i class="bi bi-chevron-right"></i>
              </a>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Detail Modal -->
  <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
      <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" id="modalOverlay"></div>

      <div class="relative bg-white rounded-lg max-w-2xl w-full mx-auto shadow-xl overflow-hidden">
        <div class="bg-gray-50 p-4 flex justify-between items-center border-b">
          <h3 class="text-lg font-semibold text-gray-900 flex items-center">
            <i class="bi bi-info-circle mr-2 text-blue-600"></i>
            Detail Barang Temuan
          </h3>
          <button id="closeModal" class="text-gray-400 hover:text-gray-500">
            <i class="bi bi-x-lg"></i>
          </button>
        </div>

        <div class="p-6">
          <div id="modalContent" class="space-y-4">
            <!-- Modal content will be loaded here -->
            <div class="skeleton-loader">
              <div class="animate-pulse space-y-4">
                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                <div class="h-4 bg-gray-200 rounded w-2/3"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-gray-50 px-4 py-3 border-t flex justify-end">
          <button id="closeModalBtn" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Tutup
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Modal functionality
      const detailModal = document.getElementById('detailModal');
      const modalOverlay = document.getElementById('modalOverlay');
      const closeModal = document.getElementById('closeModal');
      const closeModalBtn = document.getElementById('closeModalBtn');
      const viewDetailsBtns = document.querySelectorAll('.view-details-btn');

      function openModal() {
        detailModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }

      function closeModalFunc() {
        detailModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }

      viewDetailsBtns.forEach(btn => {
        btn.addEventListener('click', function() {
          const itemId = this.getAttribute('data-id');
          document.getElementById('modalContent').innerHTML = `
            <div class="text-center p-4">
              <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
              <p class="mt-2 text-gray-600">Memuat data...</p>
            </div>
          `;
          openModal();

          // Here you would normally fetch item details with AJAX
          // For demo purposes, we'll just simulate a delay and show example data
          setTimeout(() => {
            const item = findItemById(itemId);
            if (item) {
              renderItemDetails(item);
            } else {
              document.getElementById('modalContent').innerHTML = `
                <div class="text-center p-4 text-red-600">
                  <i class="bi bi-exclamation-triangle text-4xl"></i>
                  <p class="mt-2">Data tidak ditemukan</p>
                </div>
              `;
            }
          }, 500);
        });
      });

      // Mock function to find an item by ID (replace with real data in production)
      function findItemById(id) {
        // This is where you'd normally fetch data from your server
        // For demo, return mock data
        return {
          id_found: id,
          item_name: "Dompet Hitam",
          reporter_name: "John Doe",
          found_date: "2025-05-15",
          found_time: "14:30",
          location_found: "Gedung A, Lantai 3",
          info: "Dekat pintu masuk utama",
          status: "Belum diklaim",
          description: "Dompet kulit berwarna hitam berisi beberapa kartu dan sejumlah uang tunai.",
          attachments: "dompet1.jpg,dompet2.jpg",
          created_at: "2025-05-15 14:45:22"
        };
      }

      // Render item details in modal
      function renderItemDetails(item) {
        const statusClass = getStatusClass(item.status);
        const statusIcon = getStatusIcon(item.status);

        let attachmentsHtml = '';
        if (item.attachments) {
          const files = item.attachments.split(',');
          attachmentsHtml = `
            <div class="border-t border-gray-200 pt-4 mt-4">
              <h4 class="font-medium text-gray-900 mb-2 flex items-center">
                <i class="bi bi-paperclip mr-2 text-gray-500"></i> Lampiran
              </h4>
              <div class="flex flex-wrap gap-2">
                ${files.map(file => `
                  <div class="relative border border-gray-200 rounded p-1 w-24 h-24">
                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                      <i class="bi bi-file-earmark-image text-2xl text-gray-400"></i>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-xs p-1 truncate text-center">
                      ${file}
                    </div>
                  </div>
                `).join('')}
              </div>
            </div>
          `;
        }

        document.getElementById('modalContent').innerHTML = `
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <h3 class="text-lg font-semibold text-gray-900">${item.item_name}</h3>
              <span class="status-badge ${statusClass}">
                <i class="bi ${statusIcon} mr-1"></i> ${item.status}
              </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm font-medium text-gray-500">ID Laporan</p>
                <p>${item.id_found}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Pelapor</p>
                <p>${item.reporter_name}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Tanggal & Waktu Ditemukan</p>
                <p>${formatDate(item.found_date)} ${item.found_time}</p>
              </div>
              <div>
                <p class="text-sm font-medium text-gray-500">Lokasi Ditemukan</p>
                <p>${item.location_found}</p>
                ${item.info ? `<p class="text-xs text-gray-500 italic">${item.info}</p>` : ''}
              </div>
            </div>
            
            <div>
              <p class="text-sm font-medium text-gray-500">Deskripsi</p>
              <p class="mt-1 text-gray-700">${item.description}</p>
            </div>
            
            ${attachmentsHtml}
            
            <div class="border-t border-gray-200 pt-4 mt-4">
              <p class="text-xs text-gray-500 flex items-center">
                <i class="bi bi-clock-history mr-1"></i>
                Dibuat pada: ${formatDate(item.created_at, true)}
              </p>
            </div>
          </div>
        `;
      }

      function formatDate(dateString, includeTime = false) {
        const date = new Date(dateString);
        const options = {
          year: 'numeric',
          month: 'short',
          day: 'numeric'
        };
        if (includeTime) {
          return date.toLocaleDateString('id-ID', options) + ' ' +
            date.toLocaleTimeString('id-ID', {
              hour: '2-digit',
              minute: '2-digit'
            });
        }
        return date.toLocaleDateString('id-ID', options);
      }

      function getStatusClass(status) {
        switch (status) {
          case 'Belum diklaim':
            return 'bg-yellow-100 text-yellow-800';
          case 'Diklaim':
            return 'bg-green-100 text-green-800';
          case 'Karantina':
            return 'bg-blue-100 text-blue-800';
          default:
            return 'bg-gray-100 text-gray-800';
        }
      }

      function getStatusIcon(status) {
        switch (status) {
          case 'Belum diklaim':
            return 'bi-exclamation-circle';
          case 'Diklaim':
            return 'bi-check-circle';
          case 'Karantina':
            return 'bi-box-seam';
          default:
            return 'bi-question-circle';
        }
      }

      closeModal.addEventListener('click', closeModalFunc);
      closeModalBtn.addEventListener('click', closeModalFunc);
      modalOverlay.addEventListener('click', closeModalFunc);

      // Search and filter functionality
      const searchInput = document.getElementById('searchInput');
      const statusFilter = document.getElementById('statusFilter');
      const refreshButton = document.getElementById('refreshButton');

      function filterItems() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusTerm = statusFilter.value;

        const items = document.querySelectorAll('.hover\\:bg-gray-50, .card-item');

        items.forEach(item => {
          // For desktop rows or mobile cards
          const isDesktopRow = item.tagName === 'TR';

          let itemName, itemStatus;

          if (isDesktopRow) {
            itemName = item.querySelector('td:nth-child(2)').textContent.toLowerCase();
            itemStatus = item.querySelector('td:nth-child(6)').textContent.trim();
          } else {
            itemName = item.querySelector('h3').textContent.toLowerCase();
            itemStatus = item.querySelector('.status-badge').textContent.trim();
          }

          const matchesSearch = searchTerm === '' || itemName.includes(searchTerm);
          const matchesStatus = statusTerm === '' || itemStatus.includes(statusTerm);

          if (matchesSearch && matchesStatus) {
            item.style.display = '';
          } else {
            item.style.display = 'none';
          }
        });

        checkEmptyState();
      }

      function checkEmptyState() {
        const desktopItems = document.querySelectorAll('.hover\\:bg-gray-50');
        const mobileItems = document.querySelectorAll('.card-item');

        let visibleDesktopItems = 0;
        let visibleMobileItems = 0;

        desktopItems.forEach(item => {
          if (item.style.display !== 'none') visibleDesktopItems++;
        });

        mobileItems.forEach(item => {
          if (item.style.display !== 'none') visibleMobileItems++;
        });

        const desktopTableBody = document.querySelector('.table-responsive tbody');
        if (desktopTableBody) {
          if (visibleDesktopItems === 0) {
            if (!document.getElementById('desktop-empty-state')) {
              const emptyRow = document.createElement('tr');
              emptyRow.id = 'desktop-empty-state';
              emptyRow.innerHTML = `
                <td colspan="7" class="px-4 py-8 text-center">
                  <div class="inline-block p-3 bg-gray-100 rounded-full mb-4">
                    <i class="bi bi-search text-gray-400 text-2xl"></i>
                  </div>
                  <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada data</h3>
                  <p class="text-gray-500">Tidak ada item yang sesuai dengan filter.</p>
                </td>
              `;
              desktopTableBody.appendChild(emptyRow);
            }
          } else {
            const emptyState = document.getElementById('desktop-empty-state');
            if (emptyState) emptyState.remove();
          }
        }

        const mobileContainer = document.querySelector('.lg\\:hidden');
        if (mobileContainer) {
          const mobileEmptyState = document.getElementById('mobile-empty-state');

          if (visibleMobileItems === 0) {
            if (!mobileEmptyState) {
              const emptyDiv = document.createElement('div');
              emptyDiv.id = 'mobile-empty-state';
              emptyDiv.className = 'bg-white p-8 text-center rounded-lg border border-gray-200';
              emptyDiv.innerHTML = `
                <div class="inline-block p-3 bg-gray-100 rounded-full mb-4">
                  <i class="bi bi-search text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada data</h3>
                <p class="text-gray-500">Tidak ada item yang sesuai dengan filter.</p>
              `;
              mobileContainer.appendChild(emptyDiv);
            }
          } else {
            if (mobileEmptyState) mobileEmptyState.remove();
          }
        }
      }

      searchInput.addEventListener('input', filterItems);
      statusFilter.addEventListener('change', filterItems);

      refreshButton.addEventListener('click', function() {
        searchInput.value = '';
        statusFilter.value = '';
        filterItems();

        this.classList.add('animate-spin');
        setTimeout(() => {
          this.classList.remove('animate-spin');
        }, 500);
      });

      const deleteButtons = document.querySelectorAll('.bg-red-100.text-red-600');
      deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
          e.preventDefault();
          const confirmed = confirm('Anda yakin ingin menghapus item ini?');
          if (confirmed) {
            alert('Item telah dihapus!');
          }
        });
      });
    });
  </script>
</body>

</html>