<?php


namespace App\Helpers;


class DownloadHelper
{
    public static function getDownloadLink($download)
    {
        if ($download->steam_link_package) {
            return $download->steam_link_package;
        } elseif ($download->tfnet_link_package) {
            return $download->tfnet_link_package;
        } else {
            return $download->tf_france_link_package;
        }
    }
}
