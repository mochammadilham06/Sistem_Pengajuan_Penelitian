<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{

    use HasFactory;

    protected $fillable = [
        'nama_dosen',
        'file',
        'tgl',
        'jenis',
        'user_id',
        'prodi_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id');
    }
}
