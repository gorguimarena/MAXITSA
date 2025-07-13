<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAXIT-SA Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .bg-dark-custom {
            background-color: #1a1a1a;
        }

        .bg-darker-custom {
            background-color: #141414;
        }

        .bg-card-custom {
            background-color: #2a2a2a;
        }

        .text-gray-custom {
            color: #9ca3af;
        }

        .border-gray-custom {
            border-color: #374151;
        }
    </style>
</head>

<body class="bg-dark-custom text-white min-h-screen">
    <!-- Container principal -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-darker-custom p-4 hidden md:block fixed left-0 top-0 h-full z-40">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white">MAXIT-SA</h1>
            </div>

            <nav class="space-y-2">
                <div class="flex items-center space-x-3 p-3 rounded-lg bg-gray-800">
                    <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center">
                        <span class="text-xs">⚪</span>
                    </div>
                    <span class="text-sm text-gray-custom">Mes Transactions</span>
                </div>
                <div class="flex items-center space-x-3 p-3 rounded-lg bg-gray-800">
                    <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center">
                        <span class="text-xs">⚪</span>
                    </div>
                    <span class="text-sm text-gray-custom">Ajouter compte</span>
                </div>
                <div class="flex items-center space-x-3 p-3 rounded-lg bg-gray-800">
                    <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center">
                        <span class="text-xs">⚪</span>
                    </div>
                    <span class="text-sm text-gray-custom">Voir mes comptes</span>
                </div>
            </nav>

            <!-- Bouton de déconnexion -->
            <div class="absolute bottom-4 left-4">
                <div class="flex items-center space-x-3 p-3 text-gray-custom hover:text-white cursor-pointer">
                    <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center">
                        <span class="text-xs">↗</span>
                    </div>
                    <span class="text-sm">Se déconnecter</span>
                </div>
            </div>
        </div>


        <!-- Contenu principal -->
        <div class="flex-1 p-6 md:ml-64">
            <?php echo $content ?>
        </div>

    </div>

    <!-- Mobile menu button (visible on small screens) -->
    <div class="md:hidden fixed top-4 left-4 z-50">
        <button class="bg-card-custom p-2 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
</body>

</html>