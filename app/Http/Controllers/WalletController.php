<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use App\Services\WalletService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class WalletController extends Controller
{
    private $walletService;

    public function __construct(WalletService $walletService) {

        $this->middleware('auth:api');
        $this->walletService = $walletService;

    }

    public function getUserWallet(CurrencyService $currencyService)
    {

        $wallet = $this->walletService->getUserWalletByEmail(JWTAuth::user()->email);

        $currency_price = 1;
        
        if($wallet->currency!='USD'){
            $currency_price = $currencyService->getCurrencyPrice('USD', $wallet->currency);
        }

        $wallet['third_hightest_amount'] = $this->walletService->getThirdHightestAmountOfTrensectionByWalletId($wallet->id);

        $wallet['currency_price'] = $currency_price;

        return $wallet;

    }
}
