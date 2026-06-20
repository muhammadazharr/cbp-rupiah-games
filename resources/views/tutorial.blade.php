@extends('layout.games')

@push('style')
    <style>
        .tutorial-container {
            width: 100%;
            max-width: 960px;
            margin: 0 auto;
            padding: 1.5rem;
            position: relative;
            z-index: 10;
        }

        /* ===== Slide System ===== */
        .tutorial-slides {
            position: relative;
            min-height: 420px;
        }
        .tutorial-slide {
            display: none;
            animation: fadeSlide 0.4s ease;
        }
        .tutorial-slide.active {
            display: block;
        }
        @keyframes fadeSlide {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ===== Step Indicator ===== */
        .step-indicators {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }
        .step-dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            border: 2px solid rgba(220, 53, 69, 0.3);
            transition: all 0.3s ease;
        }
        .step-dot.active {
            background: #dc3545;
            border-color: #dc3545;
            transform: scale(1.3);
            box-shadow: 0 0 12px rgba(220, 53, 69, 0.5);
        }
        .step-dot.completed {
            background: #28a745;
            border-color: #28a745;
        }

        /* ===== Content Cards ===== */
        .tutorial-card {
            background: rgba(255, 255, 255, 0.92);
            border-radius: 24px;
            padding: 2.5rem 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            border: 1px solid rgba(255, 193, 7, 0.3);
        }
        .tutorial-card h3 {
            color: #dc3545;
            font-weight: 800;
            font-size: 1.6rem;
            margin-bottom: 1.25rem;
        }
        .tutorial-card .subtitle {
            color: #8b0000;
            font-weight: 600;
            font-size: 1.05rem;
            margin-bottom: 1.5rem;
        }

        /* ===== Step Items ===== */
        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.25rem;
            padding: 1rem 1.25rem;
            background: rgba(255, 193, 7, 0.08);
            border-radius: 16px;
            border-left: 4px solid #ffc107;
            transition: all 0.25s ease;
        }
        .step-item:hover {
            background: rgba(255, 193, 7, 0.15);
            transform: translateX(4px);
        }
        .step-number {
            min-width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, #dc3545, #8b0000);
            color: #ffc107;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
            flex-shrink: 0;
        }
        .step-text {
            flex: 1;
        }
        .step-text h5 {
            margin: 0 0 4px 0;
            font-weight: 700;
            color: #333;
            font-size: 1rem;
        }
        .step-text p {
            margin: 0;
            color: #666;
            font-size: 0.92rem;
            line-height: 1.5;
        }

        /* ===== Game Preview Image ===== */
        .game-preview {
            width: 100%;
            max-width: 400px;
            border-radius: 16px;
            border: 3px solid rgba(255, 193, 7, 0.4);
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin: 0 auto 1.5rem;
            display: block;
        }

        /* ===== Tip Box ===== */
        .tip-box {
            background: linear-gradient(135deg, rgba(40,167,69,0.1), rgba(40,167,69,0.05));
            border: 2px solid rgba(40,167,69,0.3);
            border-radius: 16px;
            padding: 1rem 1.25rem;
            margin-top: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }
        .tip-box i {
            color: #28a745;
            font-size: 1.4rem;
            margin-top: 2px;
        }
        .tip-box p {
            margin: 0;
            color: #333;
            font-size: 0.92rem;
            line-height: 1.5;
        }

        /* ===== Navigation Buttons ===== */
        .tutorial-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.5rem;
            gap: 1rem;
        }
        .btn-tutorial-prev {
            background: transparent;
            color: #dc3545;
            border: 2px solid #dc3545;
            border-radius: 50px;
            padding: 12px 32px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .btn-tutorial-prev:hover {
            background: rgba(220,53,69,0.1);
        }
        .btn-tutorial-prev:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }
        .btn-tutorial-next {
            background: linear-gradient(135deg, #dc3545, #8b0000);
            color: #ffc107;
            border: none;
            border-radius: 50px;
            padding: 14px 40px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(139, 0, 0, 0.4);
        }
        .btn-tutorial-next:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(139, 0, 0, 0.5);
        }

        /* ===== Welcome Slide ===== */
        .welcome-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        .game-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 193, 7, 0.15);
            border: 2px solid rgba(255, 193, 7, 0.4);
            border-radius: 50px;
            padding: 0.6rem 1.25rem;
            margin: 0.5rem;
            font-weight: 600;
            color: #8b0000;
            font-size: 0.95rem;
        }
        .game-badge img {
            width: 36px;
            height: 36px;
            object-fit: contain;
        }
    </style>
@endpush

