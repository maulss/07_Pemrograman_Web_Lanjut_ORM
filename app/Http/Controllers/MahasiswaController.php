<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel
        // $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
        // return view('mahasiswas.index', compact('mahasiswas'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);

        $keyword = $request->input('Nama');

        if ($keyword) {
            $mahasiswas = Mahasiswa::where('Nama', 'like', '%' . $keyword . '%')->paginate(5);
        } else {
            $mahasiswas = Mahasiswa::paginate(5);
        }


        return view('mahasiswas.index', ['mahasiswas' => $mahasiswas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tgl_lahir' => 'required',
        ]);
        //fungsi eloquent untuk menambah data
        Mahasiswa::create($request->all());
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
            ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        // $Mahasiswa = Mahasiswa::find($Nim);
        $Mahasiswa = $mahasiswa;
        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $Mahasiswa = $mahasiswa;
        return view('mahasiswas.edit', compact('Mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tgl_lahir' => 'required',
        ]);

        //fungsi eloquent untuk mengupdate data inputan kita
        // Mahasiswa::where('Nim', $mahasiswa->Nim)->update($request->all());
        // dd($request->all(), $mahasiswa_update, $mahasiswa);
        $mahasiswa->Nim = $request->Nim;
        $mahasiswa->Nama = $request->Nama;
        $mahasiswa->Kelas = $request->Kelas;
        $mahasiswa->Jurusan = $request->Jurusan;
        $mahasiswa->No_Handphone = $request->No_Handphone;
        $mahasiswa->Email = $request->Email;
        $mahasiswa->Tgl_lahir = $request->Tgl_lahir;
        $mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect('mahasiswas')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //fungsi eloquent untuk menghapus data
        // Mahasiswa::find($mahasiswa->Nim)->delete();
        $mahasiswa->delete();
        return redirect('mahasiswas')->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function search(Request $request)
    {
    }
}
