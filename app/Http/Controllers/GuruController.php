<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Daftar_Guru;
use App\Models\Daftar_Siswa;
use App\Models\Daftar_UH;
use App\Models\Daftar_TUGAS;
use App\Models\Data_Nilai_UAS;
use App\Models\Data_Nilai_UTS;
use App\Models\Data_Nilai_UH;
use App\Models\Data_Nilai_TUGAS;

class GuruController extends Controller
{
    public function index()
    {
        $id = Session::get('id');
        $data = Daftar_Guru::where('ID', $id)->get();
        $daftar_kelas = DB::select('SELECT a.ID_KELAS, a.NAMA
                                    FROM daftar_kelas a
                                    LEFT JOIN kbm b ON a.ID_KELAS = b.ID_KELAS
                                    WHERE b.ID_GURU = ?
                                    ORDER BY a.NAMA ASC', [$id]);
        return view('guru.dashboard', compact('daftar_kelas','data'));
    }

    public function daftar_siswa($id)
    {
        $id1 = Session::get('id');
        $data = DB::select('SELECT * FROM daftar_siswa WHERE ID_KELAS = ? ORDER BY NAMA ASC', [$id]);
        $daftar_kelas = DB::select('SELECT a.ID_KELAS, a.NAMA
                                    FROM daftar_kelas a
                                    LEFT JOIN kbm b ON a.ID_KELAS = b.ID_KELAS
                                    WHERE b.ID_GURU = ?
                                    ORDER BY a.NAMA ASC', [$id1]);
        return view('guru.daftar_siswa', compact('data', 'daftar_kelas'));
    }

    public function tabel($id)
    {
        Session::forget('id_kelas');
        Session::put('id_kelas', $id);
        $id = Session::get('id');
        $daftar_kelas = DB::select('SELECT a.ID_KELAS, a.NAMA
                                    FROM daftar_kelas a
                                    LEFT JOIN kbm b ON a.ID_KELAS = b.ID_KELAS
                                    WHERE b.ID_GURU = ?
                                    ORDER BY a.NAMA ASC', [$id]);
        return view('guru.tabel', compact('daftar_kelas'));
    }

    //UAS
    public function data_uas()
    {
        $id = Session::get('id');
        $id_kelas = Session::get('id_kelas');
        $data = DB::select('SELECT a.ID_UAS, a.NILAI, b.NAMA
                            FROM data_nilai_uas a
                            LEFT JOIN daftar_siswa b ON a.ID_SISWA = b.ID_SISWA
                            WHERE a.ID_GURU = ? AND a.ID_KELAS = ?
                            ORDER BY b.NAMA ASC', [$id, $id_kelas]);

        $daftar_kelas = DB::select('SELECT a.ID_KELAS, a.NAMA
                                    FROM daftar_kelas a
                                    LEFT JOIN kbm b ON a.ID_KELAS = b.ID_KELAS
                                    WHERE b.ID_GURU = ?
                                    ORDER BY a.NAMA ASC', [$id]);
        return view('guru.nilai_uas', compact('data', 'daftar_kelas'));
    }

    public function Det_Uas($id)
    {
        $data = Data_Nilai_UAS::where('ID_UAS', $id)->get();
        return response()->json($data);
    }

    public function Upd_Uas(Request $request, $id)
    {
        if ($id == "new") {

        }else {
            $lAda = Data_Nilai_UAS::where('ID_UAS',$id)->count();
            if ($lAda == 1)
            {
                DB::select("UPDATE data_nilai_uas SET NILAI = '$request->nilai' WHERE ID_UAS = '$id'");
            } else
            {
                //
            }

        }
    }

    //UTS
    public function data_uts()
    {
        $id = Session::get('id');
        $id_kelas = Session::get('id_kelas');
        $data = DB::select('SELECT a.ID_UTS, a.NILAI, b.NAMA
                            FROM data_nilai_uts a
                            LEFT JOIN daftar_siswa b ON a.ID_SISWA = b.ID_SISWA
                            WHERE a.ID_GURU = ? AND a.ID_KELAS = ?
                            ORDER BY b.NAMA ASC', [$id, $id_kelas]);
        $daftar_kelas = DB::select('SELECT a.ID_KELAS, a.NAMA
                                    FROM daftar_kelas a
                                    LEFT JOIN kbm b ON a.ID_KELAS = b.ID_KELAS
                                    WHERE b.ID_GURU = ?
                                    ORDER BY a.NAMA ASC', [$id]);
        return view('guru.nilai_uts', compact('daftar_kelas', 'data'));
    }

    public function Det_Uts($id)
    {
        $data = Data_Nilai_UTS::where('ID_UTS', $id)->get();
        return response()->json($data);
    }

    public function Upd_Uts(Request $request, $id)
    {
        if ($id == "new") {

        }else {
            $lAda = Data_Nilai_UTS::where('ID_UTS',$id)->count();
            if ($lAda == 1)
            {
                DB::select("UPDATE data_nilai_uts SET NILAI = '$request->nilai' WHERE ID_UTS = '$id'");
            } else
            {
                //
            }

        }
    }

    //UH
    public function data_uh()
    {
        $id = Session::get('id_uh');
        $id_kelas = Session::get('id_kelas');
        $id_guru = Session::get('id');
        $data = DB::select('SELECT a.ID, a.NILAI, b.NAMA
                            FROM data_nilai_uh a
                            LEFT JOIN daftar_siswa b ON a.ID_SISWA = b.ID_SISWA
                            WHERE a.ID_GURU = ? AND a.ID_KELAS = ? AND a.ID_UH = ?
                            ORDER BY b.NAMA ASC', [$id_guru, $id_kelas, $id]);
        $daftar_kelas = DB::select('SELECT a.ID_KELAS, a.NAMA
                                    FROM daftar_kelas a
                                    LEFT JOIN kbm b ON a.ID_KELAS = b.ID_KELAS
                                    WHERE b.ID_GURU = ?
                                    ORDER BY a.NAMA ASC', [$id_guru]);
        $daftar_uh = DB::select('SELECT * FROM daftar_uh
                                    WHERE ID_KELAS = ? AND ID_GURU = ?', [$id_kelas, $id_guru]);
        return view('guru.nilai_uh', compact('daftar_kelas', 'data', 'daftar_uh'));
    }

    public function Det_Uh($id)
    {
        $data = DB::select('SELECT * FROM data_nilai_uh WHERE ID = ?', [$id]);
        return response()->json($data);
    }

    public function Upd_Uh(Request $request, $id)
    {
        if ($id == "new") {
            $guru = Session::get('id');
            $mapel = DB::select('SELECT MENGAJAR FROM guru WHERE ID = ?', [$guru]);
            $kelas = Session::get('id_kelas');
            DB::table('daftar_uh')->insert([
                'ID_GURU' => $guru,
                'ID_MAPEL' => $mapel[0]->MENGAJAR,
                'ID_KELAS' => $kelas,
                'NAMA' => $request->NAMA
            ]);
            $uh = Daftar_UH::all()->count();
            $length = Daftar_Siswa::where('ID_KELAS',$kelas)->count();
            $siswa = DB::select("SELECT ID_SISWA FROM daftar_siswa WHERE ID_KELAS = ?", [$kelas]);
            for ($i=0; $i < $length; $i++) {
                DB::table('data_nilai_uh')->insert([
                    'ID_MAPEL' => $mapel[0]->MENGAJAR,
                    'ID_GURU' => $guru,
                    'ID_KELAS' => $kelas,
                    'ID_UH' => $uh,
                    'ID_SISWA' => $siswa[$i]->ID_SISWA
                ]);
            }

        }else {
            DB::select("UPDATE data_nilai_uh SET NILAI = '$request->nilai' WHERE ID = '$id'");

        }
    }

    //TUGAS
    public function data_tugas()
    {
        $id = Session::get('id_tugas');
        $id_kelas = Session::get('id_kelas');
        $id_guru = Session::get('id');
        $data = DB::select('SELECT a.ID, a.NILAI, b.NAMA
                            FROM data_nilai_tugas a
                            LEFT JOIN daftar_siswa b ON a.ID_SISWA = b.ID_SISWA
                            WHERE a.ID_GURU = ? AND a.ID_KELAS = ? AND a.ID_TUGAS = ?
                            ORDER BY b.NAMA ASC', [$id_guru, $id_kelas, $id]);
        $daftar_kelas = DB::select('SELECT a.ID_KELAS, a.NAMA
                                    FROM daftar_kelas a
                                    LEFT JOIN kbm b ON a.ID_KELAS = b.ID_KELAS
                                    WHERE b.ID_GURU = ?
                                    ORDER BY a.NAMA ASC', [$id_guru]);
        $daftar_tugas = DB::select('SELECT * FROM daftar_tugas
                                    WHERE ID_KELAS = ? AND ID_GURU = ?', [$id_kelas, $id_guru]);
        return view('guru.nilai_tugas', compact('daftar_kelas', 'data', 'daftar_tugas'));
    }

    public function get_tugas($id)
    {
        Session::forget('id_tugas');
        Session::put('id_tugas',$id);
        return redirect()->route('/data_tugas');
    }

    public function Det_Tug($id)
    {
        $data = DB::select('SELECT * FROM data_nilai_tugas WHERE ID = ?', [$id]);
        return response()->json($data);
    }

    public function Upd_Tug(Request $request, $id)
    {
        if ($id == "new") {
            $guru = Session::get('id');
            $mapel = DB::select('SELECT MENGAJAR FROM guru WHERE ID = ?', [$guru]);
            $kelas = Session::get('id_kelas');
            DB::table('daftar_tugas')->insert([
                'ID_GURU' => $guru,
                'ID_MAPEL' => $mapel[0]->MENGAJAR,
                'ID_KELAS' => $kelas,
                'NAMA' => $request->NAMA
            ]);
            $tugas = Daftar_TUGAS::all()->count();
            $length = Daftar_Siswa::where('ID_KELAS',$kelas)->count();
            $siswa = DB::select("SELECT ID_SISWA FROM daftar_siswa WHERE ID_KELAS = ?", [$kelas]);
            for ($i=0; $i < $length; $i++) {
                DB::table('data_nilai_tugas')->insert([
                    'ID_MAPEL' => $mapel[0]->MENGAJAR,
                    'ID_GURU' => $guru,
                    'ID_KELAS' => $kelas,
                    'ID_TUGAS' => $tugas,
                    'ID_SISWA' => $siswa[$i]->ID_SISWA
                ]);
            }

        }else {
            DB::select("UPDATE data_nilai_uh SET NILAI = '$request->nilai' WHERE ID = '$id'");

        }
    }

    public function tes($id)
    {
        Session::forget('id_uh');
        Session::put('id_uh', $id);
        return redirect()->route('/data_uh');
    }
}
