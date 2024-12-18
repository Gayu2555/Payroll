<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Payroll System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body class="bg-gray-100">
    <aside class="w-64 bg-white shadow-lg h-screen fixed left-0 top-0 overflow-y-auto">
        <div class="bg-blue-600 text-white p-5 text-center">
            <h1 class="text-2xl font-bold">Payroll System</h1>
        </div>
        <nav class="mt-5">
            <div class="sidebar-menu">
                <a href="index.php" data-section="dashboard"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-home mr-3"></i>Dashboard
                </a>
                <a href="index.php" data-section="employees"
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
                <!-- New Salary Management Menu Item -->
                <a href="gaji.php" data-section="payroll"
                    class="menu-item block px-5 py-3 hover:bg-blue-100 transition duration-200 
                          text-gray-700 hover:text-blue-600 border-l-4 border-transparent 
                          hover:border-blue-600">
                    <i class="fas fa-money-check-alt mr-3"></i>Penggajian
                </a>
            </div>
        </nav>
    </aside>

    <main class="flex-1 p-10 bg-gray-100 ml-64">
        <div class="bg-white shadow-lg rounded-xl">
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 p-6 flex justify-between items-center">
                <h1 class="text-3xl font-bold text-white">Daftar Karyawan</h1>
                <div class="flex space-x-3">
                    <button id="tambah-karyawan" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300">
                        <i class="fas fa-plus mr-2"></i>Tambah Karyawan
                    </button>
                    <button id="atur-gaji" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600 transition duration-300">
                        <i class="fas fa-money-check-alt mr-2"></i>Atur Gaji
                    </button>
                </div>
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

        <!-- Salary Configuration Modal -->
        <div id="salary-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
            <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6">
                <div class="flex justify-between items-center border-b pb-3 mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Konfigurasi Gaji Karyawan</h2>
                    <button id="close-salary-modal" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <form id="salary-form" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Pilih Karyawan</label>
                            <select class="w-full p-2 border rounded-lg" id="employee-select">
                                <option>Pilih Karyawan</option>
                                <!-- Options will be populated dynamically -->
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Gaji Pokok (Rp)</label>
                            <input type="number" class="w-full p-2 border rounded-lg" placeholder="Masukkan Gaji Pokok">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Tunjangan Jabatan (Rp)</label>
                            <input type="number" class="w-full p-2 border rounded-lg" placeholder="Masukkan Tunjangan Jabatan">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Bonus (Rp)</label>
                            <input type="number" class="w-full p-2 border rounded-lg" placeholder="Masukkan Bonus">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Email Karyawan</label>
                        <input type="email" class="w-full p-2 border rounded-lg" placeholder="Masukkan Email untuk Slip Gaji">
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button type="button" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300">
                            Batal
                        </button>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            Kirim Slip Gaji
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('atur-gaji').addEventListener('click', () => {
            document.getElementById('salary-modal').classList.remove('hidden');
        });

        document.getElementById('close-salary-modal').addEventListener('click', () => {
            document.getElementById('salary-modal').classList.add('hidden');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const employeeSelect = document.getElementById('employee-select');
            const salaryForm = document.getElementById('salary-form');
            const aturGajiButton = document.getElementById('atur-gaji');
            const employeeTableBody = document.getElementById('employeeTableBody');
            const salaryModal = document.getElementById('salary-modal');
            const closeSalaryModalButton = document.getElementById('close-salary-modal');

            // Fungsi untuk memuat daftar karyawan
            function loadEmployees() {
                fetch('backend/salary.php')
                    .then(response => response.json())
                    .then(result => {
                        if (result.status === 'success') {
                            // Isi tabel karyawan
                            employeeTableBody.innerHTML = result.data.map(employee => `
                        <tr>
                            <td class="p-3">${employee.id}</td>
                            <td class="p-3">${employee.nama}</td>
                            <td class="p-3">${employee.alamat}</td>
                            <td class="p-3">${employee.nomor_telepon}</td>
                            <td class="p-3 text-center">
                                <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    `).join('');

                            // Isi dropdown karyawan untuk modal gaji
                            employeeSelect.innerHTML = `
                        <option value="">Pilih Karyawan</option>
                        ${result.data.map(employee => `
                            <option value="${employee.id}">${employee.nama} (${employee.id})</option>
                        `).join('')}
                    `;
                        } else {
                            console.error('Gagal memuat data karyawan:', result.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal memuat data karyawan. Silakan coba lagi.');
                    });
            }

            // Fungsi untuk menangani submit form gaji
            function handleSalarySubmit(event) {
                event.preventDefault();

                // Ambil nilai dari form
                const employeeId = document.querySelector('#employee-select').value;
                const gajiPokok = document.querySelector('input[placeholder="Masukkan Gaji Pokok"]').value;
                const tunjangan = document.querySelector('input[placeholder="Masukkan Tunjangan Jabatan"]').value;
                const bonus = document.querySelector('input[placeholder="Masukkan Bonus"]').value;
                const email = document.querySelector('input[placeholder="Masukkan Email untuk Slip Gaji"]').value;

                // Validasi input
                if (!employeeId || !gajiPokok || !email) {
                    alert('Harap lengkapi semua field yang wajib diisi');
                    return;
                }

                // Data untuk dikirim
                const payloadData = {
                    id_karyawan: parseInt(employeeId),
                    id_jabatan: 1, // Anda perlu mengganti ini dengan logika pengambilan ID jabatan
                    gaji_pokok: parseFloat(gajiPokok),
                    tunjangan: parseFloat(tunjangan || 0),
                    bonus: parseFloat(bonus || 0),
                    email: email
                };

                // Kirim data ke backend
                fetch('backend/salary.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(payloadData)
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.status === 'success') {
                            alert('Gaji berhasil disimpan dan slip gaji dikirim!');
                            salaryModal.classList.add('hidden');
                            // Reset form
                            salaryForm.reset();
                        } else {
                            alert('Gagal menyimpan gaji: ' + result.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    });
            }

            // Event listeners
            aturGajiButton.addEventListener('click', () => {
                salaryModal.classList.remove('hidden');
            });

            closeSalaryModalButton.addEventListener('click', () => {
                salaryModal.classList.add('hidden');
            });

            salaryForm.addEventListener('submit', handleSalarySubmit);

            // Muat daftar karyawan saat halaman dimuat
            loadEmployees();
        });
    </script>
</body>

</html>