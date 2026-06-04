<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MenuCategoryController extends Controller
{
    public function index(): View
    {
        return view('menu-categories.index', [
            'categories' => MenuCategory::query()->withCount('menus')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('menu-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        MenuCategory::query()->create($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => false]);

        return redirect()->route('menu-categories.index')->with('status', 'Kategori menu berhasil dibuat.');
    }

    public function edit(MenuCategory $menuCategory): View
    {
        return view('menu-categories.edit', ['category' => $menuCategory]);
    }

    public function update(Request $request, MenuCategory $menuCategory): RedirectResponse
    {
        $menuCategory->update($request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]) + ['is_active' => false]);

        return redirect()->route('menu-categories.index')->with('status', 'Kategori menu berhasil diperbarui.');
    }

    public function destroy(MenuCategory $menuCategory): RedirectResponse
    {
        if ($menuCategory->menus()->exists()) {
            $menuCategory->update(['is_active' => false]);

            return back()->with('status', 'Kategori masih dipakai menu, jadi dinonaktifkan.');
        }

        $menuCategory->delete();

        return back()->with('status', 'Kategori menu berhasil dihapus.');
    }
}
