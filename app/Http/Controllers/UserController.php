<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;


use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

use App\Models\Role;
use App\Models\User;


class UserController extends Controller
{

    public function index()
    {
        $users = User::get();
        $roles = Role::pluck('name', 'id');
        $prodi = Prodi::pluck('prodi', 'id');
        return view('users.index', compact('users', 'roles', 'prodi'));
    }

    public function store(Request $request)
    {
        // $users = new User;

        // $users->name = $request->get('name');
        // $users->role_id = $request->get('role_id');
        // $users->prodi_id = $request->get('prodi_id');
        // $users->nidn = $request->get('nidn');
        // $users->password = bcrypt($request->get('password'));
        // $users->remember_token = Str::random(10);

        // $users->save();
        // return redirect()->route('users.index');

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        try {
            User::create($data);
            return response()->json(['res' => 'success', 'msg' => 'Data berhasil ditambahkan'], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json(['res' => 'error', 'msg' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(User $user)
    {
        return $user->load('role');
    }

    public function update(Request $request, User $user)
    {
        try {
            $user->update($request->all());
            return response()->json(['res' => 'success', 'msg' => 'Data berhasil diubah'], Response::HTTP_ACCEPTED);
        } catch (\Throwable $e) {
            return response()->json(['res' => 'error', 'msg' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['res' => 'success'], Response::HTTP_NO_CONTENT);
    }
}
