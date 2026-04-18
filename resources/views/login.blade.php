{{-- resources/views/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Kas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px 15px 0 0 !important;
            padding: 20px;
        }

        .role-card {
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
        }

        .role-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .role-card.selected {
            border-color: #667eea;
            background-color: #f0f0ff;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header text-center">
                        <h3 class="mb-0">Aplikasi Data Kas</h3>
                        <p class="mb-0">Silahkan pilih role untuk melanjutkan</p>
                    </div>
                    <div class="card-body">
                        <form id="loginForm" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="role-card p-4 text-center" data-role="user">
                                        <div style="font-size: 48px; margin-bottom: 15px;">👤</div>
                                        <h4>User</h4>
                                        <p class="text-muted">Login tanpa password<br>Hanya bisa melihat data</p>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="role-card p-4 text-center" data-role="admin">
                                        <div style="font-size: 48px; margin-bottom: 15px;">👨‍💼</div>
                                        <h4>Admin</h4>
                                        <p class="text-muted">Login dengan password<br>Full akses CRUD</p>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="role" id="selectedRole" required>
                            <button type="submit" class="btn btn-primary w-100 mt-3" id="loginBtn" disabled>
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const roleCards = document.querySelectorAll('.role-card');
        const selectedRoleInput = document.getElementById('selectedRole');
        const loginBtn = document.getElementById('loginBtn');

        roleCards.forEach(card => {
            card.addEventListener('click', () => {
                roleCards.forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                const role = card.getAttribute('data-role');
                selectedRoleInput.value = role;
                loginBtn.disabled = false;
            });
        });
    </script>
</body>

</html>
