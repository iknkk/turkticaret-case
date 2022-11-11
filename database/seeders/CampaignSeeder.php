<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaigns = [
            [
                'name' => 'Buy 2 get 1 free',
                'buyXpcsYpcsFree' => 2,
                'buyXpcsYpcsDiscountAuthorId' => 3,
                'buyXpcsYfreeLimit' => 1,
                'overXpriceDiscountAmount' => NULL,
                'overXpriceDiscountPercent' => NULL,
                'status' => 1,
            ],
            [
                'name' => '5% Discount over 100TL',
                'buyXpcsYpcsFree' => NULL,
                'buyXpcsYpcsDiscountAuthorId' => NULL,
                'buyXpcsYfreeLimit' => NULL,
                'overXpriceDiscountAmount' => 100,
                'overXpriceDiscountPercent' => 5,
                'status' => 1,
            ]
        ];
        
        foreach ($campaigns as $campaign) {
            \App\Models\Campaign::create($campaign);
        }
    }
}
