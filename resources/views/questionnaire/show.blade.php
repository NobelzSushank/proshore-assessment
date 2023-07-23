<x-cms-master>

    <x-breadcrumb :title="$pageTitle" :method="''" :maintitleroute="'questionnaire.index'" :maintitle="'Car'" :item="'3'"/>

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

                    <h2>Physics Questions:</h2>
                    <ul>
                        @foreach($questionnaire->questions as $question)
                            @if ($question->subject === 'physics')
                                <li>{{ $question->question }}</li>
                                <ol>
                                    <li>{{ $question->option_a }}</li>
                                    <li>{{ $question->option_b }}</li>
                                    <li>{{ $question->option_c }}</li>
                                    <li>{{ $question->option_d }}</li>
                                </ol>
                                <p><span class="h6">Answer:</span> Option {{ $question->answer }}</p>
                            @endif
                        @endforeach
                    </ul>

                    <h2>Chemistry Questions:</h2>
                    <ul>
                        @foreach($questionnaire->questions as $question)
                            @if ($question->subject === 'chemistry')
                                <li>{{ $question->question }}</li>
                                <ol>
                                    <li>{{ $question->option_a }}</li>
                                    <li>{{ $question->option_b }}</li>
                                    <li>{{ $question->option_c }}</li>
                                    <li>{{ $question->option_d }}</li>
                                </ol>
                                <p><span class="h6">Answer:</span> Option {{ $question->answer }}</p>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-cms-master>
