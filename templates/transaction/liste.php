<?php
use MAXITSA\ENTITY\TypeTransaction;
?>
<div class="mb-3">
    <div class="bg-card-custom rounded-lg p-3">
        <h2 class="text-lg font-semibold mb-2">Total Solde</h2>
        <p class="text-3xl font-bold"><?= number_format($compte->getSolde(), 0, ',', ' ') ?> Fcfa</p>
    </div>
</div>

<!-- Barre de recherche et filtres -->
<div class="flex flex-col justify-between md:flex-row gap-4">

    <form method="GET" class="flex flex-col md:flex-row gap-4 lex-1 mb-6">
        <?php if ($search) :  ?>
            <input type="text" name="date" placeholder="Date (YYYY-MM-DD)" class="bg-card-custom px-4 py-2 rounded-lg text-white" value="<?= htmlspecialchars($filters['date'] ?? '') ?>">
            <select name="type" class="bg-card-custom px-4 py-2 rounded-lg text-white">
                <option value="">Tous</option>
                <option value="<?= TypeTransaction::TRANSFERT->value ?>" <?= ($filters['type'] ?? '') === TypeTransaction::TRANSFERT->value ? 'selected' : '' ?>>Transfert</option>
                <option value="<?= TypeTransaction::PAIEMENT->value ?>" <?= ($filters['type'] ?? '') === TypeTransaction::PAIEMENT->value ? 'selected' : '' ?>>Paiement</option>
            </select>
            <input type="hidden" name="search" value="true">
            <button type="submit" class="bg-blue-600 px-4 px-4  rounded-lg text-white hover:bg-blue-500">Filtrer</button>
        <?php endif  ?>
    </form>
    <?php if (!$search) :  ?>
        <a href="trans?search=true" class="justify-center rounded-lg px-4 items-center w-24 bg-card-custom flex flex-col md:flex-row gap-4 lex-1 mb-6">
            <span class="bg-card-custom py-3 ">
                Voir plus
            </span>
        </a>
    <?php endif  ?>
</div>

<!-- Section Transactions -->
<div class="bg-card-custom rounded-lg">
    <!-- En-tête du tableau -->
    <!-- <div class="p-4 border-b border-gray-custom">
        <div class="flex items-center space-x-2">
            <svg class="w-5 h-5 text-gray-custom" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span class="font-medium">Transactions</span>
            <svg class="w-4 h-4 text-gray-custom ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div> -->

    <!-- En-tête des colonnes -->
    <div class="hidden md:grid md:grid-cols-2 gap-4 p-4 border-b border-gray-custom text-sm text-gray-custom">
        <div>Transactions</div>
        <div class="text-right">Date de transaction</div>
    </div>

    <!-- Liste des transactions -->
    <div class="divide-y divide-gray-custom px-2">
        <!-- Transaction 1 -->
        <?php foreach ($transactions as $t): ?>
            <div class="p-2 grid grid-cols-1 md:grid-cols-2 gap-4 hover:bg-gray-800 transition-colors">
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
    <?php if ($search) :  ?>
        <div class="p-4 border-t border-gray-custom flex items-center justify-between">
            <div class="text-sm text-gray-custom">
                Page <?= ($filters['offset'] / $filters['limit']) + 1 ?>
            </div>
            <div class="flex space-x-2">
                <?php $prev = max(0, $filters['offset'] - $filters['limit']); ?>
                <?php $next = $filters['offset'] + $filters['limit']; ?>
                <a href="?limit=<?= $filters['limit'] ?>&offset=<?= $prev ?>&type=<?= $filters['type'] ?? '' ?>&date=<?= $filters['date'] ?? '' ?>" class="px-3 py-1 bg-gray-700 text-gray-300 rounded hover:bg-gray-600">Previous</a>
                <a href="?limit=<?= $filters['limit'] ?>&offset=<?= $next ?>&type=<?= $filters['type'] ?? '' ?>&date=<?= $filters['date'] ?? '' ?>" class="px-3 py-1 bg-gray-700 text-gray-300 rounded hover:bg-gray-600">Next</a>
            </div>
        </div>
    <?php endif  ?>
</div>