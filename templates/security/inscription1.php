<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAXIT-SA - Inscription</title>
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
    </style>
</head>
<body class="custom-bg min-h-screen py-8 px-4">
    <div class="max-w-md mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block custom-primary text-white px-12 py-8 rounded-bl-3xl rounded-tl-xl rounded-tr-3xl mb-6">
                <h1 class="text-xl font-bold">MAXIT-SA</h1>
            </div>
            <h2 class="text-2xl font-bold custom-text mb-2">BIENVENUE SUR MAXIT-SA</h2>
        </div>

        <!-- Form -->
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
                        class="w-full px-4 py-3 border custom-border rounded-lg focus:outline-none custom-focus transition-colors"
                    >
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
                        class="w-full px-4 py-3 border custom-border rounded-lg focus:outline-none custom-focus transition-colors"
                    >
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
                    class="w-full px-4 py-3 border custom-border rounded-lg focus:outline-none custom-focus transition-colors"
                >
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
                    class="w-full px-4 py-3 border custom-border rounded-lg focus:outline-none custom-focus transition-colors"
                >
            </div>

            <!-- Numéro de téléphone -->
            <div>
                <label for="telephone" class="block text-sm font-medium custom-text mb-2">
                    Numéro téléphone
                </label>
                <div class="flex">
                    <select 
                        class="px-3 py-3 border custom-border rounded-l-lg focus:outline-none custom-focus bg-white custom-text"
                    >
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
                        class="flex-1 px-4 py-3 border-t border-r border-b custom-border rounded-r-lg focus:outline-none custom-focus transition-colors"
                    >
                </div>
            </div>

            <!-- Bouton Suivre -->
            <button 
                type="submit" 
                class="w-full custom-primary text-white py-3 px-6 rounded-lg font-medium hover:custom-primary transition-colors flex items-center justify-center gap-2"
            >
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
    </div>

</body>
</html>