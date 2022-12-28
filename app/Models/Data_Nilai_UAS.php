<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_Nilai_UAS extends Model
{
    use HasFactory;

    protected $table = 'data_nilai_uas';
    protected $fillable = ['ID_MAPEL',
                            'ID_GURU',
                            'ID_SISWA',
                            'NILAI'];
}
