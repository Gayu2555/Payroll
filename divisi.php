<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll System</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100 min-h-screen flex font-sans">
    <div class="flex w-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white shadow-2xl">
            <div class="p-6 text-center border-b border-blue-500">
                <h1 class="text-2xl font-bold tracking-wider">
                    <i class="fas fa-chart-line mr-2"></i>Payroll
                </h1>
            </div>
            <nav class="mt-5">
                <div class="sidebar-menu">
                    <a href="index.php" data-section="dashboard" class="menu-item block px-6 py-4 hover:bg-blue-700 transition duration-200 flex items-center border-l-4 border-transparent hover:border-white">
                        <i class="fas fa-home mr-4 text-lg"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="#employees" data-section="employees" class="menu-item block px-6 py-4 hover:bg-blue-700 transition duration-200 flex items-center border-l-4 border-transparent hover:border-white">
                        <i class="fas fa-users mr-4 text-lg"></i>
                        <span class="font-medium">Karyawan</span>
                    </a>
                    <a href="#attendance" data-section="attendance" class="menu-item block px-6 py-4 hover:bg-blue-700 transition duration-200 flex items-center border-l-4 border-transparent hover:border-white">
                        <i class="fas fa-calendar-check mr-4 text-lg"></i>
                        <span class="font-medium">Absensi</span>
                    </a>
                    <a href="#divisions" data-section="divisions" class="menu-item block px-6 py-4 bg-blue-700 flex items-center border-l-4 border-transparent">
                        <i class="fas fa-building mr-4 text-lg"></i>
                        <span class="font-medium">Divisi</span>
                    </a>
                    <a href="#positions" data-section="positions" class="menu-item block px-6 py-4 hover:bg-blue-700 transition duration-200 flex items-center border-l-4 border-transparent hover:border-white">
                        <i class="fas fa-briefcase mr-4 text-lg"></i>
                        <span class="font-medium">Jabatan</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-10 bg-gray-100">
            <div class="max-w-xl mx-auto">
                <div class="bg-white shadow-lg rounded-xl overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6">
                        <h1 class="text-3xl font-bold text-white">Tambah Divisi</h1>
                    </div>
                    <form id="add-division-form" class="p-8">
                        <div class="space-y-4">
                            <div>
                                <label for="nama_divisi" class="block text-gray-700 mb-2 font-semibold">
                                    Nama Divisi
                                </label>
                                <input
                                    type="text"
                                    id="nama_divisi"
                                    name="nama_divisi"
                                    placeholder="Masukkan nama divisi"
                                    class="w-full p-3 border-2 border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                                    required>
                            </div>
                            <button
                                type="submit"
                                class="w-full bg-yellow-500 text-white p-3 rounded-lg hover:bg-yellow-600 transition duration-300 font-bold tracking-wider uppercase shadow-md">
                                Simpan Divisi
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <script>
        $(document).ready(function() {
            $('#add-division-form').on('submit', function(e) {
                e.preventDefault();
                const nama_divisi = $('#nama_divisi').val().trim();

                if (nama_divisi === '') {
                    Swal.fire('Error', 'Nama divisi tidak boleh kosong', 'error');
                    return;
                }

                $.ajax({
                    url: 'backend/add_division.php',
                    type: 'POST',
                    data: {
                        nama_divisi: nama_divisi
                    },
                    success: function(response) {
                        const res = JSON.parse(response);
                        if (res.status === 'success') {
                            Swal.fire('Berhasil', res.message, 'success');
                            $('#add-division-form')[0].reset();
                        } else {
                            Swal.fire('Gagal', res.message, 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Gagal', 'Terjadi kesalahan pada server', 'error');
                    }
                });
            });
        });
    </script>
</body>

</html>