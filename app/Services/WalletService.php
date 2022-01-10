<?php

namespace App\Services;

use App\Models\User;
use App\Models\WalletTrensection;

class WalletService {
    
    public function getUserWalletByEmail($email)
    {
        $user = User::where('email', $email)->first();

        if($user){
            return $user->wallet;
        }

        return false;
    }

    public function getThirdHightestAmountOfTrensectionByWalletId($walletId)
    {
        $trensectionAmount = WalletTrensection::select('amount')
            ->where('from_wallet_id', $walletId)
            ->orWhere('to_wallet_id', $walletId)
            ->orderBy('amount')
            ->limit(1)
            ->offset(2)
            ->first();

        $amount = 0;
        if($trensectionAmount){
            $amount = $trensectionAmount->amount;
        }

        return $amount;
    }

}