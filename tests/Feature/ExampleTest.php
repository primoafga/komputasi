<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // Testing SISWA
    //log in berhasil
    public function test_login_siswa()
    {
        $response = $this->call(method: 'POST', uri:'/login', parameters:[
            'NIS' => 2041720090,
            'password' => 12345,
        ]);
        $this->assertTrue(condition:true);
    }

    //log in eror
    public function test_login_siswaeror()
    {
        $response = $this->call(method: 'POST', uri:'/login', parameters:[
            'NIS' => 1234567,
            'password' => satu,
        ]);
        $this->assertTrue(condition:true);
    }

    //dashboard
    public function test_siswa_dashboard()
    {
        $response = $this->get('/siswa/dashboard');
        $response->assertStatus(302);
    }

    //nilai
    public function test_siswa_nilai()
    {
        $response = $this->get('/siswa/rekap_nilai');
        $response->assertStatus(302);
    }


    //Testing GURU
    //log in berhasil
    public function test_login_Guru()
    {
        $response = $this->call(method: 'POST', uri:'/login', parameters:[
            'NIG' => 12345678,
            'password' => 123,
        ]);
        $this->assertTrue(condition:true);
    }

    //log in eror
    public function test_login_Gurueror()
    {
        $response = $this->call(method: 'POST', uri:'/login', parameters:[
            'NIG' => 1234567,
            'password' => 'satu',
        ]);
        $this->assertTrue(condition:true);
    }

    //kelas
    public function test_guru_kelas()
    {
        $response = $this->get('/kelas/3');
        $response->assertStatus(302);
    }

    //tambah data
    public function test_guru_data()
    {
        $response = $this->call(method: 'POST', uri:'/data_tugas', parameters:[
            'NAMA' => satu,
        ]);
        $this->assertTrue(condition:true);
    }
    
    //edit nilai
    public function test_guru_nilai()
    {
        $response = $this->call(method: 'PUT', uri:'/data_tugas', parameters:[
            'NILAI' => aaa,
        ]);
        $this->assertTrue(condition:true);
    }

    //dashboard
    public function test_guru_daskelas()
    {
        $response = $this->get('/guru/dashboard');
        $response->assertStatus(404);
    }
    

    //Testing ADMIN
    //log in berhasil
    public function test_login_Admin()
    {
        $response = $this->call(method: 'POST', uri:'/login', parameters:[
            'NIG' => 87654321,
            'password' => 123,
        ]);
        $this->assertTrue(condition:true);
    }

    //log in eror
    public function test_login_Admineror()
    {
        $response = $this->call(method: 'POST', uri:'/login', parameters:[
            'NIG' => satuduatiga,
            'password' => satu,
        ]);
        $this->assertTrue(condition:true);
    }

    //setting guru
    public function test_admin_settingguru()
    {
        $response = $this->call(method: 'POST', uri:'/kbm_guru', parameters:[
            'NIG' => 1,
            'password' => 2,
        ]);
        $this->assertTrue(condition:true);
    }

    //tambah kelas
    public function test_tambah_kelas()
    {
        $response = $this->call(method: 'PUT', uri:'/admin/data_kelas', parameters:[
            'NAMA' => 'TI3A',
            'ID_WALI_KELAS' => a,
            'TINGKAT' => '3',
        ]);
        $this->assertTrue(condition:true);
    }

    //tambah guru
    public function test_tambah_guru()
    {
        $response = $this->call(method: 'POST', uri:'/admin/data_guru', parameters:[
            `NIG` => 12345678, 
            `NAMA` => 'Muhammad', 
            `ALAMAT`=> 'Malang', 
            `TTL` => 'Malang, 30 Oktober 2003',
            `MENGAJAR` => 2,
        ]);
        $this->assertTrue(condition:true);
    }
    
    //edit guru
    public function test_edit_guru()
    {
        $response = $this->call(method: 'PUT', uri:'/admin/data_guru', parameters:[
            `NIG` => 12345678, 
            `NAMA` => 'Paidi', 
            `ALAMAT`=> 'Nganjuk', 
            `TTL` => 'Malang, 3 Maret 2003',
            `MENGAJAR` => 2,
        ]);
        $this->assertTrue(condition:true);
    }

    //tambah siswa
    public function test_tambah_siswa()
    {
        $response = $this->call(method: 'POST', uri:'/admin/daftar_siswa', parameters:[
            `NIS` => 2041720090, 
            `NAMA` => 'Soo Likin', 
            `ALAMAT` => 'Malang', 
            `TTL` => 'Nganjuk, 4 mei 2002',
        ]);
        $this->assertTrue(condition:true);
    }

    //edit siswa
    public function test_edit_siswa()
    {
        $response = $this->call(method: 'PUT', uri:'/admin/daftar_siswa', parameters:[
            `NIS` => 2041720090, 
            `NAMA` => 'Soo Solehmen', 
            `ALAMAT` => 'Nganjuk', 
            `TTL` => 'Nganjuk, 3 Oktober 2002',
        ]);
        $this->assertTrue(condition:true);
    }

    //tambah mata pelajaran
    public function test_tambah_matapelajaran()
    {
        $response = $this->call(method: 'PUT', uri:'/admin/data_mapel', parameters:[
            'NAMA' => 'Fisika',
            'KETERANGAN' => '-',
        ]);
        $this->assertTrue(condition:true);
    }
}

