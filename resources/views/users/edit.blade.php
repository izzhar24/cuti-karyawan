@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit Admin</h2>

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf @method('PUT')

                
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
                    <div class="form-group col-6">
                        <label for="birth_date">Tanggal Lahir</label>
                        <input type="date" name="birth_date" class="form-control"
                            value="{{ old('birth_date', $user->birth_date) }}">
                        @if ($errors->has('birth_date'))
                            <span class="text-danger">{{ $errors->first('birth_date') }}</span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary toggle-password" tabindex="-1">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>

                    <div class="form-group col-6">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                autocomplete="new-password">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-outline-secondary toggle-password" tabindex="-1">
                                    <i class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        @if ($errors->has('password_confirmation'))
                            <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                        @endif
                    </div>

                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-danger">Kembali</a>
            </form>
        </div>
    </div>
@endsection
