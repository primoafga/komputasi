<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_Nilai_TUGAS extends Model
{
    use HasFactory;

    protected $table = 'data_nilai_tugas';
    protected $fillable = ['ID_MAPEL',
                            'ID_GURU',
                            'ID_KELAS',
                            'ID_TUGAS',
                            'ID_SISWA',
                            'NILAI'];
}
