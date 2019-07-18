<?php

namespace App\Http\Controllers\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Validator, Redirect, Response, File;
use App\Master\satuanModel;
use App\Master\kategoriModel;
use App\Master\arsipModel;
use App\Master\draftMouModel;
use App\Master\draftMoaModel;

class arsipController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.dataarsip');
    }


    public function showArsip(Request $request)
    {
        $caridata = $request->caridata;
        $draftArsip = arsipModel::where('jenisArsip', 'LIKE', '%' . $caridata . '%')
            ->orwhere('nomorArsip', 'LIKE', '%' . $caridata . '%')
            ->orwhere('mitra', 'LIKE', '%' . $caridata . '%')
            ->orwhere('file', 'LIKE', '%' . $caridata . '%')
            ->get();

        $contoh = $draftArsip->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelArsip')->with('draftArsip', $draftArsip)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data MOU anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function insertArsipMOU(Request $request)
    {
        $skrng = date('Y-m-d');
        $mou = draftMouModel::where("id", $request->id)->first();

        $arsip = new arsipModel();
        $arsip->jenisArsip = "MOU";
        $arsip->nomorArsip = $mou->nomorMouUdb;
        $arsip->mitra = $mou->mitra;
        $arsip->file = $mou->file;
        $arsip->tanggal = $skrng;
        $arsip->save();
    }

    public function insertArsipMOA(Request $request)
    {
        $skrng = date('Y-m-d');
        $moa = draftMoaModel::where("id", $request->id)->first();

        $arsip = new arsipModel();
        $arsip->jenisArsip = "MOA";
        $arsip->nomorArsip = $moa->nomorMoaUdb;
        $arsip->mitra = $moa->mitra;
        $arsip->file = $moa->file;
        $arsip->tanggal = $skrng;
        $arsip->save();
    }
}
