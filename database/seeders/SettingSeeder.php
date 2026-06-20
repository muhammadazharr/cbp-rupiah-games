<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'rupa_rupiah_timer', 'value' => '25'],
            ['key' => 'ingat_rupiah_memorize_timer', 'value' => '8'],
            ['key' => 'ingat_rupiah_answer_timer', 'value' => '18'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], ['value' => $setting['value']]);
        }
    }
}
