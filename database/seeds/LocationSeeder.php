<?php

use Illuminate\Database\Seeder;

use App\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locations = [
            [
                "location_code" => "JKT",
                "location_name" => "Jakarta",
            ],
            [
                "location_code" => "SBY",
                "location_name" => "Surabaya",
            ],
            [
                "location_code" => "BDG",
                "location_name" => "Bandung",
            ],
            [
                "location_code" => "LAM",
                "location_name" => "Lampung",
            ],
            [
                "location_code" => "MKS",
                "location_name" => "Makassar",
            ],
            [
                "location_code" => "BTM",
                "location_name" => "Batam",
            ],
            [
                "location_code" => "PKU",
                "location_name" => "Pekanbaru",
            ],
            [
                "location_code" => "MDN",
                "location_name" => "Medan",
            ],
            [
                "location_code" => "SMG",
                "location_name" => "Semarang",
            ],
            [
                "location_code" => "OTR",
                "location_name" => "Other",
            ],
        ];

        foreach($locations as $location){
            DB::table('locations')->insert([
                "location_code" => $location['location_code'],
                "location_name" => $location['location_name'],
            ]);
        }

    }
}
