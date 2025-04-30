@props([
    'name' => 'password',
    'label' => 'Password',
    'required' => false,
])

<div class="form-group position-relative">
    <label for="{{ $name }}">{{ $label }}</label>
    <div class="input-group">
        <input type="password" name="{{ $name }}" id="{{ $name }}" {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}>
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-secondary toggle-password" tabindex="-1">
                <i class="fa fa-eye"></i>
            </button>
        </div>
    </div>
    @error($name)
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>



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
