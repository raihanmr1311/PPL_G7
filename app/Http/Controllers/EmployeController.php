<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class EmployeController extends Controller
{
    public function index(Request $request)
    {
        $data = Employe::all();

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
            })->addColumn('kecamatan', function (Employe $employe) {
                return $employe->district->kecamatan;
            })->rawColumns(['action'])->make(true);
        }

        return view('employe.index');
    }

    public function create()
    {
        $districts = District::all();
        return view('employe.create', compact('districts'));
    }


    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'nama_lengkap' => 'required',
                'nama_pengguna' => 'required|unique:karyawan',
                'no_hp' => 'required',
                'alamat' => 'required',
                'nomor' => 'required',
                'password' => 'required',
                'id_kecamatan' => 'required'
            ]
        );

        $hashedPassword = Hash::make($data['password']);
        $data['password'] = $hashedPassword;

        if (Employe::create($data)) {
            return redirect(route('employes.index'))->with('success', 'Data berhasil ditambahkan');
        }

        return redirect(route('employes.index'))->with('error', 'Terjadi kesalahan ketika menambahkan data');
    }

    public function edit(Employe $employe)
    {
        $districts = District::all();
        return view('employe.edit', compact('employe', 'districts'));
    }

    public function update(Request $request, Employe $employe)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required',
            'nama_pengguna' => 'required|unique:karyawan,nama_pengguna,' . $employe->id,
            'no_hp' => 'required',
            'alamat' => 'required',
            'nomor' => 'required',
            'password' => '',
            'id_kecamatan' => 'required'
        ]);

        if (!$request->password) {
            $request->password = $employe->password;
        } else {
            $request->password = bcrypt($request->password);
        }

        $data['password'] = $request->password;

        if ($employe->update($data)) {
            return redirect(route('employes.index'))->with('success', 'Data berhasil diubah');
        }

        return redirect(route('employes.index'))->with('error', 'Terjadi kesalahan ketika mengubah data');
    }

    public function destroy(Employe $employe)
    {
        if ($employe->delete()) {
            return redirect(route('employes.index'))->with('success', 'Data berhasil dihapus');
        }

        return redirect(route('employes.index'))->with('error', 'Terjadi kesalahan ketika menghapus data');
    }
}
