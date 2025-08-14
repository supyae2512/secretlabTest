<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VersionControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $myseeders = [];
        for($i = 1; $i <= 50; $i++) {
            array_push($myseeders, [
                'v_key' => 'user_'.$i,
                'v_value' => 'value_'.$i,
                'created_at' => $now->toDateTimeString()
            ]);
        }

        DB::table('version_control')->insert(
            $myseeders
        );
    }
}
