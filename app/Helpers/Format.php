<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class Format
{
    public static function formatUserGroup($group)
    {
        switch ($group) {
            case 0:
                return 'Utilisateur';
            case 1:
                return 'Administrateur';
            default:
                return 'Aucun groupe';
        }
    }

    public static function switchDownloadProvider($providers)
    {
        switch ($providers) {
            case 'steam':
                return 'steam_icon.png';
            case 'tfnet':
                return 'tf_net_icon.png';
            case 'tf_france':
                return 'tf_france_icon.png';
            default:
                return 'null_icon.png';
        }
    }

    public static function symbolDownloadProvider($provider, $size = 20)
    {
        switch ($provider) {
            case 'steam':
                return '<div class="symbol symbol-' . $size . ' symbol-lg-30 symbol-circle mr-3" data-toggle="tooltip" data-theme="dark" data-placement="right" title="Steam">
                            <img alt="Pic" src="storage/files/shares/core/icons/steam_icon.png"/>
                        </div>';
                break;
            case 'tfnet':
                return '<div class="symbol symbol-' . $size . ' symbol-lg-30 symbol-circle mr-3" data-toggle="tooltip" data-theme="dark" data-placement="right" title="Transport Fever net">
                            <img alt="Pic" src="storage/files/shares/core/icons/tf_net_icon.png"/>
                        </div>';
                break;

            case 'tf_france':
                return '<div class="symbol symbol-' . $size . ' symbol-lg-30 symbol-circle mr-3" data-toggle="tooltip" data-theme="dark" data-placement="right" title="TF France">
                            <img alt="Pic" src="storage/files/shares/core/icons/tf_france_icon.png"/>
                        </div>';
                break;

            default:
                return '<div class="symbol symbol-' . $size . ' symbol-lg-30 symbol-circle mr-3" data-toggle="tooltip" data-theme="dark" data-placement="right" title="Aucun">
                            <img alt="Pic" src="storage/files/shares/core/icons/null_icon.png"/>
                        </div>';
                break;
        }
    }

    public static function IsModAuthor($user, $download_id)
    {
        $value = DB::table('download_user')->where('download_id', $download_id)->where('user_id', $user)->first();
        if ($value == null) {
            return false;
        } else {
            return true;
        }
    }
}
