<?php
use App\Settings\GeneralSettings;

class HomeController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        return view('home', [
            'siteName' => $settings->site_name,
            'timezone' => $settings->timezone
        ]);
    }
}