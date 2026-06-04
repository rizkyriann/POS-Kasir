<label class="block text-sm font-semibold">Kategori</label>
<select name="menu_category_id" required class="ta-input mt-2">
    <option value="">Pilih kategori</option>
    @foreach($categories as $category)
        <option value="{{ $category->id }}" @selected(old('menu_category_id', $menu?->menu_category_id) == $category->id)>{{ $category->name }}</option>
    @endforeach
</select>
<label class="mt-4 block text-sm font-semibold">Nama Menu</label>
<input name="name" value="{{ old('name', $menu?->name) }}" required class="ta-input mt-2">
<label class="mt-4 block text-sm font-semibold">Harga</label>
<input name="price" type="number" min="0" step="100" value="{{ old('price', $menu?->price) }}" required class="ta-input mt-2">
<label class="mt-4 block text-sm font-semibold">Gambar</label>
<input name="image" type="file" accept="image/*" class="ta-input mt-2 h-auto">
@if($menu?->image)<p class="mt-2 text-xs text-gray-500">Gambar saat ini: {{ $menu->image }}</p>@endif
<label class="mt-4 block text-sm font-semibold">Deskripsi</label>
<textarea name="description" rows="4" class="ta-input mt-2 h-auto">{{ old('description', $menu?->description) }}</textarea>
<label class="mt-4 flex items-center gap-2 text-sm"><input type="checkbox" name="is_available" value="1" @checked(old('is_available', $menu?->is_available ?? true))> Tersedia di POS</label>
<div class="mt-6 flex gap-3"><button class="ta-btn-primary">Simpan</button><a href="{{ route('menus.index') }}" class="ta-btn-secondary">Batal</a></div>
