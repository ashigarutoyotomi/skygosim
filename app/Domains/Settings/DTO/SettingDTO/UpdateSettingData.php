<?php


namespace App\Domains\Settings\DTO\SettingDTO;


use Spatie\DataTransferObject\DataTransferObject;

class UpdateSettingData extends DataTransferObject
{
    public string $section;
    public string $type;
    public string $title;
    public string $value;
    public int $id;
}
