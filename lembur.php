<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Lembur</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="bg-gray-100">
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
                <a href="gajian.php" data-section="payroll"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-money-check-alt mr-3"></i>Manajemen & Penggajian
                </a>
                <a href="gajian.php" data-section="payroll"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-money-check-alt mr-3"></i>Manajemen & Tunjangan
                </a>
                <a href="gajian.php" data-section="payroll"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-money-check-alt mr-3"></i>Manajemen & Lembur
                </a>
            </div>
        </nav>
    </aside>
    <div class="container mx-auto mt-10 p-5 bg-white shadow-lg">
        <h2 class="text-2xl font-bold mb-5">Form Pengaturan Lembur</h2>

        <!-- Form Lembur -->
        <form id="lemburForm" action="backend/simpan_lembur.php" method="POST">
            <div class="mb-4">
                <label for="karyawan" class="block text-gray-700">Pilih Karyawan:</label>
                <select name="id_karyawan" id="karyawan" class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Karyawan --</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="tanggal" class="block text-gray-700">Tanggal Lembur:</label>
                <input type="date" name="tanggal_lembur" id="tanggal" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label for="durasi" class="block text-gray-700">Durasi (Jam):</label>
                <input type="number" name="durasi_jam" id="durasi" class="w-full border rounded px-3 py-2" min="1" required>
            </div>

            <div class="mb-4">
                <label for="tarif" class="block text-gray-700">Tarif per Jam (Rp):</label>
                <input type="number" name="tarif_per_jam" id="tarif" class="w-full border rounded px-3 py-2" min="0" step="0.01" required>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">Simpan</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Fetch karyawan data from get_karyawan.php
            $.ajax({
                url: 'backend/get_karyawan.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        alert('Error: ' + data.error);
                    } else {
                        data.forEach(karyawan => {
                            $('#karyawan').append(
                                `<option value="${karyawan.id}">${karyawan.nama}</option>`
                            );
                        });
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        });
    </script>
</body>

</html>