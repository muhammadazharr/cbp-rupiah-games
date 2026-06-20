@extends('layout.games')

@push('style')
    <style>
        .score-circle {
            width: 180px;
            height: 180px;
            background: linear-gradient(135deg, #ffc107, #ffdb4d);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 8px 30px rgba(255, 193, 7, 0.4);
        }
    </style>
@endpush

@section('content')
    <div class="game-container text-center" style="margin-top: 15vh; z-index: 10;">
        <div class="glass-card py-5" id="scoreBox">
            <h1 class="fw-bold text-danger mb-4" style="font-size: 2.5rem;">Skor Anda</h1>
            
            <div class="d-flex justify-content-center align-items-center mb-4">
                <div class="score-circle">
                    <span class="fw-bold text-danger" style="font-size: 64px;">{{ $hasil }}</span>
                </div>
            </div>
            
            <h3 class="fw-bold text-danger mb-3">{{ $affirmation }}</h3>
            
            <div class="d-inline-block mb-4 px-4 py-2 rounded-pill" style="background: linear-gradient(135deg, #ffc107, #ffdb4d);">
                <span class="fw-bold text-danger" style="font-size: 1.2rem;">{{ $poin }}</span>
            </div>
            
            <div>
                <a id="startButton" href="{{ route('start') }}" class="btn-nusantara" style="font-size: 1.3rem;">
                    Main Lagi
                </a>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let scoreBox = document.getElementById('scoreBox');
            gsap.fromTo(scoreBox, {
                opacity: 0,
                scale: 0,
            }, {
                opacity: 1,
                scale: 1,
                duration: 1,
                ease: 'elastic.out(0.7, 0.6)'
            });
        });
    </script>
@endpush
