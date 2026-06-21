@extends('layouts.satpam')

@section('title', 'Scanner Validasi')

@section('content')
<!-- html5-qrcode CDN recommendation -->
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

<div class="mb-8">
    <nav class="flex mb-2" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 text-xs font-medium text-slate-500">
            <li class="inline-flex items-center">
                <a href="#" class="hover:text-emerald-600 transition-colors">Validator</a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-3.5 h-3.5 text-slate-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-slate-700">Scan QR Code</span>
                </div>
            </li>
        </ol>
    </nav>
    <h3 class="text-2xl font-bold tracking-tight text-slate-900 md:text-3xl">Scan QR Code Perizinan</h3>
    <p class="mt-1.5 text-sm text-slate-500">Arahkan kamera ke QR Code pada dokumen e-permit pemohon untuk memverifikasi keabsahan izin.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Scanner Card -->
    <div class="lg:col-span-2 bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm shadow-slate-100/50 flex flex-col justify-between">
        <div>
            <div class="flex items-center justify-between pb-4 border-b border-slate-100 mb-6">
                <div class="flex items-center gap-2">
                    <span class="w-3.5 h-3.5 rounded-full bg-emerald-500 animate-pulse"></span>
                    <h4 class="text-base font-bold text-slate-700">Camera Feed</h4>
                </div>
                <!-- Camera Select -->
                <div class="w-1/2">
                    <select id="camera-select" class="w-full text-xs px-3 py-2 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 appearance-none text-slate-700">
                        <option value="">Memuat kamera...</option>
                    </select>
                </div>
            </div>

            <!-- HTML5 QR Scanner Container -->
            <div class="relative w-full aspect-video bg-slate-950 rounded-xl overflow-hidden flex items-center justify-center border border-slate-800 shadow-inner">
                <!-- Camera view placeholder -->
                <div id="reader" class="w-full h-full"></div>
                
                <!-- Initial Scanner Overlay Screen -->
                <div id="scanner-placeholder" class="absolute inset-0 bg-slate-900/90 flex flex-col items-center justify-center text-center p-6 transition-all duration-300">
                    <div class="w-16 h-16 rounded-full bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 mb-4 shadow-lg shadow-emerald-500/5">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 4h-2m6-4a6 6 0 11-12 0 6 6 0 0112 0zm-8-6a2 2 0 114 0 2 2 0 01-4 0z"></path>
                        </svg>
                    </div>
                    <h5 class="font-bold text-white text-base">Kamera Belum Aktif</h5>
                    <p class="text-xs text-slate-400 mt-1 max-w-xs">Silakan pilih kamera di atas lalu tekan tombol Mulai Pemindaian di bawah.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 mt-6 pt-4 border-t border-slate-100">
            <button id="start-btn" class="flex-1 px-5 py-3 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-md shadow-emerald-500/10 hover:shadow-emerald-500/20 active:scale-[0.98] transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                </svg>
                Mulai Pemindaian
            </button>
            <button id="stop-btn" disabled class="flex-1 px-5 py-3 text-sm font-semibold text-slate-500 bg-slate-100 hover:bg-slate-200 disabled:opacity-50 disabled:cursor-not-allowed rounded-xl transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z"></path>
                </svg>
                Hentikan
            </button>
        </div>
    </div>

    <!-- Instructions / Tips Card -->
    <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm shadow-slate-100/50 flex flex-col">
        <h4 class="text-base font-bold text-slate-700 pb-3 border-b border-slate-100 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Petunjuk Validasi
        </h4>
        <ul class="space-y-4 flex-1 text-sm text-slate-600">
            <li class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">1</span>
                <p>Pilih kamera aktif dari dropdown dan klik <strong>Mulai Pemindaian</strong>.</p>
            </li>
            <li class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">2</span>
                <p>Posisikan QR Code di tengah kotak pemindai.</p>
            </li>
            <li class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">3</span>
                <p>Sistem akan memverifikasi kode secara otomatis ke database.</p>
            </li>
            <li class="flex gap-3">
                <span class="flex-shrink-0 w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-xs">4</span>
                <p>Hasil validasi (Valid/Invalid) akan langsung tampil di layar beserta detail izin.</p>
            </li>
        </ul>
        <div class="mt-6 pt-4 border-t border-slate-100">
            <div class="p-3 bg-amber-50 rounded-xl border border-amber-200/50 flex items-start gap-2.5">
                <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <p class="text-xs text-amber-700 leading-relaxed font-medium">Pastikan koneksi internet stabil dan pencahayaan memadai agar pemindaian optimal.</p>
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
            <button id="close-modal-btn" class="mt-6 w-full py-3 px-4 text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 rounded-xl transition-all duration-200">
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
    const placeholder = document.getElementById('scanner-placeholder');
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

        // Hide placeholder and activate scanner
        placeholder.classList.add('opacity-0');
        setTimeout(() => placeholder.classList.add('hidden'), 300);

        startBtn.disabled = true;
        stopBtn.disabled = false;

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
                placeholder.classList.remove('hidden');
                setTimeout(() => placeholder.classList.remove('opacity-0'), 50);
                startBtn.disabled = false;
                stopBtn.disabled = true;
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
            showResultModal(body.success, body.message, body.data || {});
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
</script>
@endsection
