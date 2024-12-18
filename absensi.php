<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100 flex">
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
    <div class="flex-1 ml-64 p-8">
        <div class="container mx-auto py-8">
            <h1 class="text-2xl font-bold text-center mb-6">Form Absensi Karyawan</h1>

            <!-- Form Absensi -->
            <form id="attendance-form" class="bg-white p-6 rounded shadow-md">
                <div class="mb-4">
                    <label for="id_karyawan" class="block text-gray-700 font-bold mb-2">ID Karyawan</label>
                    <select id="id_karyawan" name="id_karyawan" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="">Pilih Karyawan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="status_kehadiran" class="block text-gray-700 font-bold mb-2">Status Kehadiran</label>
                    <select id="status_kehadiran" name="status_kehadiran" class="w-full p-2 border border-gray-300 rounded" required>
                        <option value="Hadir">Hadir</option>
                        <option value="Izin">Izin</option>
                        <option value="Sakit">Sakit</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="jam_masuk" class="block text-gray-700 font-bold mb-2">Jam Masuk</label>
                    <input type="time" id="jam_masuk" name="jam_masuk" class="w-full p-2 border border-gray-300 rounded" required>
                </div>

                <div class="mb-4">
                    <label for="jam_keluar" class="block text-gray-700 font-bold mb-2">Jam Keluar</label>
                    <input type="time" id="jam_keluar" name="jam_keluar" class="w-full p-2 border border-gray-300 rounded">
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Absensi</button>
            </form>

            <!-- Tabel Riwayat Absensi -->
            <h2 class="text-xl font-bold mt-8 mb-4">Riwayat Absensi</h2>

            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Nama Karyawan</th>
                        <th class="py-2 px-4 border-b">Tanggal</th>
                        <th class="py-2 px-4 border-b">Status</th>
                        <th class="py-2 px-4 border-b">Clock In</th>
                        <th class="py-2 px-4 border-b">Clock Out</th>
                    </tr>
                </thead>
                <tbody id="attendance-table-body">
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500">Memuat data...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Fungsi untuk mengambil daftar karyawan
        function fetchKaryawan() {
            $.ajax({
                url: 'backend/get_karyawan.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#id_karyawan').empty();
                    response.forEach(function(employee) {
                        $('#id_karyawan').append(
                            `<option value="${employee.id}">${employee.nama}</option>`
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Employee fetch error:', error);
                    alert('Terjadi kesalahan saat memuat karyawan');
                }
            });
        }

        // Fungsi untuk mengambil riwayat absensi
        function fetchAttendanceHistory() {
            $.ajax({
                url: 'backend/get_absen.php',
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const tableBody = $('#attendance-table-body');
                    tableBody.empty();

                    if (response.success && Array.isArray(response.data)) {
                        response.data.forEach(function(record) {
                            tableBody.append(`
                                <tr>
                                    <td class="p-3">${record.nama_karyawan}</td>
                                    <td class="p-3">${record.tanggal_absen}</td>
                                    <td class="p-3">${record.status_kehadiran}</td>
                                    <td class="p-3">${record.jam_masuk}</td>
                                    <td class="p-3">${record.jam_keluar}</td>
                                </tr>
                            `);
                        });
                    } else {
                        tableBody.append(`
                            <tr>
                                <td colspan="5" class="p-3 text-center text-gray-500">Belum ada data absensi.</td>
                            </tr>
                        `);
                    }
                }
            });
        }

        $('#attendance-form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: 'backend/proses_absen.php',
                method: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    console.log('Response:', response); // Tambahkan log di sini
                    if (response.success) {
                        alert('Absensi berhasil disimpan');
                        fetchAttendanceHistory();
                        $('#attendance-form')[0].reset();
                    } else {
                        alert('Gagal menyimpan absensi: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Proses Absen Error:', error);
                    alert('Terjadi kesalahan saat memproses absensi.');
                }
            });
        });

        $(document).ready(function() {
            fetchKaryawan();
            fetchAttendanceHistory();
        });
    </script>
</body>

</html>