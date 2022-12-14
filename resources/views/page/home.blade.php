@extends('template')
@section('title')
Home
@endsection
@section('title_header')
<h1>Home</h1>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        {{-- <li class="breadcrumb-item">Pages</li> --}}
        {{-- <li class="breadcrumb-item active">Blank</li> --}}
    </ol>
</nav>
@endsection
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header">
            <h2>List Game</h2>
            <a href="{{route('input-buku')}}" class="btn btn-outline-info float-end">Tambah Game</a>
        </div>

    </div>


        <!-- Default Card -->


        <!-- Card with header and footer -->

        <!-- Card with an image on left -->
        @foreach ($buku as $i => $isi)
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{'https://storage.googleapis.com/rakacloud/'.$isi->gambar}}"
                            style="object-fit:cover; background-size:cover; width:100%;" class="rounded-start"
                            alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-header">
                            <h4><span class="badge bg-warning text-dark">{{$isi->judul}}</span></h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><span class="text-info"><i class="ri-bookmark-2-line"></i>
                                    {{$isi->kategori()->first()->nama_kategori}}</span> /
                                <span class="text-danger"> <i class="bi bi-person"></i> {{$isi->pengarang}}</span> /
                                <span class="text-primary"><i class="bi bi-book-half"></i> {{$isi->penerbit}}</span> /
                                <span class="text-success"><i class="bi bi-calendar4"></i> {{$isi->tahun_terbit}}</span>
                            </p>
                            <p>Jumlah Stok : {{$isi->jumlah_buku}}
                              </p>

                            <div class="card-text">
                                @if ($isi->jumlah_buku > 0)
                                <a href="{{route('chart/',$isi->id)}}" class="btn btn-success"><i
                                        class="bi bi-bag-plus-fill"></i></a>
                                @endif
                                
                                <a href="{{route('detail-buku',$isi->id)}}" class="btn btn-info"><i
                                        class="bi bi-info"></i></a>
                                <a href="{{route('delete-buku',$isi->id)}}"
                                    onclick="return confirm('Are you sure you want to delete')"
                                    class=" btn btn-danger  float-end"><i class="bi bi-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Card with an image on left -->
        </div>
        {{-- Modal Delete --}}

        @endforeach
    </div>
</div>



@endsection
