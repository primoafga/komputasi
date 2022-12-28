<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar_TUGAS extends Model
{
    use HasFactory;

    protected $table = 'daftar_tugas';
    protected $fillable = ['ID_GURU',
                            'ID_MAPEL',
                            'ID_KELAS',
                            'NAMA'];
}
