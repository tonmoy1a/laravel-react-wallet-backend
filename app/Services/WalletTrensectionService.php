<?php

namespace App\Services;

use App\Models\WalletTrensection;

class WalletTrensectionService {
    
    public function createTrensection($fromWalletId, $toWalletId, $amount, $note)
    {
        $wallet = new WalletTrensection();
        $wallet->from_wallet_id = $fromWalletId;
        $wallet->to_wallet_id = $toWalletId;
        $wallet->amount = $amount;
        $wallet->note = $note;

        $wallet->save();
    }

    public function getTrensectionsByUserId($user_id)
    {
        return WalletTrensection::where('from_wallet_id', $user_id)
            ->orWhere('to_wallet_id', $user_id)
            ->latest()
            ->get();
    }

}