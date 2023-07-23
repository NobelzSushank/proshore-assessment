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
                </div>
                <div class="card-body">
                    <form action="{{ route('questionnaire.submit', $questionnaire->id) }}" method="post">
                        @csrf
                        @foreach ($questionnaire->questions as $question)
                            <h3>{{ $question->question }}</h3>
                            
                                <label>
                                    <input type="radio" name="answers[{{ $question->id }}]" value="a">
                                    {{ $question->option_a }}
                                </label><br>

                                <label>
                                    <input type="radio" name="answers[{{ $question->id }}]" value="b">
                                    {{ $question->option_b }}
                                </label><br>

                                <label>
                                    <input type="radio" name="answers[{{ $question->id }}]" value="c">
                                    {{ $question->option_c }}
                                </label><br>

                                <label>
                                    <input type="radio" name="answers[{{ $question->id }}]" value="d">
                                    {{ $question->option_d }}
                                </label><br>
                            
                            <hr>
                        @endforeach
                        <button type="submit">Submit Quiz</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-cms-master>
