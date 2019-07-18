<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Master\draftMouModel;
use Yajra\DataTables\DataTables;
use Validator, Redirect, Response, File;
use App\Master\satuanModel;
use App\Master\kategoriModel;

class draftMouController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.dataDraftMou');
    }

    public function mouByMitra()
    {
        return view('mitra.dataDraftMouByMitra');
    }

    public function getDatadraftMou()
    {

        $draftMou = draftMouModel::all();

        return DataTables::of($draftMou)
            ->addIndexColumn()
            ->addColumn('action', function ($draftMou) {
                return '<a class="btn-sm btn-warning" id="btn-edit" href="#" onclick="showEditDraftMou(\'' . $draftMou->kdDraftMou . '\',
                 \'' . $draftMou->namaDraftMou . '\', \'' . $draftMou->kdKategori . '\', \'' . $draftMou->kdSatuan . '\', \'' . $draftMou->hargaJual . '\',
                  \'' . $draftMou->diskon . '\', \'' . $draftMou->deskripsi . '\', \'' . $draftMou->promo . '\', \'' . $draftMou->qty . '\', event)" ><i class="fa fa-edit"></i></a>
                            <a class="btn-sm btn-danger" id="btn-delete" href="#" onclick="hapus(\'' . $draftMou->kdDraftMou . '\',event)" ><i class="fa fa-trash"></i></a>
                        ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function MitraInsertMou(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|file|max:2048'
            ]
        );

        if ($validator->passes()) {
            $file = $request->file('file');
            $new_name = $request->mitra . $request->nomorMouMitra . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file'), $new_name);
        } else {
            $new_name = '';
        }

        $mou = new draftMouModel();
        $mou->mitra = $request->mitra;
        $mou->tanggalPembuatan = $request->tanggalPembuatan;
        $mou->nomorMouUdb = $request->nomorMouUdb;
        $mou->tanggalExpired = $request->tanggalExpired;
        $mou->nomorMouMitra = $request->nomorMouMitra;
        $mou->file = $new_name;
        $mou->save();
    }


    public function showMouByMitra(Request $request)
    {
        $mitra = $request->mitra;
        $caridata = $request->caridata;
        $draftMou = draftMouModel::where('mitra', $mitra)
            ->where(function ($q) use ($caridata) {
                $q->where('nomorMouMitra', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('nomorMouUdb', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('tanggalPembuatan', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('tanggalExpired', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('file', 'LIKE', '%' . $caridata . '%');
            })

            ->get();

        $contoh = $draftMou->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelMouByMitra')->with('draftMou', $draftMou)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data MOU anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showMou(Request $request)
    {
        $caridata = $request->caridata;
        $draftMou = draftMouModel::where('nomorMouMitra', 'LIKE', '%' . $caridata . '%')
            ->orwhere('nomorMouUdb', 'LIKE', '%' . $caridata . '%')
            ->orwhere('tanggalPembuatan', 'LIKE', '%' . $caridata . '%')
            ->orwhere('tanggalExpired', 'LIKE', '%' . $caridata . '%')
            ->orwhere('file', 'LIKE', '%' . $caridata . '%')
            ->get();

        $contoh = $draftMou->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelMou')->with('draftMou', $draftMou)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data MOU anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showEditMou(Request $request)
    {
        $id = $request->id;
        $draftMou = draftMouModel::where('id', $id)
            ->get();

        $contoh = $draftMou->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.modalEditMou')->with('draftMou', $contoh)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data MOU anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showMitraEditMou(Request $request)
    {
        $id = $request->id;
        $draftMou = draftMouModel::where('id', $id)
            ->get();

        $contoh = $draftMou->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.modalMitraEditMou')->with('draftMou', $contoh)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data MOU anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function AdminEditMou(Request $request)
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
                $new_name = $request->mitra . $request->nomorMouMitra . rand(1, 1000) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('file'), $new_name);
            } else {
                $new_name = '';
            }
        }

        $mou = draftMouModel::find($request->id);
        $mou->nomorMouUdb = $request->nomorMouUdb;
        $mou->status = $request->status;
        if (!$request->file == '') {
            $mou->file = $new_name;
        }
        $mou->save();
    }

    public function MitraEditMou(Request $request)
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
                $new_name = $request->mitra . $request->nomorMouMitra . rand(1, 1000) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('file'), $new_name);
            } else {
                $new_name = '';
            }
        }

        $mou = draftMouModel::find($request->id);
        $mou->nomorMouMitra = $request->nomorMouMitra;
        $mou->tanggalExpired = $request->tanggalExpired;
        if (!$request->file == '') {
            $mou->file = $new_name;
        }
        $mou->save();
    }

    public function showCariMou(Request $request)
    {
        $mitra = $request->mitra;
        $draftMou = draftMouModel::where('mitra', $mitra)
            ->get();

        $contoh = $draftMou->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.modalCariMou')->with('draftMou', $draftMou)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data MOU anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }
}
