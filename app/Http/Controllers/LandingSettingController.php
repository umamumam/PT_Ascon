<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\SocialFeed;
use Illuminate\Http\Request;

class LandingSettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->all();
        $feeds = SocialFeed::latest()->get();
        return view('landing.settings', compact('settings', 'feeds'));
    }

    public function update(Request $request)
    {
        $keys = [
            'hero_title',
            'hero_subtitle',
            'head_office_address',
            'semarang_office_address',
            'phone',
            'phone_2',
            'phone_semarang',
            'phone_semarang_2',
            'email',
            'whatsapp',
            'facebook_link',
            'instagram_link',
            'linkedin_link',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $request->get($key)]
                );
            }
        }

        return redirect()->route('cms.settings.index')->with('success', 'Global landing settings updated successfully.');
    }
}
