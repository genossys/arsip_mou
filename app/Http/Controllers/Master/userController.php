<?php

namespace App\Http\Controllers\Master;

use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    //

    //menampilkan halaman user
    public function index()
    {
        return view('admin.master.datauser');
    }

    public function showUser(Request $request)
    {
        $caridata = $request->caridata;
        $user = User::where('username', 'LIKE', '%' . $caridata . '%')
            ->orwhere('email', 'LIKE', '%' . $caridata . '%')
            ->orwhere('noHp', 'LIKE', '%' . $caridata . '%')
            ->orwhere('alamat', 'LIKE', '%' . $caridata . '%')
            ->orwhere('hakAkses', 'LIKE', '%' . $caridata . '%')
            ->get();

        $contoh = $user->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelUser')->with('user', $user)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data User akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }


    public function insertUser(Request $r)
    {
        # code...

        try {
            $member = new User();
            $member->username = $r->username;
            $member->email = $r->email;
            $member->password = Hash::make($r->password);
            $member->noHp = $r->noHp;
            $member->hakAkses = $r->hakAkses;
            $member->alamat = $r->alamat;
            $member->save();
        } catch (\Throwable $th) {
            return 'Error Program ' . $th;
        }
    }

    public function showEditUser(Request $request)
    {
        $caridata = $request->user;
        $user = User::where('id', $caridata)->first();

        if ($user != null) {
            $returnHTML = view('isidata.modalEditUser')->with('user', $user)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data User akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function editUser(Request $r)
    {
        # code...

        try {
            $member = User::find($r->id);
            $member->email = $r->email;
            $member->noHp = $r->noHp;
            $member->hakAkses = $r->hakAkses;
            $member->alamat = $r->alamat;
            $member->save();
        } catch (\Throwable $th) {
            return 'Error Program ' . $th;
        }
    }

    public function deleteUser(Request $r)
    {
        try {
            $member = User::find($r->id);
            $member->delete();
        } catch (\Throwable $th) {
            return 'Error Program ' . $th;
        }
    }
}
