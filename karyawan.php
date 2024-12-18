<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Karyawan</title>
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
                    <a href="index.php" class="menu-item block px-6 py-4 hover:bg-blue-700 transition duration-200 
                        flex items-center border-l-4 border-transparent hover:border-white">
                        <i class="fas fa-home mr-4 text-lg"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="#employees" class="menu-item block px-6 py-4 hover:bg-blue-700 transition duration-200 
                        flex items-center border-l-4 border-transparent hover:border-white bg-blue-700">
                        <i class="fas fa-users mr-4 text-lg"></i>
                        <span class="font-medium">Karyawan</span>
                    </a>
                    <a href="divisi.php" class="menu-item block px-6 py-4 hover:bg-blue-700 transition duration-200 
                        flex items-center border-l-4 border-transparent hover:border-white">
                        <i class="fas fa-building mr-4 text-lg"></i>
                        <span class="font-medium">Divisi</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 p-10 bg-gray-100 ml-64">
            <div class="bg-white shadow-lg rounded-xl">
                <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6 flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-white">Daftar Karyawan</h1>
                    <button id="tambah-karyawan" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                        <i class="fas fa-plus mr-2"></i>Tambah Karyawan
                    </button>
                </div>

                <div class="p-6">
                    <div id="employee-list" class="mt-4">
                        <div id="employee-table-container" class="bg-white shadow-md rounded-lg overflow-hidden">
                            <table class="w-full" id="employeeTable">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="p-3 text-left">ID</th>
                                        <th class="p-3 text-left">Nama</th>
                                        <th class="p-3 text-left">Alamat</th>
                                        <th class="p-3 text-left">Nomor Telepon</th>
                                        <th class="p-3 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="employeeTableBody">
                                    <!-- Isi tabel karyawan akan dimasukkan secara dinamis -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Tambah/Edit Karyawan -->
    <div id="employeeModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-xl w-full max-w-md p-6">
            <!-- Header Modal -->
            <div class="flex justify-between items-center mb-4">
                <h2 id="modalTitle" class="text-2xl font-bold">Atur Gaji Karyawan</h2>
                <button id="closeModal" class="text-gray-600 hover:text-gray-800">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <!-- Formulir Karyawan -->
            <form id="employeeForm">
                <input type="hidden" id="karyawan_id" name="karyawan_id">
                <div class="space-y-4">

                    <!-- Input Nama -->
                    <div>
                        <label for="nama" class="block text-gray-700 mb-2">Nama</label>
                        <input type="text" id="nama" name="nama" class="w-full p-2 border rounded" required>
                    </div>

                    <!-- Input Alamat -->
                    <div>
                        <label for="alamat" class="block text-gray-700 mb-2">Alamat</label>
                        <textarea id="alamat" name="alamat" class="w-full p-2 border rounded" required></textarea>
                    </div>

                    <!-- Input Nomor Telepon -->
                    <div>
                        <label for="nomor_telepon" class="block text-gray-700 mb-2">Nomor Telepon</label>
                        <input type="tel" id="nomor_telepon" name="nomor_telepon" class="w-full p-2 border rounded" required>
                    </div>

                    <!-- Input Email -->
                    <div>
                        <label for="email" class="block text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full p-2 border rounded" required>
                    </div>

                    <!-- Pilih Jabatan -->
                    <div>
                        <label for="jabatan" class="block text-gray-700 mb-2">Jabatan</label>
                        <select id="jabatan" name="jabatan" class="w-full p-2 border rounded" required>
                            <option value="" disabled selected>Pilih Jabatan</option>
                        </select>
                    </div>

                    <!-- Input Gaji Pokok -->
                    <div>
                        <label for="gaji_pokok" class="block text-gray-700 mb-2">Gaji Pokok</label>
                        <input type="number" id="gaji_pokok" name="gaji_pokok" class="w-full p-2 border rounded" required min="0">
                    </div>

                    <!-- Data Lembur -->
                    <div>
                        <label for="lembur" class="block text-gray-700 mb-2">Data Lembur</label>
                        <div id="lemburInfo" class="p-2 border rounded bg-gray-50 text-sm text-gray-700">
                            <p>Memuat informasi lembur...</p>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const employeeModal = document.getElementById('employeeModal');
            const closeModalButton = document.getElementById('closeModal');
            const jabatanSelect = document.getElementById('jabatan');
            const lemburInfo = document.getElementById('lemburInfo');
            const employeeForm = document.getElementById('employeeForm');

            // Fungsi untuk membuka modal
            function openModal() {
                employeeModal.classList.remove('hidden');
            }

            // Fungsi untuk menutup modal
            function closeModal() {
                employeeModal.classList.add('hidden');
            }

            // Tutup modal ketika tombol close ditekan
            closeModalButton.addEventListener('click', closeModal);

            // Ambil data jabatan dari API atau endpoint
            function loadJabatan() {
                $.ajax({
                    url: 'backend/get_divisi.php',
                    method: 'GET',
                    success: function(data) {
                        jabatanSelect.innerHTML = '<option value="" disabled selected>Pilih Jabatan</option>';
                        data.forEach(jabatan => {
                            const option = document.createElement('option');
                            option.value = jabatan.id_jabatan;
                            option.textContent = jabatan.nama_jabatan;
                            jabatanSelect.appendChild(option);
                        });
                    },
                    error: function(error) {
                        console.error('Gagal memuat data jabatan:', error);
                    }
                });
            }

            // Ambil informasi lembur dari database
            function loadLemburInfo() {
                $.ajax({
                    url: '/api/get-lembur-info',
                    method: 'GET',
                    success: function(data) {
                        lemburInfo.innerHTML = '';
                        data.forEach(item => {
                            const p = document.createElement('p');
                            p.textContent = `Upah Lembur: Rp ${item.upah_lembur} / jam`;
                            lemburInfo.appendChild(p);
                        });
                    },
                    error: function(error) {
                        lemburInfo.innerHTML = '<p>Gagal memuat data lembur.</p>';
                        console.error('Gagal memuat data lembur:', error);
                    }
                });
            }

            // Ambil data karyawan dari database
            function loadKaryawanData(karyawanId) {
                $.ajax({
                    url: `backend/get_karyawan.php=${karyawanId}`,
                    method: 'GET',
                    success: function(data) {
                        document.getElementById('karyawan_id').value = data.id;
                        document.getElementById('nama').value = data.nama;
                        document.getElementById('alamat').value = data.alamat;
                        document.getElementById('nomor_telepon').value = data.nomor_telepon;
                        document.getElementById('email').value = data.email;
                    },
                    error: function(error) {
                        console.error('Gagal memuat data karyawan:', error);
                    }
                });
            }

            // Panggil fungsi untuk memuat data jabatan dan lembur saat halaman dimuat
            loadJabatan();
            loadLemburInfo();

            // Tambahkan event listener untuk elemen yang mengklik untuk membuka modal
            document.querySelectorAll('.edit-karyawan').forEach(button => {
                button.addEventListener('click', function() {
                    const karyawanId = this.dataset.id;
                    loadKaryawanData(karyawanId);
                    openModal();
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            // Fungsi untuk memuat daftar karyawan
            function loadEmployees() {
                $.ajax({
                    url: 'backend/get_karyawan.php',
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const tableBody = $('#employeeTableBody');
                        tableBody.empty();

                        if (Array.isArray(response)) {
                            if (response.length === 0) {
                                tableBody.html(`
                                <tr>
                                    <td colspan="5" class="text-center p-4 text-gray-500">
                                        Tidak ada data karyawan
                                    </td>
                                </tr>
                            `);
                            } else {
                                response.forEach(function(karyawan) {
                                    tableBody.append(`
                                    <tr class="border-b hover:bg-gray-100">
                                        <td class="p-3">${karyawan.id}</td>
                                        <td class="p-3">${karyawan.nama}</td>
                                        <td class="p-3">${karyawan.alamat || '<span class="text-gray-500">Tidak ada alamat</span>'}</td>
                                        <td class="p-3">${karyawan.nomor_telepon || '<span class="text-gray-500">Tidak ada nomor</span>'}</td>
                                        <td class="p-3 text-center">
                                            <button class="edit-btn text-blue-500 hover:text-blue-700 mr-2" 
                                                    data-id="${karyawan.id}" 
                                                    data-nama="${karyawan.nama}"
                                                    data-alamat="${karyawan.alamat || ''}"
                                                    data-nomor_telepon="${karyawan.nomor_telepon || ''}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="delete-btn text-red-500 hover:text-red-700" 
                                                    data-id="${karyawan.id}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                `);
                                });
                            }
                        } else {
                            tableBody.html(`
                            <tr>
                                <td colspan="5" class="text-center p-4 text-gray-500">
                                    Tidak dapat memuat data karyawan
                                </td>
                            </tr>
                        `);
                        }
                    },
                    error: function() {
                        $('#employeeTableBody').html(`
                        <tr>
                            <td colspan="5" class="text-center p-4 text-red-500">
                                Gagal memuat data karyawan
                            </td>
                        </tr>
                    `);
                    }
                });
            }

            // Muat karyawan saat halaman pertama kali dimuat
            loadEmployees();

            // Tampilkan modal tambah karyawan
            $('#tambah-karyawan').on('click', function() {
                $('#modalTitle').text('Tambah Karyawan');
                $('#karyawan_id').val('');
                $('#nama').val('');
                $('#alamat').val('');
                $('#nomor_telepon').val('');
                $('#employeeModal').removeClass('hidden');
            });

            // Tutup modal
            $('#closeModal').on('click', function() {
                $('#employeeModal').addClass('hidden');
            });

            // Submit form karyawan
            $('#employeeForm').on('submit', function(e) {
                e.preventDefault();
                // Logika submit form akan ditambahkan kemudian
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Fungsionalitas akan diimplementasikan'
                });
                $('#employeeModal').addClass('hidden');
            });

            // Edit karyawan
            $(document).on('click', '.edit-btn', function() {
                const id = $(this).data('id');
                const nama = $(this).data('nama');
                const alamat = $(this).data('alamat');
                const nomorTelepon = $(this).data('nomor_telepon');

                $('#modalTitle').text('Edit Karyawan');
                $('#karyawan_id').val(id);
                $('#nama').val(nama);
                $('#alamat').val(alamat);
                $('#nomor_telepon').val(nomorTelepon);
                $('#employeeModal').removeClass('hidden');
            });

            // Hapus karyawan (untuk demonstrasi)
            $(document).on('click', '.delete-btn', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Konfirmasi Hapus',
                    text: 'Apakah Anda yakin ingin menghapus karyawan ini?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Dihapus!',
                            text: 'Fungsionalitas hapus akan diimplementasikan'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>