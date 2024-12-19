<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tunjangan</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Toast notification library -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <aside class="w-64 bg-white shadow-lg h-screen fixed left-0 top-0 overflow-y-auto">
        <div class="bg-blue-600 text-white p-5 text-center">
            <h1 class="text-2xl font-bold">Payroll System</h1>
        </div>
        <nav class="mt-5">
            <div class="sidebar-menu">
                <a href="index.php" class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-home mr-3"></i>Dashboard
                </a>
                <a href="tambah_karyawan.php" class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-users mr-3"></i>Tambah Karyawan
                </a>
                <a href="absensi.php" class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-calendar-check mr-3"></i>Absensi
                </a>
                <a href="divisi.php" class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-building mr-3"></i>Divisi
                </a>
                <a href="jabatan.php" class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-briefcase mr-3"></i>Jabatan
                </a>
                <a href="karyawan.php" class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-users mr-3"></i>List Karyawan
                </a>
                <a href="gaji.php" class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-money-check-alt mr-3"></i>Penggajian
                </a>
                <a href="manajemen_gaji.php" class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-cog mr-3"></i>Manajemen & Penggajian
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Tunjangan</h2>
                </div>

                <!-- Form Tunjangan -->
                <form id="tunjanganForm" class="space-y-6 bg-gray-50 p-6 rounded-lg">
                    <input type="hidden" id="id_tunjangan" name="id_tunjangan">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700" for="nama_tunjangan">
                                Nama Tunjangan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="nama_tunjangan" name="nama_tunjangan"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                required
                                pattern="[A-Za-z0-9\s]+"
                                title="Hanya huruf, angka dan spasi yang diperbolehkan">
                            <p class="text-red-500 text-xs mt-1 hidden" id="nama_tunjangan_error"></p>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700" for="jumlah_tunjangan">
                                Jumlah Tunjangan <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2.5 text-gray-500">Rp</span>
                                <input type="number" id="jumlah_tunjangan" name="jumlah_tunjangan"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    required
                                    min="0"
                                    step="1000">
                            </div>
                            <p class="text-red-500 text-xs mt-1 hidden" id="jumlah_tunjangan_error"></p>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <button type="button" id="resetForm" class="px-6 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-200 flex items-center">
                            <i class="fas fa-undo mr-2"></i>Reset
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200 flex items-center">
                            <i class="fas fa-save mr-2"></i>Simpan Tunjangan
                        </button>
                    </div>
                </form>

                <!-- Table -->
                <div class="mt-8">
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" data-sort="nama_tunjangan">
                                        Nama Tunjangan <i class="fas fa-sort ml-1"></i>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100" data-sort="jumlah_tunjangan">
                                        Jumlah Tunjangan <i class="fas fa-sort ml-1"></i>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tunjanganTableBody" class="divide-y divide-gray-200">
                                <!-- Will be populated via Ajax -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-4 flex justify-between items-center">
                        <div class="text-sm text-gray-700">
                            Showing <span id="startRecord" class="font-medium">1</span> to
                            <span id="endRecord" class="font-medium">10</span> of
                            <span id="totalRecords" class="font-medium">0</span> entries
                        </div>
                        <div class="flex space-x-2" id="pagination">
                            <!-- Will be populated via Javascript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading Overlay -->
        <div id="loadingOverlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="animate-spin rounded-full h-16 w-16 border-t-2 border-b-2 border-blue-500"></div>
        </div>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            $(document).ready(function() {
                const fetchTunjangan = () => {
                    $.post('backend/i_tunjangan.php', {
                        action: 'fetch'
                    }, function(response) {
                        if (response.status === 'success') {
                            let rows = '';
                            response.data.forEach(row => {
                                rows += `
                            <tr>
                                <td>${row.nama_tunjangan}</td>
                                <td>Rp${parseFloat(row.jumlah_tunjangan).toLocaleString()}</td>
                                <td>
                                    <button class="delete-btn bg-red-600 text-white px-4 py-2 rounded-lg" data-id="${row.id_tunjangan}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        `;
                            });
                            $('#tunjanganTableBody').html(rows);
                        }
                    }, 'json');
                };

                fetchTunjangan();

                $('#tunjanganForm').on('submit', function(e) {
                    e.preventDefault();
                    const data = $(this).serialize() + '&action=save';

                    $.post('backend/i_tunjangan.php', data, function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            fetchTunjangan();
                            $('#tunjanganForm')[0].reset();
                        } else {
                            toastr.error(response.message);
                        }
                    }, 'json');
                });

                $(document).on('click', '.delete-btn', function() {
                    const id = $(this).data('id');
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Data ini akan dihapus secara permanen!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.post('tunjangan.php', {
                                action: 'delete',
                                id_tunjangan: id
                            }, function(response) {
                                if (response.status === 'success') {
                                    toastr.success(response.message);
                                    fetchTunjangan();
                                } else {
                                    toastr.error(response.message);
                                }
                            }, 'json');
                        }
                    });
                });
            });
        </script>


</body>

</html>