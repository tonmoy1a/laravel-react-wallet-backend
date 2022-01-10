<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class CurrencyService {
    
    public function getCurrencyPrice($from, $to)
    {
        $rate = $this->fixerIoApi($from, $to);

        return $rate;
    }

    public function fixerIoApi($from, $to)
    {
        $currency_price = Http::get('http://data.fixer.io/api/latest?access_key=9931e056784977d6acd578f39b6bcf5b&symbols='.$from.'&format=1');

        $currency_price_json = $currency_price->json();
        $price = 1-($currency_price_json['rates']['USD']-1);

        return $price;
    }

}