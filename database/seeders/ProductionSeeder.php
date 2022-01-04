<?php

namespace Database\Seeders;

use App\Models\Account\UserDeviceToken;
use App\Models\Core\Badge;
use App\Models\Page;
use App\Models\Site;
use App\Models\User;
use App\Models\UserSocial;
use App\Models\Wiki\WikiCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::query()->create([
            "name" => "Transport Fever France",
            "facebook_link" => "https://www.facebook.com/groups/TransportFeverFR",
            "twitter_link" => "https://twitter.com/T_FeverFR",
            "insta_link" => "https://www.instagram.com/transportfeverfrance/?hl=fr",
            "discord_link" => "https://discord.com/invite/VaSSqzG",
            "steam_link" => "https://steamcommunity.com/profiles/76561199062863693/myworkshopfiles/?appid=1066780",
        ]);

        User::withoutEvents(function () {
            $user = User::query()->create([
                'name' => "Bot TF France",
                'email' => "bot@transportfeverfrance.fr",
                'password' => bcrypt('0000'),
                'group' => 0,
                'avatar' => null,
            ]);

            UserDeviceToken::query()->create([
                "user_id" => $user->id
            ]);

            UserSocial::query()->create([
                "user_id" => $user->id
            ]);
        });

        $items = [
            ['teams', 'Equipes'],
            ['terms', 'Condition d\'utilisation du service'],
            ['privacy', 'Politique de confidentialité'],
        ];

        foreach ($items as $item) {
            Page::factory()->create([
                'slug' => $item[0],
                'title' => $item[1],
            ]);
        }

        DB::table('follows')->insert([
            ["title" => "Twitter", "href" => "https://twitter.com/T_FeverFR", "icon" => "twitter", "slug" => "twitter", "color" => "btn-twitter"],
            ["title" => "Facebook", "href" => "https://www.facebook.com/groups/TransportFeverFR", "icon" => "facebook", "slug" => "facebook", "color" => "btn-facebook"],
            ["title" => "Instagram", "href" => "https://www.instagram.com/transportfeverfrance/?hl=fr", "icon" => "instagram", "slug" => "instagram", "color" => "btn-insta"],
            ["title" => "Discord", "href" => "https://discord.com/invite/VaSSqzG", "icon" => "discord", "slug" => "discord", "color" => "btn-discord"],
            ["title" => "Steam", "href" => "https://steamcommunity.com/profiles/76561199062863693/myworkshopfiles/?appid=1066780", "icon" => "steam", "slug" => "steam", "color" => "btn-steam"],
        ]);

        Badge::query()->create(["name" => "Nouveau", "action" => "newuser", "action_count" => 0, "description" => "Bienvenue sur TF France"]);
        Badge::query()->create(["name" => "Timide", "action" => "comments", "action_count" => 10, "description" => "Vous avez poster 10 commentaires"]);
        Badge::query()->create(["name" => "Bavard", "action" => "comments", "action_count" => 50, "description" => "Vous avez poster 50 commentaires"]);
        Badge::query()->create(["name" => "Pipelette", "action" => "comments", "action_count" => 100, "description" => "Vous avez poster 100 commentaires"]);
        Badge::query()->create(["name" => "Jeunot", "action" => "ages", "action_count" => 1, "description" => "Inscrit depuis 1 an"]);
        Badge::query()->create(["name" => "Habitué", "action" => "ages", "action_count" => 2, "description" => "Inscrit depuis 2 an"]);
        Badge::query()->create(["name" => "Ancien", "action" => "ages", "action_count" => 3, "description" => "Inscrit depuis 3 an"]);
        Badge::query()->create(["name" => "Curieux", "action" => "train", "action_count" => 0, "description" => "Vous avez trouver le train de Transport Fever France"]);

        DB::table('blog_categories')->insert([
            [
                'title' => "TPF France",
                'slug' => 'tpf-france'
            ],
            [
                'title' => "Urban Games",
                'slug' => 'urban-games'
            ],
            [
                'title' => "Partenaires",
                'slug' => 'partenaires'
            ],
            [
                'title' => "Mods",
                'slug' => 'mods'
            ],
        ]);

        DB::table('download_categories')->insert([
            [
                'title' => "Scénario",
                'slug' => "scenario"
            ],
            [
                'title' => "Cartes & Sauvegardes",
                'slug' => "cartes-sauvegardes"
            ],
            [
                'title' => "Véhicules",
                'slug' => "vehicle"
            ],
            [
                'title' => "Station",
                'slug' => "station"
            ],
            [
                'title' => "Rail & Voie",
                'slug' => "track-street"
            ],
            [
                'title' => "Dépot",
                'slug' => "depot"
            ],
            [
                'title' => "Batiments",
                'slug' => "building"
            ],
            [
                'title' => "Objets",
                'slug' => "asset"
            ],
            [
                'title' => "Autres",
                'slug' => "other"
            ],
        ]);

        DB::table('download_sub_categories')->insert([
            [
                'title' => "Tempéré",
                'slug' => "temperate",
                'image' => "1.png",
                "download_category_id" => 1
            ],
            [
                'title' => "Sec",
                'slug' => "dry",
                'image' => "2.png",
                "download_category_id" => 1
            ],
            [
                'title' => "Tropical",
                'slug' => "tropical",
                'image' => "3.png",
                "download_category_id" => 1
            ],
            [
                'title' => "Europe",
                'slug' => "europe",
                'image' => "4.png",
                "download_category_id" => 1
            ],
            [
                'title' => "USA",
                'slug' => "usa",
                'image' => "5.png",
                "download_category_id" => 1
            ],
            [
                'title' => "Asie",
                'slug' => "asia",
                'image' => "6.png",
                "download_category_id" => 1
            ],
            [
                'title' => "Carte",
                'slug' => "map",
                'image' => "7.png",
                "download_category_id" => 2
            ],
            [
                'title' => "Sauvegarde",
                'slug' => "save",
                'image' => "8.png",
                "download_category_id" => 2
            ],
            [
                'title' => "Locomotive",
                'slug' => "locomotive",
                'image' => "9.png",
                "download_category_id" => 3
            ],
            [
                'title' => "Wagon",
                'slug' => "wagon",
                'image' => "10.png",
                "download_category_id" => 3
            ],
            [
                'title' => "Unité Multiple",
                'slug' => "multiple-unit",
                'image' => "11.png",
                "download_category_id" => 3
            ],
            [
                'title' => "Bus / Car",
                'slug' => "bus",
                'image' => "12.png",
                "download_category_id" => 3
            ],
            [
                'title' => "Camion",
                'slug' => "truck",
                'image' => "13.png",
                "download_category_id" => 3
            ],
            [
                'title' => "Tram",
                'slug' => "tram",
                'image' => "14.png",
                "download_category_id" => 3
            ],
            [
                'title' => "Bateau",
                'slug' => "ship",
                'image' => "15.png",
                "download_category_id" => 3
            ],
            [
                'title' => "Avion",
                'slug' => "plane",
                'image' => "16.png",
                "download_category_id" => 3
            ],
            [
                'title' => "Station de train passagers",
                'slug' => "train-station-passager",
                'image' => "17.png",
                "download_category_id" => 4
            ],
            [
                'title' => "Station de train marchandise",
                'slug' => "train-station-cargo",
                'image' => "18.png",
                "download_category_id" => 4
            ],
            [
                'title' => "Station de bus",
                'slug' => "bus-station",
                'image' => "19.png",
                "download_category_id" => 4
            ],
            [
                'title' => "Station pour camion de marchandise",
                'slug' => "truck-station",
                'image' => "",
                "download_category_id" => 4
            ],
            [
                'title' => "Station de tram",
                'slug' => "tram-station",
                'image' => "",
                "download_category_id" => 4
            ],
            [
                'title' => "Aeroport",
                'slug' => "airport",
                'image' => "",
                "download_category_id" => 4
            ],
            [
                'title' => "Port de passager",
                'slug' => "passenger-harbor",
                'image' => "",
                "download_category_id" => 4
            ],
            [
                'title' => "Port de marchandise",
                'slug' => "cargo-harbor",
                'image' => "",
                "download_category_id" => 4
            ],
            [
                'title' => "Rail",
                'slug' => "rail",
                'image' => "",
                "download_category_id" => 5
            ],
            [
                'title' => "Route et rue",
                'slug' => "street",
                'image' => "",
                "download_category_id" => 5
            ],
            [
                'title' => "Pont",
                'slug' => "bridge",
                'image' => "",
                "download_category_id" => 5
            ],
            [
                'title' => "Tunnel",
                'slug' => "tunnel",
                'image' => "",
                "download_category_id" => 5
            ],
            [
                'title' => "Signalisation",
                'slug' => "signal",
                'image' => "",
                "download_category_id" => 5
            ],
            [
                'title' => "Passage à niveau",
                'slug' => "railroad-crossing",
                'image' => "",
                "download_category_id" => 5
            ],
            [
                'title' => "Construction Urbaine",
                'slug' => "street-construction",
                'image' => "",
                "download_category_id" => 5
            ],
            [
                'title' => "Dépot de train",
                'slug' => "train-depot",
                'image' => "",
                "download_category_id" => 6
            ],
            [
                'title' => "Dépot de Voirie",
                'slug' => "road-depot",
                'image' => "",
                "download_category_id" => 6
            ],
            [
                'title' => "Dépot de tram",
                'slug' => "tram-depot",
                'image' => "",
                "download_category_id" => 6
            ],
            [
                'title' => "Chantier Naval",
                'slug' => "shipyard",
                'image' => "",
                "download_category_id" => 6
            ],
            [
                'title' => "Industrie",
                'slug' => "industry",
                'image' => "",
                "download_category_id" => 7
            ],
            [
                'title' => "Batiment de ville",
                'slug' => "town-building",
                'image' => "",
                "download_category_id" => 7
            ],
            [
                'title' => "Brosse",
                'slug' => "brush",
                'image' => "",
                "download_category_id" => 8
            ],
            [
                'title' => "Objet de voie",
                'slug' => "track-asset",
                'image' => "",
                "download_category_id" => 8
            ],
            [
                'title' => "Script",
                'slug' => "mod-script",
                'image' => "",
                "download_category_id" => 9
            ],
            [
                'title' => "Voiture",
                'slug' => "car",
                'image' => "",
                "download_category_id" => 9
            ],
            [
                'title' => "Personne",
                'slug' => "person",
                'image' => "",
                "download_category_id" => 9
            ],
            [
                'title' => "Animaux",
                'slug' => "animal",
                'image' => "",
                "download_category_id" => 9
            ],
            [
                'title' => "Son",
                'slug' => "sound",
                'image' => "",
                "download_category_id" => 9
            ],
            [
                'title' => "Shader",
                'slug' => "shader",
                'image' => "",
                "download_category_id" => 9
            ],
            [
                'title' => "Mission",
                'slug' => "mission",
                'image' => "",
                "download_category_id" => 9
            ],
            [
                'title' => "Campagne",
                'slug' => "campaign",
                'image' => "",
                "download_category_id" => 9
            ],
            [
                'title' => "Localisation",
                'slug' => "localization",
                'image' => "",
                "download_category_id" => 9
            ],
            [
                'title' => "Autres",
                'slug' => "misc-other",
                'image' => "",
                "download_category_id" => 9
            ],

        ]);

        WikiCategory::query()->create(["title" => "Installation", "slug" => "installation"]);
        WikiCategory::query()->create(["title" => "Basique", "slug" => "basique"]);
        WikiCategory::query()->create(["title" => "Mode de Jeux", "slug" => "mode-de-jeux"]);
        WikiCategory::query()->create(["title" => "Interface", "slug" => "interface"]);
        WikiCategory::query()->create(["title" => "Infrastructure", "slug" => "infrastructure"]);
        WikiCategory::query()->create(["title" => "Gestion", "slug" => "gestion"]);
        WikiCategory::query()->create(["title" => "Simulation", "slug" => "simulation"]);
        WikiCategory::query()->create(["title" => "Utilisation des mods", "slug" => "utilisation-des-mods"]);

        WikiCategory::query()->create(["title" => "General", "slug" => "mods-general"]);
        WikiCategory::query()->create(["title" => "Outils", "slug" => "mods-outils"]);
        WikiCategory::query()->create(["title" => "Vehicule", "slug" => "mods-vehicule"]);
        WikiCategory::query()->create(["title" => "Construction", "slug" => "mods-construction"]);
        WikiCategory::query()->create(["title" => "Voie & Routes", "slug" => "mods-track-street"]);
        WikiCategory::query()->create(["title" => "Environnement", "slug" => "mods-environnement"]);
        WikiCategory::query()->create(["title" => "Scripts & Programmation", "slug" => "mods-scripting"]);

    }
}
