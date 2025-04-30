@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Data Cuti Pegawai</h3>
            <a href="{{ route('leaves.create') }}" class="btn btn-primary mb-2">
                <span class="fa fa-add"></span>
                Tambah Cuti
            </a>

            <div class="table-responsive">
                <table class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Pegawai</th>
                            <th>Alasan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaves as $leave)
                            <tr>
                                <td>{{ $leave->employee->first_name }} {{ $leave->employee->last_name }}</td>
                                <td>{{ $leave->reason }}</td>
                                <td>{{ $leave->start_date }}</td>
                                <td>{{ $leave->end_date }}</td>

                                <td>
                                    <a type="button" href="{{ route('leaves.edit', $leave->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <span class="fa fa-pencil"></span>
                                    </a>
                                    <form action="{{ route('leaves.destroy', $leave->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger btn-delete"
                                            data-name="{{ $leave->employee->first_name }}">
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
