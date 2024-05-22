<div class="form-check mb-4">
    <input {{ $disabled ? 'disabled' : '' }} type="checkbox" class="form-check-input @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" {{ old($name, $checked) ? 'checked' : '' }}>
    <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    <x-input-error :field="$name" />
</div>
