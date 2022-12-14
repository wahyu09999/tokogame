<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Chart;
use App\Models\Diskon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChartController extends Controller
{
    public function index($id)
    {
        $data['buku'] = Buku::whereId($id)->with(['kategori'])->first();
        $data['diskon_buku'] = Diskon::where('id_buku',$id)->get();
        $data['diskon'] = Diskon::where('id_buku', $id)->with(['buku'])->first();
        $data['chart'] = Chart::with(['buku', 'diskon'])->get();
        $data['input'] = true;
        // dd($data);
        return view('page.chart', $data);
    }

    public function chart()
    {
        $data['input'] = false;

        $data['chart'] = Chart::with(['buku', 'diskon'])->get();
        return view('page.chart', $data);
    }

    public function inputChart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_buku' => 'required',
            'jumlah_beli' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('chart/' . $request->id_buku)
                ->withErrors($validator)
                ->withInput();
        }
        $buku = Buku::find($request->id_buku);
        $harga = $buku->harga;
        $jumlah = $request->jumlah_beli;
        $diskon = Diskon::where(['id_buku' => $request->id_buku])->first();
        if ($diskon != null) {
            $min_pem = $diskon->min_pembelian;
            if ($jumlah < $min_pem) {
                $subtotal = $jumlah * $harga;
            } else {
                $subtotal = ($jumlah * $harga) - (($jumlah * $harga) * $diskon->diskon / 100);
            }
            $simpan = Chart::insert([
                'id_buku' => $request->id_buku,
                'jumlah' => $jumlah,
                'sub_total' => $subtotal,
                'id_diskon' => $diskon->id,
            ]);
        } else {
            $subtotal = $jumlah * $harga;
            $simpan = Chart::insert([
                'id_buku' => $request->id_buku,
                'jumlah' => $jumlah,
                'sub_total' => $subtotal,
                'id_diskon' => null,
            ]);
        }

        $jum_skrg = $buku->jumlah_buku - $jumlah;
        $buku->update([
            'jumlah_buku' => $jum_skrg
        ]);
        if ($simpan) {
            return redirect('chart')->with('success', 'Data Berhasil Disimpan');
        } else {
            return redirect('chart' . $request->id_buku)->with('error', 'Data Gagal Disimpan');
        }
    }

    public function deleteChart($id)
    {
        
        $delete = Chart::find($id);
        $jumlah = $delete->jumlah;
        $buku=Buku::find($delete->id_buku);
        $buku->update([
            'jumlah_buku'=>$buku->jumlah_buku+$jumlah
        ]);
        $delete->delete();
        return redirect('chart')->with('success', 'Data Berhasil Dihapus');
    }
}
