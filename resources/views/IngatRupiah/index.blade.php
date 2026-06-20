@extends('layout.games')
@push('style')
    <style>
        .wave {
            z-index: -1;
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            transform: translate(-50%, -50%);
            border: 4px solid;
            opacity: 0;
            pointer-events: none;
            border-radius: 50px;
        }
    </style>
@endpush

@section('content')
    <div class="game-container text-center" style="margin-top: 12vh; z-index: 10;">
        <div class="glass-card d-flex flex-column align-items-center py-4">
            <img src="{{ asset('assets/ingatRupiah/logo.png') }}" class="img-fluid mb-4" style="max-width: 350px;" alt="Ingat Rupiah">
            
            <div style="position: relative;">
                <a id="startButton" href="{{ route('ingat_rupiah.question', $user_id) }}"
                    class="btn-nusantara" style="font-size: 1.5rem; padding: 16px 60px;">START</a>
                <div class="wave"></div>
                <div class="wave"></div>
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
            document.getElementById('musik').play();
        })
        document.getElementById('startButton').addEventListener('click', function() {
            gsap.to('#startButton', {
                scale: 1.05,
                duration: 0.15,
                yoyo: true,
                repeat: 1,
                ease: "power1.inOut",
                transformOrigin: "center center",
            });
            document.querySelectorAll('.wave').forEach((wave, index) => {
                gsap.fromTo(
                    wave, {
                        scale: 0,
                        opacity: 1,
                        color: "#ca2424"
                    }, {
                        scale: 2,
                        opacity: 0,
                        duration: 0.8,
                        delay: index * 0.1,
                        ease: "power1.out",
                    }
                );
            });
        });
    </script>
@endpush
