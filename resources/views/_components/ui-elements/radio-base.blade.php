@props([
    'title' => 'Form Radios',
    'col' => '12',
    'required' => false,
])
<div {{$attributes->merge(['class' => "col-md-{$col}"])}}>
    <div>
        <h5 class="font-size-14 mb-4" {{$attributes->get('radioTitleAttribute')}} >{{ $title }} <small><code>{{$required == true ? '[Required]' : ''}}</code></small></h5>

        {{ $slot }}

    </div>
</div>