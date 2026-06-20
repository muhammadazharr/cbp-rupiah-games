
@extends('layout.games')
@push('style')
    <style>
        .card {
            width: 217px;
            height: 117px;
            perspective: 1000px;
            border: none;
            padding: 0;
        }

        .card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            transition: transform 0.6s;
            transform-style: preserve-3d;
        }

        .card.flip .card-inner {
            transform: rotateY(180deg);
        }

        .card-front,
        .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: white;
        }

        .card-front {
            background-color: #ffc107;
            color: #dc3644;
            font-size: 48px;
            font-weight: 700;

            /* background-image: url('/assets/cbp-logo.png');
                        background-size: cover; */
        }

        .card-back {
            transform: rotateY(180deg);
        }

        #card-container {
            margin: 0;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            justify-items: center;
            align-items: center;
            height: auto;
        }

        .alert-background {
            background-color: #ffc107;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-5">
        <div class="row mb-3">
            <div id="timer"
                class="fw-bold text-danger bg-warning mx-auto d-inline-flex justify-content-center align-items-center rounded"
                style="font-size: 80px; width: 200px; height: 100px;"></div>
        </div>
        <div id="card-container" class="d-flex flex-wrap justify-content-center align-items-center"
            style="width: 100%; max-width: 900px; margin: 0 auto;">
            <!-- Kartu akan dihasilkan di sini -->
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

        var timer = document.querySelector('#timer');
        var card = document.querySelectorAll('#card');

        document.addEventListener('DOMContentLoaded', () => {
            gsap.from(
                timer, {
                    scale: 0,
                    opacity: 0,
                    duration: 1,
                    ease: 'back.out'
                }
            );
            card.forEach((cards) => {
                gsap.fromTo(
                    card, {
                        scale: 0,
                        opacity: 0,
                    }, {
                        scale: 1,
                        opacity: 1,
                        duration: 0.8,
                        stagger: 0.2,
                        ease: 'back.out'
                    }
                )
            })
        })

        const cardContainer = document.querySelector('#card-container');
        const cardValues = [{
                front: '1000.png',
                back: '1000_belakang.png',
                pair: '1000'
            },
            {
                front: '2000.png',
                back: '2000_belakang.png',
                pair: '2000'
            },
            {
                front: '5000.png',
                back: '5000_belakang.png',
                pair: '5000'
            },
            {
                front: '10000.png',
                back: '10000_belakang.png',
                pair: '10000'
            },
            {
                front: '20000.png',
                back: '20000_belakang.png',
                pair: '20000'
            },
            {
                front: '50000.png',
                back: '50000_belakang.png',
                pair: '50000'
            },
            {
                front: '100000.png',
                back: '100000_belakang.png',
                pair: '100000'
            },
            {
                front: '1000TE16.png',
                back: '1000TE16_belakang.png',
                pair: '1000TE16'
            },
            {
                front: '2000TE16.png',
                back: '2000TE16_belakang.png',
                pair: '2000TE16'
            },
            {
                front: '5000TE16.png',
                back: '5000TE16_belakang.png',
                pair: '5000TE16'
            },
            {
                front: '10000TE16.png',
                back: '10000TE16_belakang.png',
                pair: '10000TE16'
            },
            {
                front: '20000TE16.png',
                back: '20000TE16_belakang.png',
                pair: '20000TE16'
            },
            {
                front: '50000TE16.png',
                back: '50000TE16_belakang.png',
                pair: '50000TE16'
            },
            {
                front: '100000TE16.png',
                back: '100000TE16_belakang.png',
                pair: '100000TE16'
            },
            {
                front: '100000TE14.png',
                back: '100000TE14_belakang.png',
                pair: '100000TE14'
            },
            {
                front: '2000TE09.png',
                back: '2000TE09_belakang.png',
                pair: '2000TE09'
            },
            {
                front: '50000TE05.png',
                back: '50000TE05_belakang.png',
                pair: '50000TE05'
            },
            {
                front: '10000TE05.png',
                back: '10000TE05_belakang.png',
                pair: '10000TE05'
            },
            {
                front: '100000TE04.png',
                back: '100000TE04_belakang.png',
                pair: '100000TE04'
            },
            {
                front: '20000TE04.png',
                back: '20000TE04_belakang.png',
                pair: '20000TE04'
            },
            {
                front: '5000TE01.png',
                back: '5000TE01_belakang.png',
                pair: '5000TE01'
            },
            {
                front: '1000TE00.png',
                back: '1000TE00_belakang.png',
                pair: '1000TE00'
            }
        ];

        // Fungsi untuk mendapatkan 8 pasang kartu secara acak
        function getRandomCardPairs() {
            // Mengacak dan memilih 8 pasang kartu
            const shuffledCards = cardValues.sort(() => 0.5 - Math.random()).slice(0, 8);
            const selectedCards = [];

            shuffledCards.forEach(card => {
                selectedCards.push(card); // Menambahkan kartu depan
                selectedCards.push({ // Menambahkan kartu belakang
                    front: card.back,
                    back: card.front,
                    pair: card.pair
                });
            });

            return selectedCards.sort(() => 0.5 - Math.random()); // Mengacak urutan kartu yang dipilih
        }

        // Mengambil kartu yang dirandom
        const selectedCards = getRandomCardPairs();

        // Membuat kartu
        selectedCards.forEach(card => {
            const cardElement = document.createElement('div');
            cardElement.id = 'card';
            cardElement.classList.add('card', 'rounded', 'border', 'd-flex', 'justify-content-center',
                'align-items-center');
            cardElement.dataset.pair = card.pair;
            cardElement.innerHTML = `
                <div class="card-inner">
                    <div class="card-front">?</div>
                    <div class="card-back">
                        <img src="{{ asset('assets/uang/${card.front}') }}" alt="card" style="width: 100%; height: 100%; object-fit: contain ;">
                    </div>
                </div>`;
            cardElement.addEventListener('click', flipCard);
            cardContainer.appendChild(cardElement);
        });

        let firstCard, secondCard;
        let lockBoard = false;
        let points = 0; // Variabel untuk menyimpan poin
        const totalPairs = 8; // Total pasangan yang harus dicocokkan

        function flipCard() {
            if (lockBoard) return;
            if (this === firstCard) return;

            this.classList.add('flip');

            if (!firstCard) {
                firstCard = this;
                return;
            }
            secondCard = this;
            lockBoard = true;

            checkForMatch();
        }

        function checkForMatch() {
            const isPair = firstCard.dataset.pair === secondCard.dataset.pair;

            if (isPair) {
                points++; // Tambah poin jika kartu cocok
                console.log(points);

                disableCards(); // Jika kartu cocok, nonaktifkan event click
                checkGameStatus(); // Cek status permainan
            } else {
                unflipCards(); // Jika tidak cocok, tutup kembali kartu
            }
        }

        function disableCards() {
            firstCard.removeEventListener('click', flipCard);
            secondCard.removeEventListener('click', flipCard);
            resetBoard();
        }

        function unflipCards() {
            setTimeout(() => {
                firstCard.classList.remove('flip');
                secondCard.classList.remove('flip');
                resetBoard();
            }, 1000); // Tutup kembali kartu setelah 1 detik
        }

        function resetBoard() {
            [firstCard, secondCard, lockBoard] = [null, null, false];
        }

        function checkGameStatus() {
            if (points === totalPairs) {
                // Jika poin mencapai 8, redirect ke halaman hasil
                window.location.href = "/IngatRupiah/" + {{ $user_id }} + "/result/" + points;
            }
        }

        var initialTime = 8; // Waktu untuk mengingat kartu 16
        var gameTime = 18; // Waktu bermain 25
        var timerElement = document.getElementById('timer');
        const allCards = document.querySelectorAll('.card');

        // Menampilkan countdown awal

        showAllCards(); // Tampilkan semua kartu
        var initialCountdown = setInterval(function() {
            initialTime--;
            timerElement.textContent = initialTime;

            if (initialTime <= 0) {
                clearInterval(initialCountdown);
                setTimeout(hideAllCards, 1000); // Tutup semua kartu setelah 5 detik
            }
        }, 1000);

        function showAllCards() {
            allCards.forEach(card => card.classList.add('flip')); // Membuka semua kartu
        }

        function hideAllCards() {
            allCards.forEach(card => card.classList.remove('flip')); // Menutup semua kartu
            startGame(); // Memulai permainan setelah kartu ditutup
        }

        function startGame() {
            var timeLeft = gameTime; // Mengatur waktu bermain
            timerElement.textContent = timeLeft; // Menampilkan waktu bermain

            var countdown = setInterval(function() {
                timeLeft--;
                timerElement.textContent = timeLeft;

                if (timeLeft <= 0) {
                    clearInterval(countdown);
                    // alert("Waktu habis!"); // Tampilkan pesan waktu habis
                    // // Redirect ke halaman hasil dengan poin yang ada
                    // window.location.href = "/IngatRupiah/result/" + points;
                    Swal.fire({
                        title: "Waktu Habis!",
                        icon: "error",
                        // imageUrl: '{{ asset('assets/albert-einstein.png') }}',
                        // imageWidth: 200,
                        // imageHeight: 200,
                        confirmButtonText: "Lihat Skor",
                        background: '#ffffff',
                        titleColor: '#dc3545',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: false,
                        customClass: {
                            title: 'fw-bold text-danger',
                            popup: 'swal2-title-large',
                            confirmButton: 'btn btn-warning text-danger rounded-pill fw-bold px-5'
                        },
                        html: '<style>.swal2-title-large .swal2-title { font-size: 38px !important; }</style>'
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = "/IngatRupiah/" + {{ $user_id }} + "/result/" +
                                points;
                        }
                    });
                }
            }, 1000);
        }
    </script>
@endpush
