<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $query = User::query()->latest();

        if (auth()->user()->role === 'admin') {
            $query->where('role', 'kasir');
        }

        return view('users.index', ['users' => $query->paginate(10)]);
    }

    public function create(): View
    {
        return view('users.create', ['roles' => $this->allowedRoles()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', Rule::in($this->allowedRoles())],
        ]);

        $data['password'] = Hash::make($data['password']);
        User::query()->create($data);

        return redirect()->route('users.index')->with('status', 'User berhasil dibuat.');
    }

    public function edit(User $user): View
    {
        $this->authorizeAdminKasir($user);

        return view('users.edit', ['user' => $user, 'roles' => $this->allowedRoles()]);
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorizeAdminKasir($user);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', Rule::in($this->allowedRoles())],
        ]);

        if ($data['password'] ?? false) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('status', 'User berhasil diperbarui.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorizeAdminKasir($user);

        if ($user->is(auth()->user())) {
            return back()->withErrors(['user' => 'User yang sedang login tidak bisa dihapus.']);
        }

        $user->delete();

        return back()->with('status', 'User berhasil dihapus.');
    }

    private function allowedRoles(): array
    {
        return auth()->user()->role === 'owner' ? ['owner', 'admin', 'kasir'] : ['kasir'];
    }

    private function authorizeAdminKasir(User $user): void
    {
        if (auth()->user()->role === 'admin' && $user->role !== 'kasir') {
            abort(403);
        }
    }
}
