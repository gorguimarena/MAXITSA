<!-- Contenu principal -->
<div class="flex items-center justify-center min-h-screen p-6">
    <div class="w-full max-w-md">
        <!-- Formulaire d'inscription -->
        <div class="rounded-lg shadow-lg p-8">
            <form class="space-y-6" action="/client/save_account" method="POST">
                <!-- Numéro téléphone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-white mb-2">
                        Numéro téléphone
                    </label>
                    <div class="flex">
                        <div class="relative">
                            <select class="appearance-none bg-gray-50 text-black  border border-gray-300 rounded-l-lg px-3 py-2 pr-8 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="SN">SN</option>
                                <option value="FR">FR</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </div>
                        <input
                            type="tel"
                            id="phone"
                            name="number_tel"
                            class="flex-1 bg-gray-50 text-black  border border-l-0 border-gray-300 rounded-r-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="777065468">
                    </div>
                </div>

                <!-- Solde à débiter -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-white mb-2">
                        Solde à débiter
                    </label>
                    <input
                        type="text"
                        id="amount"
                        name="solde"
                        class="w-full bg-gray-50 border border-gray-300 text-black rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Montant à débiter">
                </div>

                <!-- Bouton S'inscrire -->
                <button
                    type="submit"
                    class="w-full bg-gray-800 text-white font-medium py-2 px-4 rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                    S'inscrire
                </button>
            </form>
        </div>
    </div>
</div>



<!-- <div class="md:hidden fixed top-4 left-4 z-50">
    <button class="bg-darker-custom p-2 rounded-lg text-white">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>

<div class="md:hidden fixed inset-0 bg-black bg-opacity-50 z-30 hidden" id="sidebar-overlay">
    <div class="w-64 bg-darker-custom h-full">
        <div class="p-4">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-white">MAXIT-SA</h1>
            </div>

            <nav class="space-y-2">
                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 cursor-pointer">
                    <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center">
                        <span class="text-xs text-white">📊</span>
                    </div>
                    <span class="text-sm text-gray-custom">Mes transactions</span>
                </div>

                <div class="flex items-center space-x-3 p-3 rounded-lg bg-gray-800 border-l-4 border-blue-500">
                    <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center">
                        <span class="text-xs text-white">+</span>
                    </div>
                    <span class="text-sm text-white">Ajouter compte</span>
                </div>

                <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 cursor-pointer">
                    <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center">
                        <span class="text-xs text-white">👁</span>
                    </div>
                    <span class="text-sm text-gray-custom">Voir mes comptes</span>
                </div>
            </nav>

            <div class="absolute bottom-4 left-4">
                <div class="flex items-center space-x-3 p-3 text-gray-custom hover:text-white cursor-pointer">
                    <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center">
                        <span class="text-xs">↗</span>
                    </div>
                    <span class="text-sm">Se déconnecter</span>
                </div>
            </div>
        </div>
    </div>
</div> -->