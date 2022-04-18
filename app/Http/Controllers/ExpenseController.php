<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $data = Expense::with('employe')->select('pengeluaran.*');


        if ($request->ajax()) {
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function (Expense $expense) {
                return
                    '<form id="deleteForm' . $expense->id . '" class="d-inline d-flex" action="' . route('expenses.destroy', $expense->id) . '"method="POST">

                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <a href=' . route('expenses.edit', $expense->id) . ' class="btn btn-icon btn-warning"><i class="fa fa-edit"></i></a>
                    <span onclick=confirmDelete(deleteForm' . $expense->id . ') class="ml-1 btn btn-action btn-danger btnDelete">
                        <i class="fa fa-trash"></i>
                    </span>
                    <a href=' . route('expenses.show', $expense->id) . ' class="ml-1 btn btn-icon btn-primary">Detail</a>
                </form>';
            })->addColumn('karyawan', function (Expense $expense) {
                return $expense->employe->nama_lengkap;
            })->make(true);
        }

        return view('expense.index');
    }

    public function create()
    {
        return view('expense.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['tanggal' => 'required']);

        $data['id_karyawan'] = auth()->user()->id;

        if (Expense::create($data)) {
            return redirect(route('expenses.index'))->with('success', 'Data berhasil ditambahkan');
        }

        return redirect(route('expenses.index'))->with('error', 'Terjadi kesalahan ketika menambahkan data');
    }

    public function show(Expense $expense)
    {
        return view('expense.show');
    }

    public function edit(Expense $expense)
    {
        return view('expense.edit', compact('expense'));
    }

    public function update(Request $request, Expense $expense)
    {
        $data = $request->validate(['tanggal' => 'required']);

        if ($expense->update($data)) {
            return redirect(route('expenses.index'))->with('success', 'Data berhasil diubah');
        }

        return redirect(route('expenses.index'))->with('error', 'Terjadi kesalahan ketika mengubah data');
    }

    public function destroy(Expense $expense)
    {
        if ($expense->delete()) {
            return redirect(route('expenses.index'))->with('success', 'Data berhasil dihapus');
        }

        return redirect(route('expenses.index'))->with('error', 'Terjadi kesalahan ketika menghapus data');
    }
}
