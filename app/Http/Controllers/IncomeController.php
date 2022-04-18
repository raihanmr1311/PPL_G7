<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $data = Income::all();

        if ($request->ajax()) {
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function (Income $income) {
                return
                    '<form id="deleteForm' . $income->id . '" class="d-inline d-flex" action="' . route('incomes.destroy', $income->id) . '"method="POST">

                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <a href=' . route('incomes.edit', $income->id) . ' class="btn btn-icon btn-warning"><i class="fa fa-edit"></i></a>
                    <span onclick=confirmDelete(deleteForm' . $income->id . ') class="ml-1 btn btn-action btn-danger btnDelete">
                        <i class="fa fa-trash"></i>
                    </span>
                </form>';
            })->addColumn('karyawan', function (Income $income) {
                return $income->employe->nama_lengkap;
            })->make(true);
        }

        return view('income.index');
    }

    public function create()
    {
        return view('income.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }
}
