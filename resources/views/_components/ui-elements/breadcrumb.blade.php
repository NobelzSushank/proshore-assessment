@props([
    'item' => 1,
    'title' => null,
    'maintitle' => null,
    'maintitleroute' => null,
    'method' => 'Create'
])

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{$method . ' ' . $title}}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @if($item == 1)
                        <li class="breadcrumb-item active">{{$title}}</li>
                    @endif

                    @if($item == 2)
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active">{{$title}}</li>
                    @endif

                    @if($item == 3)
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route($maintitleroute)}}">{{$maintitle}}</a></li>
                        <li class="breadcrumb-item active">{{$method . ' ' . $title}}</li>
                    @endif
                </ol>
            </div>

        </div>
    </div>
</div>
