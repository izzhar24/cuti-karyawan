@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Tambah Pegawai</h3>
            <form action="{{ route('employees.store') }}" method="POST">
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
                    <div class="form-group col-4">
                        <x-form.input name="email" label="Email" />
                    </div>
                    <div class="form-group col-4">
                        <x-form.phone name="phone" label="No HP" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-6">
                       <x-form.textarea name="address" label="Alamat" />
                    </div>
                </div>
                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="{{ route('employees.index') }}" class="btn btn-danger">Kembali</a>
            </form>
        </div>
    </div>
@endsection
