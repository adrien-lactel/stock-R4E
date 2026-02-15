

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">👥 Gestion des utilisateurs</h1>
                <p class="text-sm text-gray-400 mt-1">Liste complète des utilisateurs du système</p>
            </div>
            <a href="<?php echo e(route('admin.dashboard')); ?>" 
               class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition">
                ← Retour
            </a>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <?php
                $totalUsers = $users->count();
                $admins = $users->where('role', 'admin')->count();
                $stores = $users->where('type', 'Magasin')->count();
                $repairers = $users->where('type', 'Réparateur')->count();
            ?>
            
            <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4">
                <div class="text-xs text-gray-400 uppercase mb-1">Total utilisateurs</div>
                <div class="text-2xl font-bold text-white"><?php echo e($totalUsers); ?></div>
            </div>
            <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4">
                <div class="text-xs text-gray-400 uppercase mb-1">Administrateurs</div>
                <div class="text-2xl font-bold text-purple-400"><?php echo e($admins); ?></div>
            </div>
            <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4">
                <div class="text-xs text-gray-400 uppercase mb-1">Magasins</div>
                <div class="text-2xl font-bold text-blue-400"><?php echo e($stores); ?></div>
            </div>
            <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4">
                <div class="text-xs text-gray-400 uppercase mb-1">Réparateurs</div>
                <div class="text-2xl font-bold text-green-400"><?php echo e($repairers); ?></div>
            </div>
        </div>

        
        <div class="bg-gray-800/30 backdrop-blur border border-gray-700/50 rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-900/50 border-b border-gray-700/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Utilisateur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Affiliation</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Créé le</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-700/30 transition">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-white"><?php echo e($user['name']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-400"><?php echo e($user['email']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php if($user['type'] === 'Administrateur'): ?>
                                        <span class="px-2 py-1 text-xs font-semibold rounded bg-purple-900/50 text-purple-300">
                                            👑 <?php echo e($user['type']); ?>

                                        </span>
                                    <?php elseif($user['type'] === 'Magasin'): ?>
                                        <span class="px-2 py-1 text-xs font-semibold rounded bg-blue-900/50 text-blue-300">
                                            🏬 <?php echo e($user['type']); ?>

                                        </span>
                                    <?php elseif($user['type'] === 'Réparateur'): ?>
                                        <span class="px-2 py-1 text-xs font-semibold rounded bg-green-900/50 text-green-300">
                                            🔧 <?php echo e($user['type']); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 text-xs font-semibold rounded bg-gray-700/50 text-gray-300">
                                            <?php echo e($user['type']); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-400"><?php echo e($user['affiliation']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-400"><?php echo e($user['created_at']->format('d/m/Y')); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <button onclick="resetPassword(<?php echo e($user['id']); ?>, '<?php echo e($user['name']); ?>')"
                                            class="inline-flex items-center px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded transition">
                                        🔑 Réinitialiser
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    Aucun utilisateur trouvé
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<div id="reset-password-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-gray-800 rounded-lg max-w-md w-full p-6 border border-gray-700">
        <h3 class="text-lg font-semibold text-white mb-4">Réinitialiser le mot de passe</h3>
        <p class="text-sm text-gray-400 mb-4">
            Voulez-vous réinitialiser le mot de passe de <strong id="user-name" class="text-white"></strong> ?
        </p>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-400 mb-2">
                Nouveau mot de passe (optionnel)
            </label>
            <input type="text" id="new-password-input" 
                   class="w-full px-3 py-2 bg-gray-900 border border-gray-700 rounded text-white text-sm focus:outline-none focus:border-indigo-500"
                   placeholder="Laisser vide pour générer automatiquement">
            <p class="text-xs text-gray-500 mt-1">Si vide, un mot de passe aléatoire sera généré</p>
        </div>

        <div class="flex gap-3">
            <button onclick="closeModal()" 
                    class="flex-1 px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded transition">
                Annuler
            </button>
            <button onclick="confirmResetPassword()" 
                    class="flex-1 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded transition">
                Confirmer
            </button>
        </div>
    </div>
</div>


<div id="result-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-gray-800 rounded-lg max-w-md w-full p-6 border border-gray-700">
        <h3 class="text-lg font-semibold text-white mb-4">✅ Mot de passe réinitialisé</h3>
        <div class="bg-gray-900 rounded p-4 mb-4">
            <p class="text-sm text-gray-400 mb-2">Nouveau mot de passe pour <strong id="result-user" class="text-white"></strong> :</p>
            <div class="flex items-center gap-2">
                <input type="text" id="generated-password" readonly
                       class="flex-1 px-3 py-2 bg-gray-950 border border-gray-700 rounded text-white font-mono text-sm">
                <button onclick="copyPassword()" 
                        class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm rounded transition">
                    📋 Copier
                </button>
            </div>
        </div>
        <button onclick="closeResultModal()" 
                class="w-full px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded transition">
            Fermer
        </button>
    </div>
</div>

<script>
let currentUserId = null;

function resetPassword(userId, userName) {
    currentUserId = userId;
    document.getElementById('user-name').textContent = userName;
    document.getElementById('new-password-input').value = '';
    document.getElementById('reset-password-modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('reset-password-modal').classList.add('hidden');
}

function closeResultModal() {
    document.getElementById('result-modal').classList.add('hidden');
}

async function confirmResetPassword() {
    const newPassword = document.getElementById('new-password-input').value;
    
    try {
        const response = await fetch(`/admin/users/${currentUserId}/reset-password`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                new_password: newPassword || null
            })
        });

        const data = await response.json();

        if (data.success) {
            closeModal();
            document.getElementById('result-user').textContent = data.user;
            document.getElementById('generated-password').value = data.new_password;
            document.getElementById('result-modal').classList.remove('hidden');
        } else {
            alert('❌ Erreur: ' + (data.message || 'Erreur inconnue'));
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('❌ Erreur lors de la réinitialisation du mot de passe');
    }
}

function copyPassword() {
    const input = document.getElementById('generated-password');
    input.select();
    document.execCommand('copy');
    
    const btn = event.target;
    const originalText = btn.textContent;
    btn.textContent = '✅ Copié !';
    setTimeout(() => {
        btn.textContent = originalText;
    }, 2000);
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/users/index.blade.php ENDPATH**/ ?>