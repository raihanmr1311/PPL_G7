<?php

namespace App\Http\Controllers;

use Akaunting\Money\Money;
use App\Models\Employe;
use App\Models\ExpenseView;
use App\Models\IncomeView;
use App\Models\Item;
use App\Models\Profit;
use Carbon\Carbon;
use Flowframe\Trend\Trend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MiscController extends Controller
{
    public function incomesStatistic()
    {
        abort_if(auth()->user()->isEmploye(), 403);
        $incomesChart = Trend::model(IncomeView::class)
            ->between(now()->startOfWeek(), now()->endOfWeek())
            ->dateColumn('tanggal')
            ->perDay()
            ->sum('total_harga');

        return view('income.statistic', compact('incomesChart'));
    }

    public function expensesStatistic()
    {
        abort_if(auth()->user()->isEmploye(), 403);
        $expensesChart = Trend::model(ExpenseView::class)
            ->between(now()->startOfWeek(), now()->endOfWeek())
            ->dateColumn('tanggal')
            ->perDay()
            ->sum('total_harga');

        return view('expense.statistic', compact('expensesChart'));
    }

    public function dashboard()
    {
        $itemCount = Item::count();
        $adminCount = Employe::count();
        $profitChart = null;

        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');


        $monthIncome = Money::IDR(Profit::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->select("pendapatan")->get()[0]['pendapatan'] ?? 0, true);

        $monthExpense = Money::IDR(Profit::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->select("pengeluaran")->get()[0]['pengeluaran'] ?? 0, true);

        if (auth()->user()->isOwner()) {
            $profitChart = Trend::model(Profit::class)
                ->between(now()->startOfYear(), end: now()->endOfYear())
                ->dateColumn('tanggal')
                ->perMonth()
                ->sum('keuntungan');
        }


        return view('dashboard', compact('profitChart', 'itemCount', 'adminCount', 'monthIncome', 'monthExpense'));
    }

    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string',
            'nama_pengguna' => 'required|string|unique:karyawan,nama_pengguna,' . auth()->user()->id,
            'alamat' => 'required|string',
            'no_hp' => 'required|string'
        ]);


        if (auth()->user()->update($data)) {
            return redirect(route('profile'))->with('success', 'Profil berhasil diubah');
        }

        return redirect(route('profile'))->with('error', 'Terjadi kesalahan ketika mengubah data');
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required|current_password|string',
            'password' => 'required|string|confirmed',
        ]);


        if (auth()->user()->update([
            'password' => Hash::make($data['password'])
        ])) {
            return redirect(route('profile'))->with('success', 'Kata sandi berhasil diubah');
        }

        return redirect(route('profile'))->with('error', 'Terjadi kesalahan ketika mengubah data');
    }
}
