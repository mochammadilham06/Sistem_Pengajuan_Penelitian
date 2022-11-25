<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Prodi;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PengajuanController extends Controller
{
    public function index()
    {
        $users = User::get();
        $pengajuan = Pengajuan::all();
        $prodi = Prodi::pluck('prodi', 'id');
        return view('pengajuan.danaHibah.index', compact('users', 'pengajuan', 'prodi'));
    }

    public function store(Request $request)
    {
        try {
            if ($request->file('file')) {
                $file = $request->file('file');
                $nama_file = time() . rand() . $file->getClientOriginalName();
            } else {
                $nama_file = "";
            }

            Pengajuan::toBase()->insert([
                'nama_dosen' => $request->nama_dosen,
                'tgl' => $request->tgl,
                'jenis' => $request->jenis,
                'user_id' => $request->user_id,
                'prodi_id' => $request->prodi_id,
                'file' => $nama_file,
            ]);

            $file->move('documents/', $nama_file);
            return response()->json(['res' => 'success', 'msg' => 'Data berhasil ditambahkan'], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['res' => 'error', 'msg' => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Pengajuan $pengajuan)
    {
        return $pengajuan->load('user', 'prodi');
    }

    public function edit($id)
    {
        $pengajuan = Pengajuan::toBase()->find($id);
        if ($pengajuan) {
            return response(['data' => $pengajuan], 200);
        }
        return response('Error Get Data', 500);
    }

    public function update(Pengajuan $pengajuan, Request $request)
    {
        dd($request->all(), $pengajuan);
        try {
            if ($request->file('file')) {
                $file = $request->file('file');
                $nama_file = time() . rand() . $file->getClientOriginalName();
                $file->move('documents/', $nama_file);

                $pengajuan->update([
                    'nama_dosen' => $request->nama_dosen,
                    'tgl' => $request->tgl,
                    'jenis' => $request->jenis,
                    'user_id' => $request->user_id,
                    'prodi_id' => $request->prodi_id,
                    'file' => $nama_file,
                ]);
            } else {
                $pengajuan->update([
                    'nama_dosen' => $request->nama_dosen,
                    'tgl' => $request->tgl,
                    'jenis' => $request->jenis,
                    'user_id' => $request->user_id,
                    'prodi_id' => $request->prodi_id,
                ]);
            }

            return response()->json(['res' => 'success', 'msg' => 'Data berhasil ditambahkan'], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['res' => 'error', 'msg' => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy(Pengajuan $pengajuan)
    {
        $pengajuan->delete();
        return response()->json(['res' => 'success'], Response::HTTP_NO_CONTENT);
    }
}
