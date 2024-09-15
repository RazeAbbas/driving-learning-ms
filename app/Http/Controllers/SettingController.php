<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // private $page_title = '';
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showSettings()
    {
        $data = array(
            'page_title' => "Stripe Settings",
        );
        $data['stripeKey'] = Setting::where('key', 'stripe_key')->value('value');
        $data['stripeSecret'] = Setting::where('key', 'stripe_secret')->value('value');
        /* $data['paypalKey'] = Setting::where('key', 'paypal_key')->value('value');
        $data['paypalSecret'] = Setting::where('key', 'paypal_secret')->value('value'); */
        $data['active_module'] = "home";
        return view('admin.setting', $data);
    }
    
    public function updateSettings(Request $request)
    {
        $data = array(
            'page_title' => "Stripe Settings",
        );
        $request->all();
        Setting::updateOrCreate(['key' => 'stripe_key'], ['value' => $request->stripe_key]);
        Setting::updateOrCreate(['key' => 'stripe_secret'], ['value' => $request->stripe_secret]);
        /* Setting::updateOrCreate(['key' => 'paypal_key'], ['value' => $request->paypal_key]);
        Setting::updateOrCreate(['key' => 'paypal_secret'], ['value' => $request->paypal_secret]); */
        
        return redirect()->route('admin.settings', $data)->with('success', 'Settings updated successfully.');
    }
}
