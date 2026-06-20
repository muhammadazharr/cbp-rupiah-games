@extends('layout.games')

@section('content')
<div class="game-container" style="margin-top: 12vh;">
    <div class="glass-card">
        <h2 class="fw-bold text-danger mb-4 text-center">⚙️ Dashboard Kontrol Game</h2>
        
        @if(session('success'))
            <div class="alert alert-success border-0 rounded-pill text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <h5 class="fw-bold text-danger mb-3 border-bottom pb-2">🎮 Game: Rupa Rupiah</h5>
            <div class="mb-4">
                <label class="form-label fw-bold">Waktu Menjawab (detik)</label>
                <input type="number" name="rupa_rupiah_timer" class="form-control rounded-pill border-warning" value="{{ $settings['rupa_rupiah_timer'] ?? 25 }}">
                <small class="text-muted">Durasi timer saat menebak pecahan uang.</small>
            </div>

            <h5 class="fw-bold text-danger mb-3 border-bottom pb-2 mt-5">🧠 Game: Ingat Rupiah</h5>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Waktu Mengingat (detik)</label>
                    <input type="number" name="ingat_rupiah_memorize_timer" class="form-control rounded-pill border-warning" value="{{ $settings['ingat_rupiah_memorize_timer'] ?? 8 }}">
                    <small class="text-muted">Waktu kartu terbuka di awal.</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Waktu Bermain (detik)</label>
                    <input type="number" name="ingat_rupiah_answer_timer" class="form-control rounded-pill border-warning" value="{{ $settings['ingat_rupiah_answer_timer'] ?? 18 }}">
                    <small class="text-muted">Durasi timer untuk mencocokkan kartu.</small>
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" class="btn-nusantara">Simpan Perubahan</button>
                <a href="/" class="btn-nusantara-outline ms-2">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
