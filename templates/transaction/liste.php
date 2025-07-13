<div class="mb-8">
    <div class="bg-card-custom rounded-lg p-6">
        <h2 class="text-lg font-semibold mb-2">Total Solde</h2>
        <p class="text-3xl font-bold"><?= number_format($compte->getSolde(), 0, ',', ' ') ?> Fcfa</p>
    </div>
</div>

<!-- Barre de recherche et filtres -->
<div class="mb-6 flex flex-col md:flex-row gap-4">
    <div class="flex-1 relative">
        <input type="text"
            placeholder="Search"
            class="w-full bg-card-custom border border-gray-custom rounded-lg px-4 py-2 pl-10 text-white placeholder-gray-custom focus:outline-none focus:border-gray-500">
        <div class="absolute left-3 top-2.5">
            <svg class="w-4 h-4 text-gray-custom" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
    </div>
    <button class="bg-card-custom border border-gray-custom rounded-lg px-4 py-2 flex items-center space-x-2 hover:bg-gray-700">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
        </svg>
        <span>Filters</span>
    </button>
</div>

<!-- Section Transactions -->
<div class="bg-card-custom rounded-lg">
    <!-- En-tête du tableau -->
    <div class="p-4 border-b border-gray-custom">
        <div class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-gray-custom" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="font-medium">Transactions</span>
            <svg class="w-4 h-4 text-gray-custom ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>

    <!-- En-tête des colonnes -->
    <div class="hidden md:grid md:grid-cols-2 gap-4 p-4 border-b border-gray-custom text-sm text-gray-custom">
        <div>Transactions</div>
        <div class="text-right">Date de transaction</div>
    </div>

    <!-- Liste des transactions -->
    <div class="divide-y divide-gray-custom">
        <!-- Transaction 1 -->
        <?php foreach ($transactions as $t): ?>
            <div class="p-3 grid grid-cols-1 md:grid-cols-2 gap-4 hover:bg-gray-800 transition-colors">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gray-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium"><?= ucfirst(strtolower($t->getTypeTransaction()->name)) ?></p>
                        <p class="text-sm text-gray-custom"><?= number_format($t->getMontant(), 0, ',', ' ') ?> Fcfa</p>
                    </div>
                </div>
                <div class="text-right md:text-right text-left">
                    <p class="text-sm text-gray-custom"><?= date('d M Y', strtotime($t->getDateDebit())) ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="p-4 border-t border-gray-custom flex items-center justify-between">
        <div class="text-sm text-gray-custom">
            Page 1 of 10
        </div>
        <div class="flex space-x-2">
            <button class="px-3 py-1 bg-gray-700 text-gray-300 rounded hover:bg-gray-600 transition-colors">
                Previous
            </button>
            <button class="px-3 py-1 bg-gray-700 text-gray-300 rounded hover:bg-gray-600 transition-colors">
                Next
            </button>
        </div>
    </div>
</div>