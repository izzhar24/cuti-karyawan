@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Daftar Pegawai</h3>
            <a href="{{ route('employees.create') }}" class="btn btn-primary mb-2">
                <span class="fa fa-add"></span>
                Tambah Pegawai
            </a>

            <div class="table-responsive">
                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">No HP</th>
                            <th scope="col" style="width:20%">Alamat</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Cuti Diambil</th>
                            <th scope="col">Sisa Cuti</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $e)
                            <tr>
                                <td>{{ $e->first_name }} {{ $e->last_name }}</td>
                                <td>{{ $e->email }}</td>
                                <td>{{ $e->phone }}</td>
                                <td>{{ $e->address }}</td>
                                <td>{{ ucfirst($e->gender == 'L' ? 'Laki- Laki' : 'Perempuan') }}</td>
                                <td>{{ $e->leaves->count() }}</td>
                                <td>{{ 12 - (int) $e->leaves->count() }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $e->id) }}" class="btn btn-sm btn-warning">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <form action="{{ route('employees.destroy', $e->id) }}" method="POST"
                                        style="display:inline-block">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-name="{{ $e->first_name }}">
                                            <span class="fa fa-trash"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const form = this.closest('form');
                    const name = this.dataset.name;

                    Swal.fire({
                        title: 'Yakin ingin menghapus?',
                        text: `Data ${name} akan dihapus permanen!`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
