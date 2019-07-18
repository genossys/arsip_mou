<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\draftMoaModel;
use Yajra\DataTables\DataTables;
use Validator, Redirect, Response, File;
use App\Master\satuanModel;
use App\Master\kategoriModel;

class draftMoaController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.dataDraftMoa');
    }

    public function moaByMitra()
    {
        return view('mitra.dataDraftMoaByMitra');
    }

    public function getDatadraftMoa()
    {

        $draftMoa = draftMoaModel::all();

        return DataTables::of($draftMoa)
            ->addIndexColumn()
            ->addColumn('action', function ($draftMoa) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showEditDraftMoa(\'' . $draftMoa->kdDraftMoa . '\',
                 \'' . $draftMoa->namaDraftMoa . '\', \'' . $draftMoa->kdKategori . '\', \'' . $draftMoa->kdSatuan . '\', \'' . $draftMoa->hargaJual . '\',
                  \'' . $draftMoa->diskon . '\', \'' . $draftMoa->deskripsi . '\', \'' . $draftMoa->promo . '\', \'' . $draftMoa->qty . '\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $draftMoa->kdDraftMoa . '\',event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function MitraInsertMoa(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|file|max:2048'
            ]
        );

        if ($validator->passes()) {
            $file = $request->file('file');
            $new_name = $request->mitra . $request->nomorMoaMitra . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file'), $new_name);
        } else {
            $new_name = '';
        }

        $moa = new draftMoaModel();
        $moa->mitra = $request->mitra;
        $moa->tanggalPembuatan = $request->tanggalPembuatan;
        $moa->namaKegiatan = $request->namaKegiatan;
        $moa->nomorMou = $request->nomorMou;
        $moa->nomorMoaUdb = $request->nomorMoaUdb;
        $moa->tanggalExpired = $request->tanggalExpired;
        $moa->nomorMoaMitra = $request->nomorMoaMitra;
        $moa->file = $new_name;
        $moa->save();
    }


    public function showMoaByMitra(Request $request)
    {
        $mitra = $request->mitra;
        $caridata = $request->caridata;
        $draftMoa = draftMoaModel::where('mitra', $mitra)
            ->where(function ($q) use ($caridata) {
                $q->where('nomorMoaMitra', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('nomorMoaUdb', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('tanggalPembuatan', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('tanggalExpired', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('file', 'LIKE', '%' . $caridata . '%');
            })
            ->get();

        $contoh = $draftMoa->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelMoaByMitra')->with('draftMoa', $draftMoa)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data MOA anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showMoa(Request $request)
    {
        $caridata = $request->caridata;
        $draftMoa = draftMoaModel::where('nomorMoaMitra', 'LIKE', '%' . $caridata . '%')
            ->orwhere('nomorMoaUdb', 'LIKE', '%' . $caridata . '%')
            ->orwhere('tanggalPembuatan', 'LIKE', '%' . $caridata . '%')
            ->orwhere('tanggalExpired', 'LIKE', '%' . $caridata . '%')
            ->orwhere('file', 'LIKE', '%' . $caridata . '%')
            ->get();
        $contoh = $draftMoa->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelMoa')->with('draftMoa', $draftMoa)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data MOU anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showEditMoa(Request $request)
    {
        $id = $request->id;
        $draftMoa = draftMoaModel::where('id', $id)
            ->get();

        $contoh = $draftMoa->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.modalEditMoa')->with('draftMoa', $contoh)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data MOU anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showMitraEditMoa(Request $request)
    {
        $id = $request->id;
        $draftMoa = draftMoaModel::where('id', $id)
            ->get();

        $contoh = $draftMoa->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.modalMitraEditMoa')->with('draftMoa', $contoh)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data MOU anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function AdminEditMoa(Request $request)
    {
        if (!$request->file == '') {

            $validator = Validator::make(
                $request->all(),
                [
                    'file' => 'file|max:2048'
                ]
            );

            if ($validator->passes()) {
                $file = $request->file('file');
                $new_name = $request->mitra . $request->nomorMoaMitra . rand(1, 1000) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('file'), $new_name);
            } else {
                $new_name = '';
            }
        }

        $moa = draftMoaModel::find($request->id);
        $moa->nomorMoaUdb = $request->nomorMoaUdb;
        $moa->status = $request->status;
        if (!$request->file == '') {
            $moa->file = $new_name;
        }
        $moa->save();
    }

    public function MitraEditMoa(Request $request)
    {
        if (!$request->file == '') {

            $validator = Validator::make(
                $request->all(),
                [
                    'file' => 'file|max:2048'
                ]
            );

            if ($validator->passes()) {
                $file = $request->file('file');
                $new_name = $request->mitra . $request->nomorMoaMitra . rand(1, 1000) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('file'), $new_name);
            } else {
                $new_name = '';
            }
        }

        $moa = draftMoaModel::find($request->id);
        $moa->nomorMoaMitra = $request->nomorMoaMitra;
        $moa->tanggalExpired = $request->tanggalExpired;
        if (!$request->file == '') {
            $moa->file = $new_name;
        }
        $moa->save();
    }
}
