<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/chesecafe-favicon.png') }}">
    <title>Login - CheSe Cafe</title>

    <style>
        :root {
            --cream: #f2eee9;
            --cream-strong: #f7f2ed;
            --brown-900: #3a2a22;
            --brown-700: #5c4138;
            --brown-500: #8d6755;
            --input: rgba(255,255,255,0.4);
            --shadow: rgba(70, 46, 36, 0.18);
        }

        * { box-sizing: border-box; }

        html, body {
            margin: 0;
            min-height: 100%;
            height: 100%;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5efe9;
            color: var(--brown-900);
        }

        .login-scene {
            position: relative;
            width: 100vw;
            height: 100vh;
            background-image: url('{{ asset('images/139963500917675137.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: hidden;
        }

        .bean-layer {
            position: absolute;
            inset: 0;
            pointer-events: none;
            overflow: hidden;
            z-index: 0;
        }

        .bean {
            position: absolute;
            top: -12%;
            width: 52px;
            height: 34px;
            background:
                radial-gradient(circle at 30% 26%, rgba(255, 216, 165, 0.28), transparent 18%),
                linear-gradient(90deg, #5f331f 0%, #8d532f 18%, #b08154 34%, #603926 58%, #3d1c15 100%);
            border-radius: 48% 52% 50% 50% / 52% 48% 52% 48%;
            border: 2px solid rgba(31, 14, 10, 0.38);
            opacity: 0.9;
            box-shadow: inset -8px -6px 10px rgba(38, 18, 11, 0.2), inset 5px 4px 8px rgba(255, 214, 160, 0.12);
            transform: rotate(18deg);
            animation: beanFloat linear infinite;
        }

        .bean::before {
            content: "";
            position: absolute;
            inset: 5px 10px 5px 10px;
            border-radius: 45% 55% 50% 50% / 50% 50% 50% 50%;
            background: linear-gradient(90deg, rgba(255, 244, 220, 0.08), rgba(70, 38, 29, 0.12));
        }

        .bean::after {
            content: "";
            position: absolute;
            top: 8%;
            left: 50%;
            width: 8px;
            height: 76%;
            transform: translateX(-50%) rotate(-4deg);
            background: linear-gradient(180deg, rgba(255, 211, 161, 0.62), rgba(86, 52, 33, 0.9), rgba(47, 20, 13, 0.8));
            border-radius: 999px;
            opacity: 0.9;
        }

        .bean:nth-child(odd) {
            transform: rotate(-8deg);
        }

        .bean:nth-child(3n) {
            width: 62px;
            height: 38px;
        }

        @keyframes beanFloat {
            0% {
                transform: translate3d(0, -10vh, 0) rotate(0deg);
                opacity: 0;
            }
            12% {
                opacity: 0.8;
            }
            50% {
                transform: translate3d(25px, 45vh, 0) rotate(150deg);
                opacity: 0.85;
            }
            100% {
                transform: translate3d(-20px, 110vh, 0) rotate(300deg);
                opacity: 0;
            }
        }

        .login-card-wrap {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: min(720px, 68vw);
            height: min(720px, 68vw);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease-out;
            will-change: transform;
            transform-style: preserve-3d;
        }

        .login-card {
            position: relative;
            width: min(660px, 62vw);
            height: min(660px, 62vw);
            background: linear-gradient(145deg, rgba(249, 243, 236, 0.96), rgba(233, 223, 214, 0.9));
            border-radius: 50%;
            padding: 42px 74px 24px;
            box-shadow: 0 24px 44px rgba(59, 35, 28, 0.22), inset 0 0 0 2px rgba(255,255,255,0.45), inset 0 -20px 40px rgba(122, 87, 77, 0.08);
            border: 9px solid rgba(74, 49, 39, 0.9);
            display: flex;
            flex-direction: column;
            justify-content: center;
            z-index: 2;
            transform-style: preserve-3d;
            transition: transform 0.18s ease-out;
        }

        .login-card::before {
            content: "";
            position: absolute;
            inset: 14px;
            border-radius: 50%;
            border: 2px solid rgba(128, 94, 80, 0.14);
            pointer-events: none;
        }

        .login-card::after {
            content: "";
            position: absolute;
            inset: 18px 22px 18px 18px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255,255,255,0.22), rgba(255,255,255,0));
            pointer-events: none;
        }

        .login-card h2 {
            margin: 0;
            font-size: clamp(3.2rem, 4.6vw, 5.2rem);
            line-height: 1;
            letter-spacing: -0.06em;
            color: var(--brown-900);
            font-weight: 900;
            text-align: center;
        }

        .subtitle {
            margin: 14px 0 16px;
            text-align: center;
            font-size: clamp(1rem, 1.5vw, 1.25rem);
            font-weight: 600;
            color: var(--brown-700);
            font-style: italic;
        }

        .field {
            display: block;
            margin-bottom: 10px;
        }

        .field label {
            display: block;
            font-size: 1.08rem;
            letter-spacing: 0.04em;
            font-weight: 800;
            color: var(--brown-700);
            margin-bottom: 6px;
        }

        .field input {
            width: 100%;
            border: none;
            border-radius: 14px;
            background: rgba(255,255,255,0.28);
            box-shadow: inset 0 0 0 1px rgba(136, 108, 92, 0.12);
            padding: 17px 16px;
            font-size: 1.05rem;
            color: brown;
            outline: none;
        }

        .field input::placeholder {
            color: rgba(90, 61, 50, 0.5);
        }

        .field input:focus {
            box-shadow: inset 0 0 0 2px rgba(108, 75, 59, 0.22);
        }

        .login-button {
            width: min(190px, 62%);
            margin: 6px auto 8px;
            border: none;
            border-radius: 14px;
            padding: 18px 16px;
            background: linear-gradient(180deg, #7a574d, #5a3a2e);
            color: #fff;
            font-weight: 900;
            font-size: 1.05rem;
            letter-spacing: 0.08em;
            box-shadow: 0 10px 18px rgba(83, 59, 50, 0.17);
            cursor: pointer;
            display: block;
        }

        .brand-logo-wrap {
            position: absolute;
            right: 5vw;
            bottom: 5vh;
            width: min(540px, 38vw);
            display: flex;
            align-items: flex-end;
            justify-content: flex-end;
            z-index: 1;
            transition: transform 0.2s ease-out;
            will-change: transform;
            cursor: pointer;
            transform-origin: center bottom;
        }

        .brand-logo {
            width: 100%;
            height: auto;
            display: block;
            filter: drop-shadow(0 12px 18px rgba(60, 40, 30, 0.14));
            transition: transform 0.18s ease, filter 0.18s ease;
        }

        .brand-logo-wrap.is-bouncing .brand-logo {
            animation: catZoom 0.28s ease-in-out;
        }

        @keyframes catZoom {
            0% {
                transform: scale(1);
            }
            35% {
                transform: scale(1.08);
            }
            100% {
                transform: scale(1);
            }
        }

        .speech-bubble {
            position: absolute;
            right: 8%;
            bottom: calc(100% + 18px);
            background: rgba(255, 250, 246, 0.96);
            color: var(--brown-900);
            border: 1px solid rgba(126, 91, 77, 0.12);
            border-radius: 18px;
            padding: 12px 18px;
            font-size: clamp(0.82rem, 0.95vw, 1rem);
            font-weight: 700;
            line-height: 1.5;
            text-align: center;
            box-shadow: 0 10px 18px rgba(86, 62, 51, 0.12);
            transform: translateY(10px) scale(0.96);
            opacity: 0;
            pointer-events: none;
            transition: all 0.22s ease;
            max-width: 250px;
            white-space: nowrap;
        }

        .speech-bubble::after {
            content: "";
            position: absolute;
            left: 42%;
            bottom: -10px;
            width: 18px;
            height: 18px;
            background: rgba(255, 250, 246, 0.96);
            border-right: 1px solid rgba(126, 91, 77, 0.12);
            border-bottom: 1px solid rgba(126, 91, 77, 0.12);
            transform: rotate(45deg);
        }

        .brand-logo-wrap.is-active .speech-bubble {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .error-box {
            background: rgba(255, 232, 236, 0.95);
            color: #8b3e52;
            border: 1px solid rgba(173, 95, 112, 0.16);
            border-radius: 12px;
            padding: 10px 12px;
            margin: 0 0 16px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        @media (max-width: 900px) {
            .login-card-wrap {
                width: min(92vw, 620px);
                height: auto;
                top: 52%;
            }

            .login-card {
                width: min(440px, 90vw);
                min-height: 480px;
                padding: 36px 26px 28px;
                border-radius: 40px;
            }

            .brand-logo {
                right: 3vw;
                bottom: 2vh;
                width: min(380px, 55vw);
            }
        }
    </style>
</head>
<body>

<div class="login-scene" id="loginScene">
    <div class="bean-layer" aria-hidden="true">
        <span class="bean" style="left: 8%; animation-duration: 16s; animation-delay: 0s;"></span>
        <span class="bean" style="left: 19%; animation-duration: 18s; animation-delay: 3s;"></span>
        <span class="bean" style="left: 30%; animation-duration: 14s; animation-delay: 1.5s;"></span>
        <span class="bean" style="left: 42%; animation-duration: 17s; animation-delay: 6s;"></span>
        <span class="bean" style="left: 56%; animation-duration: 19s; animation-delay: 2s;"></span>
        <span class="bean" style="left: 68%; animation-duration: 15s; animation-delay: 4.5s;"></span>
        <span class="bean" style="left: 79%; animation-duration: 20s; animation-delay: 1s;"></span>
        <span class="bean" style="left: 90%; animation-duration: 16s; animation-delay: 5s;"></span>
        <span class="bean" style="left: 12%; animation-duration: 18s; animation-delay: 8s;"></span>
        <span class="bean" style="left: 71%; animation-duration: 17s; animation-delay: 9s;"></span>
    </div>

    <div class="login-card-wrap" id="loginCardWrap">
        <div class="login-card" id="loginCard">
            <h2>LOGIN</h2>
            <div class="subtitle">Masuk untuk mengelola sistem kasir cafe</div>

            @if ($errors->any())
                <div class="error-box">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <div class="field">
                    <label for="email">EMAIL:</label>
                    <input id="email" type="email" name="email" placeholder="Alamat Email" required autocomplete="off" autocapitalize="none" spellcheck="false">
                </div>

                <div class="field">
                    <label for="password">PASSWORD</label>
                    <input id="password" type="password" name="password" placeholder="Kata Sandi" required autocomplete="new-password" autocapitalize="none" spellcheck="false">
                </div>

                <button class="login-button" type="submit">DONE !</button>
            </form>
        </div>
    </div>

    <div class="brand-logo-wrap" id="brandLogoWrap" tabindex="0" aria-label="Kucing CheSe Cafe">
        <div class="speech-bubble" id="speechBubble" aria-live="polite">
            <span id="speechText">Meow, Hari Yang Menyenangkan?</span>
        </div>
        <img class="brand-logo" id="brandLogo" src="{{ asset('images/chatgpt-logo-1.png') }}" alt="CheSe Cafe">
    </div>
</div>

<script>
    const scene = document.getElementById('loginScene');
    const cardWrap = document.getElementById('loginCardWrap');
    const logoWrap = document.getElementById('brandLogoWrap');
    const speechText = document.getElementById('speechText');

    const catMessages = [
        'Meow, Hari Yang Menyenangkan?',
        'Semangat Bekerja Yaw :3',
        'Meow! Ayo semangat hari ini!'
    ];

    let messageIndex = 0;

    if (logoWrap && speechText) {
        const updateSpeechMessage = () => {
            speechText.textContent = catMessages[messageIndex];
            messageIndex = (messageIndex + 1) % catMessages.length;
        };

        logoWrap.addEventListener('click', function () {
            logoWrap.classList.remove('is-bouncing');
            void logoWrap.offsetWidth;
            logoWrap.classList.add('is-bouncing');
            logoWrap.classList.toggle('is-active');
            if (logoWrap.classList.contains('is-active')) {
                updateSpeechMessage();
            }

            setTimeout(() => {
                logoWrap.classList.remove('is-bouncing');
            }, 280);
        });

        logoWrap.addEventListener('keydown', function (event) {
            if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();
                logoWrap.click();
            }
        });
    }

    if (scene && cardWrap && logoWrap) {
        scene.addEventListener('pointermove', function (event) {
            const rect = scene.getBoundingClientRect();
            const px = (event.clientX - rect.left) / rect.width;
            const py = (event.clientY - rect.top) / rect.height;

            const rotateY = (px - 0.5) * 18;
            const rotateX = (0.5 - py) * 14;
            const angle = rotateY * 0.9;

            cardWrap.style.transform = `translate(-50%, -50%) rotateX(${rotateX}deg) rotateY(${rotateY}deg) rotateZ(${angle}deg)`;
            logoWrap.style.transform = `translate(${(px - 0.5) * 16}px, ${(0.5 - py) * 16}px) rotate(${rotateY * 0.8}deg)`;
        });

        scene.addEventListener('pointerleave', function () {
            cardWrap.style.transform = 'translate(-50%, -50%) rotateX(0deg) rotateY(0deg) rotateZ(0deg)';
            logoWrap.style.transform = 'translate(0px, 0px) rotate(0deg)';
        });
    }
</script>

</body>
</html>
