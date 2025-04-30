@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Edit Pegawai</h3>
            <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-row">
                    <div class="form-group col-4">
                        <x-form.input name="first_name" label="Nama Depan" :value="$employee->first_name" />
                    </div>
                    <div class="form-group col-4">
                        <x-form.input name="last_name" label="Nama Belakang" :value="$employee->last_name" />
                    </div>
                    <div class="form-group col-4">
                        <x-form.radio name="gender" label="Jenis Kelamin" :options="['L' => 'Laki-laki', 'P' => 'Perempuan']" :value="$employee->gender" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-4">
                        <x-form.input name="email" label="Email" :value="$employee->email" />
                    </div>
                    <div class="form-group col-4">
                        <x-form.phone name="phone" label="No HP" :value="$employee->phone" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-6">
                        <x-form.textarea name="address" label="Alamat" :value="$employee->address" />
                    </div>
                </div>
                <button class="btn btn-success">Update</button>
                <a href="{{ route('employees.index') }}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
