<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
    <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">Nombre</label>
        <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
               class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">Categoría</label>
        <select name="category_id" class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600" required>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ (old('category_id', $product->category_id ?? '')) == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">URL de imagen</label>
        <input type="url" name="image" value="{{ old('image', $product->image ?? '') }}" placeholder="https://..."
               class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600">
    </div>

    <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">Descripción</label>
        <textarea name="description" rows="3" class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600">{{ old('description', $product->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">Precio (S/)</label>
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? '') }}"
               class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-ink-900 dark:text-white mb-1.5">Stock</label>
        <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}"
               class="w-full border border-stone-100 dark:border-white/10 dark:bg-white/5 dark:text-white rounded-xl px-4 py-2.5 focus:ring-forest-600 focus:border-forest-600" required>
    </div>
</div>