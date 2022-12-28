<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_Siswa extends Model
{
    use HasFactory;

    protected $table = 'daftar_siswa';
    protected $fillable = ['NIS',
                            'NAMA',
                            'ALAMAT',
                            'TTL',
                            'ID_KELAS',
                            'password'];
}
