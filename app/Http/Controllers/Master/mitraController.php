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
use Illuminate\Support\Facades\Redirect;

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

    public function laporanMitra()
    {
        return view('admin.laporan.laporanMitra');
    }


    public function showFormRegistrasi()
    {
        $this->middleware('guest');
        return view('auth.registermember');
    }

    public function dataMitra()
    {
        $mitra = auth()->user()->username;
        $mitra = mitraModel::where('username', $mitra)->first();
        return view('mitra.datamitra')->with('mitra', $mitra);
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'mitraname' => 'required|max:191|unique:tb_user,username',
            'email' => 'required|max:191',
            'password' => 'required|string|min:8|confirmed',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function register(Request $r)
    {

        // $validator = Validator::make(
        //     $r->all(),
        //     [
        //         'file' => 'required|file|max:2000',
        //         'username' => 'required|max:191|unique:tb_user,username',
        //         'email' => 'required|max:191',
        //         'password' => 'required|string|min:8|confirmed',
        //     ]
        // );

        // if ($validator->passes()) {
        //     $file = $r->file('file');
        //     $new_name = $r->username . '.' . $file->getClientOriginalExtension();
        //     $file->move(public_path('file'), $new_name);

        # code...
        try {
            $member = new mitraModel();
            $member->username = $r->username;
            $member->email = $r->email;
            $member->password = Hash::make($r->password);
            $member->nohp = $r->nohp;
            $member->alamat = $r->alamat;
            // $member->fileSurat = $new_name;
            $member->save();
            $credentials = $r->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect()->intended('/mitra ')->with('warning', 'Pesan Warning');
            } else {
                // echo "<script>alert('sukses')</script>";
                return view('mitra.menuawal')->with('alert', 'sukses');
            }
        } catch (\Throwable $th) {
            return 'Error Program ' . $th;
        }
        // } else {
        //     return Redirect::back()->withErrors($validator);
        // }
    }

    public function uploadSurat(Request $r)
    {

        $validator = Validator::make(
            $r->all(),
            [
                'file' => 'required|file|max:2000',
            ]
        );

        if ($validator->passes()) {
            $file = $r->file('file');
            $new_name = $r->username . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file'), $new_name);

            # code...
            try {
                $member = mitraModel::find($r->username);
                $member->fileSurat = $new_name;
                $member->save();
            } catch (\Throwable $th) {
                return 'Error Program ' . $th;
            }
        } else {
            return Redirect::back()->withErrors($validator);
        }
    }

    public function showMitra(Request $request)
    {
        $caridata = $request->caridata;
        $mitra = mitraModel::where('username', 'LIKE', '%' . $caridata . '%')
            ->orwhere('email', 'LIKE', '%' . $caridata . '%')
            ->orwhere('noHp', 'LIKE', '%' . $caridata . '%')
            ->orwhere('alamat', 'LIKE', '%' . $caridata . '%')
            ->orderby('status', 'asc')
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

    public function showCariMitra(Request $request)
    {
        $caridata = $request->mitra;
        $mitra = mitraModel::where('status', 'acc')
            ->where(function ($q) use ($caridata) {
                $q->where('username', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('email', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('noHp', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('alamat', 'LIKE', '%' . $caridata . '%');
            })
            ->get();

        $contoh = $mitra->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelCariMitra')->with('mitra', $mitra)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data Mitra akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showLaporanMitra(Request $request)
    {
        $caridata = $request->caridata;
        $status = $request->status;
        $mitra = mitraModel::where('status', 'LIKE', '%' . $status . '%')
            ->where(function ($q) use ($caridata) {
                $q->where('username', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('email', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('noHp', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('alamat', 'LIKE', '%' . $caridata . '%');
            })
            ->get();

        $contoh = $mitra->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelLaporanMitra')->with('mitra', $mitra)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data Mitra akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showEditMitra(Request $request)
    {
        $caridata = $request->username;
        $mitra = mitraModel::where('username',  $caridata)->first();

        if ($mitra != null) {
            $returnHTML = view('isidata.modalEditMitra')->with('mitra', $mitra)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data Mitra akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function editMitra(Request $r)
    {
        # code...

        try {
            $member = mitraModel::find($r->username);
            $member->email = $r->email;
            $member->noHp = $r->noHp;
            $member->status = $r->status;
            $member->alamat = $r->alamat;
            $member->save();
        } catch (\Throwable $th) {
            return 'Error Program ' . $th;
        }
    }

    public function deleteMitra(Request $r)
    {
        try {
            $member = mitraModel::find($r->username);
            $member->delete();
        } catch (\Throwable $th) {
            return 'Error Program ' . $th;
        }
    }
}
