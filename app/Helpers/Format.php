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
            case 1:
                return 'steam_icon.png';
            case 2:
                return 'tf_net_icon.png';
            case 3:
                return 'tf_france_icon.png';
            default:
                return 'null_icon.png';
        }
    }

    public static function symbolDownloadProvider($provider, $size = 20)
    {
        switch ($provider) {
            case 1:
                return '<div class="symbol symbol-' . $size . ' symbol-lg-30 symbol-circle mr-3" data-toggle="tooltip" data-theme="dark" data-placement="right" title="Steam">
                            <img alt="Pic" src="/storage/files/shares/core/icons/steam_icon.png"/>
                        </div>';
                break;
            case 2:
                return '<div class="symbol symbol-' . $size . ' symbol-lg-30 symbol-circle mr-3" data-toggle="tooltip" data-theme="dark" data-placement="right" title="Transport Fever net">
                            <img alt="Pic" src="/storage/files/shares/core/icons/tf_net_icon.png"/>
                        </div>';
                break;

            case 3:
                return '<div class="symbol symbol-' . $size . ' symbol-lg-30 symbol-circle mr-3" data-toggle="tooltip" data-theme="dark" data-placement="right" title="TF France">
                            <img alt="Pic" src="/storage/files/shares/core/icons/tf_france_icon.png"/>
                        </div>';
                break;

            default:
                return '<div class="symbol symbol-' . $size . ' symbol-lg-30 symbol-circle mr-3" data-toggle="tooltip" data-theme="dark" data-placement="right" title="Aucun">
                            <img alt="Pic" src="/storage/files/shares/core/icons/null_icon.png"/>
                        </div>';
                break;
        }
    }

    public static function DownloadState($state)
    {
        switch ($state) {
            case 0:
                return "<span class='badge badge-danger'>Non Publier</span>";
                break;

            case 1:
                return "<span class='badge badge-success'>Publier</span>";
                break;

            default:
                return "<span class='badge badge-default'>Inconnue</span>";
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

    public static function labelDownloadVersionType($type, $back = false)
    {
        if($back == false) {
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
        } else {
            switch ($type) {
                case 'alpha':
                    return '<span class="badge badge-light-danger font-weight-bolder ml-2">Alpha</span>';
                    break;
                case 'beta':
                    return '<span class="badge badge-light-info font-weight-bolder ml-2">Beta</span>';
                    break;
                case 'release':
                    return '<span class="badge badge-light-success font-weight-bolder ml-2">Release</span>';
                    break;
                case 'hotfix':
                    return '<span class="badge badge-light-warning font-weight-bolder ml-2">Hotfix</span>';
                    break;
                default:
                    return '<span class="badge badge-light-warning font-weight-bolder ml-2">Hotfix</span>';
            }
        }
    }

    public static function labelDownloadVersionState($state, $back = false)
    {
        if($back == false) {
            switch ($state) {
                case 0:
                    return '<span class="label label-light-danger font-weight-bolder label-inline ml-2">Non publier</span>';
                    break;

                case 1:
                    return '<span class="label label-light-warning font-weight-bolder label-inline ml-2">En cours de publication</span>';
                    break;

                case 2:
                    return '<span class="label label-light-success font-weight-bolder label-inline ml-2">Publier</span>';
                    break;

                default:
                    return '<span class="label label-light-default font-weight-bolder label-inline ml-2">Inconnue</span>';

            }
        } else {
            switch ($state) {
                case 0:
                    return '<span class="badge badge-light-danger font-weight-bolder label-inline ml-2">Non publier</span>';
                    break;

                case 1:
                    return '<span class="badge badge-light-warning font-weight-bolder label-inline ml-2">En cours de publication</span>';
                    break;

                case 2:
                    return '<span class="badge badge-light-success font-weight-bolder label-inline ml-2">Publier</span>';
                    break;

                default:
                    return '<span class="badge badge-light-default font-weight-bolder label-inline ml-2">Inconnue</span>';

            }
        }
    }

    public static function labelDownloadSupportState($state, $back = false)
    {
        if($back == false) {
            switch ($state) {
                case 0:
                    return '<span class="label label-success font-weight-bolder label-inline ml-2">Ouvert</span>';
                    break;
                case 1:
                    return '<span class="label label-info font-weight-bolder label-inline ml-2">En attente de l\'auteur</span>';
                    break;
                case 2:
                    return '<span class="label label-info font-weight-bolder label-inline ml-2">En attente de l\'utilisateur</span>';
                    break;
                case 3:
                    return '<span class="label label-danger font-weight-bolder label-inline ml-2">Terminer</span>';
                    break;
                default:
                    return null;
            }
        } else {
            switch ($state) {
                case 0:
                    return '<span class="badge badge-success font-weight-bolder label-inline ml-2">Ouvert</span>';
                    break;
                case 1:
                    return '<span class="badge badge-info font-weight-bolder label-inline ml-2">En attente de l\'auteur</span>';
                    break;
                case 2:
                    return '<span class="badge badge-info font-weight-bolder label-inline ml-2">En attente de l\'utilisateur</span>';
                    break;
                case 3:
                    return '<span class="badge badge-danger font-weight-bolder label-inline ml-2">Terminer</span>';
                    break;
                default:
                    return null;
            }
        }
    }

    public static function percentProfilComplete($value)
    {
        if ($value <= 33) {
            return '<div class="bg-danger rounded h-5px" role="progressbar" style="width: ' . $value . '%;" aria-valuenow="' . $value . '" aria-valuemin="0" aria-valuemax="100"></div>';
        } elseif ($value > 34 && $value <= 66) {
            return '<div class="bg-warning rounded h-5px" role="progressbar" style="width: ' . $value . '%;" aria-valuenow="' . $value . '" aria-valuemin="0" aria-valuemax="100"></div>';
        } else {
            return '<div class="bg-success rounded h-5px" role="progressbar" style="width: ' . $value . '%;" aria-valuenow="' . $value . '" aria-valuemin="0" aria-valuemax="100"></div>';
        }
    }

    public static function formatSocialProvider($provider, $user)
    {
        switch ($provider) {
            case 'facebook':
                if ($user->social->facebook_id)
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-facebook text-default"></i>
                            </div>';
                else
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-facebook text-default"></i>
                            </div>';
                break;

            case 'google':
                if ($user->social->google_id)
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-google text-default"></i>
                            </div>';
                else
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-google text-default"></i>
                            </div>';
                break;

            case 'twitter':
                if ($user->social->twitter_id)
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-twitter text-default"></i>
                            </div>';
                else
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-twitter text-default"></i>
                            </div>';
                break;

            case 'steam':
                if ($user->social->steam_id)
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-steam text-default"></i>
                            </div>';
                else
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-steam text-default"></i>
                            </div>';
                break;

            case 'discord':
                if ($user->social->discord_user_id)
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-facebook text-default"></i>
                            </div>';
                else
                    return '<div class="symbol symbol-20 symbol-lg-30 symbol-circle mr-3">
                                <i class="socicon-facebook text-default"></i>
                            </div>';
        }
    }

    public static function passwordComplexity($password)
    {
        $lgt = strlen($password);
        $point = 0;

        for ($i = 0; $i < $lgt; $i++) {
            $letter = $password[$i];

            if ($letter >= 'a' && $letter <= 'z') {
                $point = $point + 1;

                $point_min = 1;
                $point_maj = 0;
                $point_chiffre = 0;
                $point_other = 0;
            } elseif ($letter >= 'A' && $letter <= 'Z') {
                $point = $point + 2;
                $point_min = 0;
                $point_maj = 2;
                $point_chiffre = 0;
                $point_other = 0;
            } elseif ($letter >= '0' && $letter <= '9') {
                $point = $point + 3;
                $point_min = 0;
                $point_maj = 0;
                $point_chiffre = 3;
                $point_other = 0;
            } else {
                $point = $point + 5;

                $point_min = 0;
                $point_maj = 0;
                $point_chiffre = 5;
                $point_other = 0;
            }
        }

        $step1 = $point / $lgt;
        $step2 = $point_min + $point_maj + $point_chiffre + $point_other;
        $result = $step1 * $step2;

        return $result * $lgt;
    }

    public static function AdminStateBlog($state, $formated = true)
    {
        if ($formated == true) {
            switch ($state) {
                case 0:
                    return '<span class="text-danger">Non Publier</span>';
                    break;
                case 1:
                    return '<span class="text-success">Publier</span>';
                    break;
                default:
                    return null;
            }
        } else {
            switch ($state) {
                case 0:
                    return 'Non Publier';
                    break;
                case 1:
                    return 'Publier';
                    break;
                default:
                    return null;
            }
        }
    }

    public static function number_format($number, $euro = true, $stringColor = false)
    {
        if ($euro == true) {
            if ($stringColor == false) {
                return number_format($number, 2, ',', ' ') . " €";
            } else {
                if ($number < 0) {
                    return "<span class='text-danger'>" . self::number_format($number) . "</span>";
                } elseif ($number > 0) {
                    return "<span class='text-success'>" . self::number_format($number) . "</span>";
                } else {
                    return self::number_format($number);
                }
            }
        } else {
            return $number;
        }
    }

    public static function linkToPaypal()
    {
        if (config("paypal.mode") == 'sandbox') {
            return config('paypal.sandbox.donation_uri');
        } else {
            return config('paypal.live.donation_uri');
        }
    }

    public static function urlToPaypalActivity($paypal_id)
    {
        if (config("paypal.mode") == 'sandbox') {
            return "https://www.sandbox.paypal.com/activity/payment/{$paypal_id}";
        } else {
            return "https://www.paypal.com/activity/payment/{$paypal_id}";
        }
    }

    public static function formatRandomBadge($light = false)
    {
        $value = rand(0, 6);

        if ($light == false) {
            switch ($value) {
                case 0:
                    return 'bg-primary';
                    break;

                case 1:
                    return 'bg-secondary';
                    break;

                case 2:
                    return 'bg-success';
                    break;

                case 3:
                    return 'bg-info';
                    break;

                case 4:
                    return 'bg-warning';
                    break;

                case 5:
                    return 'bg-danger';
                    break;

                case 6:
                    return 'bg-dark';
                    break;
            }
        } else {
            switch ($value) {
                case 0:
                    return 'bg-light-primary';
                    break;

                case 1:
                    return 'bg-light-secondary';
                    break;

                case 2:
                    return 'bg-light-success';
                    break;

                case 3:
                    return 'bg-light-info';
                    break;

                case 4:
                    return 'bg-light-warning';
                    break;

                case 5:
                    return 'bg-light-danger';
                    break;

                case 6:
                    return 'bg-light-dark';
                    break;
            }
        }
    }
}
