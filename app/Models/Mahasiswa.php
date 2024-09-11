<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nrp';
    protected $fillable = ['nrp', 'nama', 'email'];

    public function get_all_mahasiswa()
    {
        return DB::select("
            SELECT * FROM mahasiswa
            ");  
    }

    public function get_create_mahasiswa($nrp, $nama, $email)
    {
        return DB::insert("
            INSERT INTO mahasiswa (nrp, nama, email) VALUES ('$nrp', '$nama', '$email')
            ");      
    }

    public function get_update_mahasiswa($nrp, $nama, $email)
    {
        return DB::update("
            UPDATE mahasiswa SET nama = '$nama', email = '$email' WHERE nrp = '$nrp'
        ");      
    }

    public function get_mahasiswa_by_nrp($nrp)
    {
        return DB::selectOne("SELECT * FROM mahasiswa WHERE nrp = ?", [$nrp]);
    }

    public function get_delete_mahasiswa($nrp)
    {
        return DB::delete("
            DELETE FROM mahasiswa WHERE nrp = $nrp
            ");      
    }
}
