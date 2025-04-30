@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit Profil</h2>

            <form action="{{ route('users.profile.update') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-4">
                        <x-form.input name="first_name" label="Nama Depan" :value="$user->first_name" />
                    </div>
                    <div class="form-group col-4">
                        <x-form.input name="last_name" label="Nama Belakang" :value="$user->last_name" />
                    </div>
                    <div class="form-group col-4">
                        <x-form.radio name="gender" label="Jenis Kelamin" :options="['L' => 'Laki-laki', 'P' => 'Perempuan']" :value="$user->gender" />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <x-form.input name="email" label="Email" :value="$user->email" />
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
                <button type="submit" class="btn btn-success">Ubah Profil</button>
            </form>
        </div>
    </div>
@endsection
