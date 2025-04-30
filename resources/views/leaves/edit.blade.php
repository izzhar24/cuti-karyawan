@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Edit Data Cuti Pegawai</h3>
            <form action="{{ route('leaves.update', $leave->id) }}" method="POST">
                @csrf @method('PUT')
                @csrf<div class="form-row">
                    <div class="form-group col-4">
                        <x-form.select name="employee_id" label="Pilih Pegawai" :options="$employees" :value="$leave->employee->id"/>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <x-form.textarea name="reason" label="Alasan Cuti" :value="$leave->reason" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-4">
                        <x-form.input type="date" name="start_date" label="Tanggal Mulai" :value="$leave->start_date" />
                    </div>
                    <div class="form-group col-4">
                        <x-form.input type="date" name="end_date" label="Tanggal Selesai" :value="$leave->start_date" />
                    </div>
                </div>

                <button class="btn btn-success" type="submit">Simpan</button>
                <a href="{{ route('leaves.index') }}" class="btn btn-danger">Kembali</a>
            </form>
        </div>
    </div>
@endsection
