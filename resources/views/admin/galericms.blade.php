@extends('layout.admin')
@section('title', 'Galeri')

@section('content')

    <div class="container">
        <button type="button" id="tambahButton" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#tambahModal">
            Tambah Gambar
        </button>
        <div class="table-responsive">

            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Image</th>
                        <th>Caption</th>
                        <th>Status</th>
                        <th colspan="2" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($galeri->count())
                        @foreach ($galeri as $item)
                            <tr>
                                <td class="col-md-2">{{ $item->nama }}</td>
                                <td class="col-md-8">
                                    <img src="{{ asset('images/galeri/' . $item->gambar) }}" alt=""
                                        class="img-fluid" style="display: block; margin: 0 auto; width: 80%; height: 80%;">
                                </td>
                                <td class="col-md-2">{{ $item->text }}</td>
                                <td>
                                    @if ($item->active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" id="editButton{{ $item->id }}" class="btn btn-warning"
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        Edit </button>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-button"
                                        data-item-id="{{ $item->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center fs-4">Gambar Tidak Ditemukan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Gambar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-xmark"></i></button>
                </div>
                <hr>
                <form action="{{ route('galericms.store') }}" class="form-horizontal" role="form" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama" class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                </div>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama"
                                    value="" required>
                            </div>
                            @error('nama')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="gambar" class="col-sm-3 control-label"> Gambar</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="gambar">
                            @error('gambar')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="text" class="col-sm-3 control-label"> Text (caption)</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <textarea class="form-control" rows="4" name="text" placeholder="Tuliskan caption" required></textarea>
                            </div>
                            @error('text')
                                <small style="color: red">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-3">
                            <input id="submit" name="submit" type="submit" value="Tambah" class="btn btn-primary">
                        </div>
                    </div>
                    <hr>
                </form>
            </div>
        </div>
    </div>

    @foreach ($galeri as $key)
        <div class="modal fade" id="editModal{{ $key->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Gambar</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                class="fa-solid fa-xmark"></i></button>
                    </div>
                    <hr>
                    <form action="{{ route('galericms.update', ['id' => $key->id]) }}" class="form-horizontal"
                        role="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span>
                                    </div>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama" value="{{ $key->nama }}" required>
                                </div>
                                @error('nama')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gambar" class="col-sm-3 control-label"> Gambar</label>
                            <div class="col-sm-9">
                                <img src="{{ asset('images/galeri/' . $key->gambar) }}" alt="" class="img-fluid"
                                    style="display: block; margin: 0 auto; width: 80%; height: 80%;">
                                <input type="file" class="form-control" name="gambar">
                                @error('gambar')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text" class="col-sm-3 control-label"> Text (caption)</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <textarea class="form-control" rows="4" name="text" placeholder="Tuliskan caption" required>{{ $key->text }}</textarea>
                                </div>
                                @error('text')
                                    <small style="color: red">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <label for="active">Image Status</label>
                        <div class="form-check">
                            <input type="hidden" name="active" value="0">
                            <input type="checkbox" class="form-check-input" name="active" id="active"
                                {{ $key->active ? 'checked' : '' }} value="1">
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-3">
                                <input id="submit" name="submit" type="submit" value="Edit"
                                    class="btn btn-primary">
                            </div>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    <script>
        const editModal = document.querySelectorAll('[id^="editModal"]');

        document.querySelectorAll('[id^="editButton"]').forEach((button, index) => {
            button.addEventListener('click', () => {
                const balasModal = new bootstrap.Modal(editModals[index]);
                editModal.show();
            });
        });


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
                            form.action = "{{ route('galericms.destroy', ':id') }}"
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

    <script>
        // Check if the success_message session variable is present
        @if (session('success_message'))
            // Show SweetAlert notification on page load
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success_message') }}',
            });
        @endif
    </script>

@endsection
