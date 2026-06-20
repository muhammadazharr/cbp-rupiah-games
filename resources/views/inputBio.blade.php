@extends('layout.start')

@push('style')
    <style>
        .bio-input {
            background: rgba(255, 193, 7, 0.85);
            color: #dc3545;
            font-weight: 700;
            border: 2px solid rgba(255, 193, 7, 0.5);
            border-radius: 50px;
            padding: 10px 20px;
            transition: all 0.25s ease;
        }
        .bio-input:focus {
            background: rgba(255, 193, 7, 1);
            border-color: #dc3545;
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.15);
            color: #dc3545;
            outline: none;
        }
        .bio-input::placeholder {
            color: rgba(220, 53, 69, 0.5);
        }
        textarea.bio-input {
            border-radius: 16px;
        }
    </style>
@endpush

@section('content')
    <div class="game-container" style="margin-top: 12vh; z-index: 10; padding-bottom: 3rem;">
        <div class="glass-card">
            <h3 class="text-center fw-bold text-danger mb-4">Biodata Pemain</h3>
            <form action="{{ route('input') }}" method="post">
                @csrf
                @method('POST')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nameInput" class="form-label fw-bold text-danger">Nama</label>
                        <input type="text" name="name" required class="form-control bio-input"
                            id="nameInput" placeholder="Nama lengkap">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="phoneInput" class="form-label fw-bold text-danger">Nomor Telepon</label>
                        <input type="number" name="phone" required class="form-control bio-input"
                            id="phoneInput" placeholder="08xxxxxxxxxx">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="addressInput" class="form-label fw-bold text-danger">Alamat</label>
                        <textarea name="address" id="addressInput" rows="3" required
                            class="form-control bio-input" placeholder="Alamat lengkap"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ageInput" class="form-label fw-bold text-danger">Umur</label>
                        <input type="number" name="age" required class="form-control bio-input"
                            id="ageInput" placeholder="Umur">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="genderSelect" class="form-label fw-bold text-danger">Jenis Kelamin</label>
                        <select name="gender" id="genderSelect" required class="form-control bio-input">
                            <option value="">Pilih...</option>
                            <option value="1">Pria</option>
                            <option value="0">Wanita</option>
                        </select>
                    </div>
                </div>
                
                <div class="mt-3">
                    <button type="submit" class="btn-nusantara w-100 text-center">
                        SUBMIT
                    </button>
                </div>
            </form>
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
    </script>
@endpush
