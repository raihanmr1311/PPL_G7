<?php

namespace App\Http\Controllers;

use Akaunting\Money\Money;
use App\Models\Employe;
use App\Models\ExpenseView;
use App\Models\IncomeView;
use App\Models\Item;
use App\Models\Profit;
use Illuminate\Support\Carbon;
use Flowframe\Trend\Trend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MiscController extends Controller
{
    public function incomesStatistic(Request $request)
    {
        abort_if(auth()->user()->isEmploye(), 403);

        $startofWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        if ($request->has('range')) {
            $dates = explode(' - ', $request->range);
            $startofWeek = Carbon::parse($dates[0]);
            $endOfWeek = Carbon::parse($dates[1]);
        }


        $incomesChart = Trend::model(IncomeView::class)
            ->between($startofWeek, $endOfWeek)
            ->dateColumn('tanggal')
            ->perDay()
            ->sum('total_harga');

        return view('income.statistic', [
            'incomesChart' => $incomesChart,
            'startWeek' => $startofWeek,
            'endWeek' => $endOfWeek,
            'maxDate' => now()->endOfWeek()
        ]);
    }

    public function expensesStatistic(Request $request)
    {
        abort_if(auth()->user()->isEmploye(), 403);

        $startofWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();

        if ($request->has('range')) {
            $dates = explode(' - ', $request->range);
            $startofWeek = Carbon::parse($dates[0]);
            $endOfWeek = Carbon::parse($dates[1]);
        }

        $expensesChart = Trend::model(ExpenseView::class)
            ->between($startofWeek, $endOfWeek)
            ->dateColumn('tanggal')
            ->perDay()
            ->sum('total_harga');

        return view('expense.statistic', [
            'expensesChart' => $expensesChart,
            'startWeek' => $startofWeek,
            'endWeek' => $endOfWeek,
            'maxDate' => now()->endOfWeek()
        ]);
    }

    public function dashboard(Request $request)
    {
        $itemCount = Item::count();
        $adminCount = Employe::count();
        $profitChart = null;

        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');

        $startMonth = now()->startOfYear();
        $endMonth = now()->endOfYear();


        $monthIncome = Money::IDR(Profit::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->select("pendapatan")->get()[0]['pendapatan'] ?? 0, true);

        $monthExpense = Money::IDR(Profit::whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->select("pengeluaran")->get()[0]['pengeluaran'] ?? 0, true);

        if (auth()->user()->isOwner()) {

            if ($request->has('range')) {
                $dates = explode(' - ', $request->range);
                $startMonth = Carbon::parse($dates[0])->startOfMonth();
                $endMonth = Carbon::parse($dates[1])->endOfMonth();
            }


            $profitChart = Trend::model(Profit::class)
                ->between(start: $startMonth, end: $endMonth)
                ->dateColumn('tanggal')
                ->perMonth()
                ->sum('keuntungan');
        }

        $maxMonth = now()->endOfYear();


        return view('dashboard', compact(
            'profitChart',
            'itemCount',
            'adminCount',
            'monthIncome',
            'monthExpense',
            'startMonth',
            'endMonth',
            'maxMonth',
        ));
    }

    public function profile()
    {
        return view('profile');
    }
}
