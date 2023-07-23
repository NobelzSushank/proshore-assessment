@props([
    'type' => 'text',
    'col' => '12',
    'name' => 'Default',
    'label' => 'Default',
    'placeholder' => 'Select Parent Category',
    'required' => false,
    'values' => [],
    'selected' => null,
    'multiple' => false,
    'title' => 'name',
    'val_id' =>'id',
    'id' => 'Default',
])

<div class="col-lg-{{$col}}">
    <div class="mb-3">
        <label for="{{$name}}">{{$label}} <small><code>{{$required == true ? '[Required]' : ''}}</code></small></label>
        <select
            {{$attributes->get('inputAttribute')}}
            {{ $attributes->class(['form-control', 'is-invalid' =>  $errors->has($name)]) }}
            data-trigger
            name="{{$name}}"
            id="{{$id}}"
            data-placeholder="{{$placeholder}}"
            {{$required ? 'required' : ''}}
            {{$multiple ? 'multiple' : ''}}
            
        >
            <option value data-choices-placeholder>{{$placeholder}}</option>
            {{$slot}}
            @if(count($values) > 0)
            @foreach($values as $value)
                <option
                    value="{{$value->$val_id}}"
                    @if($value->$val_id == $selected) selected @endif
                >{{$value->$title}}</option>
            @endforeach
            @endif
        </select>
        @error($name)
        <div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
</div>
