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
            <?php echo $content ?>
        </main>
    </div>
</body>

</html>