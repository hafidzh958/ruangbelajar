<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RegisterFormSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * RegisterFormSettingController: Mengelola pengaturan form pendaftaran.
 * Singleton pattern — hanya 1 record, jadi hanya index + update.
 */
class RegisterFormSettingController extends Controller
{
    public function index()
    {
        $formSetting = RegisterFormSetting::first() ?? new RegisterFormSetting([
            'button_text' => 'Daftar Sekarang',
        ]);

        return view('admin.register.form-setting', compact('formSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'form_title'      => 'nullable|string|max:255',
            'form_highlight'  => 'nullable|string|max:255',
            'button_text'     => 'nullable|string|max:100',
            'success_message' => 'nullable|string',
            'whatsapp_notice' => 'nullable|string',
            'privacy_notice'  => 'nullable|string',
            'form_image'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $formSetting = RegisterFormSetting::first() ?? new RegisterFormSetting();

        $data = $request->only([
            'form_title', 'form_highlight', 'button_text',
            'success_message', 'whatsapp_notice', 'privacy_notice',
        ]);

        if ($request->hasFile('form_image')) {
            if ($formSetting->form_image && Storage::disk('public')->exists($formSetting->form_image)) {
                Storage::disk('public')->delete($formSetting->form_image);
            }
            $data['form_image'] = $request->file('form_image')->store('images/register', 'public');
        }

        $formSetting->fill($data)->save();

        return redirect()->route('admin.register.form-setting.index')
            ->with('success', '✅ Pengaturan form berhasil diperbarui!');
    }
}
