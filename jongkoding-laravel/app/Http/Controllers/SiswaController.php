<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    // prioritas pake query builder(DB::table) semua kalo bisa wajib agar terhindar sqli inject
    public function index()
    {
        // $siswa = DB::table('siswa')->get();
        // foreach ($siswa as $data) {
        //     echo $data->nis . " - " . $data->nama . "</br>";
        // }

        // mengambil 1 kolom nis, bisa diganti
        // $siswanis = DB::table('siswa')->pluck('nis');
        // $siswanis = DB::table('siswa')->pluck('nis', 'nama'); // kurang paham
        // foreach ($siswanis as $nama => $nis) {
        //     echo $nis . "</br>";
        // }

        // $jmlh_siswa = DB::table('siswa')->count();
        // echo $jmlh_siswa;

        // boleh make 'jk as jenisKelamin'
        // $siswa = DB::table('siswa')->select('nis', 'nama', 'jk')->get();
        // echo $siswa;

        // $siswa = DB::table('siswa')->distinct('nis')->get(); //kurang paham
        // echo $siswa;

        // // menghitung di jurusan itu ada berapa siswa
        // $siswa = DB::table('siswa')
        //     ->select(DB::raw('count(*) as jml_siswa, id_jurusan'))
        //     ->where('id_jurusan', '>', 0)
        //     ->groupBy('id_jurusan')
        //     ->get();
        // echo $siswa;

        // // join(), leftJoin() master kiri =, rightJoin() master kanan =, crossJoin()
        // $siswa = DB::table('siswa')
        //     ->rightJoin('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan') 
        //     ->get();
        // echo $siswa;


        // // pilih tabel dan masukkan tabel siswa > yg mana siswa.id_jurusan == jurusan.id_jurusan
        // $users = DB::table('siswa')
        //     ->join('jurusan', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
        //     // ->join('siswa', 'siswa.id_jurusan', '=', 'jurusan.id_jurusan')
        //     ->select('siswa.*', 'siswa.nama', 'jurusan.nama')
        //     ->get();
        // echo $users;

        // // dri tadi ketika join tabel pada kolom nama selalu ketimpa, cari caranya!!
        // // eh ternyata cukup ganti nama field...
        // $users = DB::table('siswa')
        //     ->crossJoin('jurusan')
        //     ->get();
        // echo $users;

        // // masih kurang paham sama konsepnya
        // $jurusan_siswa = DB::table('siswa')->where('id_jurusan', '>', 1);
        // $siswa = DB::table('siswa')
        //     ->whereNull('id_jurusan')
        //     ->union($jurusan_siswa)
        //     ->get();
        // echo $siswa;

        // // arg 1 = diurutkan dri field, arg 2 desc atau asc?
        // $siswa = DB::table('siswa')
        //     ->orderBy('id_jurusan', 'desc')
        //     ->get();
        // echo $siswa;


        // $siswa = DB::table('siswa')
        //     ->orderBy('id_jurusan', 'asc')
        //     ->groupBy('nis')
        //     ->get();
        // echo $siswa;

        $siswa = DB::table('siswa')
            ->orderBy('id_jurusan', 'asc')
            ->groupBy('nis')
            ->offset(3) // data yg diambil dri urutan ke3
            ->limit(6)
            ->get();
        echo $siswa;

        // // Mengambil semua nama siswa
        // foreach (Siswa::all() as $siswa) {
        //     echo $siswa->nama . "</br>";
        // }
    }

    public function lakek()
    {
        // Mengambil siswa == lakek
        $siswa_laki = Siswa::where('jk', 'L')
            ->orderBy('nis')
            ->get();

        foreach ($siswa_laki as $siswa) {
            echo $siswa->nis . " - " . $siswa->nama . "</br>";
        }
    }

    public function sm(){
        // // mengambil satu baris/record
        // $siswa = DB::table('siswa')
        //     ->where('nama', 'Salwa')
        //     ->first();
        // echo $siswa->nama;

        // // mengambil 1 value tidak bisa lebih
        // $siswa = DB::table('siswa')
        //     ->where('nama', 'Salwa')
        //     ->value('nis');
        // echo $siswa;

        // $siswa = DB::table('siswa')->find(2021010004); //bodoamat lah boy...
        // echo $siswa;


        // // mengambil model dengan pk, hanya bisa untuk pk
        // $siswa = Siswa::find('2021010003'); 

        // // ambil model pertama yg cocok dengan batasan query
        // $siswa1 = Siswa::where('nama', 'Tegar')->first();
        // // alternatif
        // $siswa2 = Siswa::firstWhere('nama', 'Dian');
    }


    public function siswajrs(){
        $siswajrs = Siswa::where('id_jurusan', '=', 1)->firstOr(function(){ // mengambil record pertama dalam jurusan urutan default nis
            // jika data tidak ditemukan akan menjalankan disini
            echo "tidak ada yg ditemukan </br>";
        });
        if ($siswajrs) {
            echo $siswajrs;
        }
    }

    public function siswafof($value='')
    {
        // findOrFail firstOrFail kalo gagal nampilin 404
        $siswa = Siswa::findOrFail('kok bisa');
        $siswa2 = Siswa::where('id_jurusan', '>', 2)->firstOrFail();

        echo $siswa;
        echo $siswa2;
    }

    public function store(Request $request)
    {
        //  // single record
        // $siswa = DB::table('siswa')
        //     ->insert(['nis' => '2021010011', 'nama' => 'hah', 'jk' => 'L', 'alamat' => 'loh', 'tmp_lahir' => 'eh', 'tgl_lahir' => '1999-01-02', 'telepon' => '083912821', 'id_jurusan' => '2']);
        // // multiply
        // $siswa = DB::table('siswa')
        //     ->insert([
        //         ['nis' => '2021010012', 'nama' => 'hah', 'jk' => 'L', 'alamat' => 'loh', 'tmp_lahir' => 'eh', 'tgl_lahir' => '1999-01-02', 'telepon' => '083912821', 'id_jurusan' => '2'],
        //         ['nis' => '2021010013', 'nama' => 'hah2', 'jk' => 'L', 'alamat' => 'loh2', 'tmp_lahir' => 'eh2', 'tgl_lahir' => '1999-01-02', 'telepon' => '083912822', 'id_jurusan' => '1']
        //     ]);

        // $siswa = new Siswa;
        // $siswa->nama = $request->nama; // karna di tabelku ada yg not null jadi error
        // $siswa->save();

        // $siswa = new Siswa([
        //     'nis' => '2021010012',
        //     'nama' => 'Putrahh',
        //     'jk' => 'P',
        //     'alamat' => 'Jong',
        //     'tmp_lahir' => 'Koding',
        //     'tgl_lahir' => '2000-02-21',
        //     'telepon' => '081928212',
        //     'id_jurusan' => '2'
        // ]); // ntahlah gimana 

        // // cari dulu nisnya kalo kosong baru create bikin record, kalo ada return value
        // $siswa2 = Siswa::firstOrCreate(
        //     ['nis' => '2021010009'],
        //     ['nama' => 'Putrahh1',
        //     'jk' => 'L',
        //     'alamat' => 'Koding',
        //     'tmp_lahir' => 'Jong',
        //     'tgl_lahir' => '2000-03-22',
        //     'telepon' => '08221212',
        //     'id_jurusan' => '1']
        // );
        // echo $siswa2;
    }

    public function update($id){

        // $siswa = DB::table('siswa')
        //     ->where('nis', $id)
        //     ->update(['nama' => 'hah berubah']);

        // $siswa = DB::table('siswa')
        //     ->updateOrInsert(
        //         ['nis' => $id, 'nama' => 'hah berubah'],
        //         [
        //             'jk' => 'P',
        //             'tmp_lahir' => 'jakarta'
        //         ]
        //     );

        // $siswa = Siswa::where('nis', $id)->update([
        //         'nama' => 'Putrahh1 lagi',
        //         'jk' => 'L',
        //         'alamat' => 'Jong',
        //         'tmp_lahir' => 'Kodign',
        //         'tgl_lahir' => '2000-03-22',
        //         'telepon' => '08221212',
        //         'id_jurusan' => '1'
        //     ]);

        // jika nis dan nama cocok maka akan diupdate,
        //  jika tidak ada akan create baru dengan gabungan array 1 dan 2
        // $siswa = Siswa::updateOrCreate([
        //         'nis' => '$id', 'nama' => 'Putrahh1 lagi'],
        //         ['jk' => 'L',
        //         'alamat' => 'Jong',
        //         'tmp_lahir' => 'Kodign',
        //         'tgl_lahir' => '2000-03-22',
        //         'telepon' => '08221212',
        //         'id_jurusan' => '1'
        //     ]);
    }

    public function delete($id){

        $siswa = DB::table('siswa')
            ->where('nis', $id)
            ->delete();

        // $siswa = Siswa::find($id);
        // $siswa->delete();

        // $siswa = Siswa::where('tmp_lahir', 'Surabaya')->delete();


        // Selain menerima satu primary key, method destroy()
        // dapat menerima beberapa primary key, array primary, atau collection
        // primary key.
        // $siswa = Siswa::destroy($id);
        // $siswa = Siswa::destroy(1, 2, 3);
        // $siswa = Siswa::destroy([1, 2, 3]);
        // $siswa = Siswa::destroy(collect([1, 2, 3]));

        return "data sudah terhapus!";
    }
}

