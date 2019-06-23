<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\memberModel;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class memberController extends Controller
{
    //

    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        
    }

    public function index(){
        return view( 'admin.master.datamember');
    }

    public function getDataMember()
    {
        $member = memberModel::query()
            ->select('id', 'username', 'email', 'nohp', 'alamat', 'tglLahir')
            ->get();
        return DataTables::of($member)
            ->addIndexColumn()
            ->addColumn('action', function ( $member) {
                return ' <a class="btn-sm btn-danger" data-toggle="tooltip" title="Hapus Data" id="btn-delete" href="#" onclick="hapus(\'' . $member->username . '\', event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->make(true);
    }

    public function showFormRegistrasi(){
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
            'nohp' => 'required|numeric|digits_between:1,15',
            'dateTanggalLahir' => 'required',
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
                $member = new memberModel();
                $member->username = $r->username;
                $member->email = $r->email;
                $member->password = Hash::make($r->password);
                $member->nohp = $r->nohp;
                $member->alamat = $r->alamat;
                $member->tgllahir = $r->dateTanggalLahir;
                $member->save();
                $credentials = $r->only('email', 'password');
                    if (Auth::attempt($credentials)) {
                        return redirect()->intended('/');
                    }else{
                        return redirect()->back();
                    }
            } catch (\Throwable $th) {
                return 'Error Program ' . $th;
            }
        
    }

    public function delete(Request $r)
    {
        $id = $r->input('id');
        memberModel::query()
            ->where('username', '=', $id)
            ->delete();;
        return response()->json([
            'sukses' => 'Berhasil Di hapus' . $id,
            'sqlResponse' => true,
        ]);
    } 
}
