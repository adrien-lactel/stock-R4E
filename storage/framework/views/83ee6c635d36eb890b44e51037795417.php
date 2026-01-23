<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto py-10 px-6">

    <div class="mb-6">
        <a href="<?php echo e(route('admin.mods.index')); ?>" class="text-blue-600 hover:underline">
            ← Retour à la liste
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-6">➕ Créer un Mod</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="<?php echo e(route('admin.mods.store')); ?>">
            <?php echo csrf_field(); ?>

            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Nom du Mod *</label>
                <input type="text" 
                       name="name" 
                       value="<?php echo e(old('name')); ?>"
                       required
                       class="w-full border rounded p-2 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="Ex: Changement ventilateur, Câble HDMI, etc.">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Icône (emoji)</label>
                <input type="text" 
                       name="icon" 
                       id="icon_input"
                       value="<?php echo e(old('icon', '🔧')); ?>"
                       maxlength="10"
                       class="w-full border rounded p-2 <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="Ex: 🔧 ⚙️ 🎮 📦 🔌">
                
                <div class="mt-2">
                    <p class="text-xs text-gray-600 mb-2">Sélectionnez une icône :</p>
                    <div class="grid grid-cols-10 gap-2">
                        <?php
                            $icons = ['🔧', '⚙️', '🔌', '🔋', '📦', '🎮', '💾', '📀', '🖥️', '⌨️', 
                                      '🖱️', '🎧', '🔊', '📱', '📺', '🎨', '🖼️', '✨', '⭐', '💡',
                                      '🔴', '🟢', '🔵', '🟡', '🟣', '🟠', '⚫', '⚪', '🟤', '📍'];
                        ?>
                        <?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emoji): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" 
                                    onclick="selectIcon('<?php echo e($emoji); ?>')"
                                    class="text-2xl hover:bg-gray-100 rounded p-2 transition"
                                    title="<?php echo e($emoji); ?>">
                                <?php echo e($emoji); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                
                <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Description *</label>
                <textarea name="description" 
                          rows="3"
                          required
                          class="w-full border rounded p-2 <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="Description détaillée du mod ou accessoire"><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Prix d'achat (€) *</label>
                    <input type="number" 
                           step="0.01" 
                           name="purchase_price" 
                           value="<?php echo e(old('purchase_price')); ?>"
                           required
                           class="w-full border rounded p-2 <?php $__errorArgs = ['purchase_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['purchase_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Quantité en stock *</label>
                    <input type="number" 
                           name="quantity" 
                           value="<?php echo e(old('quantity', 0)); ?>"
                           required
                           min="0"
                           class="w-full border rounded p-2 <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_accessory" 
                           value="1"
                           <?php echo e(old('is_accessory') ? 'checked' : ''); ?>

                           class="mr-2">
                    <span class="text-sm font-medium">📦 Ceci est un accessoire (câble, boîte, etc.)</span>
                </label>
            </div>

            
            <div class="mb-6 border-t pt-4">
                <h3 class="text-lg font-semibold mb-3">🎯 Compatibilité</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Sélectionnez les catégories/types compatibles. Laissez vide pour un mod universel.
                </p>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Catégories compatibles</label>
                    <select name="compatible_categories[]" 
                            multiple
                            class="w-full border rounded p-2"
                            size="5">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"
                                    <?php echo e(in_array($category->id, old('compatible_categories', [])) ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Maintenez Ctrl/Cmd pour sélectionner plusieurs</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Sous-catégories compatibles</label>
                    <select name="compatible_sub_categories[]" 
                            multiple
                            class="w-full border rounded p-2"
                            size="5">
                        <?php $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($subCategory->id); ?>"
                                    <?php echo e(in_array($subCategory->id, old('compatible_sub_categories', [])) ? 'selected' : ''); ?>>
                                <?php echo e($subCategory->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Types compatibles</label>
                    <select name="compatible_types[]" 
                            multiple
                            class="w-full border rounded p-2"
                            size="5">
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->id); ?>"
                                    <?php echo e(in_array($type->id, old('compatible_types', [])) ? 'selected' : ''); ?>>
                                <?php echo e($type->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="flex justify-end space-x-3">
                <a href="<?php echo e(route('admin.mods.index')); ?>" 
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    Annuler
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    ✅ Créer le Mod
                </button>
            </div>
        </form>
    </div>

</div>

<script>
function selectIcon(icon) {
    document.getElementById('icon_input').value = icon;
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/mods/create.blade.php ENDPATH**/ ?>