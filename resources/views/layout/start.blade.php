<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CBP Fun Games Gorontalo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- FontAwesome 6.2.0 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            width: 100vw;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background-image: url('/assets/bg-gradient.png');
            background-size: cover
        }

        .bg-bunga {
            width: 100vw;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
            opacity: 0.5;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .bunga-kiri img,
        .bunga-tengah img,
        .bunga-kanan img {
            animation: rotate 20s linear infinite;
        }

        .bunga-tengah img {
            animation-duration: 25s;
        }
        
        .bunga-kiri img { width: 45vw; max-width: 800px; position: absolute; top: 15vh; left: -20vw; }
        .bunga-tengah img { width: 60vw; max-width: 1200px; position: absolute; top: 10vh; left: 50%; transform: translateX(-50%); }
        .bunga-kanan img { width: 45vw; max-width: 800px; position: absolute; top: 15vh; right: -20vw; }

        /* ===== Design System: Modern Nusantara ===== */
        .game-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 1.5rem;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            padding: 2rem;
        }

        .btn-nusantara {
            background: linear-gradient(135deg, #dc3545, #8b0000);
            color: #ffc107;
            border: none;
            border-radius: 50px;
            padding: 14px 40px;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(139, 0, 0, 0.4);
        }
        .btn-nusantara:hover {
            transform: scale(1.06);
            box-shadow: 0 6px 20px rgba(139, 0, 0, 0.5);
            color: #ffe066;
        }
        .btn-nusantara:active {
            transform: scale(0.97);
            box-shadow: 0 2px 8px rgba(139, 0, 0, 0.3);
        }

        .btn-nusantara-outline {
            background: transparent;
            color: #dc3545;
            border: 2px solid #dc3545;
            border-radius: 50px;
            padding: 12px 36px;
            font-weight: 700;
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
            cursor: pointer;
            transition: all 0.25s ease;
        }
        .btn-nusantara-outline:hover {
            background: #dc3545;
            color: #ffc107;
            transform: scale(1.04);
        }

        .option-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 16px;
            border: 2px solid rgba(255, 193, 7, 0.4);
            padding: 14px 20px;
            cursor: pointer;
            transition: all 0.25s ease;
            text-decoration: none;
        }
        .option-card:hover {
            background: rgba(255, 193, 7, 0.3);
            border-color: #ffc107;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }
        .option-card:active {
            transform: scale(0.97);
        }
        .option-card.correct {
            background: rgba(40, 167, 69, 0.3) !important;
            border-color: #28a745 !important;
            box-shadow: 0 0 20px rgba(40, 167, 69, 0.3);
        }
        .option-card.wrong {
            background: rgba(220, 53, 69, 0.3) !important;
            border-color: #dc3545 !important;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }

        .progress-bar-game {
            width: 100%;
            height: 10px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 1rem;
        }
        .progress-bar-game .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #ffc107, #dc3545);
            border-radius: 10px;
            transition: width 0.4s ease;
        }

        .timer-badge {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #ffc107, #ffdb4d);
            color: #dc3545;
            font-weight: 800;
            font-size: 2rem;
            min-width: 80px;
            height: 80px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.4);
            transition: all 0.3s ease;
        }
        .timer-badge.urgent {
            animation: pulse-urgent 0.6s ease infinite;
            background: linear-gradient(135deg, #dc3545, #ff6b6b);
            color: #fff;
        }
        @keyframes pulse-urgent {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.08); }
        }
    </style>
    @stack('style')
</head>

<body>
    <audio id="musik" autoplay loop>
        <!--<source src="{{asset('assets/start-song.mp3')}}" type="audio/mpeg">-->
        <source src="{{asset('assets/Pacu_Jalur.mp3')}}" type="audio/mpeg">
        <!--<source src="{{asset('assets/garam_madu.mp3')}}" type="audio/mpeg">-->
        <!--<source src="{{ asset('assets/aku_dah_lupa.mp3') }}" type="audio/mpeg">-->
    </audio>
    <div class="d-flex w-100 d-none">
        <button id="musicController" class="p-3 rounded m-3 ms-auto btn btn-warning text-danger border border-0">
            <i id="logoMusic" class="fa-solid fa-volume-xmark" style="font-size: 25px"></i>
        </button>
    </div>

    <header class="d-flex justify-content-between align-items-start w-100 p-4 position-absolute top-0 start-0 z-3" style="pointer-events: none;">
        <img src="{{ asset('assets/BI_logo.png') }}" class="img-fluid" style="max-width: 200px; height: auto;" alt="">
        <img src="{{ asset('assets/CBP_blue_logo.png') }}" class="img-fluid" style="max-width: 250px; height: auto;" alt="">
    </header>

    <div class="bg-bunga">
        <div class="bunga-kiri"><img src="{{ asset('assets/bunga-bg.png') }}" alt=""></div>
        <div class="bunga-tengah"><img src="{{ asset('assets/bunga-bg.png') }}" alt=""></div>
        <div class="bunga-kanan"><img src="{{ asset('assets/bunga-bg.png') }}" alt=""></div>
    </div>

    <main class="position-relative z-2 min-vh-100 d-flex flex-column align-items-center">
        @yield('content')
    </main>

    <!-- (Optional) Use CSS or JS implementation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js"
        integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js"></script>
    @stack('script')
</body>

</html>
