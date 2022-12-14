@extends('template')
@section('title')
Edit Data Buku
@endsection
@section('title_header')
Edit Data Game
@endsection
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>Input Game</h2>
            </div>
            <div class="card-body">
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
                                <option >--- Pilih Kategori ---</option>
                                @foreach ($kategori as $i => $kat)
                                <option value="{{$kat->id}}" <?= $buku->id_kategori == $kat->id ? 'selected' : '' ?>>{{$kat->nama_kategori}}</option>
                                @endforeach
                             
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Developer</label>
                        <div class="col-sm-10">
                            <input type="text" name="pengarang" value="{{$buku->pengarang}}" class="form-control">
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
                                <option value="{{$i}}" <?= $buku->tahun_terbit == $i ? 'selected' : ''?> >{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Jumlah Game</label>
                        <div class="col-sm-10">
                            <input type="number" value="{{$buku->jumlah_buku}}" name="jumlah" min="1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Harga Game</label>
                        <div class="col-sm-10">
                            <input type="number" name="harga" value="{{$buku->harga}}" min="1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                          <textarea name="deskripsi" class="form-control" style="height: 100px">{{$buku->deskripsi}}</textarea>
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
                            <img src="{{'https://storage.googleapis.com/cloudwrz/'.$buku->gambar}}" width="30%" alt="">
                        </div>
                    </div>
                    <br />
                    <div id="dvPreview">
                    </div>


                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                    <script language="javascript" type="text/javascript">
                    $(function () {
                        $("#fileupload").change(function () {
                            $("#dvPreview").html("");
                            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                            if (regex.test($(this).val().toLowerCase())) {
                                if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                                    $("#fotolama").hide();
                                    $("#dvPreview").show();
                                    $("#dvPreview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
                                }
                                else {
                                    if (typeof (FileReader) != "undefined") {
                                        $("#fotolama").hide();  
                                        $("#dvPreview").show();
                                        $("#dvPreview").append("<img />");
                                        var reader = new FileReader();
                                        reader.onload = function (e) {
                                            $("#dvPreview img").attr("src", e.target.result);
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
        </div>
    </div>
</div>
@endsection
