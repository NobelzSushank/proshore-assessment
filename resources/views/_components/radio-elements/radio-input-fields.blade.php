@props([
    'name' => 'Default',
    'id' => 'Default',
    'checked' => FALSE,
    'label' => 'Default',
    'value' => 'Default',
    'inline' => FALSE,
    'selected' => NULL
])
<div {{$attributes->merge(['class' => "form-check"])}} @if( $inline==true ) style="display: inline-block;margin-right: 10px;" @endif>
    <input class="form-check-input" type="radio" name="{{$name}}" id="{{$id}}" value="{{ $value }}" @if($value == $selected) checked @endif >
    <label class="form-check-label" for="{{ $id }}">
        {{ $label }}
    </label>
</div>