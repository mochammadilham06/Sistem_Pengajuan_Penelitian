<?php

namespace App\Http\Controllers;

use App\Models\SuratKontrak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;



class SuratKontrakControllers extends Controller
{
    public function index()
    {
        $users = User::get();
        $surat = SuratKontrak::all();
        return view('kelolaSurat.index', compact('users', 'surat'));
    }

    public function pengarsipan()
    {
        $users = User::get();
        $surat = SuratKontrak::query();
        $surat->when(request('tgl_awal'), function ($query) {
            $query->whereBetween('tgl', [request('tgl_awal'), request('tgl_akhir')]);
        });
        $newSurat = $surat->get();

        return view('pengarsipan.index', compact('users', 'newSurat'));
    }

    public function store(Request $req)
    {
        try {
            $surat = new SuratKontrak();

            $surat->no_surat = $req->get('no_surat');
            $surat->tgl = $req->get('tgl');
            $surat->user_id = $req->get('user_id');
            if ($req->hasFile('file')) {
                $extension = $req->file('file')->extension();

                $filename = 'surat_kontrak' . time() . '.' . $extension;

                $req->file('file')->move(
                    'surat/',
                    $filename
                );

                $surat->file = $filename;
            }

            $surat->save();
            return response()->json(['res' => 'success', 'msg' => 'Data berhasil ditambahkan'], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['res' => 'error', 'msg' => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    // public function store(Request $request)
    // {
    //     try {
    //         if ($request->file('file')) {
    //             $file = $request->file('file');
    //             $nama_file = time() . rand() . $file->getClientOriginalName();
    //         } else {
    //             $nama_file = "";
    //         }

    //         SuratKontrak::toBase()->insert([
    //             'no_surat' => $request->no_surat,
    //             'tgl' => $request->tgl,
    //             'user_id' => $request->user_id,
    //             'file' => $nama_file,
    //         ]);

    //         $file->move('suratKontrak/', $nama_file);
    //         return response()->json(['res' => 'success', 'msg' => 'Data berhasil ditambahkan'], Response::HTTP_CREATED);
    //     } catch (\Throwable $th) {
    //         return response()->json(['res' => 'error', 'msg' => $th->getMessage()], Response::HTTP_BAD_REQUEST);
    //     }
    // }

    public function show(SuratKontrak $surat)
    {
        return $surat->load('user');
    }

    public function edit($id)
    {
        $surat = SuratKontrak::toBase()->find($id);
        if ($surat) {
            return response(['data' => $surat], 200);
        }
        return response('Error Get Data', 500);
    }

    public function update(Request $req)
    {
        try {
            $surat = SuratKontrak::find($req->get('id'));

            $surat->no_surat = $req->get('no_surat');
            $surat->tgl = $req->get('tgl');
            $surat->user_id = $req->get('user_id');

            if ($req->hasFile('file')) {
                $extension = $req->file('file')->extension();

                $filename = 'test' . time() . '.' . $extension;

                $req->file('file')->storeAs(
                    'public/surat',
                    $filename
                );

                Storage::delete('public/surat/' . $req->get('old_file'));

                $surat->cover = $filename;
            }

            $surat->save();
            return response()->json(['res' => 'success', 'msg' => 'Data berhasil ditambahkan'], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['res' => 'error', 'msg' => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    // public function update(SuratKontrak $surat, Request $request)
    // {
    //     dd($request->all(), $surat);
    //     try {
    //         if ($request->file('file')) {
    //             $file = $request->file('file');
    //             $nama_file = time() . rand() . $file->getClientOriginalName();
    //             $file->move('suratKontrak/', $nama_file);

    //             $surat->update([
    //                 'no_surat' => $request->no_surat,
    //                 'tgl' => $request->tgl,
    //                 'user_id' => $request->user_id,
    //                 'file' => $nama_file,
    //             ]);
    //         } else {
    //             $surat->update([
    //                 'no_surat' => $request->no_surat,
    //                 'tgl' => $request->tgl,
    //                 'user_id' => $request->user_id,
    //             ]);
    //         }

    //         return response()->json(['res' => 'success', 'msg' => 'Data berhasil ditambahkan'], Response::HTTP_CREATED);
    //     } catch (\Throwable $th) {
    //         return response()->json(['res' => 'error', 'msg' => $th->getMessage()], Response::HTTP_BAD_REQUEST);
    //     }
    // }

    // public function destroy(Request $req)
    // {
    //     $surat = SuratKontrak::find($req->id);
    //     $surat->delete();
    //     return response()->json(['res' => 'success'], Response::HTTP_NO_CONTENT);
    // }

    public function destroy(SuratKontrak $surat, Request $req)
    {

        $surat->delete();
        Storage::delete('public/surat/' . $req->get('file'));
        return response()->json(['res' => 'success'], Response::HTTP_NO_CONTENT);
    }

    public function cetak()
    {
        $surat = SuratKontrak::query();
        $surat->when(request('tgl_awal') && request('tgl_akhir'), function ($query) {
            $query->whereBetween('tgl', [request('tgl_awal'), request('tgl_akhir')]);
        });
        $newSurat = $surat->get();

        ini_set('max_execution_time', 300);
        $pdf = app('dompdf.wrapper');
        $pdf->setPaper('a4', 'landscape');
        $pdf->getDomPDF()->set_option("enable_php", true);
        $pdf->loadView('kelolaSurat.print', ['surat' => $newSurat, 'tgl_awal' => request('tgl_awal'), 'tgl_akhir' => request('tgl_akhir')]);
        return $pdf->stream('' . time() . '-' . rand() . '.pdf');
    }
}
