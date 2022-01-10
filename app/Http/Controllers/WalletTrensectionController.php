<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\WalletTrensection;
use App\Services\WalletService;
use App\Services\WalletTrensectionService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class WalletTrensectionController extends Controller
{
    private $walletTrensectionSerivce;

    public function __construct(WalletTrensectionService $walletTrensectionSerivce) {
        $this->middleware('auth:api');
        $this->walletTrensectionSerivce = $walletTrensectionSerivce;
    }

    public function store(Request $request, WalletService $walletService)
    {
        $request->validate([
            'walletId'=> 'required',
            'amount'=> 'required|integer'
        ]);

        $wallet = $walletService->getUserWalletByEmail($request->walletId);

        if($wallet){
            $this->walletTrensectionSerivce->createTrensection(
                JWTAuth::user()->wallet->id,
                $wallet->id,
                $request->amount,
                $request->note
            );
        }else{
            return response()->json(['error'=> 'User wallet not found'])->setStatusCode(422);
        }

    }

    public function getUserWalletTrensection()
    {
        return $this->walletTrensectionSerivce->getTrensectionsByWalletId(JWTAuth::user()->wallet->id);

    }


}
