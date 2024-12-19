<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Divisi & Gaji</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg h-screen fixed left-0 top-0 overflow-y-auto">
        <div class="bg-blue-600 text-white p-5 text-center">
            <h1 class="text-2xl font-bold">Payroll System</h1>
        </div>
        <nav class="mt-5">
            <div class="sidebar-menu">
                <a href="#dashboard" data-section="dashboard"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-home mr-3"></i>Dashboard
                </a>
                <a href="#employees" data-section="employees"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-users mr-3"></i>Tambah Karyawan
                </a>
                <a href="#attendance" data-section="attendance"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-calendar-check mr-3"></i>Absensi
                </a>
                <a href="divisi.php" data-section="divisions"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-building mr-3"></i>Divisi
                </a>
                <a href="#positions" data-section="positions"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-briefcase mr-3"></i>Jabatan
                </a>
                <a href="karyawan.php" data-section="positions"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-briefcase mr-3"></i>List Karyawan
                </a>
                <a href="gaji.php" data-section="payroll"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-money-check-alt mr-3"></i>Penggajian
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="ml-64 p-8">
        <div class="container">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-blue-600 text-white p-4 rounded-t-lg flex justify-between items-center">
                    <h1 class="text-2xl font-bold">Manajemen Divisi</h1>
                    <button onclick="tambahData()" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                        <i class="bi bi-plus"></i> Tambah Divisi
                    </button>
                </div>

                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2">ID</th>
                                    <th class="px-4 py-2">Nama Divisi</th>
                                    <th class="px-4 py-2">Gaji Pokok</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="dataTable">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Form -->
        <div id="modalForm" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h2 class="text-2xl font-bold text-gray-800" id="modalTitle">Tambah Divisi</h2>
                    <button onclick="tutupModal()" class="text-gray-600 hover:text-gray-900">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                <form id="dataForm" onsubmit="return handleSubmit(event)">
                    <input type="hidden" id="inputId" name="id">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Divisi</label>
                        <input type="text" id="inputNamaDivisi" name="nama_divisi" class="w-full p-2 border rounded-lg" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Gaji Pokok</label>
                        <input type="number" id="inputGajiPokok" name="gaji_pokok" class="w-full p-2 border rounded-lg" required>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" onclick="tutupModal()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Your existing JavaScript code remains the same
        let isEdit = false;

        function loadData() {
            $.ajax({
                url: 'backend/get_divisi.php',
                type: 'GET',
                data: {
                    action: 'get'
                },
                success: function(response) {
                    if (response.data) {
                        let html = '';
                        response.data.forEach(function(item) {
                            html += `
                            <tr>
                                <td class="px-4 py-2">${item.id_divisi}</td>
                                <td class="px-4 py-2">${item.nama_divisi}</td>
                                <td class="px-4 py-2">Rp ${formatNumber(item.gaji_pokok)}</td>
                                <td class="px-4 py-2">
                                    <button onclick="editData('${item.id_divisi}', '${item.nama_divisi}', ${item.gaji_pokok})" 
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded mr-1">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button onclick="hapusData(${item.id_divisi})" 
                                        class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        });
                        $('#dataTable').html(html);
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data: ' + error
                    });
                }
            });
        }

        function formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function tambahData() {
            isEdit = false;
            $('#modalTitle').text('Tambah Divisi');
            $('#dataForm')[0].reset();
            $('#modalForm').removeClass('hidden');
        }

        function editData(id, nama_divisi, gaji_pokok) {
            isEdit = true;
            $('#modalTitle').text('Edit Divisi');
            $('#inputId').val(id);
            $('#inputNamaDivisi').val(nama_divisi);
            $('#inputGajiPokok').val(gaji_pokok);
            $('#modalForm').removeClass('hidden');
        }

        function handleSubmit(event) {
            event.preventDefault();

            const formData = {
                action: isEdit ? 'update' : 'add',
                id_divisi: $('#inputId').val(),
                nama_divisi: $('#inputNamaDivisi').val(),
                gaji_pokok: $('#inputGajiPokok').val()
            };

            $.ajax({
                url: 'backend/simpan_divisi.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });
                        tutupModal();
                        loadData();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.error
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan: ' + error
                    });
                }
            });

            return false;
        }

        function hapusData(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus divisi ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'backend/simpan_divisi.php',
                        type: 'POST',
                        data: {
                            action: 'delete',
                            id_divisi: id
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                loadData();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.error
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Terjadi kesalahan: ' + error
                            });
                        }
                    });
                }
            });
        }

        function tutupModal() {
            $('#modalForm').addClass('hidden');
            $('#dataForm')[0].reset();
        }

        $(document).ready(function() {
            loadData();
        });
    </script>
</body>

</html>