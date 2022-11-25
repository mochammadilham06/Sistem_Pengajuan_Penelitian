<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ValidationController extends Controller
{
    public function index()
    {
        $users = User::get();
        $roles = Role::pluck('name', 'id');
        $pengajuan = Pengajuan::all();
        return view('validation.danaHibah.index', compact('pengajuan', 'users', 'roles'));
    }

    public function changeStatus(Request $request)
    {
        try {
            Pengajuan::find($request->id)->update(['status' => $request->status]);
            return response()->json(['res' => 'success', 'msg' => 'Status berhasil diubah'], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json(['res' => 'error', 'msg' => $th->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
