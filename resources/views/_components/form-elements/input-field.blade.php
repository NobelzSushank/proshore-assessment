@props([
    'type' => 'text',
    'label' => 'Default',
    'name' => 'Default',
    'id' => 'Default',
    'placeholder' => 'Default',
    'col' => '12',
    'required' => false,
    'value' => null,
    'step' => 0,
    'autofocus' => false,
    'min' => null,
    'max' => null,
])

<div class="col-md-{{ $col }}">
    <div class="mb-3">
        <label for="{{$name}}" class="form-label">{{$label}} <small><code>{{$required == true ? '[Required]' : ''}}</code></small></label>
        <input
            {{ $attributes->class(['form-control', 'is-invalid' =>  $errors->has($name)]) }}
            type="{{$type}}"
            placeholder="{{$placeholder}}"
            id="{{$id}}"
            name="{{$name}}"
            @if($step != 0 && $type == 'number') step="{{$step}}" @endif
            @if($min != null && $type == 'number') min="{{$min}}" @endif
            @if($max != null && $type == 'number') max="{{$max}}" @endif
            @if(old($name, $value)) value="{{old($name, $value)}}" @endif
            {{$required == true ? 'required' : ''}}
            {{$autofocus == true ? 'autofocus' : ''}}
            {{$attributes->get('inputAttribute')}}
        >
        @error($name)
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
