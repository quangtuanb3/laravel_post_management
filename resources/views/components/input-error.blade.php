@if ($errors->has($field))
    <div class="text-red-600 mt-1 text-sm" style="color: red">
        {{ $errors->first($field) }}
    </div>
@endif
