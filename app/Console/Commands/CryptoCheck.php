<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CryptoCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crypto:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check crypto prince and send alert';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $response = Http::get('https://api.coingecko.com/api/v3/simple/price', [
            'ids' => 'bitcoin',
            'vs_currencies' => 'usd',
        ]);


        if(!$response->successful()){
            Log::error("Failed to fetch crypto price: " . $response->status());
            return;
        }

        // $price = $response->json()
        $data = $response->json();

        $price = $data['bitcoin']['usd'];

        if($price < 5000000){
            Log::alert("Bitcoin price dropped to {$price} USD");
            $this->warn("Bitcoin Alert ₹{$price}");
        }else{
            Log::info("Bitcoin price is normal: ₹{$price}");
            $this->info("Bitcoin Price:Normal ₹{$price}");
        }
        // dd($price);

    }
}
