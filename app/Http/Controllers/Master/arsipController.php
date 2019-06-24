<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Master\arsipModel;

class arsipController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.dataarsip');
    }

    public function getDatakaArsip()
    {
        $arsip = arsipModel::query()
            ->select('kdArsip', 'judulArsip', 'keterangan', 'tanggal', 'urlFile', 'username')
            ->get();

        return DataTables::of($arsip)
            ->addIndexColumn()
            ->addColumn('action', function ($arsip) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showEditkategori(\'' . $arsip->kdKategori . '\', \'' . $arsip->namaKategori . '\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $arsip->kdKategori . '\', event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Field :attribute Maksimal :max',
            'image'       => 'Field :attribute Harus File Gambar',
        ];

        $rules = [
            'kdArsip' => 'required|max:25',
            'judulArsip' => 'required|max:191',
            'keterangan' => 'required|numeric',
            'tanggal' => 'required|numeric',
            'urlFle' => 'required',
            'username' => 'required',
        ];

        return Validator::make($r->all(), $rules, $messages);
    }

    public function insert(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all()
            ]);
        } else {

            if ($r->hasFile('fileArsip')) {
                $upFoto = $r->file('fileArsip');
                $namaFoto = $r->fileArsip . '.' . $upFoto->getClientOriginalExtension();
                $r->fileArsip->move(public_path('file'), $namaFoto);
            } else {
                $namaFoto = '';
            }

            try {
                $arsip = new arsipModel();
                $arsip->kdArsip = $r->kdArsip;
                $arsip->judulArsip = $r->judulArsip;
                $arsip->keterangan = $r->keterangan;
                $arsip->tanggal = $r->dateTanggal;
                $arsip->username = 'admin';
                $arsip->urlFile = $namaFoto;
                $arsip->save();
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $arsip
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => false,
                    'data' => $th
                ]);
            }
        }
    }

    public function edit(Request $r)
    {
        if ($this->isValid($r)->fails()) {
            return response()->json([
                'valid' => false,
                'errors' => $this->isValid($r)->errors()->all()
            ]);
        } else {
            try {
                $id = $r->oldkdArsip;
                $data = [
                    'kdArsip' => $r->kdArsip,
                    'judulArsip' => $r->judulArsip,
                    'keterangan' => $r->keterangan,
                    'tanggal' => $r->tanggal,
                    'username' => $r->username,
                ];

                if ($r->hasFile('fileArsip')) {
                    $upFoto = $r->file('fileArsip');
                    $namaFoto = $r->fileArsip . '.' . $upFoto->getClientOriginalExtension();
                    $r->fileArsip->move(public_path('file'), $namaFoto);
                } else {
                    $namaFoto = '';
                }

                productModel::query()
                    ->where('kdArsip', '=', $id)
                    ->update($data);
                return response()
                    ->json([
                        'sqlResponse' => true,
                        'sukses' => $data,
                        'valid' => true,
                    ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'sqlResponse' => false,
                    'data' => $th,
                    'valid' => true,
                ]);
            }
        }
    }

    public function delete(Request $r)
    {
        $id = $r->input('id');
        productModel::query()
            ->where('kdArsip', '=', $id)
            ->delete();;
        return response()->json([
            'sukses' => 'Berhasil Di hapus' . $id,
            'data' => 'tahapan/dataTahapan',
            'sqlResponse' => true,
        ]);
    }
}
