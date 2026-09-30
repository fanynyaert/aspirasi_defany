<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Aspirasi | Sistem Pengaduan & Aspirasi Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>
</head>
<body class="h-full bg-slate-50 text-slate-800 flex flex-col font-sans antialiased selection:bg-indigo-500 selection:text-white">

    <header class="bg-white border-b border-slate-200 sticky top-0 z-40 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <div class="flex items-center space-x-3 cursor-pointer" onclick="switchView('siswa-form')">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 flex items-center justify-center text-white shadow-md shadow-indigo-200">
                    <i class="fa-solid fa-bullhorn text-lg"></i>
                </div>
                <div>
                    <span class="font-bold text-lg tracking-tight bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">E-Aspirasi</span>
                    <span class="block text-xs font-medium text-slate-400">Sistem Pengaduan Siswa</span>
                </div>
            </div>

            <!-- Role Switcher & Navigation Tabs -->
            <div class="flex items-center space-x-1 sm:space-x-2">
                <div class="bg-slate-100 p-1 rounded-xl flex items-center border border-slate-200">
                    <button onclick="switchRole('siswa')" id="btnRoleSiswa" class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-all flex items-center space-x-2 bg-white text-indigo-600 shadow-sm">
                        <i class="fa-solid fa-user-graduate"></i>
                        <span class="hidden sm:inline">Portal</span> Siswa
                    </button>
                    <button onclick="switchRole('admin')" id="btnRoleAdmin" class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-all flex items-center space-x-2 text-slate-600 hover:text-slate-900">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span class="hidden sm:inline">Dashboard</span> Admin
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- ==================== SISWA VIEW ==================== -->
        <div id="viewSiswa" class="space-y-6">
            <!-- Hero Banner -->
            <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-indigo-900 via-indigo-800 to-violet-900 text-white p-6 sm:p-10 shadow-xl">
                <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="relative z-10 max-w-2xl">
                    <span class="inline-flex items-center space-x-1.5 py-1 px-3 rounded-full text-xs font-semibold bg-white/10 text-indigo-200 mb-4 border border-white/10">
                        <i class="fa-solid fa-sparkles"></i>
                        <span>Transparan, Aman & Cepat</span>
                    </span>
                    <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight mb-3">Suarakan Aspirasi & Laporanmu untuk Sekolah Lebih Baik</h1>
                    <p class="text-indigo-200 text-sm sm:text-base leading-relaxed mb-6">Sampaikan kritik, saran, atau laporan fasilitas rusak secara transparan. Privasi Anda terjaga dan setiap laporan dapat dilacak real-time.</p>
                    
                    <div class="flex flex-wrap gap-3">
                        <button onclick="switchSiswaTab('form')" id="tabBtnForm" class="px-4 py-2.5 rounded-xl font-semibold text-sm bg-white text-indigo-900 shadow-md hover:bg-indigo-50 transition-all flex items-center space-x-2">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>Buat Pengaduan</span>
                        </button>
                        <button onclick="switchSiswaTab('tracking')" id="tabBtnTracking" class="px-4 py-2.5 rounded-xl font-semibold text-sm bg-white/10 hover:bg-white/20 text-white border border-white/20 transition-all flex items-center space-x-2">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span>Lacak Laporan</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Form Pengaduan -->
            <div id="siswaTabForm" class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 animate-fade-in">
                <div class="max-w-2xl mx-auto">
                    <div class="border-b border-slate-100 pb-4 mb-6">
                        <h2 class="text-xl font-bold text-slate-900 flex items-center space-x-2">
                            <i class="fa-solid fa-file-circle-plus text-indigo-600"></i>
                            <span>Formulir Pengaduan / Aspirasi</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">Isi data di bawah dengan jujur dan jelas. Anda dapat memilih untuk mengirimkan secara anonim.</p>
                    </div>

                    <form id="formAspirasi" onsubmit="handleFormSubmit(event)" class="space-y-6">
                        <!-- Kategori -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Kategori Aspirasi / Laporan <span class="text-rose-500">*</span></label>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                <label class="cursor-pointer border border-slate-200 rounded-xl p-3 flex flex-col items-center justify-center text-center hover:border-indigo-500 hover:bg-indigo-50/50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/85 has-[:checked]:text-indigo-900">
                                    <input type="radio" name="kategori" value="Fasilitas Rusak" class="sr-only" required>
                                    <i class="fa-solid fa-wrench text-xl mb-1 text-indigo-600"></i>
                                    <span class="text-xs font-medium">Fasilitas Rusak</span>
                                </label>
                                <label class="cursor-pointer border border-slate-200 rounded-xl p-3 flex flex-col items-center justify-center text-center hover:border-indigo-500 hover:bg-indigo-50/50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/85 has-[:checked]:text-indigo-900">
                                    <input type="radio" name="kategori" value="Kebersihan" class="sr-only">
                                    <i class="fa-solid fa-broom text-xl mb-1 text-emerald-600"></i>
                                    <span class="text-xs font-medium">Kebersihan</span>
                                </label>
                                <label class="cursor-pointer border border-slate-200 rounded-xl p-3 flex flex-col items-center justify-center text-center hover:border-indigo-500 hover:bg-indigo-50/50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/85 has-[:checked]:text-indigo-900">
                                    <input type="radio" name="kategori" value="Kurikulum/Akademik" class="sr-only">
                                    <i class="fa-solid fa-book-open text-xl mb-1 text-amber-600"></i>
                                    <span class="text-xs font-medium">Kurikulum</span>
                                </label>
                                <label class="cursor-pointer border border-slate-200 rounded-xl p-3 flex flex-col items-center justify-center text-center hover:border-indigo-500 hover:bg-indigo-50/50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/85 has-[:checked]:text-indigo-900">
                                    <input type="radio" name="kategori" value="Keamanan" class="sr-only">
                                    <i class="fa-solid fa-shield-halved text-xl mb-1 text-rose-600"></i>
                                    <span class="text-xs font-medium">Keamanan</span>
                                </label>
                                <label class="cursor-pointer border border-slate-200 rounded-xl p-3 flex flex-col items-center justify-center text-center hover:border-indigo-500 hover:bg-indigo-50/50 transition-all has-[:checked]:border-indigo-600 has-[:checked]:bg-indigo-50/85 has-[:checked]:text-indigo-900">
                                    <input type="radio" name="kategori" value="Lainnya" class="sr-only">
                                    <i class="fa-solid fa-circle-question text-xl mb-1 text-purple-600"></i>
                                    <span class="text-xs font-medium">Lainnya</span>
                                </label>
                            </div>
                        </div>

                        <!-- Opsi Identitas -->
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="text-sm font-semibold text-slate-800 block">Kirim sebagai Anonim?</label>
                                    <p class="text-xs text-slate-500">Nama dan kelas Anda akan disembunyikan dari publik.</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="isAnonim" name="isAnonim" onchange="toggleIdentitas()" class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>

                            <div id="identitasContainer" class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-200">
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                                    <input type="text" id="namaPelapor" name="nama" placeholder="cth: Ahmad Fauzi" class="w-full text-sm rounded-xl border border-slate-300 px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 mb-1">Kelas</label>
                                    <input type="text" id="kelasPelapor" name="kelas" placeholder="cth: XI IPA 2" class="w-full text-sm rounded-xl border border-slate-300 px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                                </div>
                            </div>
                        </div>

                        <!-- Subjek / Judul -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Judul / Subjek Singkat <span class="text-rose-500">*</span></label>
                            <input type="text" name="judul" required placeholder="cth: AC di Ruang Kelas XII IPA 1 Tidak Dingin" class="w-full text-sm rounded-xl border border-slate-300 px-3.5 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <!-- Isi Pesan -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-1">Isi Pengaduan / Aspirasi <span class="text-rose-500">*</span></label>
                            <textarea name="pesan" rows="4" required placeholder="Jelaskan detail kejadian, lokasi, atau saran secara jelas..." class="w-full text-sm rounded-xl border border-slate-300 p-3.5 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                        </div>

                        <!-- Tombol Submit -->
                        <button type="submit" class="w-full py-3 px-4 rounded-xl font-semibold text-sm bg-indigo-600 text-white hover:bg-indigo-700 shadow-lg shadow-indigo-200 transition-all flex items-center justify-center space-x-2">
                            <i class="fa-solid fa-paper-plane"></i>
                            <span>Kirim Pengaduan Sekarang</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Tab Content: Tracking Pelacakan -->
            <div id="siswaTabTracking" class="hidden space-y-6 animate-fade-in">
                <div class="bg-white rounded-3xl border border-slate-200 shadow-sm p-6 sm:p-8 max-w-2xl mx-auto">
                    <div class="border-b border-slate-100 pb-4 mb-6">
                        <h2 class="text-xl font-bold text-slate-900 flex items-center space-x-2">
                            <i class="fa-solid fa-magnifying-glass text-indigo-600"></i>
                            <span>Lacak Status Laporan</span>
                        </h2>
                        <p class="text-xs text-slate-500 mt-1">Masukkan kode unik (token) yang Anda dapatkan saat mengirimkan laporan untuk melihat status real-time.</p>
                    </div>

                    <div class="flex gap-2 mb-6">
                        <div class="relative flex-grow">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-ticket"></i>
                            </span>
                            <input type="text" id="inputToken" placeholder="cth: ASP-84920" class="w-full text-sm rounded-xl border border-slate-300 pl-10 pr-3.5 py-3 uppercase tracking-wider font-mono focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                        <button onclick="trackLaporan()" class="px-5 py-3 rounded-xl font-semibold text-sm bg-indigo-600 text-white hover:bg-indigo-700 transition-all flex items-center space-x-2 shrink-0">
                            <span>Lacak</span>
                        </button>
                    </div>

                    <!-- Riwayat Token Tersimpan di Browser -->
                    <div id="savedTokensSection" class="mb-6 pt-4 border-t border-slate-100">
                        <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider block mb-2">Token Laporan Anda di Perangkat Ini:</span>
                        <div id="listSavedTokens" class="flex flex-wrap gap-2">
                            <!-- Injected via JS -->
                        </div>
                    </div>

                    <!-- Hasil Tracking -->
                    <div id="trackingResult" class="hidden mt-6 pt-6 border-t border-slate-100">
                        <!-- Detail Laporan akan muncul disini -->
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== ADMIN VIEW ==================== -->
        <div id="viewAdmin" class="hidden space-y-6">
            <!-- Header Admin -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
                <div>
                    <span class="text-xs font-bold text-indigo-600 uppercase tracking-wider">Admin Panel</span>
                    <h1 class="text-2xl font-extrabold text-slate-900">Dashboard Pengelolaan Aspirasi</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <button onclick="resetDataDummy()" class="px-4 py-2 text-xs font-semibold rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 transition-all flex items-center space-x-2">
                        <i class="fa-solid fa-rotate-right"></i>
                        <span>Reset Data Demo</span>
                    </button>
                </div>
            </div>

            <!-- Statistik Ringkas -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-slate-400 block mb-1">Total Laporan</span>
                        <span id="statTotal" class="text-2xl font-extrabold text-slate-900">0</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-folder-open"></i>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-amber-500 block mb-1">Menunggu</span>
                        <span id="statMenunggu" class="text-2xl font-extrabold text-slate-900">0</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-blue-500 block mb-1">Diproses</span>
                        <span id="statDiproses" class="text-2xl font-extrabold text-slate-900">0</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-spinner"></i>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between">
                    <div>
                        <span class="text-xs font-semibold text-emerald-500 block mb-1">Selesai</span>
                        <span id="statSelesai" class="text-2xl font-extrabold text-slate-900">0</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
            </div>

            <!-- Tabel Daftar Laporan -->
            <div class="bg-white rounded-3xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-900">Semua Laporan Masuk</h2>
                        <p class="text-xs text-slate-500">Kelola status dan berikan tanggapan resmi dari pihak sekolah.</p>
                    </div>
                    <!-- Filter Kategori & Status -->
                    <div class="flex flex-wrap gap-2">
                        <select id="filterStatus" onchange="renderAdminTable()" class="text-xs rounded-xl border border-slate-300 px-3 py-2 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 font-medium">
                            <option value="ALL">Semua Status</option>
                            <option value="Menunggu">Menunggu</option>
                            <option value="Diproses">Diproses</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 text-xs font-bold uppercase tracking-wider">
                                <th class="py-4 px-6">Token & Tanggal</th>
                                <th class="py-4 px-6">Pelapor</th>
                                <th class="py-4 px-6">Kategori & Judul</th>
                                <th class="py-4 px-6">Status</th>
                                <th class="py-4 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="adminTableBody" class="divide-y divide-slate-100 text-sm">
                            <!-- Data Injected via JS -->
                        </tbody>
                    </table>
                </div>
                <div id="emptyAdminTable" class="hidden p-12 text-center text-slate-400">
                    <i class="fa-solid fa-folder-open text-4xl mb-3"></i>
                    <p class="text-sm font-medium">Belum ada laporan yang sesuai.</p>
                </div>
            </div>
        </div>

    </main>

    <!-- ==================== MODAL SUKSES SUBMIT (TOKEN) ==================== -->
    <div id="modalSuccess" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-md w-full p-6 sm:p-8 shadow-2xl animate-fade-in text-center">
            <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl mx-auto mb-4">
                <i class="fa-solid fa-check"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900 mb-1">Aspirasi Berhasil Dikirim!</h3>
            <p class="text-xs text-slate-500 mb-6">Simpan kode token unik di bawah ini untuk melacak perkembangan laporan Anda.</p>
            
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-4 mb-6">
                <span class="text-xs font-semibold text-slate-400 block mb-1">KODE TOKEN UNIK ANDA</span>
                <span id="generatedTokenText" class="font-mono text-2xl font-extrabold text-indigo-600 tracking-wider">ASP-XXXXX</span>
            </div>

            <div class="flex gap-3">
                <button onclick="copyTokenToClipboard()" class="flex-1 py-2.5 px-4 rounded-xl font-semibold text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 transition-all flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-copy"></i>
                    <span>Salin Token</span>
                </button>
                <button onclick="closeSuccessModalAndTrack()" class="flex-1 py-2.5 px-4 rounded-xl font-semibold text-xs bg-indigo-600 hover:bg-indigo-700 text-white transition-all flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span>Lacak Sekarang</span>
                </button>
            </div>
        </div>
    </div>

    <!-- ==================== MODAL ADMIN TANGGAPAN & STATUS ==================== -->
    <div id="modalAdminEdit" class="fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-sm hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl animate-fade-in">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <div>
                    <span id="editModalTokenLabel" class="text-xs font-mono font-bold text-indigo-600">ASP-XXXXX</span>
                    <h3 class="text-lg font-bold text-slate-900">Kelola Pengaduan Siswa</h3>
                </div>
                <button onclick="closeAdminModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="formAdminEdit" onsubmit="handleAdminSave(event)" class="space-y-4">
                <input type="hidden" id="editReportId">
                
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Ubah Status Laporan</label>
                    <select id="editStatusSelect" class="w-full text-sm rounded-xl border border-slate-300 px-3.5 py-2.5 bg-white font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        <option value="Menunggu">Menunggu</option>
                        <option value="Diproses">Diproses</option>
                        <option value="Selesai">Selesai</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggapan / Respon Resmi Admin</label>
                    <textarea id="editTanggapanInput" rows="4" placeholder="Tuliskan tindak lanjut atau tanggapan dari pihak sekolah..." class="w-full text-sm rounded-xl border border-slate-300 p-3.5 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeAdminModal()" class="flex-1 py-2.5 px-4 rounded-xl font-semibold text-xs bg-slate-100 hover:bg-slate-200 text-slate-700 transition-all">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 py-2.5 px-4 rounded-xl font-semibold text-xs bg-indigo-600 hover:bg-indigo-700 text-white transition-all shadow-md shadow-indigo-200">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Data Dummy Awal
        const initialReports = [
            {
                id: "ASP-94821",
                kategori: "Fasilitas Rusak",
                isAnonim: false,
                nama: "Budi Santoso",
                kelas: "XII IPA 1",
                judul: "Proyektor di Lab Komputer 2 Mati Total",
                pesan: "Saat jam pelajaran TIK kemarin, proyektor di Lab Komputer 2 tidak mau nyala meski sudah dicolok ulang kabelnya.",
                status: "Diproses",
                tanggapan: "Tim sarpras sudah menerima laporan dan sedang menjadwalkan pengecekan lampu proyektor.",
                tanggal: "2026-06-10 08:30"
            },
            {
                id: "ASP-83719",
                kategori: "Kebersihan",
                isAnonim: true,
                nama: "Anonim",
                kelas: "-",
                judul: "Kran Air Toilet Siswa Lantai 2 Rusak",
                pesan: "Kran air di toilet lantai 2 gedung utara bocor terus menerus, air terbuang sia-sia dan lantai licin.",
                status: "Selesai",
                tanggapan: "Sudah diperbaiki oleh petugas kebersihan dan maintenance per tanggal 11 Juni.",
                tanggal: "2026-06-09 10:15"
            },
            {
                id: "ASP-12940",
                kategori: "Kurikulum/Akademik",
                isAnonim: false,
                nama: "Siti Rahma",
                kelas: "XI IPS 3",
                judul: "Jadwal Ujian Susulan Belum Keluar",
                pesan: "Mohon info terkait jadwal ujian susulan matematika kemarin karena saya sakit waktu itu.",
                status: "Menunggu",
                tanggapan: "",
                tanggal: "2026-06-11 14:00"
            }
        ];

        // Load & Save Storage helper
        function getReports() {
            const data = localStorage.getItem('e_aspirasi_reports');
            if (!data) {
                localStorage.setItem('e_aspirasi_reports', JSON.stringify(initialReports));
                return initialReports;
            }
            return JSON.parse(data);
        }

        function saveReports(reports) {
            localStorage.setItem('e_aspirasi_reports', JSON.stringify(reports));
        }

        function getSavedTokens() {
            const tokens = localStorage.getItem('e_aspirasi_my_tokens');
            return tokens ? JSON.parse(tokens) : [];
        }

        function addSavedToken(token) {
            let tokens = getSavedTokens();
            if (!tokens.includes(token)) {
                tokens.unshift(token);
                localStorage.setItem('e_aspirasi_my_tokens', JSON.stringify(tokens));
            }
        }

        // State & Navigation Switchers
        function switchRole(role) {
            const btnSiswa = document.getElementById('btnRoleSiswa');
            const btnAdmin = document.getElementById('btnRoleAdmin');
            const viewSiswa = document.getElementById('viewSiswa');
            const viewAdmin = document.getElementById('viewAdmin');

            if (role === 'siswa') {
                btnSiswa.className = "px-3 py-1.5 text-xs font-semibold rounded-lg transition-all flex items-center space-x-2 bg-white text-indigo-600 shadow-sm";
                btnAdmin.className = "px-3 py-1.5 text-xs font-semibold rounded-lg transition-all flex items-center space-x-2 text-slate-600 hover:text-slate-900";
                viewSiswa.classList.remove('hidden');
                viewAdmin.classList.add('hidden');
            } else {
                btnAdmin.className = "px-3 py-1.5 text-xs font-semibold rounded-lg transition-all flex items-center space-x-2 bg-white text-indigo-600 shadow-sm";
                btnSiswa.className = "px-3 py-1.5 text-xs font-semibold rounded-lg transition-all flex items-center space-x-2 text-slate-600 hover:text-slate-900";
                viewAdmin.classList.remove('hidden');
                viewSiswa.classList.add('hidden');
                renderAdminDashboard();
            }
        }

        function switchView(viewName) {
            switchRole('siswa');
            switchSiswaTab('form');
        }

        function switchSiswaTab(tab) {
            const tabBtnForm = document.getElementById('tabBtnForm');
            const tabBtnTracking = document.getElementById('tabBtnTracking');
            const siswaTabForm = document.getElementById('siswaTabForm');
            const siswaTabTracking = document.getElementById('siswaTabTracking');

            if (tab === 'form') {
                tabBtnForm.className = "px-4 py-2.5 rounded-xl font-semibold text-sm bg-white text-indigo-900 shadow-md hover:bg-indigo-50 transition-all flex items-center space-x-2";
                tabBtnTracking.className = "px-4 py-2.5 rounded-xl font-semibold text-sm bg-white/10 hover:bg-white/20 text-white border border-white/20 transition-all flex items-center space-x-2";
                siswaTabForm.classList.remove('hidden');
                siswaTabTracking.classList.add('hidden');
            } else {
                tabBtnTracking.className = "px-4 py-2.5 rounded-xl font-semibold text-sm bg-white text-indigo-900 shadow-md hover:bg-indigo-50 transition-all flex items-center space-x-2";
                tabBtnForm.className = "px-4 py-2.5 rounded-xl font-semibold text-sm bg-white/10 hover:bg-white/20 text-white border border-white/20 transition-all flex items-center space-x-2";
                siswaTabTracking.classList.remove('hidden');
                siswaTabForm.classList.add('hidden');
                renderSavedTokensList();
            }
        }

        function toggleIdentitas() {
            const isAnonim = document.getElementById('isAnonim').checked;
            const container = document.getElementById('identitasContainer');
            const namaInput = document.getElementById('namaPelapor');
            const kelasInput = document.getElementById('kelasPelapor');

            if (isAnonim) {
                container.style.opacity = "0.4";
                namaInput.value = "";
                kelasInput.value = "";
                namaInput.disabled = true;
                kelasInput.disabled = true;
                namaInput.required = false;
                kelasInput.required = false;
            } else {
                container.style.opacity = "1";
                namaInput.disabled = false;
                kelasInput.disabled = false;
                namaInput.required = true;
                kelasInput.required = true;
            }
        }

        // Form Submit Handler
        let lastGeneratedToken = "";
        function handleFormSubmit(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            const kategori = formData.get('kategori');
            const isAnonim = document.getElementById('isAnonim').checked;
            const nama = isAnonim ? "Anonim" : formData.get('nama');
            const kelas = isAnonim ? "-" : formData.get('kelas');
            const judul = formData.get('judul');
            const pesan = formData.get('pesan');

            const randomNum = Math.floor(10000 + Math.random() * 90000);
            const newToken = `ASP-${randomNum}`;
            lastGeneratedToken = newToken;

            const now = new Date();
            const dateStr = now.toISOString().slice(0, 10) + ' ' + now.toTimeString().slice(0, 5);

            const newReport = {
                id: newToken,
                kategori,
                isAnonim,
                nama,
                kelas,
                judul,
                pesan,
                status: "Menunggu",
                tanggapan: "",
                tanggal: dateStr
            };

            const reports = getReports();
            reports.unshift(newReport);
            saveReports(reports);
            addSavedToken(newToken);

            form.reset();
            document.getElementById('isAnonim').checked = false;
            toggleIdentitas();

            // Show success modal
            document.getElementById('generatedTokenText').innerText = newToken;
            document.getElementById('modalSuccess').classList.remove('hidden');
        }

        function copyTokenToClipboard() {
            const text = lastGeneratedToken;
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(() => {
                    alertCustom("Token berhasil disalin ke clipboard!");
                });
            } else {
                const textArea = document.createElement("textarea");
                textArea.value = text;
                document.body.appendChild(textArea);
                textArea.select();
                try {
                    document.execCommand('copy');
                    alertCustom("Token berhasil disalin ke clipboard!");
                } catch (err) {
                    console.error('Gagal menyalin', err);
                }
                document.body.removeChild(textArea);
            }
        }

        function alertCustom(msg) {
            // Friendly inline alert simulation or standard notification
            const notif = document.createElement('div');
            notif.className = "fixed bottom-5 right-5 z-50 bg-slate-900 text-white text-xs px-4 py-3 rounded-xl shadow-xl flex items-center space-x-2 animate-fade-in";
            notif.innerHTML = `<i class="fa-solid fa-circle-check text-emerald-400"></i><span>${msg}</span>`;
            document.body.appendChild(notif);
            setTimeout(() => notif.remove(), 3000);
        }

        function closeSuccessModalAndTrack() {
            document.getElementById('modalSuccess').classList.add('hidden');
            switchSiswaTab('tracking');
            document.getElementById('inputToken').value = lastGeneratedToken;
            trackLaporan();
        }

        // Tracking Logic
        function renderSavedTokensList() {
            const listDiv = document.getElementById('listSavedTokens');
            const tokens = getSavedTokens();
            if (tokens.length === 0) {
                listDiv.innerHTML = `<span class="text-xs text-slate-400 italic">Belum ada token tersimpan di perangkat ini.</span>`;
                return;
            }

            listDiv.innerHTML = tokens.map(t => `
                <button onclick="selectToken('${t}')" class="px-3 py-1.5 rounded-lg border border-slate-200 bg-slate-50 hover:bg-indigo-50 hover:border-indigo-300 font-mono text-xs font-bold text-slate-700 transition-all flex items-center space-x-1.5">
                    <i class="fa-solid fa-ticket text-indigo-500"></i>
                    <span>${t}</span>
                </button>
            `).join('');
        }

        function selectToken(token) {
            document.getElementById('inputToken').value = token;
            trackLaporan();
        }

        function trackLaporan() {
            const tokenInput = document.getElementById('inputToken').value.trim().toUpperCase();
            const resultDiv = document.getElementById('trackingResult');

            if (!tokenInput) {
                resultDiv.innerHTML = `<div class="p-4 bg-rose-50 text-rose-600 rounded-xl text-xs font-medium">Mohon masukkan kode token pelacakan terlebih dahulu.</div>`;
                resultDiv.classList.remove('hidden');
                return;
            }

            const reports = getReports();
            const report = reports.find(r => r.id === tokenInput);

            if (!report) {
                resultDiv.innerHTML = `<div class="p-4 bg-rose-50 text-rose-600 rounded-xl text-xs font-medium"><i class="fa-solid fa-circle-exclamation mr-1"></i> Laporan dengan token <b>${tokenInput}</b> tidak ditemukan. Periksa kembali kode Anda.</div>`;
                resultDiv.classList.remove('hidden');
                return;
            }

            // Workflow status mapping
            let statusBadge = "";
            let stepMenunggu = "opacity-40";
            let stepDiproses = "opacity-40";
            let stepSelesai = "opacity-40";

            if (report.status === "Menunggu") {
                statusBadge = `<span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">Menunggu</span>`;
                stepMenunggu = "text-amber-600 font-bold opacity-100";
            } else if (report.status === "Diproses") {
                statusBadge = `<span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">Diproses</span>`;
                stepMenunggu = "text-slate-400 opacity-60";
                stepDiproses = "text-blue-600 font-bold opacity-100";
            } else if (report.status === "Selesai") {
                statusBadge = `<span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Selesai</span>`;
                stepMenunggu = "text-slate-400 opacity-60";
                stepDiproses = "text-slate-400 opacity-60";
                stepSelesai = "text-emerald-600 font-bold opacity-100";
            }

            resultDiv.innerHTML = `
                <div class="space-y-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div>
                            <span class="text-xs font-mono font-bold text-indigo-600">${report.id}</span>
                            <h3 class="text-base font-bold text-slate-900 mt-0.5">${report.judul}</h3>
                        </div>
                        <div>${statusBadge}</div>
                    </div>

                    <!-- Workflow Progress Bar -->
                    <div class="grid grid-cols-3 gap-2 bg-slate-50 p-4 rounded-2xl border border-slate-200 text-center text-xs">
                        <div class="${stepMenunggu} flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center mb-1 shadow-sm">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <span>1. Menunggu</span>
                        </div>
                        <div class="${stepDiproses} flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center mb-1 shadow-sm">
                                <i class="fa-solid fa-spinner"></i>
                            </div>
                            <span>2. Diproses</span>
                        </div>
                        <div class="${stepSelesai} flex flex-col items-center">
                            <div class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center mb-1 shadow-sm">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <span>3. Selesai</span>
                        </div>
                    </div>

                    <!-- Detail Info -->
                    <div class="space-y-3 text-xs">
                        <div class="flex justify-between py-1.5 border-b border-slate-100">
                            <span class="text-slate-400">Kategori</span>
                            <span class="font-semibold text-slate-800">${report.kategori}</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-slate-100">
                            <span class="text-slate-400">Pelapor</span>
                            <span class="font-semibold text-slate-800">${report.nama} ${report.kelas !== '-' ? '('+report.kelas+')' : ''}</span>
                        </div>
                        <div class="flex justify-between py-1.5 border-b border-slate-100">
                            <span class="text-slate-400">Waktu Laporan</span>
                            <span class="font-semibold text-slate-800">${report.tanggal}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block mb-1">Isi Pesan:</span>
                            <p class="p-3 bg-slate-50 rounded-xl text-slate-700 leading-relaxed border border-slate-200">${report.pesan}</p>
                        </div>
                    </div>

                    <!-- Tanggapan Admin -->
                    <div class="p-4 bg-indigo-50/60 border border-indigo-100 rounded-2xl">
                        <div class="flex items-center space-x-2 mb-2 text-indigo-900 font-bold text-xs">
                            <i class="fa-solid fa-shield-halved text-indigo-600"></i>
                            <span>Tanggapan Resmi Pihak Sekolah</span>
                        </div>
                        <p class="text-xs text-slate-700 leading-relaxed">
                            ${report.tanggapan ? report.tanggapan : '<span class="italic text-slate-400">Belum ada tanggapan dari admin. Laporan sedang dalam antrean peninjauan.</span>'}
                        </p>
                    </div>
                </div>
            `;
            resultDiv.classList.remove('hidden');
        }

        // Admin Dashboard Logic
        function renderAdminDashboard() {
            const reports = getReports();

            // Hitung Statistik
            const total = reports.length;
            const menunggu = reports.filter(r => r.status === "Menunggu").length;
            const diproses = reports.filter(r => r.status === "Diproses").length;
            const selesai = reports.filter(r => r.status === "Selesai").length;

            document.getElementById('statTotal').innerText = total;
            document.getElementById('statMenunggu').innerText = menunggu;
            document.getElementById('statDiproses').innerText = diproses;
            document.getElementById('statSelesai').innerText = selesai;

            renderAdminTable();
        }

        function renderAdminTable() {
            const reports = getReports();
            const filterStatus = document.getElementById('filterStatus').value;
            const tbody = document.getElementById('adminTableBody');
            const emptyState = document.getElementById('emptyAdminTable');

            let filtered = reports;
            if (filterStatus !== "ALL") {
                filtered = reports.filter(r => r.status === filterStatus);
            }

            if (filtered.length === 0) {
                tbody.innerHTML = "";
                emptyState.classList.remove('hidden');
                return;
            }

            emptyState.classList.add('hidden');
            tbody.innerHTML = filtered.map(r => {
                let statusBadge = "";
                if (r.status === "Menunggu") statusBadge = `<span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">Menunggu</span>`;
                else if (r.status === "Diproses") statusBadge = `<span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700">Diproses</span>`;
                else if (r.status === "Selesai") statusBadge = `<span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Selesai</span>`;

                return `
                    <tr class="hover:bg-slate-50/80 transition-all">
                        <td class="py-4 px-6 font-mono">
                            <span class="font-bold text-indigo-600 block text-xs">${r.id}</span>
                            <span class="text-[11px] text-slate-400">${r.tanggal}</span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-semibold text-slate-800 block text-xs">${r.nama}</span>
                            <span class="text-[11px] text-slate-400">${r.kelas}</span>
                        </td>
                        <td class="py-4 px-6 max-w-xs">
                            <span class="inline-block px-2 py-0.5 rounded text-[10px] font-semibold bg-slate-100 text-slate-600 mb-1">${r.kategori}</span>
                            <span class="font-semibold text-slate-800 block text-xs truncate">${r.judul}</span>
                        </td>
                        <td class="py-4 px-6">
                            ${statusBadge}
                        </td>
                        <td class="py-4 px-6 text-right">
                            <button onclick="openAdminEditModal('${r.id}')" class="px-3 py-1.5 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-600 font-semibold text-xs transition-all inline-flex items-center space-x-1.5">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span>Kelola</span>
                            </button>
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function openAdminEditModal(id) {
            const reports = getReports();
            const report = reports.find(r => r.id === id);
            if (!report) return;

            document.getElementById('editReportId').value = report.id;
            document.getElementById('editModalTokenLabel').innerText = report.id;
            document.getElementById('editStatusSelect').value = report.status;
            document.getElementById('editTanggapanInput').value = report.tanggapan || "";
            document.getElementById('modalAdminEdit').classList.remove('hidden');
        }

        function closeAdminModal() {
            document.getElementById('modalAdminEdit').classList.add('hidden');
        }

        function handleAdminSave(e) {
            e.preventDefault();
            const id = document.getElementById('editReportId').value;
            const newStatus = document.getElementById('editStatusSelect').value;
            const newTanggapan = document.getElementById('editTanggapanInput').value.trim();

            let reports = getReports();
            const index = reports.findIndex(r => r.id === id);
            if (index !== -1) {
                reports[index].status = newStatus;
                reports[index].tanggapan = newTanggapan;
                saveReports(reports);
                closeAdminModal();
                renderAdminDashboard();
                alertCustom("Perubahan laporan berhasil disimpan!");
            }
        }

        function resetDataDummy() {
            if (confirm("Reset seluruh data laporan ke demo awal?")) {
                localStorage.setItem('e_aspirasi_reports', JSON.stringify(initialReports));
                localStorage.removeItem('e_aspirasi_my_tokens');
                renderAdminDashboard();
                alertCustom("Data berhasil di-reset ke data demo awal.");
            }
        }

        // Initialize on load
        window.onload = function() {
            getReports(); // Ensure default storage
        };
    </script>
</body>
</html>