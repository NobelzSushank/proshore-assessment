@props([
    'col' => '12',
    'name' => 'Default',
    'label' => 'Default',
    'placeholder' => 'Default',
    'required' => false,
    'value' => null,
    'editor' => true,
    'cols' => 30,
    'rows' => 10,
    'unicode' => false,
    'id' => null,
])


<div class="col-lg-{{$col}}">
    <div class="mb-3">
        <label for="{{$name}}">{{$label}} <small><code>{{$required == true ? '[Required]' : ''}}</code></small></label>
        <textarea 
            id="{{$id ?? $name}}" 
            name="{{$name}}" 
            cols="{{$cols}}" 
            rows="{{$rows}}" 
            placeholder="{{$placeholder}}" 
            {{ $attributes->class(['form-control', 'summernote' =>  $editor, 'unicode' => $unicode, 'is-invalid' =>  $errors->has($name)]) }}
            {{$attributes->get('inputAttribute')}}
        >{!! old($name, $value) !!}</textarea>
        @error($name)<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
</div>
