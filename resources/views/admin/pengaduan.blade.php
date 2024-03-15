@extends('layout.admin')
@section('title', 'Pengaduan')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <form action="/pengaduan" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search" name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-dark" type="submit">Search</button>
                    </div>
                </form>
            </div>

            <div class="col-md-3">
                <form action="/pengaduan" method="GET">
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
                <form action="/pengaduan" method="GET">
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
                <form action="/pengaduan" method="GET">
                    <div class="input-group">
                        <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                        <input type="date" class="form-control" name="tanggal" placeholder="Select Date">
                        <button class="btn btn-dark" type="submit">Search</button>
                    </div>
                </form>
            </div>

            <div class="col-sm-1">
                <form action="/pengaduan" method="GET">
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
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telpon</th>
                        <th>Isi</th>
                        <th>Status</th>
                        <th colspan="3" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pengaduan->count())
                        @foreach ($pengaduan as $item)
                            <tr>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->NIS }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>{!! $item->Keterangan !!}</td>
                                <td>
                                    @if ($item->status == 'Menunggu')
                                        <p class="badge badge-danger">Menunggu</p>
                                    @elseif ($item->status == 'Proses')
                                        <p class="badge badge-warning">Proses</p>
                                    @elseif($item->status == 'Selesai')
                                        <p class="badge badge-success">Selesai</p>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" id="detailButton{{ $item->id }}"
                                        class="btn btn-warning detail-button">
                                        Detail
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button type="button" id="balasButton{{ $item->id }}"
                                        class="btn btn-warning balas-button">
                                        Balas
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger delete-button"
                                        data-item-id="{{ $item->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center fs-4">Data Tidak Ditemukan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @foreach ($pengaduan as $key)
        <?php
        // Check if there is a response for the current report
        $reportId = $key->id;
        $response = \App\Models\Tanggapan::where('id', $reportId)->first();
        
        // Set a variable to indicate if a response is found
        $foundReply = $response ? true : false;
        ?>
        <form id="tanggapanForm{{ $item->id }}" action="{{ route('pengaduan.tanggapan', ['id' => $item->id]) }}"
            method="post" style="display: none;">
            @csrf
            <textarea id="tanggapanInput{{ $item->id }}" name="tanggapan"></textarea>
        </form>
        <script>
            //detail
            document.addEventListener('DOMContentLoaded', function() {
                const detailButtons = document.querySelectorAll('[id^="detailButton"]');

                detailButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const itemId = button.id.replace('detailButton', '');

                        const modalContent = `                            
                            <div class="modal-body">
                                <table class="info-table">
                                    <tr>
                                        <td>Nama :</td>
                                        <td>{{ $key->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIS :</td>
                                        <td>{{ $key->NIS }}</td>
                                    </tr>
                                    <tr>
                                        <td>lokasi :</td>
                                        <td>{{ $key->lokasi }}</td>
                                    </tr>
                                    <tr>
                                        <td>tanggal :</td>
                                        <td>{{ $key->tanggal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori :</td>
                                        <td>{{ $key->Kategori->nama_kategori }}</td>
                                    </tr>
                                    <tr>
                                        <td>Isi :</td>
                                        <td>{!! $key->Keterangan !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Status :</td>
                                        <td>
                                            @if ($item->status == 'Menunggu')
                                                <p class="badge badge-danger">Menunggu</p>
                                            @elseif ($item->status == 'Proses')
                                                <p class="badge badge-warning">Proses</p>
                                            @elseif ($item->status == 'Selesai')
                                                <p class="badge badge-success">Selesai</p>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Gambar :</td>
                                        <td>
                                            <img src="{{ asset('images/pengaduan/' . $key->gambar) }}"
                                                alt="Gambar Pengaduan" style="height: 100px;">
                                    </tr>
                                </table>
                                <div class="modal-footer">
                                @if ($foundReply)
                                    <!-- Display something when a response is found -->
                                    <p>Response Found!</p>
                                @else
                                    <!-- Display something when no response is found -->
                                    <p>No Response Yet</p>
                                @endif
                            </div>
                    `;

                        Swal.fire({
                            title: "Detail",
                            html: modalContent,
                            icon: "info",
                            button: "OK"
                        });
                    });
                });
            });
        </script>
    @endforeach
    <script>
        //balas
        document.addEventListener('DOMContentLoaded', function() {
            const balasButtons = document.querySelectorAll('.balas-button');

            balasButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = button.id.replace('balasButton', '');

                    const modalBalas = `                    
                        <form id="tanggapanForm" action="/pengaduan/${itemId}/tanggapan" method="post">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" rows="4" name="isi" placeholder="Tuliskan Isi Tanggapan" required></textarea>
                            </div>
                        </form>
                `;

                    Swal.fire({
                        title: 'Balas',
                        html: modalBalas,
                        showCancelButton: true,
                        confirmButtonText: 'Kirim Tanggapan',
                        cancelButtonText: 'Batal',
                        allowOutsideClick: false,
                        preConfirm: () => {
                            const form = document.getElementById('tanggapanForm');
                            form.submit();
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Check if the form submission was successful
                            // You may need to adjust this based on the response from your server
                            Swal.fire({
                                title: 'Tanggapan terkirim!',
                                icon: 'success'
                            });
                        }
                    });
                });
            });
        });
        //delete
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-button');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const itemId = button.getAttribute('data-item-id');

                    Swal.fire({
                        title: 'Yakin ingin menghapus data?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const form = document.createElement('form');
                            form.action = "{{ route('pengaduan.destroy', ':id') }}"
                                .replace(':id', itemId);
                            form.method = 'POST';
                            form.innerHTML = `@csrf @method('DELETE')`;
                            document.body.appendChild(form);
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>

    <style>
        .info-table {
            width: 100%;
            /* Set the table width */
            border-collapse: collapse;
            /* Remove default spacing between table cells */
        }

        .info-table tr {
            border-bottom: 1px solid #ddd;
            /* Add a bottom border to separate rows */
        }

        .info-table td {
            padding: 10px;
            /* Adjust cell padding */
        }
    </style>
@endsection
