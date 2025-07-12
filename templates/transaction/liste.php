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

<!-- Transactions section -->
<div class="bg-dark-card rounded-2xl p-5">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-3">
            <div class="bg-gray-600 p-2 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
            <h2 class="text-xl font-semibold">Transactions</h2>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
        <div class="text-sm text-gray-400 hidden sm:block">Date de transaction</div>
    </div>

    <!-- Transactions list -->
    <div class="space-y-4">
        <?php foreach ($transactions as $t): ?>
            <div class="flex items-center justify-between p-1 hover:bg-gray-800 rounded-lg transition-colors">
                <div class="flex items-center space-x-4">
                    <div class="bg-gray-600 p-3 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium"><?= ucfirst(strtolower($t->getTypeTransaction()->name)) ?></div>
                        <div class="text-sm text-gray-400"><?= number_format($t->getMontant(), 0, ',', ' ') ?> Fcfa</div>
                    </div>
                </div>
                <div class="text-sm text-gray-400"><?= date('d M Y', strtotime($t->getDateDebit())) ?></div>
            </div>
        <?php endforeach; ?>
    </div>

</div>