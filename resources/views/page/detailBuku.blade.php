@extends('template')
@section('title')
Detail Game
@endsection
@section('title_header')
<h1>Detail Game</h1>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item">Detail Game</li>
        {{-- <li class="breadcrumb-item active">Blank</li> --}}
    </ol>
</nav>
@endsection
@section('content')
<div class="row">
    <div class="col-xl-4">

        <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <img src="{{'https://storage.googleapis.com/cloudwrz/'.$buku->gambar}}" width="50%" alt="Profile" class="">
                <h2>{{$buku->judul}}</h2>

            </div>
        </div>

    </div>

    <div class="col-xl-8">

        <div class="card">
            <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">

                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#profile-overview">Overview</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                            Game</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab"
                            data-bs-target="#profile-settings">Tambah Stok</button>
                    </li>

                  

                </ul>
                <div class="tab-content pt-2">

                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <h5 class="card-title">Deskripsi</h5>
                        <p class="small fst-italic">{{$buku->deskripsi}}</p>

                        <h5 class="card-title">Detail Game</h5>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Nama Game</div>
                            <div class="col-lg-9 col-md-8">{{$buku->judul}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Developer</div>
                            <div class="col-lg-9 col-md-8">{{$buku->pengarang}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Publiser</div>
                            <div class="col-lg-9 col-md-8">{{$buku->penerbit}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Tahun Rilis</div>
                            <div class="col-lg-9 col-md-8">{{$buku->tahun_terbit}}</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Harga</div>
                            <div class="col-lg-9 col-md-8">Rp. {{number_format($buku->harga,0,',','.')}}</div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4 label">Jumlah Stok</div>
                            <div class="col-lg-9 col-md-8">{{$buku->jumlah_buku}} Pcs</div>
                        </div>
                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                        <!-- Profile Edit Form -->
                        <form action="{{route('update-buku',$buku->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" name="judul" value="{{$buku->judul}}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Kategori</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="kategori" id="kategori"
                                        aria-label="Default select example">
                                        <option>--- Pilih Kategori ---</option>
                                        @foreach ($kategori as $i => $kat)
                                        <option value="{{$kat->id}}"
                                            <?= $buku->id_kategori == $kat->id ? 'selected' : '' ?>>
                                            {{$kat->nama_kategori}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Developer</label>
                                <div class="col-sm-10">
                                    <input type="text" name="pengarang" value="{{$buku->pengarang}}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Publiser</label>
                                <div class="col-sm-10">
                                    <input type="text" name="penerbit" value="{{$buku->penerbit}}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputYear" class="col-sm-2 col-form-label">Tahun Rilis</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="tahun" aria-label="Default select example">
                                        @for ($i = date('Y'); $i >= date('Y')-10; $i--)
                                        <option value="{{$i}}" <?= $buku->tahun_terbit == $i ? 'selected' : ''?>>{{$i}}
                                        </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Jumlah Game</label>
                                <div class="col-sm-10">
                                    <input type="number" value="{{$buku->jumlah_buku}}" name="jumlah" min="1"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Harga Game</label>
                                <div class="col-sm-10">
                                    <input type="number" name="harga" value="{{$buku->harga}}" min="1"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea name="deskripsi" class="form-control"
                                        style="height: 100px">{{$buku->deskripsi}}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="gambar" type="file" id="fileupload">
                                </div>
                            </div>
                            <div class="row mb-3" id="fotolama">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Foto Lama</label>
                                <div class="col-sm-10">
                                    <img src="{{asset('gambar/'.$buku->gambar)}}" width="30%" alt="">
                                </div>
                            </div>
                            <br />
                            <div id="dvPreview">
                            </div>


                            <script type="text/javascript"
                                src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                            <script language="javascript" type="text/javascript">
                                $(function () {
                                    $("#fileupload").change(function () {
                                        $("#dvPreview").html("");
                                        var regex =
                                            /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                                        if (regex.test($(this).val().toLowerCase())) {
                                            if ($.browser.msie && parseFloat(jQuery.browser.version) <=
                                                9.0) {
                                                $("#fotolama").hide();
                                                $("#dvPreview").show();
                                                $("#dvPreview")[0].filters.item(
                                                        "DXImageTransform.Microsoft.AlphaImageLoader")
                                                    .src = $(this).val();
                                            } else {
                                                if (typeof (FileReader) != "undefined") {
                                                    $("#fotolama").hide();
                                                    $("#dvPreview").show();
                                                    $("#dvPreview").append("<img />");
                                                    var reader = new FileReader();
                                                    reader.onload = function (e) {
                                                        $("#dvPreview img").attr("src", e.target
                                                            .result);
                                                        $("#dvPreview img").attr("width", '30%');
                                                        $("#dvPreview img").attr("height", '30%');
                                                    }
                                                    reader.readAsDataURL($(this)[0].files[0]);
                                                } else {
                                                    $("#fotolama").show();
                                                    alert("This browser does not support FileReader.");
                                                }
                                            }
                                        } else {
                                            $("#fotolama").show();
                                            alert("Please upload a valid image file.");
                                        }
                                    });
                                });

                            </script>



                            <div class="d-grid gap-2 mt-3">
                                <button class="btn btn-outline-warning" type="submit">Update</button>
                            </div>
                        </form>

                    </div>

                    <div class="tab-pane fade pt-3" id="profile-settings">

                        <!-- Settings Form -->
                        <form method="post" action="{{route('tambah-stok',$buku->id)}}">
                            @csrf
                            <div class="row mb-3">
                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Tambah Stok Buku</label>
                                <div class="col-md-8 col-lg-9">
                                   <input type="number" min="1" name="jumlah" class="form-control" value="1" >
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form><!-- End settings Form -->

                    </div>


                </div><!-- End Bordered Tabs -->

            </div>
        </div>

    </div>
</div>
@endsection
