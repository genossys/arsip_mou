<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Master\kategoriModel;
use Illuminate\Support\Facades\Validator;

class kategoriController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.datakategori');
    }
    public function getDatakategori()
    {
        $kategori = kategoriModel::query()
            ->select('kdKategori', 'namaKategori')
            ->get();

        return DataTables::of($kategori)
            ->addIndexColumn()
            ->addColumn('action', function ($kategori) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showEditkategori(\''.$kategori->kdKategori.'\', \''.$kategori->namaKategori.'\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\''.$kategori->kdKategori.'\', event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    private function isValid(Request $r)
    {
        $messages = [
            'required'  => 'Field :attribute Tidak Boleh Kosong',
            'max'       => 'Filed :attribute Maksimal :max',
        ];

        $rules = [
            'kdKategori' => 'required|max:10',
            'namaKategori' => 'required|max:255',
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
            try {
                $satuan = new kategoriModel();
                $satuan->kdKategori = $r->kdKategori;
                $satuan->namaKategori = $r->namaKategori;
                $satuan->save();
                return response()->json([
                    'valid' => true,
                    'sqlResponse' => true,
                    'data' => $satuan
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
                $id = $r->oldkdKategori;
                $data = [
                    'kdKategori' => $r->kdKategori,
                    'namaKategori' => $r->namaKategori,
                ];
                kategoriModel::query()
                    ->where('kdkategori', '=', $id)
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
        kategoriModel::query()
            ->where('kdkategori', '=', $id)
            ->delete();
        return response()->json([
            'sukses' => 'Berhasil Di hapus' . $id,
            'sqlResponse' => true,
        ]);
    }
}
