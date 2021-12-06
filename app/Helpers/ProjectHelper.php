<?php


namespace App\Helpers;


class ProjectHelper
{
    public static function badgeProjectPublished($published)
    {
        switch ($published) {
            case 0:
                return '<span class="badge badge-primary">Corbeille</span>';
                break;

            case 1:
                return '<span class="badge badge-danger">Privée</span>';
                break;

            case 2:
                return '<span class="badge badge-success">Public</span>';
                break;

            default:
                return '<span class="badge badge-secondary">Inconnue</span>';
                break;
        }
    }

    public static function badgeProjectState($state)
    {
        switch ($state) {
            case 0:
                return '<span class="badge badge-primary"><i class="fas fa-clock-o"></i> En cours</span>';
                break;

            case 1:
                return '<span class="badge badge-success"><i class="fas fa-check-circle-o"></i> Terminer</span>';
                break;

            case 2:
                return '<span class="badge badge-danger"><i class="fas fa-times-circle-o"></i> Annuler</span>';
                break;

            case 3:
                return '<span class="badge badge-warning"><i class="fas fa-pause"></i> En attente</span>';
                break;

            default:
                return '<span class="badge badge-secondary">Inconnue</span>';
                break;
        }
    }
}
