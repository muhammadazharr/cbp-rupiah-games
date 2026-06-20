@extends('layout.start')

@push('style')
    <style>
        /* No extra page-specific CSS needed — using design system */
    </style>
@endpush

@section('content')
    <!-- Middle Section: Title + Button inside glass card -->
    <div class="game-container text-center" style="margin-top: 6vh; z-index: 10;">
        <div class="glass-card d-flex flex-column align-items-center py-4">
            <img src="{{asset('assets/Title-logo.png')}}" class="img-fluid" style="max-width: 700px; width: 90vw; margin-bottom: 28px;" alt="Fun Game CBP Rupiah">
            
            <a href="{{ route('inputBio') }}" class="btn-nusantara">Mulai</a>
        </div>
    </div>

    <!-- Bottom Section: Character decoration -->
    <div class="mt-auto text-center" style="z-index: 9;">
        <img src="{{asset('assets/pahlawan-bg.png')}}" class="img-fluid" style="max-width: 700px; width: 85vw; margin-top: 50px;" alt="">
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
    </script>
@endpush
