<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseDetail;
use App\Models\ExpenseView;
use App\Models\Wallet;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $data = ExpenseView::all();

        if ($request->ajax()) {
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function (ExpenseView $expense) {
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
        $detail = [];

        $data = $request->validate([
            'tanggal' => 'required',
            'pengeluaran' => 'required|array|min:1|max:10',
            'pengeluaran.*' => 'required|string',
            'kuantitas' => 'required|array|min:1|max:10',
            'kuantitas.*' => 'required|numeric',
            'harga' => 'required|array|min:1|max:10',
            'harga.*' => 'required|numeric',
        ]);

        for ($i = 0; $i < count($data['pengeluaran']); $i++) {
            $tempData['pengeluaran'] = $data['pengeluaran'][$i];
            $tempData['kuantitas'] = $data['kuantitas'][$i];
            $tempData['harga'] = $data['harga'][$i];
            array_push($detail, $tempData);
        }


        $data['id_karyawan'] = auth()->user()->id;

        try {
            $expense = Expense::create($data);
            $expense->details()->createMany($detail);
            Wallet::decreaseBalance($expense->total_harga);
            return redirect(route('expenses.index'))->with('success', 'Data berhasil ditambahkan');
        } catch (Exception $e) {
            return $e;
            return redirect(route('expenses.index'))->with('error', 'Terjadi kesalahan ketika menambahkan data');
        }
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
        if ($request->has('deleteId')) {
            ExpenseDetail::destroy($request->deleteId);
        }

        $detail = [];

        $data = $request->validate([
            'tanggal' => 'required',
            'pengeluaran' => 'required|array|min:1|max:10',
            'pengeluaran.*' => 'required|string',
            'kuantitas' => 'required|array|min:1|max:10',
            'id' => '',
            'kuantitas.*' => 'required|numeric',
            'harga' => 'required|array|min:1|max:10',
            'harga.*' => 'required|numeric',
        ]);


        for ($i = 0; $i < count($data['pengeluaran']); $i++) {
            $tempData['id'] = $data['id'][$i];
            $tempData['pengeluaran'] = $data['pengeluaran'][$i];
            $tempData['kuantitas'] = $data['kuantitas'][$i];
            $tempData['harga'] = $data['harga'][$i];
            $tempData['id_pengeluaran'] = $expense->id;
            array_push($detail, $tempData);
        }

        $expense->update(['tanggal' => $data['tanggal']]);
        ExpenseDetail::upsert($detail, ['id'], ['pengeluaran', 'kuantitas', 'harga']);
        return redirect(route('expenses.index'))->with('success', 'Data berhasil diubah');

        // return redirect(route('expenses.index'))->with('error', 'Terjadi kesalahan ketika mengubah data');
    }

    public function destroy(Expense $expense)
    {
        Wallet::decreaseBalance($expense->total_harga);
        if ($expense->delete()) {
            return redirect(route('expenses.index'))->with('success', 'Data berhasil dihapus');
        }

        return redirect(route('expenses.index'))->with('error', 'Terjadi kesalahan ketika menghapus data');
    }
}
