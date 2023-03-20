<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        $response = Http::get('https://pkgstore.datahub.io/core/nasdaq-listings/nasdaq-listed_json/data/a5bc7580d6176d60ac0b2142ca8d7df6/nasdaq-listed_json.json');
        $data = json_decode($response->body(), true);

        foreach ($data as $item) {
            Company::create([
                'company_name' => $item['Company Name'],
                'financial_status' => $item['Financial Status'],
                'market_category' => $item['Market Category'],
                'round_lot_size' => $item['Round Lot Size'],
                'security_name' => $item['Security Name'],
                'symbol' => $item['Symbol'],
                'test_issue' => $item['Test Issue'],
            ]);
        }
    }
}
