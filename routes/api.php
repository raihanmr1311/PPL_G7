<?php

use App\Http\Resources\DistrictCollection;
use App\Http\Resources\RegencyCollection;
use App\Models\District;
use App\Models\Regency;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/wallet', function () {
    $balance = Wallet::all(['balance']);
    return ['data' => $balance[0]];
})->name('liveMoney');

Route::get('/districts', function (Request $request)
{
    if ($request->has('regency_id')) {
        $districts = District::where('regency_id', $request->regency_id)->get();
        return new DistrictCollection($districts);
    }
})->name('districtList');

Route::get('/regencies', function ()
{
        $regencies = Regency::where('province_id', 35)->get();
        return new RegencyCollection($regencies);

})->name('regencyList');
