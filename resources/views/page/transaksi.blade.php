@extends('template')
@section('title')
Transaksi
@endsection
@section('title_header')
<h1>Transaksi</h1>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item">Transaksi</li>
        {{-- <li class="breadcrumb-item active">Blank</li> --}}
    </ol>
</nav>
@endsection
@section('content')

<div class="card">
    <div class="card-body">
      <h5 class="card-title">History Transaksi</h5>

      <!-- Table with stripped rows -->
      <table class="table datatable dataTable-table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">No Transaksi</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Jam</th>
            <th scope="col">Item</th>
            <th scope="col">Total</th>
            <th scope="col">Bayar</th>
            <th scope="col">Kembali</th>
            <th scope="col">Info</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $i => $isi)
            <tr>
                <th scope="row">{{$i+1}}</th>
                <td>{{$isi->id}}</td>
                <td>{{$isi->tgl_transaction}}</td>
                <td>{{$isi->jam_transaction}}</td>
                <td>{{$isi->item}}</td>
                <td>{{number_format($isi->total,0,',','.')}}</td>
                <td>{{number_format($isi->bayar,0,',','.')}}</td>
                <td>{{number_format($isi->kembali,0,',','.')}}</td>
                <td><a href="{{route('detail-transaksi',$isi->id)}}" class="btn btn-success"><i class="bi bi-info-circle-fill"></i></a></td>
            </tr>
            @endforeach
        </tbody>
      </table>
      <!-- End Table with stripped rows -->

    </div>
  </div>

@endsection