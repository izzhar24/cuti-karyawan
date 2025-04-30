@props([
    'name' => 'phone',
    'label' => 'No HP',
    'value' => '',
    'required' => false,
])

<div class="form-group">
    @if ($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif

    <input type="tel" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }} inputmode="tel" pattern="^(\+62|62|0)8[1-9][0-9]{6,9}$"
        placeholder="Contoh: 081234567890"
        {{ $attributes->merge(['class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')]) }}>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

@once
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInputs = document.querySelectorAll('input[type=tel]');
            phoneInputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    let val = input.value.replace(/[^0-9]/g, '');

                    // Format agar nomor dimulai dengan +62
                    if (val.startsWith('0')) {
                        val = '+62' + val.substring(1);
                    } else if (val.startsWith('62')) {
                        val = '+' + val;
                    } else if (!val.startsWith('+62')) {
                        val = '+62' + val;
                    }

                    input.value = val;
                });
            });
        });
    </script>
@endonce
