<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        $data = Item::orderBy('id', 'DESC');

        if ($request->ajax()) {
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function (Item $item) {
                return
                    '<form id="deleteForm' . $item->id . '" class="d-inline d-flex" action="' . route('items.destroy', $item->id) . '"method="POST">

                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <a href=' . route('items.edit', $item->id) . ' class="btn btn-icon btn-warning"><i class="fa fa-edit"></i></a>
                    <span onclick=confirmDelete(deleteForm' . $item->id . ') class="ml-1 btn btn-action btn-danger btnDelete">
                        <i class="fa fa-trash"></i>
                    </span>
                </form>';
            })->make(true);
        }

        return view('item.index');
    }

    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'nama' => 'required',
                'harga' => 'required',
            ]
        );

        if (Item::create($data)) {
            return redirect(route('items.index'))->with('success', 'Data berhasil ditambahkan');
        }

        return redirect(route('items.index'))->with('error', 'Terjadi kesalahan ketika menambahkan data');
    }


    public function edit(Item $item)
    {
        return view('item.edit', compact('item'));
    }


    public function update(Request $request, Item $item)
    {
        $data = $request->validate(
            [
                'nama' => 'required',
                'harga' => 'required',
            ]
        );


        if ($item->update($data)) {
            return redirect(route('items.index'))->with('success', 'Data berhasil diubah');
        }

        return redirect(route('items.index'))->with('error', 'Terjadi kesalahan ketika mengubah data');
    }

    public function destroy(Item $item)
    {
        if ($item->delete()) {
            return redirect(route('items.index'))->with('success', 'Data berhasil dihapus');
        }

        return redirect(route('items.index'))->with('error', 'Terjadi kesalahan ketika menghapus data');
    }
}
