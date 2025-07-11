<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAXIT-SA Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg': '#1a1a1a',
                        'dark-card': '#2a2a2a',
                        'dark-sidebar': '#171717',
                        'accent-blue': '#3b82f6'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-dark-bg text-white font-sans">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-dark-sidebar p-6 flex flex-col h-screen lg:block hidden">
            <div class="mb-12">
                <h1 class="text-2xl font-bold text-white">MAXIT-SA</h1>
            </div>

            <nav class="flex-1 flex flex-col space-y-4 overflow-auto">
                <a href="#" class="flex items-center space-x-3 text-gray-400 hover:text-white transition-colors">
                    <div class="w-6 h-6 rounded-full border-2 border-gray-400 flex items-center justify-center">
                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                    </div>
                    <span>Mes transactions</span>
                </a>

                <a href="#" class="flex items-center space-x-3 text-gray-400 hover:text-white transition-colors">
                    <div class="w-6 h-6 rounded-full border-2 border-gray-400 flex items-center justify-center">
                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                    </div>
                    <span>Ajouter compte</span>
                </a>

                <a href="#" class="flex items-center space-x-3 text-gray-400 hover:text-white transition-colors">
                    <div class="w-6 h-6 rounded-full border-2 border-gray-400 flex items-center justify-center">
                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                    </div>
                    <span>Voir mes comptes</span>
                </a>
            </nav>

            <div class="mt-auto pt-6">
                <a href="/disconnect" class="flex items-center space-x-3 text-gray-400 hover:text-white transition-colors">
                    <div class="w-6 h-6 rounded-full border-2 border-gray-400 flex items-center justify-center">
                        <div class="w-2 h-2 bg-gray-400 rounded-full"></div>
                    </div>
                    <span>Se déconnecter</span>
                </a>
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6 lg:p-8">
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8 space-y-4 sm:space-y-0">
                <div class="lg:hidden">
                    <h1 class="text-2xl font-bold text-white mb-4">MAXIT-SA</h1>
                </div>

                <div class="bg-dark-card rounded-2xl p-6 inline-block">
                    <div class="text-sm text-gray-400 mb-2">Total Solde</div>
                    <div class="text-2xl font-bold text-white">
                        <?= number_format($compte->getSolde(), 0, ',', ' ') ?> Fcfa
                    </div>

                </div>

                <button class="bg-dark-card hover:bg-gray-700 transition-colors px-6 py-3 rounded-xl flex items-center space-x-2 self-start sm:self-auto">
                    <span>Voir plus</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>

            <div class="bg-dark-card rounded-2xl p-6">
                <?php echo $content ?>
            </div>
        </main>
    </div>
</body>

</html>