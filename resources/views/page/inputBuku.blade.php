@extends('template')
@section('title')
Input Data Buku
@endsection
@section('title_header')
<h1>Input Data Game</h1>
<nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
        <li class="breadcrumb-item">Input Data Game</li>
        {{-- <li class="breadcrumb-item active">Blank</li> --}}
    </ol>
</nav>
@endsection
@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h2>Input Game</h2>
            </div>
            <div class="card-body">
                <form action="{{route('save-buku')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Judul Game</label>
                        <div class="col-sm-10">
                            <input type="text" name="judul" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="kategori" id="kategori"
                                aria-label="Default select example">
                                <option selected>--- Pilih Kategori ---</option>
                                @foreach ($kategori as $i => $kat)
                                <option value="{{$kat->id}}">{{$kat->nama_kategori}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="icon col-sm-2">
                            <button onclick="buka()" type="button" class="btn btn-outline-info"><i
                                    class="bi bi-plus-square"></i></button>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Developer</label>
                        <div class="col-sm-10">
                            <input type="text" name="pengarang" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Publiser</label>
                        <div class="col-sm-10">
                            <input type="text" name="penerbit" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputYear" class="col-sm-2 col-form-label">Tahun Rilis</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="tahun" aria-label="Default select example">
                                @for ($i = date('Y'); $i >= date('Y')-10; $i--)
                                <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Jumlah Copy</label>
                        <div class="col-sm-10">
                            <input type="number" name="jumlah" min="1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Harga Game</label>
                        <div class="col-sm-10">
                            <input type="number" name="harga" min="1" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                          <textarea name="deskripsi" class="form-control" style="height: 100px"></textarea>
                        </div>
                      </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="gambar" type="file" id="fileupload">
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
                                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                                if (regex.test($(this).val().toLowerCase())) {
                                    if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
                                        $("#dvPreview").show();
                                        $("#dvPreview")[0].filters.item(
                                            "DXImageTransform.Microsoft.AlphaImageLoader").src = $(
                                            this).val();
                                    } else {
                                        if (typeof (FileReader) != "undefined") {
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
                                            alert("This browser does not support FileReader.");
                                        }
                                    }
                                } else {
                                    alert("Please upload a valid image file.");
                                }
                            });
                        });

                    </script>



                    <div class="d-grid gap-2 mt-3">
                        <button class="btn btn-outline-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Delete --}}
    <div class="modal fade" id="inputkategori" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('save-kategori')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="inputText">Nama Kategori</label>
                            <input type="text" name="nama_kategori" class="form-control" id="inputText">
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-outline-success" type="submit">Tambah Kategori</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<script>
    function buka() {
        $('#inputkategori').modal('show');
    }

</script>
@endsection
