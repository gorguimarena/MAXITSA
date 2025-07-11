<?php
$errors = $this->session->get('errors') ?? [];
$old = $this->session->get('old1')  ?? [];
unset($_SESSION['errors']);
?>
<form class="space-y-6" action="/inscription/1" method="post">
    <!-- Prénom et Nom -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label for="prenom" class="block text-sm font-medium custom-text mb-2">
                Prénom
            </label>
            <input
                type="text"
                id="prenom"
                name="prenom"
                placeholder="Prénom"
                value="<?= htmlspecialchars($old['prenom'] ?? '') ?>"
                class="w-full px-4 py-3 border custom-border <?= isset($errors['prenom']) ? 'border-red-500' : 'custom-focus' ?> rounded-lg focus:outline-none transition-colors">
        </div>
        <div>
            <label for="nom" class="block text-sm font-medium custom-text mb-2">
                Nom
            </label>
            <input
                type="text"
                id="nom"
                name="nom"
                placeholder="Nom"
                value="<?= htmlspecialchars($old['nom'] ?? '') ?>"
                class="w-full px-4 py-3 border custom-border rounded-lg focus:outline-none <?= isset($errors['nom']) ? 'border-red-500' : 'custom-focus' ?> transition-colors">
        </div>
    </div>

    <!-- Adresse -->
    <div>
        <label for="adresse" class="block text-sm font-medium custom-text mb-2">
            Adresse
        </label>
        <input
            type="text"
            id="adresse"
            name="adresse"
            placeholder="Adresse"
            value="<?= htmlspecialchars($old['adresse'] ?? '') ?>"
            class="w-full px-4 py-3 border custom-border rounded-lg focus:outline-none <?= isset($errors['adresse']) ? 'border-red-500' : 'custom-focus' ?> transition-colors">
    </div>

    <!-- Numéro de carte d'identité -->
    <div>
        <label for="carte_identite" class="block text-sm font-medium custom-text mb-2">
            Numéro de carte d'identité
        </label>
        <input
            type="text"
            id="carte_identite"
            name="carte_identite"
            placeholder="Votre numéro de carte d'identité"
            value="<?= htmlspecialchars($old['carte_identite'] ?? '') ?>"
            class="w-full px-4 py-3 border custom-border rounded-lg focus:outline-none <?= isset($errors['carte_identite']) ? 'border-red-500' : 'custom-focus' ?> transition-colors">
    </div>

    <!-- Numéro de téléphone -->
    <div>
        <label for="telephone" class="block text-sm font-medium custom-text mb-2">
            Numéro téléphone
        </label>
        <div class="flex">
            <select
                class="px-3 py-3 border custom-border rounded-l-lg focus:outline-none custom-focus bg-white custom-text">
                <option value="SN">SN</option>
                <option value="ML">ML</option>
                <option value="BF">BF</option>
                <option value="CI">CI</option>
                <option value="GN">GN</option>
            </select>
            <input
                type="tel"
                id="telephone"
                name="telephone"
                placeholder="777065468"
                value="<?= htmlspecialchars($old['telephone'] ?? '') ?>"
                class="flex-1 px-4 py-3 border-t border-r border-b custom-border rounded-r-lg focus:outline-none <?= isset($errors['telephone']) ? 'border-red-500' : 'custom-focus' ?> transition-colors">
        </div>
        <p class="text-red-500"><?= $errors['telephone'][0] ?? '' ?> </p>

    </div>

    <!-- Bouton Suivre -->
    <button
        type="submit"
        class="w-full custom-primary text-white py-3 px-6 rounded-lg font-medium hover:custom-primary transition-colors flex items-center justify-center gap-2">
        Suivre
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
        </svg>
    </button>

    <!-- Lien de connexion -->
    <div class="text-center">
        <p class="custom-text-secondary">
            Vous avez déjà un compte ?
            <a href="/" class="text-blue-600 hover:text-blue-800 font-medium">Se connecter</a>
        </p>
    </div>
</form>