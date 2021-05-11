<?php


namespace App\Domains\Settings\Actions;


use App\Domains\Settings\DTO\SettingDTO\UpdateSettingData;
use App\Domains\Settings\Models\Setting;

class SettingAction
{
    public function update(UpdateSettingData $data)
    {
        $setting = Setting::find($data->id);

        abort_unless($setting, 404, 'Setting not found');

        $setting->section = $data->section;
        $setting->type = $data->type;
        $setting->title = $data->title;
        $setting->value = $data->value;

        $setting->save();

        return $setting;
    }
}
