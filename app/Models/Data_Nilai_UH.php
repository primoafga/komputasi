<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_Nilai_UH extends Model
{
    use HasFactory;

    protected $table = 'data_nilai_uh';
    protected $fillable = ['ID_MAPEL',
                            'ID_GURU',
                            'ID_KELAS',
                            'ID_UH',
                            'ID_SISWA',
                            'NILAI'];
}
