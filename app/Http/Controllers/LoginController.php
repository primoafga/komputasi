<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DAFTAR_KELAS;
use App\Models\kbm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $siswa = DB::select('SELECT * FROM daftar_siswa
                                WHERE NIS = ? AND password = ?', [$request->nidn, $request->password]);
        $guru = DB::select('SELECT * FROM guru
                                WHERE NIG = ? AND password = ?', [$request->nidn, $request->password]);
        $admin = DB::select('SELECT * FROM admin
                                WHERE NIP = ? AND password = ?', [$request->nidn, $request->password]);

        if ($siswa) {
            Session::put('id', $siswa[0]->ID_SISWA);
            Session::put('nama', $siswa[0]->NAMA);
            Session::put('id_kelas', $siswa[0]->ID_KELAS);
            return redirect()->route('Siswa.index');
        }else if($guru){
            Session::put('id', $guru[0]->ID);
            Session::put('nama', $guru[0]->NAMA);
            return redirect()->route('Guru.index');
        }else if($admin){
            Session::put('id', $admin[0]->ID_ADMIN);
            Session::put('nama', $admin[0]->NAMA);
            return redirect()->route('Admin.index');
        }else {
            return redirect()->route('/');
        }
    }

    public function logout()
    {
        Session::forget('id');
        Session::forget('nama');
        Session::forget('id_kelas');
        return redirect()->route('/');
    }
}
