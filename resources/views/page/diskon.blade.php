@extends('template')
@section('title')
Input Diskon Buku
@endsection
@section('title_header')
<h1>Input Diskon Buku</h1>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item">Diskon</li>
    </ol>
</nav>
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>Diskon</h2>
            </div>
            <div class="card-body">
                <form action="{{route('input-diskon')}}" method="post">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Judul Buku</label>
                        <div class="col-sm-9">
                            <select class="form-select" name="id_buku" id="" aria-label="Default select example">
                                <option selected>--- Pilih Judul Buku ---</option>
                                @foreach ($buku as $i => $isi)
                                <option value="{{$isi->id}}">{{$isi->judul}} / {{$isi->pengarang}} / {{$isi->penerbit}}
                                </option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Minimal Pembelian</label>
                        <div class="col-sm-9">
                            <input type="number" min="1" name="min_pem" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-3 col-form-label">Diskon</label>
                        <div class="col-sm-9">
                            <input type="number" name="diskon" class="form-control">
                        </div>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-success text-white" type="submit">Tambah Diskon</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>List Diskon</h2>
            </div>
            <div class="card-body bg-light">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Minimal</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($diskon as $i => $isi)
                        <tr>
                            <th scope="row">{{$i+1}}</th>
                            <td>{{$isi->buku()->first()->judul}}</td>
                            <td>{{$isi->min_pembelian}}</td>
                            <td ><h5 class="text-success">{{$isi->diskon}}%</h5></td>
                            <td>
                                <form action="{{route('delete-diskon',$isi->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-danger"><i
                                        class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
