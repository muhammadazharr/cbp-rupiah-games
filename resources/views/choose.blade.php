@extends('layout.games')

@push('style')
    <style>
        .game-choice-card {
            border: none;
            background: transparent;
            border-radius: 20px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .game-choice-card:hover {
            transform: scale(1.08) translateY(-8px);
            filter: drop-shadow(0 12px 20px rgba(0, 0, 0, 0.3));
        }
        .game-choice-card:active {
            transform: scale(1.02);
        }
        .game-choice-card img {
            width: 100%;
            height: auto;
            max-width: 300px;
            object-fit: cover;
            border-radius: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="game-container text-center" style="margin-top: 12vh; z-index: 10;">
        <h2 class="fw-bold text-danger mb-4" style="text-shadow: 0 2px 4px rgba(0,0,0,0.1);">Pilih Game</h2>
        <div class="d-flex flex-wrap justify-content-center align-items-start gap-4">
            <!-- Rupa Rupiah -->
            <div class="d-flex flex-column align-items-center" style="width: 280px;">
                <div class="glass-card p-3 mb-3 d-flex align-items-center justify-content-center" style="width: 280px; height: 220px;">
                    <button id="btn-rupa" class="game-choice-card">
                        <img src="/assets/rupaRupiah/logo.png" alt="Rupa Rupiah" style="width: 240px; height: 180px; object-fit: contain;">
                    </button>
                </div>
                <span class="fw-bold text-danger" style="font-size: 1.1rem;">Rupa Rupiah</span>
            </div>

            <!-- Ingat Rupiah -->
            <div class="d-flex flex-column align-items-center" style="width: 280px;">
                <div class="glass-card p-3 mb-3 d-flex align-items-center justify-content-center" style="width: 280px; height: 220px;">
                    <button id="btn-ingat" class="game-choice-card">
                        <img src="/assets/ingatRupiah/logo.png" alt="Ingat Rupiah" style="width: 240px; height: 180px; object-fit: contain;">
                    </button>
                </div>
                <span class="fw-bold text-danger" style="font-size: 1.1rem;">Ingat Rupiah</span>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.getElementById("musicController").addEventListener("click", () => {
            if (document.getElementById('musik').paused) {
                document.getElementById('logoMusic').classList.remove('fa-volume-xmark');
                document.getElementById('logoMusic').classList.add('fa-volume-high');
                document.getElementById('musik').play();
            } else {
                document.getElementById('logoMusic').classList.remove('fa-volume-high');
                document.getElementById('logoMusic').classList.add('fa-volume-xmark');
                document.getElementById('musik').pause();
            } // Play/Pause audio when the button is clicked.
        });

        document.addEventListener('DOMContentLoaded', () => {
            let buttons = document.querySelectorAll('.game-choice-card');
            buttons.forEach((button, index) => {
                gsap.from(button.closest('.glass-card'), {
                    scale: 0,
                    duration: 0.8,
                    ease: "back.inOut",
                    delay: index * 0.2,
                });
            });
        });

        let user_id = {{ $user_id }};
        document.getElementById('btn-rupa').addEventListener('click', function() {
            window.location.href = "/RupaRupiah/" + user_id;
        });
        document.getElementById('btn-ingat').addEventListener('click', function() {
            window.location.href = "/IngatRupiah/" + user_id;
        });
    </script>
@endpush
