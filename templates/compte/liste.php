<div class="flex justify-center w-full h-full flex-col">
    <div class="bg-gray-800 rounded-lg overflow-hidden">
        <!-- Table Header -->
        <div class="grid grid-cols-12 gap-4 px-6 py-4 bg-gray-700 text-sm font-medium text-gray-300">
            <div class="col-span-1">📱</div>
            <div class="col-span-4">Numéro Compte</div>
            <div class="col-span-3 text-center">Solde Compte</div>
            <div class="col-span-3 text-center">Statut</div>
            <div class="col-span-1"></div>
        </div>

        <!-- Table Rows -->
        <div class="divide-y divide-gray-700">
            <?php foreach ($comptes as $compte): ?>
                <?php
                $numero = $compte->getNumeroTel();
                $solde = number_format($compte->getSolde(), 0, ',', ' ') . ' Fcfa';
                $statut = $compte->isDefault() ? 'Default' : 'Secondaire';
                ?>
                <div class="grid grid-cols-12 gap-4 px-6 py-4 hover:bg-gray-700 transition-colors">
                    <div class="col-span-1">
                        <div class="w-8 h-8 bg-gray-600 rounded flex items-center justify-center">
                            <span class="text-xs">📱</span>
                        </div>
                    </div>
                    <div class="col-span-4 font-mono"><?= htmlspecialchars($numero) ?></div>
                    <div class="col-span-3 text-center"><?= $solde ?></div>
                    <div class="col-span-3 text-center">
                        <span class="px-3 py-1 bg-gray-600 rounded-full text-sm"><?= $statut ?></span>
                    </div>
                    <div class="col-span-1">
                        <div class="col-span-1">
                            <?php if (!$compte->isDefault()): ?>
                                <form method="POST" action="/client/compte/rendre-principal/<?= $compte->getId() ?>" class="inline">
                                    <button type="submit" class="text-gray-400 hover:text-white" title="Définir comme principal">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-gray-400">Page 1</div>
        <div class="flex space-x-2">
            <button class="px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-600 transition-colors">Précédent</button>
            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors">Suivant</button>
        </div>
    </div>
</div>