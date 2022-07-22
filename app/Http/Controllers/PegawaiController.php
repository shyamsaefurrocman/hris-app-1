<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PegawaiController extends Controller
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
        $pegawais = User::get();
        return view('admin/pegawai.index', compact('pegawais'));
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
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
            'nomor_telepon' => 'required|min:12|max:13',
            'alamat' => 'required',
            'role' => 'required',
        ]);

        $pegawai = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'role' => $request->role,
            'foto' => "user.png",
        ]);

        if ($pegawai) {
            return redirect()
                ->route('pegawai.index')
                ->with([
                    Alert::success('Berhasil', 'Pegawai Berhasil Ditambahkan')
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    Alert::error('Gagal', 'Pegawai Gagal Ditambahkan')
                ]);
        }

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
            'nama' => 'required',
            'email' => 'required',
            'nomor_telepon' => 'required|min:12|max:13',
            'alamat' => 'required',
            'role' => 'required',
            'foto' => 'mimes:jpg,jpeg,png',
        ]);

        $foto = $request->file('foto');
        $old = User::where('id_user', Auth::user()->id_user)->first();

        function fotoprofil($foto, $old)
        {
            if ($foto != null) {
                $filename = $foto->getClientOriginalName();
                $foto->move(public_path() . '/storage/foto', $filename);
                return $filename;
            } else {
                return $old->foto;
            }
        }
        

        $pegawai = User::where('id_user', $request->id_user);
        $pegawai->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
            'role' => $request->role,
            'foto' => fotoprofil($foto, $old),
        ]);

        if ($pegawai) {
            return redirect()
                ->route('pegawai.index')
                ->with([
                    Alert::success('Berhasil', 'Pegawai Berhasil Diubah')
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    Alert::error('Gagal', 'Pegawai Gagal Diubah')
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $pegawai = User::where('id_user', $request->id_user);
        $pegawai->delete();

        if ($pegawai) {
            return redirect()
                ->route('pegawai.index')
                ->with([
                    Alert::success('Berhasil', 'Pegawai Berhasil Dihapus')
                ]);
        } else {
            return redirect()
                ->route('pegawai.index')
                ->with([
                    Alert::error('Gagal', 'Pegawai Gagal Dihapus')
                ]);
        }
    }
}
