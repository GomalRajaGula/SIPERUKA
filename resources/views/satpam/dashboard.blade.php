@extends('layouts.app')

@section('title', 'Dashboard Satpam')

@section('content')
<!-- html5-qrcode library -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<div class="space-y-8">

    <!-- HEADER / WELCOME SECTION -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-2xl font-extrabold tracking-tight text-slate-900">Selamat datang, SATPAM!</h3>
            <p class="text-xs text-slate-400 mt-1 font-semibold font-sans uppercase tracking-wider">Sistem Informasi Perizinan Ruangan PNC</p>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Card: Total Diizinkan Hari Ini --}}
        <div class="bg-white border border-emerald-200 p-6 rounded-2xl shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <span class="text-xs text-slate-400 font-semibold block">Total Diizinkan Hari Ini</span>
                <span class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $totalHariIni }}</span>
            </div>
        </div>

        {{-- Card: Sedang Berlangsung --}}
        <div class="bg-white border border-blue-200 p-6 rounded-2xl shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <span class="text-xs text-slate-400 font-semibold block">Sedang Berlangsung</span>
                <span class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $sedangBerlangsung }}</span>
            </div>
        </div>

        {{-- Card: Akan Datang --}}
        <div class="bg-white border border-indigo-200 p-6 rounded-2xl shadow-sm flex items-center gap-4 hover:shadow-md transition-shadow duration-200">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <span class="text-xs text-slate-400 font-semibold block">Akan Datang</span>
                <span class="text-2xl font-extrabold text-slate-800 leading-tight mt-0.5">{{ $akanDatang }}</span>
            </div>
        </div>
    </div>

    <!-- MAIN BODY GRID (2 Column Layout on Desktop) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- LEFT PANEL (2 Columns): Monitoring & Table -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- MONITORING CARD -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden p-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-800 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 4h-2m6-4a6 6 0 11-12 0 6 6 0 0112 0zm-8-6a2 2 0 114 0 2 2 0 01-4 0z"></path>
                        </svg>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-base font-bold text-slate-900">Monitoring Keamanan</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Verifikasi Izin Akses ruangan secara instan melalui pemindaian QR Code.</p>
                    </div>
                </div>

                <!-- Action Button / Scanner Trigger -->
                <div class="mt-5 flex gap-3 items-center">
                    <button id="start-btn" class="inline-flex items-center gap-2 px-5 py-3 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-xl shadow-md active:scale-[0.98] transition-all duration-200">
                        <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Mulai Scan Izin Ruangan
                    </button>
                    <button id="stop-btn" disabled class="hidden inline-flex items-center gap-2 px-5 py-3 text-xs font-bold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl active:scale-[0.98] transition-all duration-200">
                        Hentikan Pemindaian
                    </button>
                </div>

                <!-- SCANNER FEED CONTAINER (Hidden by Default) -->
                <div id="scanner-area" class="hidden mt-6 pt-6 border-t border-slate-100 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pilih Kamera Feed</span>
                        <div class="w-1/2">
                            <select id="camera-select" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500/15 focus:border-blue-500 appearance-none text-slate-700">
                                <option value="">Memuat kamera...</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="relative w-full aspect-video bg-slate-900 rounded-xl overflow-hidden flex items-center justify-center border border-slate-800 shadow-inner">
                        <div id="reader" class="w-full h-full"></div>
                    </div>
                </div>
            </div>

            <!-- VERIFIKASI MANUAL CARD -->
            <div class="bg-white border border-slate-200 rounded-2xl p-5 space-y-4 shadow-sm">
                <h4 class="text-sm font-bold text-slate-700">Verifikasi Manual (Input Kode TTE)</h4>
                <div class="flex gap-3">
                    <input type="text" id="manual-tte-input" placeholder="Contoh: TTE-ABC123XYZ" 
                           class="flex-1 px-4 py-2.5 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500/15 focus:border-blue-500 text-slate-700 transition-all duration-200">
                    <button id="manual-verify-btn" class="px-5 py-2.5 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all duration-200 active:scale-[0.98]">
                        Verifikasi
                    </button>
                </div>
            </div>

            <!-- ACTIVITIES TABLE -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100">
                    <h4 class="text-base font-bold text-slate-800">Daftar Kegiatan Hari Ini</h4>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-500 text-xxs font-bold uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Waktu</th>
                                <th class="px-6 py-4">Ruangan</th>
                                <th class="px-6 py-4">Nama Kegiatan</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Surat Izin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-xs">
                            @forelse($todaySchedules as $pItem)
                                @php
                                    $pDetail = $pItem->detailPengajuans->first();
                                    $pRoom = $pDetail?->ruangan?->nama_ruangan;
                                    if (!$pRoom && $pDetail) {
                                        $staticRooms = [
                                            1 => 'Aula Utama H.1.1',
                                            2 => 'Lab Komputer Terpadu',
                                            3 => 'Ruang Rapat BAAK',
                                            4 => 'Gedung Serba Guna (GSG)'
                                        ];
                                        $pRoom = $staticRooms[$pDetail->id_ruangan] ?? 'Ruangan #' . $pDetail->id_ruangan;
                                    }
                                @endphp
                                <tr class="hover:bg-slate-50/40 transition-colors">
                                    <td class="px-6 py-4 font-mono font-bold text-slate-600">
                                        @if($pDetail)
                                            {{ substr($pDetail->waktu_mulai, 0, 5) }} - {{ substr($pDetail->waktu_selesai, 0, 5) }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 font-bold text-slate-700">
                                        {{ $pRoom ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-700 font-medium">
                                        Kegiatan oleh {{ $pItem->user?->nama ?? 'Nama Tidak Diketahui' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-250">
                                            Approved
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($pItem->file_dokumen_pendukung)
                                            <a href="{{ asset('storage/' . $pItem->file_dokumen_pendukung) }}" target="_blank" class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-700">
                                                <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                PDF
                                            </a>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                                        Tidak ada jadwal kegiatan disetujui hari ini.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- LOG SCAN HISTORY CARD -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <h4 class="text-base font-bold text-slate-800">Riwayat Scan & Verifikasi</h4>
                    <button onclick="clearScanLog()" class="text-xs text-rose-600 hover:text-rose-700 font-semibold transition-colors duration-200">Hapus Riwayat</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-slate-600">
                        <thead class="bg-slate-50 text-slate-500 text-xxs font-bold uppercase tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Waktu</th>
                                <th class="px-6 py-4">Kode TTE</th>
                                <th class="px-6 py-4">Pemohon</th>
                                <th class="px-6 py-4">Ruangan</th>
                                <th class="px-6 py-4">Hasil</th>
                            </tr>
                        </thead>
                        <tbody id="scan-log-tbody" class="divide-y divide-slate-100 text-xs">
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                                    Belum ada riwayat pemindaian hari ini.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- RIGHT PANEL (1 Column): Panduan Petugas -->
        <div class="space-y-6">
            
            <!-- BLUE PANDUAN PETUGAS CARD -->
            <div class="bg-gradient-to-br from-blue-600 to-indigo-650 rounded-2xl p-6 text-white shadow-md shadow-blue-500/10">
                <div class="flex items-center gap-3 pb-4 border-b border-white/10 mb-4">
                    <div class="w-10 h-10 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-base font-extrabold">Panduan Petugas</h4>
                </div>
                
                <ul class="space-y-4 text-xs font-semibold text-blue-100">
                    <li class="flex gap-3 items-start">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-white/15 text-white flex items-center justify-center text-xxs font-bold">1</span>
                        <p class="leading-relaxed">Pilih kamera aktif dari dropdown menu dan klik tombol <strong>Mulai Scan</strong>.</p>
                    </li>
                    <li class="flex gap-3 items-start">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-white/15 text-white flex items-center justify-center text-xxs font-bold">2</span>
                        <p class="leading-relaxed">Arahkan kamera ke QR Code e-permit dokumen pemohon untuk validasi database.</p>
                    </li>
                    <li class="flex gap-3 items-start">
                        <span class="flex-shrink-0 w-5 h-5 rounded-full bg-white/15 text-white flex items-center justify-center text-xxs font-bold">3</span>
                        <p class="leading-relaxed">Sistem akan secara instan menampilkan hasil keabsahan permit dan status perizinan.</p>
                    </li>
                </ul>
            </div>
            
        </div>

    </div>

</div>

<!-- OVERLAY SCAN MODAL (RESULTS SCREEN) -->
<div id="results-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-slate-950/70 backdrop-blur-sm p-4">
    <!-- Result Card -->
    <div id="result-card" class="relative w-full max-w-md bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden transform scale-95 transition-all duration-300">
        <!-- Result Accent Top Line -->
        <div id="result-accent-line" class="h-2 bg-emerald-500"></div>

        <div class="p-6 md:p-8 text-center">
            <!-- Icon Display -->
            <div class="mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4" id="result-icon-container">
                <!-- Icon will be injected here -->
            </div>

            <!-- Title & Status Message -->
            <h4 class="text-xl font-extrabold text-slate-900" id="result-title">Validasi Berhasil</h4>
            <p class="text-sm font-semibold mt-1" id="result-status-text">Surat Izin Penggunaan Ruangan VALID</p>

            <!-- Details list -->
            <div class="mt-6 p-4 bg-slate-50 rounded-xl text-left text-xs space-y-2.5 border border-slate-100">
                <div class="flex justify-between">
                    <span class="text-slate-400 font-medium">Pemohon:</span>
                    <span class="text-slate-800 font-bold" id="res-pemohon">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 font-medium">Ruangan:</span>
                    <span class="text-slate-800 font-bold" id="res-ruangan">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 font-medium">Tanggal:</span>
                    <span class="text-slate-800 font-bold" id="res-tanggal">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 font-medium">Waktu:</span>
                    <span class="text-slate-800 font-bold" id="res-waktu">-</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-400 font-medium">Kode TTE:</span>
                    <span class="text-slate-800 font-mono font-bold" id="res-tte">-</span>
                </div>
            </div>

            <!-- Close Modal -->
            <button id="close-modal-btn" class="mt-6 w-full py-3.5 px-4 text-xs font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all duration-200">
                Tutup & Scan Kembali
            </button>
        </div>
    </div>
</div>

<!-- SCANNER CONTROLLER SCRIPT -->
<script>
    let html5QrScanner = null;
    const cameraSelect = document.getElementById('camera-select');
    const startBtn = document.getElementById('start-btn');
    const stopBtn = document.getElementById('stop-btn');
    const scannerArea = document.getElementById('scanner-area');
    const resultsModal = document.getElementById('results-modal');
    const resultCard = document.getElementById('result-card');
    const closeModalBtn = document.getElementById('close-modal-btn');

    // Load available cameras
    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            cameraSelect.innerHTML = '';
            devices.forEach((device, index) => {
                const option = document.createElement('option');
                option.value = device.id;
                option.text = device.label || `Kamera ${index + 1}`;
                cameraSelect.appendChild(option);
            });
        } else {
            cameraSelect.innerHTML = '<option value="">Kamera tidak ditemukan</option>';
        }
    }).catch(err => {
        cameraSelect.innerHTML = '<option value="">Gagal mendeteksi kamera</option>';
        console.error(err);
    });

    // Start Scanning function
    startBtn.addEventListener('click', () => {
        const cameraId = cameraSelect.value;
        if (!cameraId) {
            alert('Silakan pilih kamera terlebih dahulu.');
            return;
        }

        // Show scanner area
        scannerArea.classList.remove('hidden');
        startBtn.disabled = true;
        stopBtn.disabled = false;
        stopBtn.classList.remove('hidden');

        html5QrScanner = new Html5Qrcode("reader");
        html5QrScanner.start(
            cameraId, 
            {
                fps: 10,
                qrbox: { width: 250, height: 250 }
            },
            onScanSuccess,
            onScanFailure
        ).catch(err => {
            alert("Gagal mengaktifkan kamera: " + err);
            stopScanning();
        });
    });

    // Stop Scanning
    stopBtn.addEventListener('click', () => {
        stopScanning();
    });

    function stopScanning() {
        if (html5QrScanner) {
            html5QrScanner.stop().then(() => {
                html5QrScanner = null;
                scannerArea.classList.add('hidden');
                startBtn.disabled = false;
                stopBtn.disabled = true;
                stopBtn.classList.add('hidden');
            }).catch(err => console.error("Gagal menghentikan scanner", err));
        }
    }

    // On Scan success callback
    function onScanSuccess(decodedText, decodedResult) {
        // Stop scanning immediately upon detection
        stopScanning();

        // Hit back-end QR Verification endpoint
        verifyQrCode(decodedText);
    }

    function onScanFailure(error) {
        // Silence noise warnings
    }

    // Call AJAX endpoint
    function verifyQrCode(kodeTte) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('/satpam/verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ kode_tte: kodeTte })
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(res => {
            const { body } = res;
            const data = body.data || {};
            if (!data.kode_tte) {
                data.kode_tte = kodeTte;
            }
            showResultModal(body.success, body.message, data);
        })
        .catch(err => {
            console.error(err);
            showResultModal(false, 'Gagal terhubung ke server untuk verifikasi.', {
                pemohon: '-',
                ruangan: '-',
                tanggal: '-',
                waktu: '-',
                kode_tte: kodeTte
            });
        });
    }

    function showResultModal(isValid, message, data) {
        const accentLine = document.getElementById('result-accent-line');
        const iconContainer = document.getElementById('result-icon-container');
        const title = document.getElementById('result-title');
        const statusText = document.getElementById('result-status-text');

        // Reset details display
        document.getElementById('res-pemohon').textContent = data.pemohon || '-';
        document.getElementById('res-ruangan').textContent = data.ruangan || '-';
        document.getElementById('res-tanggal').textContent = data.tanggal || '-';
        document.getElementById('res-waktu').textContent = data.waktu || '-';
        document.getElementById('res-tte').textContent = data.kode_tte || '-';

        if (isValid) {
            accentLine.className = 'h-2 bg-emerald-500';
            iconContainer.className = 'mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4 bg-emerald-50 border border-emerald-200 text-emerald-500';
            iconContainer.innerHTML = `<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>`;
            title.textContent = 'Permit Valid';
            title.className = 'text-xl font-extrabold text-emerald-600';
            statusText.textContent = message;
            statusText.className = 'text-sm font-semibold text-slate-500 mt-1';
        } else {
            accentLine.className = 'h-2 bg-rose-500';
            iconContainer.className = 'mx-auto w-16 h-16 rounded-full flex items-center justify-center mb-4 bg-rose-50 border border-rose-200 text-rose-500';
            iconContainer.innerHTML = `<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
            </svg>`;
            title.textContent = 'Permit Tidak Valid';
            title.className = 'text-xl font-extrabold text-rose-600';
            statusText.textContent = message;
            statusText.className = 'text-sm font-semibold text-slate-500 mt-1';
        }

        // Fitur F - Push scan history to sessionStorage
        try {
            const log = JSON.parse(sessionStorage.getItem('scanLog') || '[]');
            log.unshift({ 
                time: new Date().toLocaleTimeString('id-ID'), 
                kodeTte: data.kode_tte || '-', 
                pemohon: data.pemohon || '-',
                ruangan: data.ruangan || '-',
                isValid: isValid 
            });
            sessionStorage.setItem('scanLog', JSON.stringify(log.slice(0, 10))); // keep last 10
            renderScanLog();
        } catch (e) {
            console.error('Error writing scan log to sessionStorage:', e);
        }

        // Show Modal
        resultsModal.classList.remove('hidden');
        setTimeout(() => {
            resultCard.classList.remove('scale-95');
            resultCard.classList.add('scale-100');
        }, 50);
    }

    closeModalBtn.addEventListener('click', () => {
        resultCard.classList.remove('scale-100');
        resultCard.classList.add('scale-95');
        setTimeout(() => {
            resultsModal.classList.add('hidden');
        }, 150);
    });

    // Render scan log on page load
    document.addEventListener('DOMContentLoaded', () => {
        renderScanLog();
    });

    function renderScanLog() {
        const tbody = document.getElementById('scan-log-tbody');
        if (!tbody) return;
        
        let log = [];
        try {
            log = JSON.parse(sessionStorage.getItem('scanLog') || '[]');
        } catch (e) {
            console.error('Error reading scan log from sessionStorage:', e);
        }
        
        if (log.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-slate-400">
                        Belum ada riwayat pemindaian hari ini.
                    </td>
                </tr>
            `;
            return;
        }

        tbody.innerHTML = log.map(item => {
            const statusBadge = item.isValid
                ? '<span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-250">Valid</span>'
                : '<span class="text-xs font-bold text-rose-600 bg-rose-50 px-2.5 py-1 rounded-lg border border-rose-200">Tidak Valid</span>';
            
            return `
                <tr class="hover:bg-slate-50/40 transition-colors">
                    <td class="px-6 py-4 font-mono text-slate-500">${item.time}</td>
                    <td class="px-6 py-4 font-mono font-bold text-slate-700">${item.kodeTte || '-'}</td>
                    <td class="px-6 py-4 font-medium text-slate-700">${item.pemohon || '-'}</td>
                    <td class="px-6 py-4 font-medium text-slate-700">${item.ruangan || '-'}</td>
                    <td class="px-6 py-4">${statusBadge}</td>
                </tr>
            `;
        }).join('');
    }

    function clearScanLog() {
        if (confirm('Apakah Anda yakin ingin menghapus semua riwayat scan hari ini?')) {
            sessionStorage.removeItem('scanLog');
            renderScanLog();
        }
    }

    // Manual Verify Button trigger
    const manualVerifyBtn = document.getElementById('manual-verify-btn');
    const manualTteInput = document.getElementById('manual-tte-input');

    if (manualVerifyBtn && manualTteInput) {
        manualVerifyBtn.addEventListener('click', () => {
            const kodeTte = manualTteInput.value.trim();
            if (!kodeTte) {
                alert('Silakan masukkan Kode TTE terlebih dahulu.');
                return;
            }
            verifyQrCode(kodeTte);
        });

        manualTteInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                manualVerifyBtn.click();
            }
        });
    }
</script>
@endsection
