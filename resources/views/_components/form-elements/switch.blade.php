@props([
    'type' => 'checkbox',
    'label' => 'switch3',
    'name' => 'Default',
    'col' => '12',
    'checked' => false,
    'required' => false,
    'value' => null,
])

<div {{$attributes->merge(['class' => "col-md-{$col}"])}}>
    <div class="mb-3">
        <label for="{{$name}}" class="form-label">{{$label}} <small><code>{{$required == true ? '[Required]' : ''}}</code></small></label>
        <br />
        <input
            class="form-check form-switch @error($name) is-invalid @enderror"
            type="{{$type}}"
            id="switch3"
            name="{{$name}}"
            switch="bool"
            {{$checked == true ? 'checked' : ''}}
        >
        <label for="switch3" data-on-label="Yes" data-off-label="No" class="form-label"></label>
    </div>
</div>
