@extends('layout.admin')
@section('title', 'Tanggapan')

@section('content')

    <div class="container">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th class="col-3">ID Pengaduan</th>
                        <th class="col-3">Isi</th>
                        <th class="col-3">Tanggal</th>
                        <th class="col-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($tanggapan->count())
                        @foreach ($tanggapan as $item)
                            <tr>
                                <td class="col-3">{{ $item->pengaduan_id }}</td>
                                <td class="col-3">{{ $item->isi }}</td>
                                <td class="col-3">{{ $item->tanggal }}</td>
                                <td class="col-3">
                                    <button type="button" class="btn btn-danger delete-button"
                                        data-item-id="{{ $item->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="text-center fs-4">Data Tidak Ditemukan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
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
                            form.action = "{{ route('tanggapan.destroy', ':id') }}"
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


@endsection
