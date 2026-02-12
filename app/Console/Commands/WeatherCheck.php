<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class WeatherCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:weather:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => 28.61,
            'longitude' => 77.20,
            'current_weather' => true,
        ]);

        $data = $response->json();

        $temp = $data['current_weather']['temperature'];

        if ($temp > 36) {
            Log::alert("Heat Alert! Temperature is {$temp}'C");
        } else {
            Log::info("Temperature normal: {$temp}'c");
        }
    }
};
