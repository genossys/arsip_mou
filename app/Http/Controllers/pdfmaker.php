<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Master\mitraModel;
use App\Master\draftMouModel;
use App\Master\draftMoaModel;
use App\Master\arsipModel;

class pdfmaker extends Controller
{
    //
    public function cetakDataMitra(Request $request)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataMitra($request));
        return $pdf->stream();
    }

    public function dataMitra(Request $request)
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
        return view('admin.laporan.pdfmitra')->with(['mitra' => $mitra]);
    }

    public function cetakDataMou(Request $request)
    {

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataMou($request));
        return $pdf->stream();
    }

    public function dataMou(Request $request)
    {
        $caridata = $request->caridata;
        $status = $request->status;
        $draftMou = draftMouModel::where('status', 'LIKE', '%' . $status . '%')
            ->where(function ($q) use ($caridata) {
                $q->where('mitra', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('nomorMouMitra', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('nomorMouUdb', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('tanggalExpired', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('tanggalPembuatan', 'LIKE', '%' . $caridata . '%');
            })
            ->orderby('tanggalPembuatan', 'desc')
            ->get();
        return view('admin.laporan.pdfmou')->with(['draftMou' => $draftMou]);
    }

    public function cetakDataMoa(Request $request)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataMoa($request));
        return $pdf->stream();
    }

    public function dataMoa(Request $request)
    {
        $caridata = $request->caridata;
        $status = $request->status;
        $draftMoa = draftMoaModel::where('status', 'LIKE', '%' . $status . '%')
            ->where(function ($q) use ($caridata) {
                $q->where('mitra', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('nomorMoaMitra', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('nomorMoaUdb', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('tanggalExpired', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('tanggalPembuatan', 'LIKE', '%' . $caridata . '%');
            })
            ->orderby('tanggalPembuatan', 'desc')
            ->get();
        return view('admin.laporan.pdfmoa')->with(['draftMoa' => $draftMoa]);
    }

    public function cetakDataArsip(Request $request)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->dataArsip($request));
        return $pdf->stream();
    }

    public function dataArsip(Request $request)
    {
        $caridata = $request->caridata;
        $jenisArsip = $request->jenisArsip;
        $arsip = arsipModel::where('jenisArsip', 'LIKE', '%' . $jenisArsip . '%')
            ->where(function ($q) use ($caridata) {
                $q->where('nomorArsip', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('mitra', 'LIKE', '%' . $caridata . '%')
                    ->orwhere('tanggal', 'LIKE', '%' . $caridata . '%');
            })
            ->orderby('tanggal', 'desc')
            ->get();

        return view('admin.laporan.pdfarsip')->with(['arsip' => $arsip]);
    }
}
