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

class MiscController extends Controller
{
    public function incomesStatistic()
    {
        $incomesChart = Trend::model(IncomeView::class)
            ->between(now()->startOfWeek(), now()->endOfWeek())
            ->dateColumn('tanggal')
            ->perDay()
            ->sum('total_harga');

        return view('income.statistic', compact('incomesChart'));
    }

    public function expensesStatistic()
    {
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

        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');


        $monthIncome = Money::IDR(Profit::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->select("pendapatan")->get()[0]['pendapatan'] ?? 0, true);

        $monthExpense = Money::IDR(Profit::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
        ->select("pengeluaran")->get()[0]['pengeluaran'] ?? 0, true);



        $profitChart = Trend::model(Profit::class)
            ->between(now()->startOfYear(), end: now()->endOfYear())
            ->dateColumn('tanggal')
            ->perMonth()
            ->sum('keuntungan');

        return view('dashboard', compact('profitChart', 'itemCount', 'adminCount', 'monthIncome', 'monthExpense'));
    }
}
