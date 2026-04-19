<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E-Kas Premium</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0f172a;
            margin: 0;
            height: 100vh;
            overflow: hidden;
        }

        .login-wrapper {
            height: 100vh;
            display: flex;
        }

        /* Sisi Kiri: Branding & Info */
        .login-side-info {
            background: linear-gradient(135deg, #064e3b 0%, #10b981 100%);
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 80px;
            color: white;
            position: relative;
        }

        /* Sisi Kanan: Form */
        .login-side-form {
            background: #ffffff;
            width: 480px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            box-shadow: -10px 0 40px rgba(0,0,0,0.1);
            z-index: 2;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        /* Styling khusus untuk input group agar border rapi */
        .input-group-text {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #94a3b8;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-login {
            background: #0f172a;
            color: white;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            border: none;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: #1e293b;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        @media (max-width: 992px) {
            .login-side-info { display: none; }
            .login-side-form { width: 100%; padding: 40px; }
            body { overflow: auto; }
        }

        .fade-in { animation: fadeIn 0.8s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<div class="login-wrapper">
    <div class="login-side-info">
        <div class="fade-in">
            <div class="mb-4">
                <i class="fas fa-wallet fa-4x text-white"></i>
            </div>
            <h1 class="display-4 fw-800">E-Kas <br><span style="opacity: 0.7 text-decoration: underline wavy #10b981;">Mahesa Kurung.</span></h1>
            <p class="fs-5 mt-3 opacity-75">
                Solusi cerdas manajemen keuangan kas dengan transparansi tingkat tinggi.
            </p>
        </div>
    </div>

    <div class="login-side-form">
        <div class="fade-in">
            <h3 class="fw-bold text-dark mb-1">Selamat Datang</h3>
            <p class="text-muted mb-4 small">Silakan masuk menggunakan akun terdaftar.</p>

            @if(session('error'))
                <div class="alert alert-danger border-0 small py-2 mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.process') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary">EMAIL ADDRESS</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0" style="border-radius: 12px 0 0 12px;">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" name="email" class="form-control border-start-0"
                               style="border-radius: 0 12px 12px 0;" placeholder="nama@email.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0" style="border-radius: 12px 0 0 12px;">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" class="form-control border-start-0 border-end-0"
                               placeholder="••••••••" required>
                        <span class="input-group-text border-start-0" id="togglePassword" style="border-radius: 0 12px 12px 0;">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-login w-100 shadow-sm">
                    Masuk Sekarang <i class="fas fa-sign-in-alt ms-2"></i>
                </button>
            </form>

            <div class="text-center mt-5">
                <p class="text-muted small">
                    <i class="fas fa-shield-check text-success me-1"></i>
                    Security Level: <span class="fw-bold text-dark">High</span>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const eyeIcon = document.querySelector('#eyeIcon');

    togglePassword.addEventListener('click', function (e) {
        // Toggle tipe input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle ikon
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');

        // Efek warna saat aktif
        this.classList.toggle('text-success');
    });
</script>

</body>
</html>
