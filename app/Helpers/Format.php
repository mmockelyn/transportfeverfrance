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

    public static function labelDownloadVersionType($type)
    {
        switch ($type) {
            case 'alpha':
                return '<span class="label label-light-danger font-weight-bolder label-inline ml-2">Alpha</span>';
                break;
            case 'beta':
                return '<span class="label label-light-info font-weight-bolder label-inline ml-2">Beta</span>';
                break;
            case 'release':
                return '<span class="label label-light-success font-weight-bolder label-inline ml-2">Release</span>';
                break;
            case 'hotfix':
                return '<span class="label label-light-warning font-weight-bolder label-inline ml-2">Hotfix</span>';
                break;
            default:
                return '<span class="label label-light-warning font-weight-bolder label-inline ml-2">Hotfix</span>';
        }
    }

    public static function labelDownloadSupportState($state)
    {
        switch ($state) {
            case 0: return '<span class="label label-success font-weight-bolder label-inline ml-2">Ouvert</span>'; break;
            case 1: return '<span class="label label-info font-weight-bolder label-inline ml-2">En attente de l\'auteur</span>'; break;
            case 2: return '<span class="label label-info font-weight-bolder label-inline ml-2">En attente de l\'utilisateur</span>'; break;
            case 3: return '<span class="label label-danger font-weight-bolder label-inline ml-2">Terminer</span>'; break;
            default: return null;
        }
    }

    public static function percentProfilComplete($value){
        if($value <= 33) {
            return '
                <div class="progress progress-xs mx-3 w-100">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: '.$value.'%;" aria-valuenow="'.$value.'" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="font-weight-bolder text-dark">'.round($value, 0).' % completer</span>';
        } elseif($value > 34 && $value <= 66) {
            return '
                <div class="progress progress-xs mx-3 w-100">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: '.$value.'%;" aria-valuenow="'.$value.'" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="font-weight-bolder text-dark">'.round($value, 0).' % completer</span>';
        } else {
            return '
                <div class="progress progress-xs mx-3 w-100">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: '.$value.'%;" aria-valuenow="'.$value.'" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="font-weight-bolder text-dark">'.round($value, 0).' % completer</span>';
        }
    }

    public static function formatSocialProvider($provider, $user)
    {
        switch ($provider) {
            case 'facebook':
                if($user->social->facebook_id)
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-facebook text-default"></i>
                            </div>';
                else
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-facebook text-default"></i>
                            </div>';
                break;

            case 'google':
                if($user->social->google_id)
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-google text-default"></i>
                            </div>';
                else
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-google text-default"></i>
                            </div>';
                break;

            case 'twitter':
                if($user->social->twitter_id)
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-twitter text-default"></i>
                            </div>';
                else
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-twitter text-default"></i>
                            </div>';
                break;

            case 'steam':
                if($user->social->steam_id)
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-steam text-default"></i>
                            </div>';
                else
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-steam text-default"></i>
                            </div>';
                break;

            case 'discord':
                if($user->social->discord_user_id)
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-facebook text-default"></i>
                            </div>';
                else
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-facebook text-default"></i>
                            </div>';
        }
    }
}
