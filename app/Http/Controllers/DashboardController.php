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
            $mahasiswa = Mahasiswa::select('nrp', 'nama', 'email');

            return DataTables::of($mahasiswa)
                ->addIndexColumn() // Menambahkan nomor index ke setiap baris
                ->addColumn('action', function($row){
                    $btn = '<a href="' . url('edit-mahasiswa', $row->nrp) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    $btn .= ' <a href="' . url('hapus-mahasiswa', $row->nrp) . '" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action']) // Supaya HTML di kolom 'action' bisa dirender
                ->make(true); // Mengubah menjadi format JSON yang dibutuhkan oleh DataTables
        }

        // Return view biasa jika bukan request AJAX
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
        $data = [
            'nrp' => $request->nrp,
            'nama' => $request->nama,
            'email'=> $request->email
        ];

        try {
            Mahasiswa::insert($data);
            return redirect('/dashboard')->with('success', 'Berhasil menambahkan data');
        } catch (\Exception $e) {
            return redirect('/add-mahasiswa')->with('error', 'Maaf NRP Sudah Digunakan');
        }
    }


    public function edit ($nrp) {
        $data['title'] = 'Edit Data Mahasiswa';
        $mhs = Mahasiswa::where('nrp', $nrp)->first();
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
            Mahasiswa::where('nrp', $nrp)->update($data);
            return redirect('/dashboard')->with('success', 'Berhasil mengedit data');
        } catch (\Exception $e) {
            return redirect('/dashboard')->with('error', 'Gagal mengedit data');
        }
    }

    public function hapusproses($nrp) {
        try {
            Mahasiswa::where('nrp', $nrp)->delete();
            return back()->with('success', 'Berhasil menghapus data');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data');
        }
    }
}
