<?php
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAXIT-SA - Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --primary-color: #1f2937;
            --primary-hover: #374151;
            --background-color: #f9fafb;
            --text-primary: #111827;
            --text-secondary: #6b7280;
            --border-color: #d1d5db;
            --input-focus: #3b82f6;
            --success-color: #10b981;
            --error-color: #ef4444;
        }

        .custom-primary {
            background-color: var(--primary-color);
        }

        .custom-primary:hover {
            background-color: var(--primary-hover);
        }

        .custom-bg {
            background-color: var(--background-color);
        }

        .custom-text {
            color: var(--text-primary);
        }

        .custom-text-secondary {
            color: var(--text-secondary);
        }

        .custom-border {
            border-color: var(--border-color);
        }

        .custom-focus:focus {
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .login-container {
            max-width: 500px;
            margin: 0 auto;
        }

        .connexion-title {
            color: var(--text-secondary);
            font-weight: 600;
            letter-spacing: 0.1em;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .input-field {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.2s ease;
            background-color: white;
        }

        .input-field:focus {
            outline: none;
            border-color: var(--input-focus);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .input-field::placeholder {
            color: var(--text-secondary);
        }

        .btn-primary {
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            padding: 0.875rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .signup-link {
            color: var(--input-focus);
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link:hover {
            text-decoration: underline;
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: none;
        }

        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .spinner {
            border: 2px solid transparent;
            border-top: 2px solid white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
            display: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="custom-bg min-h-screen flex items-center justify-center py-3 px-4">
    <div class="login-container">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block custom-primary text-white px-8 py-4 rounded-full mb-6">
                <h1 class="text-2xl font-bold">MAXIT-SA</h1>
            </div>
            <h2 class="text-2xl font-bold custom-text mb-2">BIENVENUE SUR MAXIT-SA</h2>
            <p class="connexion-title text-lg">CONNEXION</p>
        </div>

        <!-- Form -->
        <form id="loginForm" class="space-y-6 w-96" method="post" action="/auth">
            <!-- Email/Phone -->
            <div class="form-group">
                <label for="login" class="block text-sm font-medium custom-text mb-2">
                    Numéro téléphone ou e-mail
                </label>
                <input
                    type="text"
                    id="login"
                    name="login"
                    placeholder="777065468 or exemple@gmail.com"
                    value="<?= htmlspecialchars($old['login'] ?? '') ?>"
                    class="input-field <?= isset($errors['login']) ? 'border-red-500' : 'custom-focus' ?>">
                <?php if (isset($_SESSION['errors']['login'])): ?>
                    <div class="text-red-500">
                        <?= $_SESSION['errors']['login'] ?>
                    </div>
                <?php endif; ?>
                <div class="error-message" id="loginError"></div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="block text-sm font-medium custom-text mb-2">
                    Votre mot de passe
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="*********"
                        class="input-field <?= isset($errors['login']) ? 'border-red-500' : 'custom-focus' ?> pr-12">

                    <button
                        type="button"
                        id="togglePassword"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                        <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <div class="error-message" id="passwordError"></div>
            </div>

            <!-- Forgot Password -->
            <div class="text-right">
                <a href="#" class="signup-link text-sm" id="forgotPassword">Mot de passe oublié ?</a>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="btn-primary flex items-center justify-center gap-2"
                id="loginBtn">
                <span id="loginText">Se connecter</span>
                <div class="spinner" id="spinner"></div>
            </button>

            <!-- Sign Up Link -->
            <div class="text-center">
                <p class="custom-text-secondary">
                    Vous n'avez pas encore un compte ?
                    <a href="/inscription/0" class="signup-link" id="signupLink">S'inscrire</a>
                </p>
            </div>
        </form>
    </div>

</body>

</html>