<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\mitraModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class mitraController extends Controller
{
    //

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    { }

    public function index()
    {
        return view('admin.master.datamitra');
    }

    public function showFormRegistrasi()
    {
        $this->middleware('guest');
        return view('auth.registermember');
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'username' => 'required|max:191|unique:tb_user,username',
            'email' => 'required|max:191',
            'password' => 'required|string|min:8|confirmed',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function register(Request $r)
    {
        $this->middleware('guest');
        $this->isValid($r)->validate();
        # code...
        try {
            $member = new mitraModel();
            $member->username = $r->username;
            $member->email = $r->email;
            $member->password = Hash::make($r->password);
            $member->nohp = $r->nohp;
            $member->alamat = $r->alamat;
            $member->save();
            $credentials = $r->only('email', 'password');
            if (Auth::attempt($credentials)) {

                return redirect()->intended('/ ')->with(['warning' => 'Pesan Warning']);
            } else {

                // echo "<script>alert('sukses')</script>";
                return view('mitra.menawal')->with('alert', 'sukses');
            }
        } catch (\Throwable $th) {
            return 'Error Program ' . $th;
        }
    }

    // public function delete(Request $r)
    // {
    //     $id = $r->input('id');
    //     memberModel::query()
    //         ->where('username', '=', $id)
    //         ->delete();;
    //     return response()->json([
    //         'sukses' => 'Berhasil Di hapus' . $id,
    //         'sqlResponse' => true,
    //     ]);
    // }

    public function showMitra(Request $request)
    {
        $caridata = $request->caridata;
        $mitra = mitraModel::where('username', 'LIKE', '%' . $caridata . '%')
            ->orwhere('email', 'LIKE', '%' . $caridata . '%')
            ->orwhere('noHp', 'LIKE', '%' . $caridata . '%')
            ->orwhere('alamat', 'LIKE', '%' . $caridata . '%')
            ->get();

        $contoh = $mitra->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelMitra')->with('mitra', $mitra)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data Mitra akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }
}
