<?php


namespace App\Helpers;


use App\Models\Site;

class SiteHelper
{
    public static function getSiteInfo($field)
    {
        $site =  Site::query()->first();

        return $site->$field;
    }
}
