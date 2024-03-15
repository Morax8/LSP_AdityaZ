@extends('layout.admin')
@section('title', 'Dashboard')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <form action="/dashboard" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search" name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-dark" type="submit">Search</button>
                    </div>
                </form>
            </div>

            <div class="col-md-3">
                <form action="/dashboard" method="GET">
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

            <div class="col-md-3">
                <form action="/dashboard" method="GET">
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
            <div class="col-md-3">
                <form action="/dashboard" method="GET">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        <input type="date" class="form-control" name="tanggal" placeholder="Select Date">
                        <button class="btn btn-dark" type="submit">Search</button>
                    </div>
                </form>
            </div>

            <div class="col-sm-1">
                <form action="/dashboard" method="GET">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        @if ($request->has('tanggal') || $request->has('search') || $request->has('id_kategori') || $request->has('status'))
                            <a href="/pengaduan" class="btn btn-secondary">Clear</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Lokasi</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Isi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pengaduan->count())
                        @foreach ($pengaduan as $item)
                            <tr>
                                {{-- <td class="col-1">{{ $item->id }}</td> --}}
                                <td class="col-1">{{ $item->nama }}</td>
                                <td class="col-1">{{ $item->NIS }}</td>
                                <td class="col-2">{{ $item->lokasi }}</td>
                                <td class="col-1">{{ $item->tanggal }}</td>
                                <td class="col-1">{{ $item->Kategori->nama_kategori }}</td>
                                <td class="col-3">{!! $item->Keterangan !!}</td>
                                <td class="col-1">
                                    @if ($item->status == 'Menunggu')
                                        <p class="badge badge-danger">Menunggu</p>
                                    @elseif ($item->status == 'Proses')
                                        <p class="badge badge-warning">Proses</p>
                                    @else
                                        <p class="badge badge-success">Selesai</p>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="text-center fs-4">Data Tidak Ditemukan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
