<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Buku;
use App\Models\Chart;
use App\Models\Transaction;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Models\Detail_transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'total' => 'required',
            'bayar' => 'required',
            'kembali' => 'required',
            'item' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('chart')
                ->withErrors($validator)
                ->withInput();
        }
        $tgl = date("Y-m-d");
        $jam = date('H:i:s');


        $simpan = Transaction::create([
            'tgl_transaction' => $tgl,
            'jam_transaction' => $jam,
            'total' => $request->total,
            'bayar' => $request->bayar,
            'kembali' => $request->kembali,
            'item' => $request->item,
            'id_user' => Auth::user()->id,
        ]);


        if ($simpan) {
            $chart = Chart::all();
            foreach ($chart as $c) {
                Detail_transaction::create([
                    'id_transaction' => $simpan->id,
                    'id_buku' => $c->id_buku,
                    'jumlah' => $c->jumlah,
                    'sub_total' => $c->sub_total,
                    'id_diskon' => $c->id_diskon,
                ]);

                $c->delete();
            }
            return redirect('transaksi')->with('success', 'Data berhasil ditambahkan');
        } else {
            return redirect('chart')->with('error', 'Data gagal ditambahkan');
        }
    }

    public function index()
    {
        $data['transaksi'] = Transaction::orderBy('id', 'DESC')->get();
        return view('page.transaksi', $data);
    }

    public function detail($id)
    {
        $data['transaksi'] = Transaction::with(['detail_transaction', 'user'])->where('id', $id)->get();
        // foreach($data['transaksi'] as $t){
        //     $data['id_buku'] = $t->detail_transaction->pluck('buku.id');
        //     $data['judul'] = $t->detail_transaction->pluck('buku.judul');
        // }
        // dd($data);
        return view('page.detailTransaksi', $data);
    }

    public function cetak_pdf($id)
    {
        $filename = "AppName_Day__gen_" . date("Y-m-d_H-i") . ".pdf";

        // Send headers
     
        $data['transaksi'] = Transaction::where('id', $id)->first();
        $this->fpdf->SetFont('Arial', 'B', 15);
        $this->fpdf->AddPage("L", ['100', '100']);
        $this->fpdf->Text(10, 10, "asfsdf");
        # code...

        $cetak = $this->fpdf->Output();
        if ($cetak) {
            return redirect('transaksi');
        } else {
        }
    }
}
