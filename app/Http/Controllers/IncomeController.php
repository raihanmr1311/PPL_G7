<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\IncomeView;
use App\Models\Item;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class IncomeController extends Controller
{
    public function index(Request $request)
    {
        $data = IncomeView::all();


        if ($request->ajax()) {
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function (IncomeView $income) {
                return
                    '<form id="deleteForm' . $income->id . '" class="d-inline d-flex" action="' . route('incomes.destroy', $income->id) . '"method="POST">

                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <a href=' . route('incomes.edit', $income->id) . ' class="btn btn-icon btn-warning"><i class="fa fa-edit"></i></a>
                    <span onclick=confirmDelete(deleteForm' . $income->id . ') class="ml-1 btn btn-action btn-danger btnDelete">
                        <i class="fa fa-trash"></i>
                    </span>
                    <a href=' . route('incomes.show', $income->id) . ' class="ml-1 btn btn-icon btn-primary">Detail</a>
                </form>';
            })->make(true);
        }

        return view('income.index');
    }

    public function create()
    {
        $items = Item::all();
        return view('income.create', compact('items'));
    }

    public function store(Request $request)
    {
        $detail = [];

        $data = $request->validate([
            'tanggal' => 'required',
            'id_barang' => 'required|array|min:1|max:10',
            'id_barang.*' => 'required|string',
            'kuantitas' => 'required|array|min:1|max:10',
            'kuantitas.*' => 'required|numeric',
            'harga' => 'required|array|min:1|max:10',
            'harga.*' => 'required|numeric',
        ]);

        for ($i = 0; $i < count($data['id_barang']); $i++) {
            $tempData['id_barang'] = $data['id_barang'][$i];
            $tempData['kuantitas'] = $data['kuantitas'][$i];
            $tempData['harga'] = $data['harga'][$i];
            array_push($detail, $tempData);
        }


        $data['id_karyawan'] = auth()->user()->id;

        try {
            $income = Income::create($data);
            $income->details()->createMany($detail);
            return redirect(route('incomes.index'))->with('success', 'Data berhasil ditambahkan');
        } catch (Exception $e) {
            return $e;
            return redirect(route('incomes.index'))->with('error', 'Terjadi kesalahan ketika menambahkan data');
        }
    }


    public function show(Income $income)
    {
        //
    }


    public function edit(Income $income)
    {
        return view('income.edit', compact('income'));
    }


    public function update(Request $request, Income $income)
    {
        $data = $request->validate(['tanggal' => 'required']);

        if ($income->update($data)) {
            return redirect(route('incomes.index'))->with('success', 'Data berhasil diubah');
        }

        return redirect(route('incomes.index'))->with('error', 'Terjadi kesalahan ketika mengubah data');
    }

    public function destroy(Income $income)
    {
        if ($income->delete()) {
            return redirect(route('incomes.index'))->with('success', 'Data berhasil dihapus');
        }

        return redirect(route('incomes.index'))->with('error', 'Terjadi kesalahan ketika menghapus data');
    }
}
