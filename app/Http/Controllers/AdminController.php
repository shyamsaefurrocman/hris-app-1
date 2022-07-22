<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Absensi;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function __construct()
    {
        $absensis = Absensi::get();
        $absen = Absensi::where('tgl_absen', '<', date("Y-m-d"));
        $absen->update([
            'keterangan' => 'tutup',
        ]);
        $absen = Absensi::where('time_end', '<', date("H:i"));
        $absen->update([
            'keterangan' => 'tutup',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absen = DB::table('tb_absensi')
            ->rightJoin('tb_user_absen', 'tb_absensi.id_absensi', '=', 'tb_user_absen.id_absensi')
            ->where('tb_absensi.tgl_absen', date("Y-m-d"))
            ->where('tb_absensi.keterangan', 'buka')
            ->where('tb_user_absen.id_user', Auth::user()->id_user)
            ->first();
        
        $hadir = DB::table('tb_absensi')
        ->rightJoin('tb_user_absen', 'tb_absensi.id_absensi', '=', 'tb_user_absen.id_absensi')
        ->whereBetween('tb_absensi.tgl_absen', [date("Y-m-1"), date("Y-m-31")])
        ->where('tb_user_absen.keterangan', 'hadir')
        ->where('tb_user_absen.id_user', Auth::user()->id_user)
        ->count();

        $sakit = DB::table('tb_absensi')
        ->rightJoin('tb_user_absen', 'tb_absensi.id_absensi', '=', 'tb_user_absen.id_absensi')
        ->whereBetween('tb_absensi.tgl_absen', [date("Y-m-1"), date("Y-m-31")])
        ->where('tb_user_absen.keterangan', 'sakit')
        ->where('tb_user_absen.id_user', Auth::user()->id_user)
        ->count();

        $izin = DB::table('tb_absensi')
        ->rightJoin('tb_user_absen', 'tb_absensi.id_absensi', '=', 'tb_user_absen.id_absensi')
        ->whereBetween('tb_absensi.tgl_absen', [date("Y-m-1"), date("Y-m-31")])
        ->where('tb_user_absen.keterangan', 'izin')
        ->where('tb_user_absen.id_user', Auth::user()->id_user)
        ->count();

        $tidak_hadir = DB::table('tb_absensi')
        ->rightJoin('tb_user_absen', 'tb_absensi.id_absensi', '=', 'tb_user_absen.id_absensi')
        ->whereBetween('tb_absensi.tgl_absen', [date("Y-m-1"), date("Y-m-31")])
        ->where('tb_user_absen.keterangan', 'tidak hadir')
        ->where('tb_user_absen.id_user', Auth::user()->id_user)
        ->count();

        $total_absen = DB::table('tb_absensi')
        ->rightJoin('tb_user_absen', 'tb_absensi.id_absensi', '=', 'tb_user_absen.id_absensi')
        ->whereBetween('tb_absensi.tgl_absen', [date("Y-m-1"), date("Y-m-31")])
        ->where('tb_user_absen.id_user', Auth::user()->id_user)
        ->count();

        function hadirPersen($hadir, $total_absen)
        {
            if (!empty($hadir)) {
                return $hadir/$total_absen*100;
            } else {
               return 0;
            }
        }

        function sakitPersen($sakit, $total_absen)
        {
            if (!empty($sakit)) {
                return $sakit/$total_absen*100;
            } else {
               return 0;
            }
        }

        function izinPersen($izin, $total_absen)
        {
            if (!empty($izin)) {
                return $izin/$total_absen*100;
            } else {
               return 0;
            }
        }

        function tidakHadirPersen($tidak_hadir, $total_absen)
        {
            if (!empty($tidak_hadir)) {
                return $tidak_hadir/$total_absen*100;
            } else {
               return 0;
            }
        }
        
        $hadirPersen = hadirPersen($hadir, $total_absen);
        $sakitPersen = sakitPersen($sakit, $total_absen);
        $izinPersen = izinPersen($izin, $total_absen);
        $tidakHadirPersen = tidakHadirPersen($tidak_hadir, $total_absen);

        $pegawais = User::get();
        return view('admin.dashboard', compact('pegawais', 'absen', 'hadirPersen', 'sakitPersen', 'izinPersen', 'tidakHadirPersen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
