<?php

namespace App\Http\Controllers;

use App\Models\ExpenseView;
use App\Models\IncomeView;
use Flowframe\Trend\Trend;
use Illuminate\Http\Request;

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
}
