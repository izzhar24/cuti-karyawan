@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Tambah Admin</h2>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group col-4">
                        <x-form.input name="first_name" label="Nama Depan" />
                    </div>
                    <div class="form-group col-4">
                        <x-form.input name="last_name" label="Nama Belakang" />
                    </div>
                    <div class="form-group col-4">
                        <x-form.radio name="gender" label="Jenis Kelamin" :options="['L' => 'Laki-laki', 'P' => 'Perempuan']" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-6">
                        <x-form.input name="email" label="Email" />
                    </div>
                    <div class="form-group col-6">
                        <label for="birth_date">Tanggal Lahir</label>
                        <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date') }}">
                        @if ($errors->has('birth_date'))
                            <span class="text-danger">{{ $errors->first('birth_date') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-6">
                        <x-form.password name="password" label="Password" />
                    </div>
                    <div class="form-group col-6">
                        <x-form.password name="password_confirmation" label="Password" />
                    </div>
                </div>
                
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('users.index') }}" class="btn btn-danger">Kembali</a>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.closest('.input-group').querySelector('input');
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
        });
    </script>
@endpush
