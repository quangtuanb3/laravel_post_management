<div class="form-check mb-4 {{ $class }}">
    @if ($label)
        <label class="fw-bold d-block">{{ $label }}</label>
    @endif
    <div class="{{ $subclass }}">
        @foreach ($options as $value => $label)
            <div class="form-check ">
                <input {{ $disabled ? 'disabled' : '' }} class="m-2" type="radio"
                    class="form-check-input @error($name) is-invalid @enderror"
                    id="{{ $name }}_{{ $value }}" name="{{ $name }}" value="{{ $value }}"
                    {{ old($name, $selected) == $value ? 'checked' : '' }}>
                <label class="form-check-label"
                    for="{{ $name }}_{{ $value }}">{{ $label }}</label>
            </div>
        @endforeach
    </div>

    <x-input-error :field="$name" />
</div>
