<?php
$errors = $this->session->get('errors') ?? [];
$old = $this->session->get('old')  ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>

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