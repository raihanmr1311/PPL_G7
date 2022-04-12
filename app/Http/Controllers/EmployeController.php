<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class EmployeController extends Controller
{
    public function index(Request $request)
    {
        $data = Employe::orderBy('created_at', 'DESC');

        if ($request->ajax()) {
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function (Employe $employe) {
                return
                    '<form id="deleteForm' . $employe->id . '" class="d-inline d-flex" action="' . route('employes.destroy', $employe->id) . '"method="POST">

                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <a href=' . route('employes.edit', $employe->id) . ' class="btn btn-icon btn-warning"><i class="fa fa-edit"></i></a>
                    <span onclick=confirmDelete(deleteForm' . $employe->id . ') class="ml-1 btn btn-action btn-danger btnDelete">
                        <i class="fa fa-trash"></i>
                    </span>
                </form>';
            })->make(true);
        }

        return view('employe.index');
    }

    public function create()
    {
        return view('employe.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'nama_lengkap' => 'required',
                'nama_pengguna' => 'required',
                'no_hp' => 'required',
                'alamat' => 'required',
                'nomor' => 'required',
                'password' => 'required',
            ]
        );

        $hashedPassword = Hash::make($data['password']);
        $data['password'] = $hashedPassword;


        Employe::create($data);

        return redirect(route('employes.index'));
    }

    public function show(Employe $employe)
    {
        //
    }

    public function edit(Employe $employe)
    {
        return view('employe.edit', compact('employe'));
    }

    public function update(Request $request, Employe $employe)
    {
        //
    }

    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect(route('employes.index'));
    }
}
