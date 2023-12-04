<?php

namespace Database\Seeders;

use App\Models\Watch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WatchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dati = config('watches');

        foreach ($dati as $dato) {
            $newWatch = new Watch();
            $newWatch->brand = $dato['brand'];
            $newWatch->model = $dato['model'];
            $newWatch->slug = Str::slug($dato['brand'].' '.$dato['model'],'-');
            $newWatch->price = $dato['price'];
            $newWatch->ref = $dato['ref'];
            $newWatch->characteristics = $dato['characteristics'];
            $newWatch->images = json_encode($dato['images']);
            $newWatch->save();
        }
    }
}
