<?php
use App\Settings\GeneralSettings;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $settings = app(GeneralSettings::class);

        $settings->site_name = 'Mano Laravel sistema';
        $settings->timezone = 'Europe/Vilnius';
        $settings->maintenance_mode = false;
        $settings->save();
    }
}
