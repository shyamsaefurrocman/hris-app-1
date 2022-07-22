<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\UserAbsen;
use App\Models\Absensi;

class UserAbsenController extends Controller
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
        //
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
        $this->validate($request, [
            'keterangan' => 'required',
        ]);

        $absen = UserAbsen::where('id_user_absen', $request->id_user_absen);
        $absen->update([
            'keterangan' => $request->keterangan,
        ]);

        if ($absen) {
            return redirect()
                ->route('absensi.show', [$request->id_absensi])
                ->with([
                    Alert::success('Berhasil', 'Absensi Pegawai Berhasil Diubah')
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    Alert::error('Gagal', 'Absensi Pegawai Gagal Diubah')
                ]);
        }
    }

    public function updatePresensi(Request $request)
    {
        $userAbsen = Absensi::where('id_absensi', $request->id_absensi)->first();

        if (date("H:i") < $userAbsen->time_start) {
            return redirect()
                ->route('dashboard.index')
                ->with([
                    Alert::error('Gagal', 'Waktu Presensi Belum Dimulai')
                ]);
        } else {
            $this->validate($request, [
                'keterangan' => 'required',
            ]);

            $absen = UserAbsen::where('id_user_absen', $request->id_user_absen);
            $absen->update([
                'keterangan' => $request->keterangan,
            ]);

            if ($absen) {
                return redirect()
                    ->route('dashboard.index')
                    ->with([
                        Alert::success('Berhasil', 'Berhasil Input Presensi')
                    ]);
            } else {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with([
                        Alert::error('Gagal', 'Gagal Input Presensi')
                    ]);
            }
        }
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
