<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\DeviceCategory;
use App\Models\DeviceLocation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeviceLocation::create([
            [
                "code"=> "GAF",
                "name"=> "General Affairs",
            ],
            [
                "code"=> "IPC",
                "name"=> "Import & Customs",
            ],
            [
                "code"=> "MPH",
                "name"=> "Marketing Primary Health",
            ]
        ]);

        DeviceCategory::create([
            [
                "code"=> "OFC",
                "name" => "Office"
            ],
            [
                "code" => "PRP",
                "name" => "Peripheral"
            ]
        ]);
    }
}
