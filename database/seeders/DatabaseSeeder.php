<?php

namespace Database\Seeders;

use App\Models\Account\UserDeviceToken;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogComment;
use App\Models\Calendar;
use App\Models\Contact;
use App\Models\Core\Badge;
use App\Models\Download\Download;
use App\Models\Download\DownloadCategory;
use App\Models\Download\DownloadComment;
use App\Models\Download\DownloadSubCategory;
use App\Models\Download\DownloadSupport;
use App\Models\Download\DownloadVersion;
use App\Models\Download\DownloadWiki;
use App\Models\Page;
use App\Models\Task;
use App\Models\User;
use App\Models\UserSocial;
use App\Models\UserTutorial;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env') == 'local') {
            // \App\Models\User::factory(10)->create();
            User::withoutEvents(function () {
                User::create([
                    'name' => "Bot TF France",
                    'email' => "bot@transportfeverfrance.fr",
                    'password' => bcrypt('0000'),
                    'group' => 0,
                    'avatar' => null,
                ]);

                User::factory()->count(3)->create([
                    'group' => 0,
                ]);
            });

            $nbUsers = 4;
            $users = User::all();

            foreach ($users as $user) {
                for ($i = 0; $i < 9; $i++) {
                    UserTutorial::factory()->create([
                        'user_id' => $user->id,
                        'identifier' => $i
                    ]);
                }
                UserSocial::create(["user_id" => $user->id]);
                for ($p = 0; $p < rand(5, 9); $p++) {
                    Task::factory()->create([
                        "user_id" => $user->id
                    ]);
                }

                UserDeviceToken::create(["user_id" => $user->id]);
            }


            DB::table('blog_categories')->insert([
                [
                    'title' => "Category 1",
                    'slug' => 'category-1'
                ],
                [
                    'title' => "Category 2",
                    'slug' => 'category-2'
                ],
                [
                    'title' => "Category 3",
                    'slug' => 'category-3'
                ],
            ]);

            $nbBlogCategories = 3;

            DB::table('blog_tags')->insert([
                ['tag' => 'Tag1', 'slug' => 'tag1'],
                ['tag' => 'Tag2', 'slug' => 'tag2'],
                ['tag' => 'Tag3', 'slug' => 'tag3'],
                ['tag' => 'Tag4', 'slug' => 'tag4'],
                ['tag' => 'Tag5', 'slug' => 'tag5'],
                ['tag' => 'Tag6', 'slug' => 'tag6']
            ]);

            $nbrBlogTags = 6;

            Blog::withoutEvents(function () {
                foreach (range(1, 10) as $i) {
                    Blog::factory()->create([
                        "title" => "Post " . $i,
                        "slug" => "post-" . $i,
                        "seo_title" => "Post " . $i,
                        "image" => 'img0' . $i . '.jpg',
                    ]);
                }
            });


            $nbBlogs = 10;

            $blogs = Blog::all();

            foreach ($blogs as $blog) {
                if ($blog->id === 9) {
                    $numbers = [1, 2, 5, 6];
                    $n = 4;
                } else {
                    $numbers = range(1, $nbrBlogTags);
                    shuffle($numbers);
                    $n = rand(2, 4);
                }

                for ($i = 0; $i < $n; $i++) {
                    $blog->tags()->attach($numbers[$i]);
                }
            }

            foreach ($blogs as $blog) {
                if ($blog->id === 9) {
                    DB::table('blog_blog_category')->insert([
                        "blog_category_id" => 1,
                        "blog_id" => 9
                    ]);
                } else {
                    $numbers = range(1, $nbBlogCategories);
                    shuffle($numbers);
                    $n = rand(1, 2);
                    for ($i = 0; $i < $n; $i++) {
                        DB::table('blog_blog_category')->insert([
                            "blog_category_id" => $numbers[$i],
                            "blog_id" => $blog->id
                        ]);
                    }
                }
            }

            $faker = Factory::create();

            Contact::withoutEvents(function () {
                Contact::factory()->count(5)->create();
            });

            $items = [
                ['about-us', 'About us'],
                ['terms', 'Terms'],
                ['faq', 'FAQ'],
                ['privacy-policy', 'Privacy Policy'],
            ];

            foreach ($items as $item) {
                Page::factory()->create([
                    'slug' => $item[0],
                    'title' => $item[1],
                ]);
            }

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

            $nbDownloadCategory = DownloadCategory::all()->count();

            DB::table('download_sub_categories')->insert([
                [
                    'title' => "Tempéré",
                    'slug' => "temperate",
                    "download_category_id" => 1
                ],
                [
                    'title' => "Sec",
                    'slug' => "dry",
                    "download_category_id" => 1
                ],
                [
                    'title' => "Tropical",
                    'slug' => "tropical",
                    "download_category_id" => 1
                ],
                [
                    'title' => "Europe",
                    'slug' => "europe",
                    "download_category_id" => 1
                ],
                [
                    'title' => "USA",
                    'slug' => "usa",
                    "download_category_id" => 1
                ],
                [
                    'title' => "Asie",
                    'slug' => "asia",
                    "download_category_id" => 1
                ],
                [
                    'title' => "Carte",
                    'slug' => "map",
                    "download_category_id" => 2
                ],
                [
                    'title' => "Sauvegarde",
                    'slug' => "save",
                    "download_category_id" => 2
                ],
                [
                    'title' => "Locomotive",
                    'slug' => "locomotive",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Wagon",
                    'slug' => "wagon",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Unité Multiple",
                    'slug' => "multiple-unit",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Bus / Car",
                    'slug' => "bus",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Camion",
                    'slug' => "truck",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Tram",
                    'slug' => "tram",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Bateau",
                    'slug' => "ship",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Avion",
                    'slug' => "plane",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Station de train passagers",
                    'slug' => "train-station-passager",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Station de train marchandise",
                    'slug' => "train-station-cargo",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Station de bus",
                    'slug' => "bus-station",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Station pour camion de marchandise",
                    'slug' => "truck-station",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Station de tram",
                    'slug' => "tram-station",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Aeroport",
                    'slug' => "airport",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Port de passager",
                    'slug' => "passenger-harbor",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Port de marchandise",
                    'slug' => "cargo-harbor",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Rail",
                    'slug' => "rail",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Route et rue",
                    'slug' => "street",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Pont",
                    'slug' => "bridge",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Tunnel",
                    'slug' => "tunnel",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Signalisation",
                    'slug' => "signal",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Passage à niveau",
                    'slug' => "railroad-crossing",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Construction Urbaine",
                    'slug' => "street-construction",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Dépot de train",
                    'slug' => "train-depot",
                    "download_category_id" => 6
                ],
                [
                    'title' => "Dépot de Voirie",
                    'slug' => "road-depot",
                    "download_category_id" => 6
                ],
                [
                    'title' => "Dépot de tram",
                    'slug' => "tram-depot",
                    "download_category_id" => 6
                ],
                [
                    'title' => "Chantier Naval",
                    'slug' => "shipyard",
                    "download_category_id" => 6
                ],
                [
                    'title' => "Industrie",
                    'slug' => "industry",
                    "download_category_id" => 7
                ],
                [
                    'title' => "Batiment de ville",
                    'slug' => "town-building",
                    "download_category_id" => 7
                ],
                [
                    'title' => "Brosse",
                    'slug' => "brush",
                    "download_category_id" => 8
                ],
                [
                    'title' => "Objet de voie",
                    'slug' => "track-asset",
                    "download_category_id" => 8
                ],
                [
                    'title' => "Script",
                    'slug' => "mod-script",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Voiture",
                    'slug' => "car",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Personne",
                    'slug' => "person",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Animaux",
                    'slug' => "animal",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Son",
                    'slug' => "sound",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Shader",
                    'slug' => "shader",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Mission",
                    'slug' => "mission",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Campagne",
                    'slug' => "campaign",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Localisation",
                    'slug' => "localization",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Autres",
                    'slug' => "misc-other",
                    "download_category_id" => 9
                ],

            ]);

            $nbDownloadSubCategory = DownloadSubCategory::all()->count();

            for ($c = 1; $c <= $nbDownloadCategory; $c++) {
                for ($d = 1; $d <= $nbDownloadSubCategory; $d++) {
                    $provider = rand(0, 3);
                    $download = Download::factory()->create([
                        "title" => "Packages $c $d",
                        "slug" => "packages-$c-$d",
                        "provider" => $provider,
                        "active" => rand(0, 1),
                        "steam_link_package" => $provider == 1 ? "https://steamcommunity.com/sharedfiles/filedetails/?id=" . rand(1000000, 9999999) : null,
                        "tfnet_link_package" => $provider == 2 ? "https://www.transportfever.net/filebase/index.php?entry/" . rand(1000000, 9999999) . "-packages-$d/" : null,
                        "download_category_id" => $c,
                        "download_sub_category_id" => $d,
                    ]);

                    $download->update([
                        "image" => Storage::exists(storage_path('files/shares/download/img'.$download->id.'.jpg')) == true ? 'img'.$download->id.'.jpg' : 'img01.jpg',
                    ]);
                }
            }


            DB::table('follows')->insert([
                ["title" => "Twitter", "href" => "https://twitter.com/T_FeverFR", "icon" => "twitter"],
                ["title" => "Facebook", "href" => "https://www.facebook.com/groups/TransportFeverFR", "icon" => "facebook"],
                ["title" => "Instagram", "href" => "https://www.instagram.com/transportfeverfrance/?hl=fr", "icon" => "instagram"],
                ["title" => "Discord", "href" => "https://discord.com/invite/VaSSqzG", "icon" => "discord"],
                ["title" => "Steam", "href" => "https://steamcommunity.com/profiles/76561199062863693/myworkshopfiles/?appid=1066780", "icon" => "steam"],
            ]);

            Badge::create(["name" => "Nouveau", "action" => "newuser", "action_count" => 0, "description" => "Bienvenue sur TF France"]);
            Badge::create(["name" => "Timide", "action" => "comments", "action_count" => 10, "description" => "Vous avez poster 10 commentaires"]);
            Badge::create(["name" => "Bavard", "action" => "comments", "action_count" => 50, "description" => "Vous avez poster 50 commentaires"]);
            Badge::create(["name" => "Pipelette", "action" => "comments", "action_count" => 100, "description" => "Vous avez poster 100 commentaires"]);
            Badge::create(["name" => "Jeunot", "action" => "ages", "action_count" => 1, "description" => "Inscrit depuis 1 an"]);
            Badge::create(["name" => "Habitué", "action" => "ages", "action_count" => 2, "description" => "Inscrit depuis 2 an"]);
            Badge::create(["name" => "Ancien", "action" => "ages", "action_count" => 3, "description" => "Inscrit depuis 3 an"]);
            Badge::create(["name" => "Curieux", "action" => "train", "action_count" => 0, "description" => "Vous avez trouver le train de Transport Fever France"]);

            for ($l = 0; $l <= rand(1, 20); $l++) {
                Calendar::factory()->create([
                    "name" => "Event N°" . $l
                ]);
            }
        } elseif (config('app.env') == "beta") {
            // \App\Models\User::factory(10)->create();
            User::withoutEvents(function () {
                User::create([
                    'name' => "Bot TF France",
                    'email' => "bot@transportfeverfrance.fr",
                    'password' => bcrypt('0000'),
                    'group' => 0,
                    'avatar' => null,
                ]);
            });

            $users = User::all();

            foreach ($users as $user) {
                UserSocial::create(["user_id" => $user->id]);
                for ($p = 0; $p < rand(5, 9); $p++) {
                    Task::factory()->create([
                        "user_id" => $user->id
                    ]);
                }
            }


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

            $items = [
                ['about-us', 'About us'],
                ['terms', 'Terms'],
                ['faq', 'FAQ'],
                ['privacy-policy', 'Privacy Policy'],
            ];

            foreach ($items as $item) {
                Page::factory()->create([
                    'slug' => $item[0],
                    'title' => $item[1],
                ]);
            }

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
                    "download_category_id" => 1
                ],
                [
                    'title' => "Sec",
                    'slug' => "dry",
                    "download_category_id" => 1
                ],
                [
                    'title' => "Tropical",
                    'slug' => "tropical",
                    "download_category_id" => 1
                ],
                [
                    'title' => "Europe",
                    'slug' => "europe",
                    "download_category_id" => 1
                ],
                [
                    'title' => "USA",
                    'slug' => "usa",
                    "download_category_id" => 1
                ],
                [
                    'title' => "Asie",
                    'slug' => "asia",
                    "download_category_id" => 1
                ],
                [
                    'title' => "Carte",
                    'slug' => "map",
                    "download_category_id" => 2
                ],
                [
                    'title' => "Sauvegarde",
                    'slug' => "save",
                    "download_category_id" => 2
                ],
                [
                    'title' => "Locomotive",
                    'slug' => "locomotive",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Wagon",
                    'slug' => "wagon",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Unité Multiple",
                    'slug' => "multiple-unit",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Bus / Car",
                    'slug' => "bus",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Camion",
                    'slug' => "truck",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Tram",
                    'slug' => "tram",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Bateau",
                    'slug' => "ship",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Avion",
                    'slug' => "plane",
                    "download_category_id" => 3
                ],
                [
                    'title' => "Station de train passagers",
                    'slug' => "train-station-passager",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Station de train marchandise",
                    'slug' => "train-station-cargo",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Station de bus",
                    'slug' => "bus-station",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Station pour camion de marchandise",
                    'slug' => "truck-station",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Station de tram",
                    'slug' => "tram-station",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Aeroport",
                    'slug' => "airport",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Port de passager",
                    'slug' => "passenger-harbor",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Port de marchandise",
                    'slug' => "cargo-harbor",
                    "download_category_id" => 4
                ],
                [
                    'title' => "Rail",
                    'slug' => "rail",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Route et rue",
                    'slug' => "street",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Pont",
                    'slug' => "bridge",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Tunnel",
                    'slug' => "tunnel",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Signalisation",
                    'slug' => "signal",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Passage à niveau",
                    'slug' => "railroad-crossing",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Construction Urbaine",
                    'slug' => "street-construction",
                    "download_category_id" => 5
                ],
                [
                    'title' => "Dépot de train",
                    'slug' => "train-depot",
                    "download_category_id" => 6
                ],
                [
                    'title' => "Dépot de Voirie",
                    'slug' => "road-depot",
                    "download_category_id" => 6
                ],
                [
                    'title' => "Dépot de tram",
                    'slug' => "tram-depot",
                    "download_category_id" => 6
                ],
                [
                    'title' => "Chantier Naval",
                    'slug' => "shipyard",
                    "download_category_id" => 6
                ],
                [
                    'title' => "Industrie",
                    'slug' => "industry",
                    "download_category_id" => 7
                ],
                [
                    'title' => "Batiment de ville",
                    'slug' => "town-building",
                    "download_category_id" => 7
                ],
                [
                    'title' => "Brosse",
                    'slug' => "brush",
                    "download_category_id" => 8
                ],
                [
                    'title' => "Objet de voie",
                    'slug' => "track-asset",
                    "download_category_id" => 8
                ],
                [
                    'title' => "Script",
                    'slug' => "mod-script",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Voiture",
                    'slug' => "car",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Personne",
                    'slug' => "person",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Animaux",
                    'slug' => "animal",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Son",
                    'slug' => "sound",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Shader",
                    'slug' => "shader",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Mission",
                    'slug' => "mission",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Campagne",
                    'slug' => "campaign",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Localisation",
                    'slug' => "localization",
                    "download_category_id" => 9
                ],
                [
                    'title' => "Autres",
                    'slug' => "misc-other",
                    "download_category_id" => 9
                ],

            ]);


            DB::table('follows')->insert([
                ["title" => "Twitter", "href" => "https://twitter.com/T_FeverFR", "icon" => "twitter"],
                ["title" => "Facebook", "href" => "https://www.facebook.com/groups/TransportFeverFR", "icon" => "facebook"],
                ["title" => "Instagram", "href" => "https://www.instagram.com/transportfeverfrance/?hl=fr", "icon" => "instagram"],
                ["title" => "Discord", "href" => "https://discord.com/invite/VaSSqzG", "icon" => "discord"],
                ["title" => "Steam", "href" => "https://steamcommunity.com/profiles/76561199062863693/myworkshopfiles/?appid=1066780", "icon" => "steam"],
            ]);

            Badge::create(["name" => "Nouveau", "action" => "newuser", "action_count" => 0, "description" => "Bienvenue sur TF France"]);
            Badge::create(["name" => "Timide", "action" => "comments", "action_count" => 10, "description" => "Vous avez poster 10 commentaires"]);
            Badge::create(["name" => "Bavard", "action" => "comments", "action_count" => 50, "description" => "Vous avez poster 50 commentaires"]);
            Badge::create(["name" => "Pipelette", "action" => "comments", "action_count" => 100, "description" => "Vous avez poster 100 commentaires"]);
            Badge::create(["name" => "Jeunot", "action" => "ages", "action_count" => 1, "description" => "Inscrit depuis 1 an"]);
            Badge::create(["name" => "Habitué", "action" => "ages", "action_count" => 2, "description" => "Inscrit depuis 2 an"]);
            Badge::create(["name" => "Ancien", "action" => "ages", "action_count" => 3, "description" => "Inscrit depuis 3 an"]);
            Badge::create(["name" => "Curieux", "action" => "train", "action_count" => 0, "description" => "Vous avez trouver le train de Transport Fever France"]);

            for ($l = 0; $l <= rand(1, 20); $l++) {
                Calendar::factory()->create([
                    "name" => "Event N°" . $l
                ]);
            }

            ////////////////////////////////

        } else {
            User::withoutEvents(function () {
                User::create([
                    'name' => "Bot TF France",
                    'email' => "bot@transportfeverfrance.fr",
                    'password' => bcrypt('0000'),
                    'group' => 0,
                    'avatar' => null,
                ]);
            });

            $items = [
                ['about-us', 'About us'],
                ['terms', 'Terms'],
                ['faq', 'FAQ'],
                ['privacy-policy', 'Privacy Policy'],
            ];

            foreach ($items as $item) {
                Page::factory()->create([
                    'slug' => $item[0],
                    'title' => $item[1],
                ]);
            }

            DB::table('follows')->insert([
                ["title" => "Twitter", "href" => "https://twitter.com/T_FeverFR", "icon" => "twitter"],
                ["title" => "Facebook", "href" => "https://www.facebook.com/groups/TransportFeverFR", "icon" => "facebook"],
                ["title" => "Instagram", "href" => "https://www.instagram.com/transportfeverfrance/?hl=fr", "icon" => "instagram"],
                ["title" => "Discord", "href" => "https://discord.com/invite/VaSSqzG", "icon" => "discord"],
                ["title" => "Steam", "href" => "https://steamcommunity.com/profiles/76561199062863693/myworkshopfiles/?appid=1066780", "icon" => "steam"],
            ]);

            Badge::create(["name" => "Nouveau", "action" => "newuser", "action_count" => 0, "description" => "Bienvenue sur TF France"]);
            Badge::create(["name" => "Timide", "action" => "comments", "action_count" => 10, "description" => "Vous avez poster 10 commentaires"]);
            Badge::create(["name" => "Bavard", "action" => "comments", "action_count" => 50, "description" => "Vous avez poster 50 commentaires"]);
            Badge::create(["name" => "Pipelette", "action" => "comments", "action_count" => 100, "description" => "Vous avez poster 100 commentaires"]);
            Badge::create(["name" => "Jeunot", "action" => "ages", "action_count" => 1, "description" => "Inscrit depuis 1 an"]);
            Badge::create(["name" => "Habitué", "action" => "ages", "action_count" => 2, "description" => "Inscrit depuis 2 an"]);
            Badge::create(["name" => "Ancien", "action" => "ages", "action_count" => 3, "description" => "Inscrit depuis 3 an"]);
            Badge::create(["name" => "Curieux", "action" => "train", "action_count" => 0, "description" => "Vous avez trouver le train de Transport Fever France"]);
        }
    }
}
