@extends('layout.user')
@section('title', 'Pelayanan Pengaduan Sekolah')
@section('container')
    <section id="bg" style="margin-bottom: 70vh;">
        <div class="carousel-container">
            <div id="hero-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item">
                        <div class="hero-header" style="background-image: url('{{ asset('images/school.jpg') }}')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-text text-center">
                <div class="intro-lead-in">Formulir Aspirasi</div>
                <div class="intro-heading">Sekolah </div>
                <button class="button-28" role="button" onclick="scrollToForm()">Isi Pengaduan</button>
                <button class="button-28" role="button" onclick="scrollToHistori()">Lihat Histori</button>
            </div>
        </div>
    </section>

    <section id="Form" style="margin-bottom: 60vh">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card-body w-90 shadow p-3 mb-5 bg-body rounded ">
                        <h3 class="text-center ms-5 me-5">Formulir Pengaduan Masyarakat </h3>
                        <hr />
                        <form class="form-horizontal" role="form" method="post" action="{{ route('pengaduan.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nomor" class="col-sm-3 control-label">Nomor Pengaduan</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span
                                                class="glyphicon glyphicon-exclamation-sign"></span></div>
                                        <input class="form-control" id="nomor" name="nomor"
                                            value="{{ $nextId }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="col-sm-3 control-label">Nama</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                        </div>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            placeholder="Nama Lengkap" value="" required>
                                    </div>
                                    @error('nama')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NIS" class="col-sm-3 control-label">NIS</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
                                        </div>
                                        <input type="NIS" class="form-control" id="NIS" name="NIS"
                                            placeholder="539211017" value="" required>
                                    </div>
                                    @error('NIS')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lokasi" class="col-sm-3 control-label">Lokasi</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span>
                                        </div>
                                        <input type="text" class="form-control" id="lokasi" name="lokasi"
                                            placeholder="di lantai 1" value="" required>
                                    </div>
                                    @error('lokasi')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal" class="col-sm-3 control-label">Tanggal</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </div>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                                            placeholder="Tanggal" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="id_kategori" class="col-sm-3 control-label">Kategori</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="glyphicon glyphicon-random"></span>
                                        </div>
                                        <select class="form-control" name="id_kategori">
                                            <option>Pilih</option>
                                            <option value="1">Fasilitas</option>
                                            <option value="2">Kebersihan</option>
                                            <option value="3">Kedisiplinan</option>
                                            <option value="4">Ekstrakulikuler</option>
                                            <option value="5">Lainnya</option>
                                        </select>
                                    </div>
                                    @error('id_kategori')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="Keterangan" class="col-sm-3 control-label">Keterangan</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <textarea id="default" class="form-control" rows="4" name="Keterangan"
                                            placeholder="Tuliskan Isi keterangan"></textarea>
                                    </div>
                                    @error('Keterangan')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="keterangan" class="col-sm-3 control-label"> Gambar</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="gambar">
                                    @error('gambar')
                                        <small style="color: red">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <p></p>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-3">
                                    <input id="submit" name="submit" type="submit" value="Kirim Pengaduan"
                                        class="button-submit">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <p class="error"><em>* Catat Nomor Pengaduan Untuk Melihat Status Pengaduan</em></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="Histori" style="margin-bottom: 20vh">
        <div class="container">
            <h1 align="center">
                Histori Pengaduan
            </h1>
            <div class="row">
                <div class="col-md-3 mx-auto">
                    <form action="/#Histori" method="GET">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search" name="search"
                                value="{{ request('search') }}">
                            <button class="btn btn-dark" type="submit">Search by ID</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 mx-auto">
                    <form action="/#Histori" method="GET">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-random"></span></div>
                            <select class="form-control" name="id_kategori">
                                <option>Pilih Kategori</option>
                                <option value="1">Fasilitas</option>
                                <option value="2">Kebersihan</option>
                                <option value="3">Kedisiplinan</option>
                                <option value="4">Ekstrakulikuler</option>
                                <option value="5">Lainnya</option>
                            </select>
                            <button class="btn btn-dark" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-3 mx-auto">
                    <form action="/#Histori" method="GET">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-random"></span></div>
                            <select class="form-control" name="status">
                                <option>Pilih Status</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                            </select>
                            <button class="btn btn-dark" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-sm-1">
                    <form action="/#Histori" method="GET">
                        <div class="input-group">
                            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                            @if ($request->has('search') || $request->has('id_kategori') || $request->has('status'))
                                <a href="/#Histori" class="btn btn-secondary">Clear</a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            @if ($pengaduan->count())
                <div class="row">
                    @foreach ($pengaduan as $item)
                        <div class="col-md-6">
                            <div class="card-body shadow p-3 mb-5 bg-body rounded">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h3 class="h3-laporan custom">Pengaduan</h3>
                                    </div>
                                    <div class="col-md-8">
                                        <h4 class="text-muted text-end fs-6">
                                            {{ $item->Kategori->nama_kategori }}
                                        </h4>


                                    </div>
                                </div>
                                <hr class="hr-laporan">
                                <div class="media-body">
                                    <div>
                                        <h4 class="text-green profil-name" style="font-family: monospace;">
                                            {{ $item->nama }}
                                        </h4>
                                        <h4 class="text-muted text-start fs-6">
                                            {{ $item->status }}
                                        </h4>
                                        <p class="text-muted text-sm"><i class="fa-regular fa-calendar-days"></i> -
                                            {{ $item->tanggal }}
                                        </p>
                                    </div>
                                    <hr class="hr-nama">
                                    <div class="isi-laporan">
                                        <p class="text-justify">
                                            <img src="{{ asset('images/pengaduan/' . $item->gambar) }}" alt=""
                                                class="img-thumbnail" style=" height:200px">
                                        </p>
                                    </div>
                                    <div class="isi-laporan">
                                        <p class="text-justify">
                                            {!! $item->Keterangan !!}
                                        </p>
                                    </div>
                                    <hr class="hr-laporan">

                                    <!-- Comments -->
                                    <div class="ms-4">
                                        <h3 class="custom">Tindak Lanjut Laporan</h3>
                                        <hr class="hr-laporan">
                                        <div class="media-block comment">
                                            <div class="media-body">
                                                @if ($item->tanggapan->count() > 0)
                                                    @foreach ($item->tanggapan as $tanggapan)
                                                        <div>
                                                            <h4 class="text-primary profil-name"
                                                                style="font-family: monospace;">Admin</h4>
                                                            <p class="text-muted text-sm"><i
                                                                    class="fa-regular fa-calendar-days"></i> -
                                                                {{ $tanggapan->tanggal }}</p>
                                                            <hr class="hr-nama-admin">
                                                            <p class="text-justify">{{ $tanggapan->isi }}</p>
                                                        </div>
                                                        <hr class="hr-laporan">
                                                    @endforeach
                                                @else
                                                    <p class="text-muted text-sm">Belum Ada Balasan</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center fs-4">Laporan Tidak Ditemukan</p>
            @endif

    </section>
    <script>
        function scrollToForm() {
            document.getElementById('Form').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function scrollToHistori() {
            document.getElementById('Histori').scrollIntoView({
                behavior: 'smooth'
            });
        }
    </script>
    {{-- SweetAleert --}}
    @if (Session::has('success_message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "success",
                    title: "Success!",
                    text: "{{ Session::get('success_message') }}",
                    button: "OK",
                });
            });
        </script>
    @endif
    @if (Session::has('error_message'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "{{ Session::get('error_message') }}",
                    button: "OK",
                });
            });
        </script>
    @endif

@endsection
