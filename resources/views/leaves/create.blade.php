@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Tambah Data Cuti Pegawai</h3>
            <form action="{{ route('leaves.store') }}" method="POST">
                @csrf<div class="form-row">
                    <div class="form-group col-4">
                        <x-form.select name="employee_id" label="Pilih Pegawai" :options="$employees" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <x-form.textarea name="reason" label="Alasan Cuti" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" name="start_date" class="form-control" required
                            value="{{ old('start_date') }}">
                    </div>
                    <div class="form-group col-4">
                        <label>Tanggal Selesai</label>
                        <input type="date" name="end_date" class="form-control" required value="{{ old('end_date') }}">
                    </div>
                </div>

                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="{{ route('leaves.index') }}" class="btn btn-danger">Kembali</a>
            </form>
        </div>
    </div>
@endsection
