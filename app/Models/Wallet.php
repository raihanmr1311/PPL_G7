<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'dompet';
    public $timestamps = false;
    protected $guarded = ['id'];

    public static function increaseBalance(int $amount)
    {
        $wallet = self::find(1);
        $previousBalance = $wallet->balance;
        $wallet->update(['balance' => $previousBalance + $amount]);
    }

    public static function decreaseBalance(int $amount)
    {
        $wallet = self::find(1);
        $previousBalance = $wallet->balance;

        if ($previousBalance < $amount) {
            $wallet->update(['balance' => 0]);
        } else {
            $wallet->update(['balance' => $previousBalance - $amount]);
        }
    }

    public  static function updateBalance(int $prevAmount, int $nextAmount)
    {
        $wallet = self::find(1);
        $previousBalance = $wallet->balance;

        if ($prevAmount < $nextAmount) {
            $wallet->update(['balance' => $previousBalance + ($nextAmount - $prevAmount)]);
        } else if ($prevAmount > $nextAmount) {
            $wallet->update(['balance' => $previousBalance - ($prevAmount - $nextAmount)]);
        }
    }
}
