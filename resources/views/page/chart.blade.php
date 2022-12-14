@extends('template')
@section('title')
Cart
@endsection
@section('title_header')
<h1>Cart Game</h1>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item">Cart Game</li>
        {{-- <li class="breadcrumb-item active">Blank</li> --}}
    </ol>
</nav>
@endsection
@section('content')
<div class="row">
    @if ($input == true)
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Cart</h5>
                <form action="{{route('input-chart')}}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="hidden" name="id_buku" value="{{$buku->id}}">
                            <label class="list-group-item">{{$buku->judul}}</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Developer</label>
                        <div class="col-sm-10">
                            <label class="list-group-item">{{$buku->pengarang}}</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Publiser</label>
                        <div class="col-sm-10">
                            <label class="list-group-item">{{$buku->penerbit}}</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Tahun Rilis</label>
                        <div class="col-sm-10">
                            <label class="list-group-item">{{$buku->tahun_terbit}}</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="hidden" value="{{$buku->harga}}" id="harga">
                            <label class="list-group-item" id="harg">{{$buku->harga}}</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                <button type="button"
                                    <?= $diskon != null ? "onclick='kurang($diskon->diskon,$diskon->min_pembelian)'" : "onclick='kurang(0,0)'"?>
                                    class="btn btn-outline-dark"><i class="bi bi-dash-lg"></i></button>
                                <input class="form-control text-center" name="jumlah_beli" type="number" min="1"
                                    readonly="true" max="" id="jumlah_beli" value="1" />
                                <button type="button"
                                    <?= $diskon != null ? "onclick='tambah($buku->jumlah_buku,$diskon->diskon,$diskon->min_pembelian)'" : "onclick='tambah($buku->jumlah_buku,0,0)'"?>
                                    class="btn btn-outline-dark"><i class="bi bi-plus"></i></button>
                            </div>
                        </div>
                    </div>


                    <div class="row mb-3">
                        @foreach ($diskon_buku as $j => $diskon)
                        <div class="col-sm-10">
                            <label for="inputText"
                                class="col-sm-10 col-form-label"><?= $diskon != null ? "<span class='text-success'>Diskon $diskon->diskon% untuk Minimal Pembelian $diskon->min_pembelian </span>" : "<span class='text-danger'>Tidak Ada Diskon</span>" ?></label>
                        </div>
                        @endforeach
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">SubTotal</label>
                        <div class="col-sm-10">
                            <input type="hidden" value="{{$buku->harga}}" id="harga">
                            <label class="list-group-item" id="subtotal">{{$buku->harga}}</label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <button class="btn btn-primary">Masukan Ke Keranjang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

       
  
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">List Cart</h5>
                @if (count($chart) != 0)
                <table class="table table-border">
                    <thead>
                        <tr>
                            <th scope="col">Preview</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $total = 0;
                        $jumlah = 0;
                        @endphp
                        @foreach ($chart as $i => $isi)
                        {{-- @dd($Cart); --}}
                        @php
                        $total += $isi->sub_total;
                        $jumlah += $isi->jumlah;
                        @endphp
                        <tr>
                            <th scope="row"><a href="#"><img width="100" height=""
                                        src="{{asset('gambar/'.$isi->buku()->first()->gambar)}}" alt=""></a></th>
                            <td class="text-dark fw-bold">{{$isi->buku()->first()->judul}}</td>
                            <td class="text-center fw-bold">{{$isi->jumlah}} Pcs</td>
                            <td>Rp. {{$isi->sub_total}}</td>
                            <td class="text-center">
                                <?= $isi->diskon == null ? '<span class="text-danger fw-bold">-</span>'  : '<span class="text-success fw-bold">'.$isi->diskon()->first()->diskon.'%</span>' ?>
                            </td>
                            <td>
                                <a href="{{route('delete-chart',$isi->id)}}"><i class="text-danger bi bi-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <form action="{{route('input-transaction')}}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-6 col-form-label">Total</label>
                        <label for="inputText" class="col-sm-1 col-form-label">Rp.</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="total" name="total" value="{{$total}}" readonly />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-7 col-form-label">Banyak Item</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="item" name="item" value="{{$jumlah}}" readonly />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-6 col-form-label">Bayar</label>
                        <label for="inputText" class="col-sm-1 col-form-label">Rp.</label>
                        <div class="col-sm-5">
                            <input type="number" min="0" max="" id="bayar" name="bayar" onkeyup="kembali();"  class="form-control" />
                        </div>
                       
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-6 col-form-label">Kembali</label>
                        <label for="inputText" class="col-sm-1 col-form-label">Rp.</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="kembalian" name="kembali" placeholder="" value=""
                                readonly />
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="row mb-3">
                        <button class="btn btn-info text-white" id="input" disabled>Bayar</button>
                    </div>

                </form>
                @else
                <div class="alert alert-info">
                    <h5>Keranjang Kosong</h5>
                </div>
                @endif
                
            </div>
        </div>
    </div>
   
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("#bayar").on("input", function(){
        // Print entered value in a div box
       kembali();
    });
});
</script>
<script>

    function kembali(){
        var total = document.getElementById('total').value;
        var bayar = document.getElementById('bayar').value;
        var kembalian = bayar - total;
        if(kembalian >= 0){
            document.getElementById('kembalian').value = kembalian;
            document.getElementById('input').disabled = false;
        }else{
            document.getElementById('kembalian').value = '';
            document.getElementById('input').disabled = true;

        }

    }
    function tambah(max, diskon, min_pem) {
        var jumlah_beli = document.getElementById('jumlah_beli').value;
        var tambah = parseInt(jumlah_beli) + 1;
        var harga = document.getElementById('harga').value;
        if (tambah <= max) {
            document.getElementById('jumlah_beli').value = tambah;
        } else {
            document.getElementById('jumlah_beli').value = max;
        }

        if (tambah < min_pem) {
            console.log('belum capai minimal');
            document.getElementById('subtotal').innerHTML = harga * tambah;
        } else {
            document.getElementById('subtotal').innerHTML = (harga * tambah) - ((harga * tambah) * (diskon / 100));
            console.log('tercapai minimal');
        }
    }

    function kurang(diskon, min_pem) {
        var jumlah_beli = document.getElementById('jumlah_beli').value;
        var jumkurang = parseInt(jumlah_beli) - 1;
        var harga = document.getElementById('harga').value;
        if (jumkurang <= 0) {
            jumkurang = 1;
            document.getElementById('jumlah_beli').value = 1;
        } else {
            document.getElementById('jumlah_beli').value = parseInt(jumkurang);
        }
        if (jumkurang < min_pem) {
            document.getElementById('subtotal').innerHTML = parseInt(harga) * jumkurang;
        } else {
            document.getElementById('subtotal').innerHTML = (harga * jumkurang) - ((harga * jumkurang) * (diskon /
                100));
        }
    }

</script>
@endsection()
