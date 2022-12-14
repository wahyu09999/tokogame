@extends('template')
@section('title')
Detail Transaksi
@endsection
@section('title_header')
<h1>Detail Transaksi</h1>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item">Detail Transaksi</li>
        {{-- <li class="breadcrumb-item active">Blank</li> --}}
    </ol>
</nav>
@endsection
@section('content')
@foreach ($transaksi as $item => $isi)
<div class="row">
    <div class="col-xl-4">
        <div class="card" id="div1">
            <div class="card-body">
                {{-- <div class="row">
                    <div class="col-lg-4 col-md-4 label ">{{$item}}</div>
            <div class="col-lg-1 col-md-1 label ">:</div>
            <div class="col-lg-7 col-md-7">{{$isi->detail_transaction}}</div> --}}
            <h4 class="card-title">Transaksi</h4>
            <div class="card-text">
                <div class="row">
                    <div class="col-lg-4 col-md-4 label ">No Transaksi</div>
                    <div class="col-lg-1 col-md-1 label ">:</div>
                    <div class="col-lg-7 col-md-7">#{{$isi->id}}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label ">Total Item</div>
                    <div class="col-lg-1 col-md-1 label ">:</div>
                    <div class="col-lg-7 col-md-7">{{$isi->item}} Pcs</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label ">Tanggal Transaksi</div>
                    <div class="col-lg-1 col-md-1 label ">:</div>
                    <div class="col-lg-7 col-md-7">{{$isi->tgl_transaction}}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label ">Jam Transaksi</div>
                    <div class="col-lg-1 col-md-1 label ">:</div>
                    <div class="col-lg-7 col-md-7">{{$isi->jam_transaction}}</div>

                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label ">Total Belanja</div>
                    <div class="col-lg-1 col-md-1 label ">:</div>
                    <div class="col-lg-7 col-md-7">Rp. {{number_format($isi->total,0,',','.')}}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label ">Bayar</div>
                    <div class="col-lg-1 col-md-1 label ">:</div>
                    <div class="col-lg-7 col-md-7">Rp. {{number_format($isi->bayar,0,',','.')}}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label ">Kembali</div>
                    <div class="col-lg-1 col-md-1 label ">:</div>
                    <div class="col-lg-7 col-md-7">Rp. {{number_format($isi->kembali,0,',','.')}}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label ">Pelayan</div>
                    <div class="col-lg-1 col-md-1 label ">:</div>
                    <div class="col-lg-7 col-md-7">{{$isi->user()->first()->username}}</div>
                </div>
                <div id="hidden" >
                    <hr>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 label ">Item</div>
                    </div>

                    @foreach ($isi->detail_transaction as $i => $data)

                    <div class="row">
                        <div class="col-lg-4 col-md-4 label ">Game {{$i+1}}</div>
                        <div class="col-lg-1 col-md-1 label ">:</div>
                        <div class="col-lg-7 col-md-7">{{$data->buku->judul}}</div>
                    </div>
                    @endforeach
                </div>
                
                
                
            </div>
        </div>
    </div>
    <button class="btn btn-primary" onclick="printContent('div1')">Print Struk</button>
</div>
<div class="col-xl-8">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                List Game Transaksi
            </div>
            @foreach ($isi->detail_transaction as $i => $data)
            {{-- <h3>{{$data->buku->judul}}</h3> --}}
            <div class="row">
                <div class="col-lg-4 col-md-4 label ">
                    <img src="{{asset('gambar/'.$data->buku->gambar)}}"
                        style="object-fit:cover; background-size:cover; width:100%;" alt="">
                </div>
                <div class="col-lg-8">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Judul Game</label>
                        <div class="col-sm-10">
                            <strong for="inputText" class="col col-form-label">: {{$data->buku->judul}}</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Developer</label>
                        <div class="col-sm-10">
                            <strong for="inputText" class="col col-form-label">: {{$data->buku->pengarang}}</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Penerbit</label>
                        <div class="col-sm-10">
                            <strong for="inputText" class="col col-form-label">: {{$data->buku->penerbit}}</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">item</label>
                        <div class="col-sm-10">
                            <strong for="inputText" class="col col-form-label">: {{$data->jumlah}} Pcs</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Subtotal</label>
                        <div class="col-sm-10">
                            <strong for="inputText" class="col col-form-label text-success">: Rp.
                                {{number_format($data->sub_total,0,',','.')}} </strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Diskon</label>
                        <div class="col-sm-10">:
                            <strong for="inputText"
                                class="col col-form-label <?= $data->id_diskon != null ? 'text-success' : 'text-danger' ?>">
                                <?= $data->id_diskon != null ? $data->diskon->diskon."%"  : '-'?> </strong>
                        </div>
                    </div>
                    <hr>
                </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    function printContent(el) {
        document.getElementById("hidden").style.display = "block";
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }

</script>

@endsection
