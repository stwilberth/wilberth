<?php

namespace App\Services;

class CostaRicaLocations
{
    protected static ?array $data = null;

    protected static function data(): array
    {
        if (self::$data === null) {
            $raw = json_decode(file_get_contents(database_path('data/costarica.json')), true);

            self::$data = $raw['provincias'] ?? [];
        }

        return self::$data;
    }

    public static function provinceName(string $code): ?string
    {
        return self::data()[$code]['nombre'] ?? null;
    }

    public static function cantonName(string $province, string $canton): ?string
    {
        return self::data()[$province]['cantones'][str_pad($canton, 2, '0', STR_PAD_LEFT)]['nombre'] ?? null;
    }

    public static function districtName(string $province, string $canton, string $district): ?string
    {
        return self::data()[$province]['cantones'][str_pad($canton, 2, '0', STR_PAD_LEFT)]['distritos'][str_pad($district, 2, '0', STR_PAD_LEFT)] ?? null;
    }
}
