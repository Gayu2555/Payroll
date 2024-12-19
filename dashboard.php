<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body class="bg-gray-100 min-h-screen flex font-sans">
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
                <a href="gajian.php" data-section="payroll"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-money-check-alt mr-3"></i>Manajemen & Penggajian
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 flex-1 p-10">
        <!-- Dashboard Section -->
        <section id="dashboard-section" class="dashboard-content">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Dashboard Overview</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Total Karyawan</h2>
                    <p class="text-3xl font-bold text-blue-600" id="total-employees">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Hadir Hari Ini</h2>
                    <p class="text-3xl font-bold text-green-600" id="today-attendance">0</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold mb-4">Total Divisi</h2>
                    <p class="text-3xl font-bold text-purple-600" id="total-divisions">0</p>
                </div>
            </div>
        </section>
        <!-- Employees Section -->
        <section id="employees-section" class="dashboard-content hidden">
            <section>
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Karyawan</h1>
                <form id="add-employee-form" class="bg-white p-8 rounded-lg shadow-md">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_karyawan" class="block text-gray-700 mb-2">Nama Karyawan</label>
                            <input type="text" id="nama_karyawan" name="nama_karyawan"
                                class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="id_divisi" class="block text-gray-700 mb-2">Divisi</label>
                            <select id="id_divisi" name="id_divisi" class="w-full p-3 border rounded-md" required>
                                <option value="">Pilih Divisi</option>
                                <option value="1">IT Staff</option>
                                <option value="3">Operator Produksi</option>
                                <option value="4">Acounting</option>
                                <option value="4">Staff Gudang</option>
                                <option value="5">Quality Controll</option>
                                <option value="6">Payroll</option>
                                <option value="7">HRD</option>
                                <option value="8">K3 Safety</option>
                            </select>
                        </div>
                        <div>
                            <label for="tanggal_masuk" class="block text-gray-700 mb-2">Tanggal Masuk</label>
                            <input type="date" id="tanggal_masuk" name="tanggal_masuk"
                                class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="alamat" class="block text-gray-700 mb-2">Alamat</label>
                            <textarea id="alamat" name="alamat"
                                class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required></textarea>
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email"
                                class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>
                        <div>
                            <label for="no_hp" class="block text-gray-700 mb-2">No HP</label>
                            <input type="text" id="no_hp" name="no_hp"
                                class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                        </div>
                    </div>
                    <button type="submit"
                        class="mt-6 w-full bg-blue-600 text-white p-3 rounded-md hover:bg-blue-700 transition duration-300">
                        Simpan Karyawan
                    </button>
                </form>
            </section>
            <script>
                $(document).ready(function() {

                    // Form validation function with more robust checks
                    function validateFormData(formData) {
                        const errors = [];

                        // Nama Karyawan validation
                        if (!formData.nama_karyawan.trim()) {
                            errors.push('Nama karyawan harus diisi');
                        } else if (formData.nama_karyawan.length < 2) {
                            errors.push('Nama karyawan minimal 2 karakter');
                        }

                        // Divisi validation
                        if (!formData.id_divisi) {
                            errors.push('Divisi harus dipilih');
                        }

                        // Tanggal Masuk validation
                        if (!formData.tanggal_masuk) {
                            errors.push('Tanggal masuk harus diisi');
                        } else {
                            const inputDate = new Date(formData.tanggal_masuk);
                            const currentDate = new Date();
                            if (inputDate > currentDate) {
                                errors.push('Tanggal masuk tidak boleh di masa depan');
                            }
                        }

                        // Alamat validation
                        if (!formData.alamat.trim()) {
                            errors.push('Alamat harus diisi');
                        } else if (formData.alamat.length < 5) {
                            errors.push('Alamat terlalu pendek');
                        }

                        // Email validation
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!formData.email.trim()) {
                            errors.push('Email harus diisi');
                        } else if (!emailRegex.test(formData.email)) {
                            errors.push('Format email tidak valid');
                        }

                        // No HP validation
                        const phoneRegex = /^[0-9]{10,13}$/;
                        if (!formData.no_hp.trim()) {
                            errors.push('Nomor telepon harus diisi');
                        } else if (!phoneRegex.test(formData.no_hp)) {
                            errors.push('Nomor telepon harus 10-13 digit angka');
                        }

                        return errors;
                    }

                    // Form submission handler
                    $('#add-employee-form').on('submit', function(e) {
                        e.preventDefault();

                        // Collect form data
                        const formData = {
                            nama_karyawan: $('#nama_karyawan').val().trim(),
                            id_divisi: $('#id_divisi').val(),
                            tanggal_masuk: $('#tanggal_masuk').val(),
                            alamat: $('#alamat').val().trim(),
                            email: $('#email').val().trim(),
                            no_hp: $('#no_hp').val().trim()
                        };

                        // Validate form data
                        const errors = validateFormData(formData);

                        // Handle validation errors
                        if (errors.length > 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan Validasi',
                                html: errors.map(error => `<p>${error}</p>`).join(''),
                                confirmButtonText: 'Perbaiki'
                            });
                            return;
                        }

                        // Submit form data via AJAX
                        $.ajax({
                            url: 'backend/add_employe.php',
                            method: 'POST',
                            data: formData,
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                if (response.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil',
                                        text: response.message || 'Data karyawan berhasil disimpan',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        $('#add-employee-form')[0].reset();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal',
                                        text: response.message || 'Gagal menyimpan data',
                                        confirmButtonText: 'Tutup'
                                    });
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('Server error:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Kesalahan Server',
                                    text: 'Tidak dapat menghubungi server, masih ada yang salah di divisi yang sama',
                                    confirmButtonText: 'Tutup'
                                });
                            }
                        });
                    });
                });
            </script>
            <!-- Attendance Section -->
            <section id="attendance-section" class="dashboard-content hidden">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Absensi Karyawan</h1>
                <form id="attendance-form" class="bg-white p-8 rounded-lg shadow-md">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="id_karyawan" class="block text-gray-700 mb-2">Pilih Karyawan</label>
                            <select id="id_karyawan" name="id_karyawan"
                                class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                                <!-- Populate dynamically -->
                            </select>
                        </div>
                        <div>
                            <label for="status_kehadiran" class="block text-gray-700 mb-2">Status Kehadiran</label>
                            <select id="status_kehadiran" name="status_kehadiran"
                                class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                required>
                                <option value="Hadir">Hadir</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Izin">Izin</option>
                                <option value="Alpa">Alpa</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit"
                        class="mt-6 w-full bg-green-600 text-white p-3 rounded-md hover:bg-green-700 transition duration-300">
                        Submit Absensi
                    </button>
                </form>
            </section>

            <!-- Divisions Section -->
            <section id="divisions-section" class="dashboard-content hidden">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Divisi</h1>
                <form id="add-division-form" class="bg-white p-8 rounded-lg shadow-md">
                    <div>
                        <label for="nama_divisi" class="block text-gray-700 mb-2">Nama Divisi</label>
                        <input type="text" id="nama_divisi" name="nama_divisi"
                            class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <button type="submit"
                        class="mt-6 w-full bg-yellow-600 text-white p-3 rounded-md hover:bg-yellow-700 transition duration-300">
                        Simpan Divisi
                    </button>
                </form>
            </section>

            <!-- Positions Section -->
            <section id="positions-section" class="dashboard-content hidden">
                <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Jabatan</h1>
                <form id="add-position-form" class="bg-white p-8 rounded-lg shadow-md">
                    <div>
                        <label for="nama_jabatan" class="block text-gray-700 mb-2">Nama Jabatan</label>
                        <input type="text" id="nama_jabatan" name="nama_jabatan"
                            class="w-full p-3 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <button type="submit"
                        class="mt-6 w-full bg-pink-600 text-white p-3 rounded-md hover:bg-pink-700 transition duration-300">
                        Simpan Jabatan
                    </button>
                </form>
            </section>
    </main>
    <style>
        .hidden {
            display: none !important;
        }
    </style>
    <script>
        $(document).ready(function() {
            // Navigation
            $('.menu-item').on('click', function() {
                const targetSection = $(this).data('section'); // Ambil data-section dari menu
                console.log('Menu diklik:', targetSection); // Debugging

                // Sembunyikan semua elemen dengan class dashboard-content
                $('.dashboard-content').addClass('hidden');

                // Tampilkan hanya elemen yang sesuai dengan ID
                $(`#${targetSection}-section`).removeClass('hidden');
            });

            // Load dropdowns
            function loadDropdowns() {
                // Load Jabatan
                $.ajax({
                    url: 'backend/get_jabatan.php',
                    method: 'GET',
                    success: function(data) {
                        let options = '<option value="">Pilih Jabatan</option>';
                        data.forEach(item => {
                            options += `<option value="${item.id}">${item.nama_jabatan}</option>`;
                        });
                        $('#id_jabatan').html(options);
                    },
                    error: function() {
                        console.error('Gagal memuat data jabatan');
                    }
                });

                // Load Divisi


                // Load Karyawan for Attendance
                $.ajax({
                    url: 'backend/get_karyawan.php',
                    method: 'GET',
                    success: function(data) {
                        let options = '<option value="">Pilih Karyawan</option>';
                        data.forEach(item => {
                            options += `<option value="${item.id}">${item.nama_karyawan}</option>`;
                        });
                        $('#id_karyawan').html(options);
                    },
                    error: function() {
                        console.error('Gagal memuat data karyawan');
                    }
                });
            }
            // Dashboard Stats
            function loadDashboardStats() {
                $.ajax({
                    url: 'backend/get_dashboard_statistics.php',
                    method: 'GET',
                    success: function(data) {
                        const stats = JSON.parse(data);
                        $('#total-employees').text(stats.total_employees);
                        $('#today-attendance').text(stats.today_attendance);
                        $('#total-divisions').text(stats.total_divisions);
                    }
                });
            }
            loadDashboardStats();

            // Form Submissions with AJAX and SweetAlert
            $('#attendance-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'backend/attendance.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Absensi berhasil dicatat',
                            timer: 2000
                        });
                        loadDashboardStats();
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mencatat absensi'
                        });
                    }
                });
            });

            $('#add-division-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'backend/add_division.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Divisi berhasil ditambahkan',
                            timer: 2000
                        });
                        loadDropdowns();
                        loadDashboardStats();
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menambahkan divisi'
                        });
                    }
                });
            });

            // Tambahkan form untuk menambah jabatan
            $('#add-position-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'backend/add_position.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Jabatan berhasil ditambahkan',
                            timer: 2000
                        });
                        loadDropdowns();
                        loadDashboardStats();
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat menambahkan jabatan'
                        });
                    }
                });
            });
        });
    </script>