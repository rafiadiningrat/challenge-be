<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getUser()
    {
        $user = User::all();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ada'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => "Ok",
            'success' => true,
            'data' => $user
        ]);
    }

    public function addUser(Request $request)
    {
        try {
            $request->validate([
                'nik_user' => 'required|string|max:16',
                'username_user' => 'required|string|max:50',
                'password_user' => 'required|string|max:255',
                'nama_lengkap_user' => 'required|string|max:100',
                'telepon_user' => 'required|string|max:12',
                'alamat_user' => 'required|string|max:100',
            ]);
    
            $users = User::create([
                'nik_user' => $request->nik_user,
                'username_user' => $request->username_user,
                'password_user' => $request->password_user,
                'nama_lengkap_user' => $request->nama_lengkap_user,
                'telepon_user' => $request->telepon_user,
                'alamat_user' => $request->alamat_user,
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil ditambahkan',
                'data' => $users
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function updateUser(Request $request, $nik_user)
    {
    
        $request->validate([
            'username_user' => 'required|string|max:50',
            'password_user' => 'required|string|max:255',
            'nama_lengkap_user' => 'required|string|max:100',
            'telepon_user' => 'required|string|max:12',
            'alamat_user' => 'required|string|max:100',
        ]);

        $user = User::find($nik_user);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    
        $user->username_user = $request->input('username_user');
        $user->password_user = $request->input('password_user');
        $user->nama_lengkap_user = $request->input('nama_lengkap_user');
        $user->telepon_user = $request->input('telepon_user');
        $user->alamat_user = $request->input('alamat_user');
        $user->save();
    
        return response()->json([
            'success' => true,
            'message' => 'User berhasil diperbarui',
            'data' => $user
        ], 200);
    }

    public function deleteUser($nik_user)
    {
        $user = User::find($nik_user);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User tidak ditemukan'
        ], 404);
    }

    $user->delete();

    return response()->json([
        'success' => true,
        'message' => 'User berhasil dihapus'
    ], 200);
    }
}
