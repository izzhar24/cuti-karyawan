@props(['name', 'label' => '', 'options' => [], 'value'=> '', 'required' => false])

<div class="form-group">
    @if ($label)
        <label>{{ $label }}</label>
    @endif

    <div>
        @foreach ($options as $valueRadio => $optionLabel)
            <div class="form-check form-check-inline">
                <input class="form-check-input @error($name) is-invalid @enderror" type="radio"
                    name="{{ $name }}" id="{{ $name . '_' . $valueRadio }}" value="{{ $valueRadio }}"
                    {{ old($name, $value) == $valueRadio ? 'checked' : '' }} {{ $required ? 'required' : '' }}>
                <label class="form-check-label" for="{{ $name . '_' . $valueRadio }}">{{ $optionLabel }}</label>
            </div>
        @endforeach
    </div>

    @error($name)
        <span class="invalid-feedback d-block" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
