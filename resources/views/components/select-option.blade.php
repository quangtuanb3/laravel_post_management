<div class="form-outline mb-4 {{ $class }}">
    @if ($label)
        <label class="form-label fw-bold" for="{{ $id }}">{{ $label }}</label>
    @endif

    <select {{ $disabled ? 'disabled' : '' }} id="{{ $id }}" name="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror">
        @foreach ($options as $value => $text)
            <option value="{{ $value }}" {{ $value == old($name, $selected) ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
    <x-input-error :field="$name" />
</div>