@section('content')
    <div class="tutorial-container" style="margin-top: 4vh;">
        <!-- Step Indicators -->
        <div class="step-indicators" id="stepIndicators">
            <div class="step-dot active" data-step="0"></div>
            <div class="step-dot" data-step="1"></div>
            <div class="step-dot" data-step="2"></div>
            <div class="step-dot" data-step="3"></div>
        </div>

        <!-- Slides -->
        <div class="tutorial-slides">

            <!-- SLIDE 0: Welcome -->
            <div class="tutorial-slide active" data-slide="0">
                <div class="tutorial-card text-center">
                    <div class="welcome-icon">🎮</div>
                    <h3>Selamat Datang di Fun Game CBP Rupiah!</h3>
                    <p class="subtitle">Sebelum bermain, yuk kenali dulu cara mainnya 👇</p>

                    <p style="color: #555; font-size: 1rem; line-height: 1.7; max-width: 600px; margin: 0 auto 1.5rem;">
                        Ada <strong>2 game seru</strong> yang bisa kamu mainkan untuk menguji pengetahuanmu tentang uang Rupiah Indonesia:
                    </p>

                    <div class="d-flex flex-wrap justify-content-center mb-4">
                        <div class="game-badge">
                            <img src="{{ asset('assets/rupaRupiah/logo.png') }}" alt="">
                            <span>Rupa Rupiah</span>
                        </div>
                        <div class="game-badge">
                            <img src="{{ asset('assets/ingatRupiah/logo.png') }}" alt="">
                            <span>Ingat Rupiah</span>
                        </div>
                    </div>

                    <div class="tip-box" style="max-width: 500px; margin: 0 auto;">
                        <i class="fas fa-lightbulb"></i>
                        <p>Tutorial ini hanya perlu <strong>30 detik</strong> untuk dibaca. Setelah itu kamu langsung bisa main!</p>
                    </div>
                </div>
            </div>

            <!-- SLIDE 1: Rupa Rupiah Tutorial -->
            <div class="tutorial-slide" data-slide="1">
                <div class="tutorial-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ asset('assets/rupaRupiah/logo.png') }}" alt="" style="width: 60px; height: 60px; object-fit: contain;">
                        <div>
                            <h3 class="mb-0">Game 1: Rupa Rupiah</h3>
                            <span class="subtitle mb-0">Tebak pecahan uang dari potongan gambar</span>
                        </div>
                    </div>

                    <img src="{{ asset('assets/RupaRupiahQuestion.png') }}" alt="Preview Rupa Rupiah" class="game-preview">

                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-text">
                            <h5>Perhatikan Gambar</h5>
                            <p>Kamu akan melihat potongan gambar dari uang kertas atau logam Rupiah Indonesia.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-text">
                            <h5>Pilih Jawaban yang Benar</h5>
                            <p>Tebak pecahan uang berapa dari 4 pilihan jawaban (A, B, C, D). Hanya ada 1 jawaban yang benar!</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-text">
                            <h5>Perhatikan Waktu</h5>
                            <p>Setiap soal punya batas waktu. Jawab secepat mungkin sebelum waktu habis!</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-text">
                            <h5>Selesaikan 10 Soal</h5>
                            <p>Jawab semua 10 pertanyaan untuk mendapatkan skor akhir kamu.</p>
                        </div>
                    </div>

                    <div class="tip-box">
                        <i class="fas fa-lightbulb"></i>
                        <p><strong>Tips:</strong> Perhatikan warna, gambar pahlawan, dan nominal pada uang. Detail kecil bisa jadi petunjuk penting!</p>
                    </div>
                </div>
            </div>

            <!-- SLIDE 2: Ingat Rupiah Tutorial -->
            <div class="tutorial-slide" data-slide="2">
                <div class="tutorial-card">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ asset('assets/ingatRupiah/logo.png') }}" alt="" style="width: 60px; height: 60px; object-fit: contain;">
                        <div>
                            <h3 class="mb-0">Game 2: Ingat Rupiah</h3>
                            <span class="subtitle mb-0">Temukan pasangan kartu uang yang sama</span>
                        </div>
                    </div>

                    <img src="{{ asset('assets/IngatRupiahKertas.png') }}" alt="Preview Ingat Rupiah" class="game-preview">

                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-text">
                            <h5>Ingat Posisi Kartu</h5>
                            <p>Di awal, semua kartu akan diperlihatkan sebentar. Ingat posisi gambar uang di setiap kartu!</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-text">
                            <h5>Buka 2 Kartu</h5>
                            <p>Klik kartu untuk membukanya. Kamu hanya bisa membuka 2 kartu setiap giliran.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-text">
                            <h5>Cocokkan Pasangan</h5>
                            <p>Jika kedua kartu menampilkan uang yang sama, kartu tetap terbuka. Jika tidak, kartu akan tertutup kembali.</p>
                        </div>
                    </div>

                    <div class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-text">
                            <h5>Temukan Semua Pasangan</h5>
                            <p>Temukan semua pasangan kartu sebelum waktu habis untuk menyelesaikan permainan!</p>
                        </div>
                    </div>

                    <div class="tip-box">
                        <i class="fas fa-lightbulb"></i>
                        <p><strong>Tips:</strong> Fokus pada warna dan angka nominal di kartu. Coba ingat posisinya saat kartu pertama kali diperlihatkan!</p>
                    </div>
                </div>
            </div>

            <!-- SLIDE 3: Ready! -->
            <div class="tutorial-slide" data-slide="3">
                <div class="tutorial-card text-center">
                    <div class="welcome-icon">🚀</div>
                    <h3>Kamu Sudah Siap!</h3>
                    <p class="subtitle">Saatnya menguji pengetahuanmu tentang Rupiah</p>

                    <div style="max-width: 500px; margin: 0 auto 2rem;">
                        <div class="step-item" style="border-left-color: #28a745;">
                            <div class="step-number" style="background: linear-gradient(135deg, #28a745, #1e7e34);">✓</div>
                            <div class="step-text">
                                <h5>Rupa Rupiah</h5>
                                <p>Tebak pecahan uang dari potongan gambar — 10 soal pilihan ganda</p>
                            </div>
                        </div>
                        <div class="step-item" style="border-left-color: #28a745;">
                            <div class="step-number" style="background: linear-gradient(135deg, #28a745, #1e7e34);">✓</div>
                            <div class="step-text">
                                <h5>Ingat Rupiah</h5>
                                <p>Cocokkan pasangan kartu uang — game memori dengan batas waktu</p>
                            </div>
                        </div>
                    </div>

                    <p style="color: #888; font-size: 0.9rem; margin-bottom: 1.5rem;">Pilih salah satu game di halaman berikutnya</p>

                    <a href="{{ route('choose', $user_id) }}" class="btn-tutorial-next" style="font-size: 1.3rem; padding: 16px 60px; text-decoration: none;">
                        🎮 MAIN SEKARANG!
                    </a>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="tutorial-nav" id="tutorialNav">
            <button class="btn-tutorial-prev" id="btnPrev" disabled>
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </button>
            <button class="btn-tutorial-next" id="btnNext">
                Lanjut<i class="fas fa-arrow-right ms-2"></i>
            </button>
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
            }
        });

        // Tutorial Slide System
        const slides = document.querySelectorAll('.tutorial-slide');
        const dots = document.querySelectorAll('.step-dot');
        const btnPrev = document.getElementById('btnPrev');
        const btnNext = document.getElementById('btnNext');
        const tutorialNav = document.getElementById('tutorialNav');
        let currentSlide = 0;
        const totalSlides = slides.length;

        function showSlide(index) {
            slides.forEach(s => s.classList.remove('active'));
            dots.forEach(d => {
                d.classList.remove('active');
                if (parseInt(d.dataset.step) < index) {
                    d.classList.add('completed');
                } else {
                    d.classList.remove('completed');
                }
            });

            slides[index].classList.add('active');
            dots[index].classList.add('active');

            // Update buttons
            btnPrev.disabled = index === 0;

            if (index === totalSlides - 1) {
                // Last slide: hide nav buttons (the "MAIN SEKARANG" link is in the slide)
                tutorialNav.style.display = 'none';
            } else {
                tutorialNav.style.display = 'flex';
                btnNext.innerHTML = 'Lanjut<i class="fas fa-arrow-right ms-2"></i>';
            }

            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        btnNext.addEventListener('click', () => {
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                showSlide(currentSlide);
            }
        });

        btnPrev.addEventListener('click', () => {
            if (currentSlide > 0) {
                currentSlide--;
                showSlide(currentSlide);
            }
        });

        // Allow clicking dots to navigate
        dots.forEach(dot => {
            dot.addEventListener('click', () => {
                const step = parseInt(dot.dataset.step);
                currentSlide = step;
                showSlide(currentSlide);
            });
        });

        // Entrance animation
        document.addEventListener('DOMContentLoaded', () => {
            gsap.from('.tutorial-card', {
                y: 30,
                opacity: 0,
                duration: 0.6,
                ease: 'power2.out'
            });
        });
    </script>
@endpush
