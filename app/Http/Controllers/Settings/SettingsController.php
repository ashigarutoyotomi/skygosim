<?php


namespace App\Http\Controllers\Settings;


use App\Domains\Settings\Actions\SettingAction;
use App\Domains\Settings\DTO\SettingDTO\UpdateSettingData;
use App\Domains\Settings\Gateways\SettingGateway;
use App\Domains\Settings\Models\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\CreateSettingRequest;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::get()
            ->groupBy('section');

        return $settings;
    }

    public function pricesSettings()
    {
        return (new SettingGateway)->getPricesSettings();
    }

    public function pricesSettingsStore(CreateSettingRequest $request)
    {
        $settingData = new UpdateSettingData([
            'id' => (int)$request->get('id'),
            'section' => $request->get('section'),
            'title' => $request->get('title'),
            'type' => $request->get('type'),
            'value' => $request->get('value'),
        ]);

        return (new SettingAction)->update($settingData);
    }
}
