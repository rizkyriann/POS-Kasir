<label class="block text-sm font-semibold">Nama</label>
<input name="name" value="{{ old('name', $user?->name) }}" required class="ta-input mt-2">
<label class="mt-4 block text-sm font-semibold">Email</label>
<input name="email" type="email" value="{{ old('email', $user?->email) }}" required class="ta-input mt-2">
<label class="mt-4 block text-sm font-semibold">Password {{ $user ? '(kosongkan jika tidak diubah)' : '' }}</label>
<input name="password" type="password" {{ $user ? '' : 'required' }} class="ta-input mt-2">
<label class="mt-4 block text-sm font-semibold">Role</label>
<select name="role" required class="ta-input mt-2">
    @foreach($roles as $role)
        <option value="{{ $role }}" @selected(old('role', $user?->role) === $role)>{{ $role }}</option>
    @endforeach
</select>
<div class="mt-6 flex gap-3"><button class="ta-btn-primary">Simpan</button><a href="{{ route('users.index') }}" class="ta-btn-secondary">Batal</a></div>
