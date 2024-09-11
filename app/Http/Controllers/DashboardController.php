<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data['title'] = 'Data Mahasiswa';

        if ($request->ajax()) {
            $mahasiswa = new Mahasiswa();
            $mhs = collect($mahasiswa->get_all_mahasiswa());
    
            return DataTables::of($mhs)
                ->addIndexColumn() 
                ->addColumn('action', function($row){
                    $btn = '<a href="' . url('edit-mahasiswa', $row->nrp) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="' . url('hapus-mahasiswa', $row->nrp) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return
            view('template/header', $data) .
            view('dashboard', $data) .
            view('template/footer');
    }

    public function create () {
        $data['title'] = 'Tambah Data Mahasiswa';

        return
            view('template/header', $data) .
            view('add-mahasiswa', $data) .
            view('template/footer');
    }

    public function createproses (Request $request) {

        $nrp = $request->nrp;
        $nama = $request->nama;
        $email = $request->email;

        try {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->get_create_mahasiswa($nrp, $nama, $email);
    
            return redirect('/dashboard')->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $e) {
            return redirect('/add-mahasiswa')->with('error', 'Maaf NRP Sudah Digunakan');
        }
    }


    public function edit ($nrp) {
        $data['title'] = 'Edit Data Mahasiswa';
    
        $mahasiswa = new Mahasiswa();
        $mhs = $mahasiswa->get_mahasiswa_by_nrp($nrp);

        $data['nama'] = $mhs->nama;
        $data['email'] = $mhs->email;

        return  
            view('template/header', $data) .
            view('edit-mahasiswa', $data, compact('nrp')) .
            view('template/footer');
    }

    public function editproses(Request $request, $nrp) {
        $data = [
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'email' => $request->email
        ];
    
        try {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->get_update_mahasiswa($nrp, $data['nama'], $data['email']);
    
            return redirect('/dashboard')->with('success', 'Berhasil mengedit data');
        } catch (\Exception $e) {
            return redirect('/dashboard')->with('error', 'Gagal mengedit data');
        }
    }

    public function hapusproses($nrp) {
        try {
            $mahasiswa = new Mahasiswa();
            $mahasiswa->get_delete_mahasiswa($nrp);
    
            return back()->with('success', 'Berhasil menghapus data');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data');
        }
    }
}
