<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $stores = [
            ['name' => 'Ackermans', 'slug' => 'ackermans', 'clue' => 'Need a new outfit for your Minion mission? Look for the store where the whole family can dress for less.', 'sort_order' => 1],
            ['name' => 'Lacoste', 'slug' => 'lacoste', 'clue' => 'A stylish Minion always dresses to impress! Find the store where classic fashion and the famous crocodile make a statement.', 'sort_order' => 2],
            ['name' => 'Spec-Savers', 'slug' => 'spec-savers', 'clue' => "A Minion misplaced his banana because he couldn't see! Visit the place that helps you spot every clue clearly.", 'sort_order' => 3],
            ['name' => 'Baby City', 'slug' => 'baby-city', 'clue' => 'Little ones need lots of love and care. Find the store with baby essentials, outfits and treasures to share.', 'sort_order' => 4],
            ['name' => 'The Fun Company', 'slug' => 'the-fun-company', 'clue' => 'Games, excitement and lots of laughs await! Find the place where fun is the main attraction.', 'sort_order' => 5],
            ['name' => 'Expedition North', 'slug' => 'expedition-north', 'clue' => "Every Minion explorer needs adventure gear! Find the store that's ready for mountains, trails and the great outdoors.", 'sort_order' => 6],
            ['name' => 'Coricraft', 'slug' => 'coricraft', 'clue' => 'After a busy banana hunt, a Minion needs a comfy place to relax. Find the store where beautiful furniture makes a house a home.', 'sort_order' => 7],
            ['name' => 'Legends Barbershop', 'slug' => 'legends-barbershop', 'clue' => 'Even Minions need a fresh haircut! Find the place where great styles become legendary.', 'sort_order' => 8],
            ['name' => 'Clicks', 'slug' => 'clicks', 'clue' => 'Need toothpaste, shampoo or a quick health fix? Find the store that has a little bit of everything.', 'sort_order' => 9],
            ['name' => 'Lovisa', 'slug' => 'lovisa', 'clue' => "Sparkles catch a Minion's eye! Find the store filled with dazzling jewellery and accessories.", 'sort_order' => 10],
            ['name' => 'Destinations by Frasers', 'slug' => 'destinations-by-frasers', 'clue' => 'A Minion adventure awaits! Find the store where suitcases, travel bags and journey essentials help explorers pack for their next mission.', 'sort_order' => 11],
            ['name' => 'Freedom of Movement', 'slug' => 'freedom-of-movement', 'clue' => 'For this stop, find the place where style takes the lead. From leather treasures to branded looks, they have everything you need to move freely and confidently.', 'sort_order' => 12],
            ['name' => 'Sorbet', 'slug' => 'sorbet', 'clue' => "It's time to relax and glow! Find the place where beauty treatments and pampering help you shine from head to toe.", 'sort_order' => 13],
            ['name' => 'Old School', 'slug' => 'old-school', 'clue' => 'A true supporter needs the right gear! Find the store where fans can show their colours and wear their team pride.', 'sort_order' => 14],
            ['name' => 'Le Creuset', 'slug' => 'le-creuset', 'clue' => 'Even Minions need to cook up something delicious! Find the store where kitchen treasures and colourful cookware bring recipes to life.', 'sort_order' => 15],
            ['name' => 'PNA', 'slug' => 'pna', 'clue' => 'Need something to write, create or learn? Find the place where stationery, gifts and school essentials take their turn!', 'sort_order' => 16],
            ['name' => 'Crocs', 'slug' => 'crocs', 'clue' => 'Minions love to stand out! Find the store where colourful, comfy and funky footwear brings fun to every step.', 'sort_order' => 17],
            ['name' => 'Cell C', 'slug' => 'cell-c', 'clue' => 'Minions love to stay connected! Find the store where you can call, chat and share your banana discoveries.', 'sort_order' => 18],
            ['name' => 'Totalsports', 'slug' => 'totalsports', 'clue' => 'Ready, set, GO! Find the store where athletes and sports fans gear up for action.', 'sort_order' => 19],
            ['name' => 'Spur', 'slug' => 'spur', 'clue' => 'Follow the smell of burgers and family fun! A hungry Minion knows exactly where to go.', 'sort_order' => 20],
        ];

        foreach ($stores as $store) {
            Store::updateOrCreate(
                ['slug' => $store['slug']],
                [
                    'name' => $store['name'],
                    'clue' => $store['clue'],
                    'sort_order' => $store['sort_order'],
                    'is_active' => true,
                ]
            );
        }
    }
}
