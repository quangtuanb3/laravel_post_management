
<div class="form-outline mb-4 form-group col-{{ $col }}">
    <label class="form-label fw-bold" for="{{ $field }}">{{ ucfirst($label) }}</label>
    <input {{ $disabled ? 'disabled' : '' }} type="{{ $type }}" id="{{ $field }}" name="{{ $field }}"
        value="{{ old($field, $value) }}" class="form-control @error($field) is-invalid @enderror" />
    <x-input-error :field="$field" />
</div>
