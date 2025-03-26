<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Mail\AlertLowBalance;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if (! $user->wallet) {
            Wallet::factory()->create([
                'user_id' => $user->id,
            ]);
        }

        $transactions = $user->wallet->transactions()->with('transfer')->orderByDesc('id')->get();
        $balance = $user->wallet->balance;

        if ($balance && $balance < Wallet::MIN_BALANCE_SUM) {
            Mail::to($user->email)->queue(new AlertLowBalance($user->wallet));
        }

        return view('dashboard', compact('transactions', 'balance'));

    }
}
