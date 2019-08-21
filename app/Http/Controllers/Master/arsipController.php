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
use App\Master\mitraModel;

class arsipController extends Controller
{
    //
    public function index()
    {
        return view('admin.master.dataarsip');
    }

    public function arsipKegiatan()
    {
        return view('admin.master.dataarsipKegiatan');
    }

    public function laporanArsip()
    {
        return view('admin.laporan.laporanArsip');
    }

    public function showLaporanArsip(Request $request)
    {
        $caridata = $request->caridata;
        $arsip = mitraModel::where('status', 'acc')
            ->where(function ($q) use ($caridata) {
                $q->where('username', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('email', 'LIKE', '%' . $caridata . '%');
            })
            ->get();

        $contoh = $arsip->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelLaporanArsip')->with('arsip', $arsip)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data Arsip akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function jenisLaporanArsip(Request $request)
    {
        $jenis = $request->jenis;
        $mitra = $request->mitra;
        $arsip = arsipModel::where('jenisArsip', $jenis)
            ->where('mitra', $mitra)
            ->get();

        $contoh = $arsip->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelIsiLaporanArsip')->with('arsip', $arsip)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data Arsip '.$jenis.' akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
    }

    public function showArsipKegiatan(Request $request)
    {
        $caridata = $request->caridata;
        $draftArsip = arsipModel::where('jenisArsip', 'kegiatan')
            ->where(function ($q) use ($caridata) {
                $q->where('nomorArsip', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('mitra', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('file', 'LIKE', '%' . $caridata . '%');
            })
            ->get();



        $contoh = $draftArsip->first();

        if ($contoh != null) {
            $returnHTML = view('isidata.tabelArsip')->with('draftArsip', $draftArsip)->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        } else {
            $returnHTML = view('isidata.datakosong')->with('kosong', 'Data Arsip Kegiatan anda akan Tampil di sini ')->render();
            return response()->json(array('success' => true, 'html' => $returnHTML));
        }
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

    public function insertArsipKegiatan(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'file' => 'required|file|max:2024',
            ]
        );

        if ($validator->passes()) {
            $file = $request->file('file');
            $new_name = $request->nomorArsip . rand(1, 1000) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('file'), $new_name);

            # code...
            try {
                $skrng = date('Y-m-d');

                $arsip = new arsipModel();
                $arsip->jenisArsip = "Kegiatan";
                $arsip->nomorArsip = $request->nomorArsip;
                $arsip->mitra = $request->mitra;
                $arsip->file = $new_name;
                $arsip->tanggal = $skrng;
                $arsip->save();
            } catch (\Throwable $th) {
                return 'Error Program ' . $th;
            }
        } else {
            return Redirect::back()->withErrors($validator);
        }
    }
    public function deleteArsip(Request $request)
    {
        $arsip = arsipModel::find($request->id);
        $arsip->delete();
    }
}
