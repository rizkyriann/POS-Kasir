<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('settings.edit', [
            'settings' => [
                'cafe_name' => Setting::getValue('cafe_name', 'Cafe POS'),
                'cafe_address' => Setting::getValue('cafe_address'),
                'cafe_phone' => Setting::getValue('cafe_phone'),
                'receipt_footer_text' => Setting::getValue('receipt_footer_text'),
            ],
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'cafe_name' => ['required', 'string', 'max:255'],
            'cafe_address' => ['nullable', 'string'],
            'cafe_phone' => ['nullable', 'string', 'max:50'],
            'receipt_footer_text' => ['nullable', 'string'],
        ]);

        foreach ($data as $key => $value) {
            Setting::setValue($key, $value);
        }

        return back()->with('status', 'Pengaturan cafe berhasil disimpan.');
    }
}
