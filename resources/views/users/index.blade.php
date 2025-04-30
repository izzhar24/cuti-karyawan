@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Daftar Admin</h2>
            <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
                <span class="fa fa-add"></span>
                Tambah Admin
            </a>

            <div class="table-responsive">
                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->birth_date }}</td>
                                <td>{{ ucfirst($user->gender == 'L' ? 'Laki- Laki' : 'Perempuan') }}</td>
                                <td>
                                    <a type="button" href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-name="{{ $user->first_name }}">
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
