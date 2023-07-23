<x-cms-master>

    <x-breadcrumb :title="$pageTitle" :method="''" :maintitleroute="'questionnaire.index'" :maintitle="'Car'" :item="'3'"/>

    <x-error />
    <x-success />

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex flex-wrap align-items-center">
                        <h4 class="card-title">{{$pageTitle}} : {{ $questionnaire->title }}</h4>
                    </div>
                    <div class="card-subtitle">
                        <p>Expiry Date: {{ $questionnaire->expiry_date->format('Y-m-d') }}</p>
                    </div>
                </div>
                <div class="card-body">
                    <p>Your score: {{ $score }}</p>
                </div>
            </div>
        </div>
    </div>

</x-cms-master>
