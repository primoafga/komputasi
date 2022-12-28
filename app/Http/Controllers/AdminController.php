<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\DAFTAR_KELAS;
use App\Models\Daftar_Guru;
use App\Models\Daftar_Siswa;
use App\Models\Daftar_Mapel;
use App\Models\Admin;
use App\Models\kbm;

class AdminController extends Controller
{
    public function index()
    {
        $id = Session::get('id');
        $data = Admin::where('ID_ADMIN', $id)->get();
        $daftar_guru = Daftar_Guru::all();
        $tingkat1 = DAFTAR_KELAS::where('TINGKAT', 1)->get();
        $tingkat2 = DAFTAR_KELAS::where('TINGKAT', 2)->get();
        $tingkat3 = DAFTAR_KELAS::where('TINGKAT', 3)->get();
        return view('admin.dashboard', compact('tingkat1', 'tingkat2', 'tingkat3', 'data', 'daftar_guru'));
    }

    //SISWA
    public function daftar_siswa()
    {
        $id = Session::get('id_get_siswa');
        $data = DB::select('SELECT
                                a.ID_SISWA,
                                a.NIS,
                                a.NAMA,
                                a.ALAMAT,
                                a.TTL,
                                b.NAMA as KELAS
                            FROM
                                daftar_siswa a
                            LEFT JOIN
                                daftar_kelas b
                            ON
                                a.ID_KELAS
                                =
                                b.ID_KELAS
                            WHERE
                                a.ID_KELAS = ? ', [$id]);
        $tingkat1 = DAFTAR_KELAS::where('TINGKAT', 1)->get();
        $tingkat2 = DAFTAR_KELAS::where('TINGKAT', 2)->get();
        $tingkat3 = DAFTAR_KELAS::where('TINGKAT', 3)->get();
        return view('admin.daftar_siswa', compact('tingkat1', 'tingkat2', 'tingkat3', 'data'));
    }

    public function get_siswa($id)
    {
        Session::forget('id_get_siswa');
        Session::put('id_get_siswa', $id);
        return redirect()->route('/siswa');
    }

    public function Det_Sis( $id)
    {
        $data = Daftar_Siswa::where('ID_SISWA', $id)->get();
        return response()->json($data);
    }

    public function Upd_Sis(Request $request, $id)
    {
        if ($id == "new") {
            $ids = Session::get('id_get_siswa');
            DB::table('daftar_siswa')->insert([
                'NIS' => $request->NIS,
                'NAMA' => $request->NAMA,
                'ALAMAT' => $request->ALAMAT,
                'TTL' => $request->TTL,
                'ID_KELAS' => $ids,
                'password' => $request->NIS
            ]);
        }else {
            $lAda = Daftar_Guru::where('ID',$id)->count();
            if ($lAda == 1)
            {
                DB::select("UPDATE daftar_siswa
                            SET
                                NIS = '$request->NIS',
                                NAMA = '$request->NAMA',
                                ALAMAT = '$request->ALAMAT',
                                TTL = '$request->TTL'
                            WHERE
                                ID_SISWA = '$id'");
            } else
            {
                //
            }

        }
    }

    //GURU
    public function data_guru()
    {
        $data = DB::select('SELECT a.ID, a.NIG, a.NAMA, a.ALAMAT, a.TTL, b.NAMA as MAPEL
                            FROM guru a
                            LEFT JOIN daftar_mapel b ON a.MENGAJAR = b.ID_MAPEL');
        $daftar_mapel = Daftar_Mapel::all();
        $tingkat1 = DAFTAR_KELAS::where('TINGKAT', 1)->get();
        $tingkat2 = DAFTAR_KELAS::where('TINGKAT', 2)->get();
        $tingkat3 = DAFTAR_KELAS::where('TINGKAT', 3)->get();
        return view('admin.daftar_guru', compact('tingkat1', 'tingkat2', 'tingkat3', 'data', 'daftar_mapel'));
    }

    public function Det_Gur($id)
    {
        $data = Daftar_Guru::where('ID', $id)->get();
        return response()->json($data);
    }

    public function Upd_Gur(Request $request, $id)
    {
        if ($id == "new") {
            DB::table('guru')->insert([
                'NIG' => $request->NIG,
                'NAMA' => $request->NAMA,
                'ALAMAT' => $request->ALAMAT,
                'TTL' => $request->TTL,
                'MENGAJAR' => $request->MENGAJAR,
                'password' => $request->NIG
            ]);
        }else {
            $lAda = Daftar_Guru::where('ID',$id)->count();
            if ($lAda == 1)
            {
                DB::select("UPDATE guru
                            SET
                                NIG = '$request->NIG',
                                NAMA = '$request->NAMA',
                                ALAMAT = '$request->ALAMAT',
                                TTL = '$request->TTL',
                                MENGAJAR = '$request->MENGAJAR'
                            WHERE
                                ID = '$id'");
            } else
            {
                //
            }

        }
    }

    //KBM
    public function show_kbm()
    {
        $id = Session::get('id_get_siswa');
        $data = DB::select('SELECT
                                d.ID,
                                a.NIG,
                                a.NAMA,
                                b.NAMA as KELAS,
                                c.NAMA as MAPEL
                            FROM
                                kbm d
                            LEFT JOIN
                                guru a
                            ON
                                d.ID_GURU
                                =
                                a.ID
                            LEFT JOIN
                                daftar_kelas b
                            ON
                                d.ID_KELAS
                                =
                                b.ID_KELAS
                            LEFT JOIN
                                daftar_mapel c
                            ON
                                d.ID_MAPEL
                                =
                                c.ID_MAPEL');
        $daftar_guru = DB::select('SELECT
                                        a.ID,
                                        a.NAMA,
                                        b.NAMA as MAPEL
                                    FROM
                                        guru a
                                    LEFT JOIN
                                        daftar_mapel b
                                    ON
                                        a.MENGAJAR
                                        =
                                        b.ID_MAPEL');
        $daftar_kelas = DAFTAR_KELAS::all();
        $tingkat1 = DAFTAR_KELAS::where('TINGKAT', 1)->get();
        $tingkat2 = DAFTAR_KELAS::where('TINGKAT', 2)->get();
        $tingkat3 = DAFTAR_KELAS::where('TINGKAT', 3)->get();
        return view('admin.kbm_guru', compact('tingkat1', 'tingkat2', 'tingkat3', 'data', 'daftar_guru', 'daftar_kelas'));
    }

    public function Det_Kbm($id)
    {
        $data = kbm::where('ID', $id)->get();
        return response()->json($data);
    }

    public function Upd_Kbm(Request $request, $id)
    {
        if ($id == "new") {
            $get = DB::select('SELECT MENGAJAR FROM guru WHERE ID = ?', [$request->GURU]);
            $mapel = $get[0]->MENGAJAR;
            $length = Daftar_Siswa::where('ID_KELAS',$request->KELAS)->count();
            $siswa = DB::select("SELECT ID_SISWA FROM daftar_siswa WHERE ID_KELAS = ?", [$request->KELAS]);
            DB::table('kbm')->insert([
                'ID_GURU' => $request->GURU,
                'ID_KELAS' => $request->KELAS,
                'ID_MAPEL' => $mapel
            ]);

            for ($i=0; $i < $length; $i++) {
                DB::table('data_nilai_uas')->insert([
                    'ID_MAPEL' => $mapel,
                    'ID_GURU' => $request->GURU,
                    'ID_KELAS' => $request->KELAS,
                    'ID_SISWA' => $siswa[$i]->ID_SISWA
                ]);
                DB::table('data_nilai_uts')->insert([
                    'ID_MAPEL' => $mapel,
                    'ID_GURU' => $request->GURU,
                    'ID_KELAS' => $request->KELAS,
                    'ID_SISWA' => $siswa[$i]->ID_SISWA
                ]);
            }

        }else {
            $lAda = kbm::where('ID',$id)->count();
            if ($lAda == 1)
            {
                $get = DB::select('SELECT MENGAJAR FROM guru WHERE ID = ?', [$request->GURU]);
                $mapel = $get[0]->MENGAJAR;
                DB::select("UPDATE kbm
                            SET
                                ID_GURU = '$request->GURU',
                                ID_KELAS = '$request->KELAS',
                                ID_MAPEL = '$mapel'
                            WHERE
                                ID = '$id'");
            } else
            {
                //
            }

        }
    }

    //MAPEL
    public function show_mapel()
    {
        $data = Daftar_Mapel::all();
        $tingkat1 = DAFTAR_KELAS::where('TINGKAT', 1)->get();
        $tingkat2 = DAFTAR_KELAS::where('TINGKAT', 2)->get();
        $tingkat3 = DAFTAR_KELAS::where('TINGKAT', 3)->get();
        return view('admin.daftar_mapel', compact('tingkat1', 'tingkat2', 'tingkat3', 'data'));
    }

    public function Det_Map($id)
    {
        $data = Daftar_Mapel::where('ID_MAPEL', $id)->get();
        return response()->json($data);
    }

    public function Upd_Map(Request $request, $id)
    {
        if ($id == "new") {
            DB::table('daftar_mapel')->insert([
                'NAMA' => $request->NAMA,
                'KETERANGAN' => $request->KETERANGAN
            ]);
        }else {
            $lAda = Daftar_Mapel::where('ID_MAPEL',$id)->count();
            if ($lAda == 1)
            {
                DB::select("UPDATE daftar_mapel
                            SET
                                NAMA = '$request->NAMA',
                                KETERANGAN = '$request->KETERANGAN'
                            WHERE
                                ID_MAPEL = '$id'");
            } else
            {
                //
            }

        }
    }

    //KELAS
    public function show_kelas()
    {
        $data = DB::select('SELECT
                                a.ID_KELAS,
                                a.NAMA,
                                a.TINGKAT,
                                b.NAMA AS GURU
                            FROM
                                daftar_kelas a
                            LEFT JOIN
                                guru b
                            ON
                                a.ID_WALI_KELAS
                                =
                                b.ID
                            ORDER BY
                                a.NAMA');
        $daftar_guru = Daftar_Guru::all();
        $tingkat1 = DAFTAR_KELAS::where('TINGKAT', 1)->get();
        $tingkat2 = DAFTAR_KELAS::where('TINGKAT', 2)->get();
        $tingkat3 = DAFTAR_KELAS::where('TINGKAT', 3)->get();
        return view('admin.daftar_kelas', compact('tingkat1', 'tingkat2', 'tingkat3', 'data', 'daftar_guru'));
    }

    public function Det_Kel($id)
    {
        $data = DAFTAR_KELAS::where('ID_KELAS', $id)->get();
        return response()->json($data);
    }

    public function Upd_Kel(Request $request, $id)
    {
        if ($id == "new") {
            DB::table('daftar_kelas')->insert([
                'NAMA' => $request->NAMA,
                'ID_WALI_KELAS' => $request->GURU,
                'TINGKAT' => $request->TINGKAT
            ]);
        }else {
            $lAda = DAFTAR_KELAS::where('ID_KELAS',$id)->count();
            if ($lAda == 1)
            {
                DB::select("UPDATE daftar_kelas
                            SET
                                NAMA = '$request->NAMA',
                                ID_WALI_KELAS = '$request->GURU',
                                TINGKAT = '$request->TINGKAT'
                            WHERE
                                ID_KELAS = '$id'");
            } else
            {
                //
            }

        }
    }
}
