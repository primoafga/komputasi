<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Daftar_Siswa;
use App\Models\Data_Nilai_UH;
use App\Models\Data_Nilai_UTS;
use App\Models\Data_Nilai_UAS;
use App\Models\Data_Nilai_TUGAS;

class SiswaController extends Controller
{
    public function index()
    {
        $id = Session::get('id');
        $id_kelas = Session::get('id_kelas');
        $data = DB::select('SELECT a.ID_SISWA, a.NAMA, a.ALAMAT, a.TTL, b.NAMA as NAMA_KELAS
                            FROM daftar_siswa a
                            LEFT JOIN daftar_kelas b ON a.ID_KELAS = b.ID_KELAS
                            WHERE a.ID_SISWA = ?', [$id]);
        $daftar_mapel = DB::select('SELECT b.ID_MAPEL, b.NAMA
                                    FROM kbm a
                                    LEFT JOIN daftar_mapel b ON a.ID_MAPEL = b.ID_MAPEL
                                    LEFT JOIN guru c ON a.ID_GURU = c.ID
                                    WHERE a.ID_KELAS = ?', [$id_kelas]);
        return view('siswa.dashboard', compact('data', 'daftar_mapel'));
    }

    public function tabel_nilai($id)
    {
        $id_siswa = Session::get('id');
        $id_kelas = Session::get('id_kelas');
        $data_uh = DB::select('SELECT a.NILAI, b.NAMA
                                FROM data_nilai_uh a
                                LEFT JOIN daftar_uh b ON a.ID_UH = b.ID_UH
                                WHERE a.ID_SISWA = ? AND a.ID_MAPEL = ?', [$id_siswa, $id]);
        $data_uts = DB::select('SELECT * FROM data_nilai_uts WHERE ID_SISWA = ? AND ID_MAPEL = ?', [$id_siswa, $id]);
        $data_uas = DB::select('SELECT * FROM data_nilai_uas WHERE ID_SISWA = ? AND ID_MAPEL = ?', [$id_siswa, $id]);
        $data_tugas = DB::select('SELECT a.NILAI, b.NAMA
                                    FROM data_nilai_tugas a
                                    LEFT JOIN daftar_tugas b ON a.ID_TUGAS = b.ID_TUGAS
                                    WHERE a.ID_SISWA = ? AND a.ID_MAPEL = ?', [$id_siswa, $id]);

        //UH
        $tuh = 0;
        $uh = Data_Nilai_UH::where('ID_SISWA',$id_siswa)
                                ->where('ID_MAPEL',$id)->count();
        for ($i=0; $i < $uh; $i++) {
            $tuh += (int)$data_uh[$i]->NILAI;
        }
        $tuh = $tuh / $uh;

        //UTS
        $tuts = 0;
        $uts = Data_Nilai_UTS::where('ID_SISWA',$id_siswa)
                                ->where('ID_MAPEL',$id)->count();
        for ($i=0; $i < $uts; $i++) {
            $tuts += (int)$data_uts[$i]->NILAI;
        }

        $tuts = $tuts / $uts;
        //UAS
        $tuas = 0;
        $uas = Data_Nilai_UAS::where('ID_SISWA',$id_siswa)
                                ->where('ID_MAPEL',$id)->count();
        for ($i=0; $i < $uas; $i++) {
            $tuas += (int)$data_uas[$i]->NILAI;
        }

        $tuas = $tuas / $uas;
        //TUGAS
        $ttugas = 0;
        $tugas = Data_Nilai_TUGAS::where('ID_SISWA',$id_siswa)
                                ->where('ID_MAPEL',$id)->count();
        for ($i=0; $i < $tugas; $i++) {
            $ttugas += (int)$data_tugas[$i]->NILAI;
        }

        $ttugas = $ttugas / $tugas;

        $total = ($ttugas * 35/100) + ($tuh * 15/100) + ($tuts * 20/100) + ($tuas * 30/100);

        $daftar_mapel = DB::select('SELECT b.ID_MAPEL, b.NAMA
                                    FROM kbm a
                                    LEFT JOIN daftar_mapel b ON a.ID_MAPEL = b.ID_MAPEL
                                    LEFT JOIN guru c ON a.ID_GURU = c.ID
                                    WHERE a.ID_KELAS = ?', [$id_kelas]);
        return view('siswa.rekap_nilai', compact('daftar_mapel', 'data_uh', 'data_uts', 'data_uas', 'data_tugas', 'total'));
    }
}
