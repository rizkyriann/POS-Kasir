<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        return view('menus.index', [
            'menus' => Menu::query()->with('category')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('menus.create', ['categories' => $this->activeCategories()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::query()->create($data + ['is_available' => false]);

        return redirect()->route('menus.index')->with('status', 'Menu berhasil dibuat.');
    }

    public function edit(Menu $menu): View
    {
        return view('menus.edit', ['menu' => $menu, 'categories' => $this->activeCategories()]);
    }

    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }

            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data + ['is_available' => false]);

        return redirect()->route('menus.index')->with('status', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->update(['is_available' => false]);

        return back()->with('status', 'Menu berhasil dinonaktifkan.');
    }

    private function activeCategories()
    {
        return MenuCategory::query()->where('is_active', true)->orderBy('name')->get();
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'menu_category_id' => ['required', 'exists:menu_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'max:2048'],
            'description' => ['nullable', 'string'],
            'is_available' => ['nullable', 'boolean'],
        ]);
    }
}
