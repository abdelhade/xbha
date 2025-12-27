<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    protected $path = 'admin_settings.json';

    public function index()
    {
        $settings = [];
        if (Storage::exists($this->path)) {
            $settings = json_decode(Storage::get($this->path), true);
        }

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'nullable|string|max:255',
            'support_email' => 'nullable|email',
            'sms_notifications' => 'nullable|boolean',
        ]);

        // Normalize checkbox
        $data['sms_notifications'] = (bool) ($request->input('sms_notifications'));

        Storage::put($this->path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return redirect()->back()->with('message', 'تم حفظ الإعدادات');
    }
}