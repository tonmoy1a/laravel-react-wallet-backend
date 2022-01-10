<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTrensection extends Model
{
    use HasFactory;

    public function fromWallet()
    {
        return $this->belongsTo('App\Models\Wallet');
    }
}
