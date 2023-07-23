<?php

namespace App\Services;

use App\Enums\SubjectTypeEnum;
use App\Jobs\SendQuestionnaireInvitationsJob;
use App\Models\Question;
use App\Models\QuizResult;
use App\Repositories\Contracts\QuestionnaireRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class QuestionnaireService
{
    /**
    * QuestionnaireService constructor.
    *
    * @param QuestionnaireRepositoryInterface $questionnaireRepositoryInterface
    */
    public function __construct(
        protected QuestionnaireRepositoryInterface $questionnaireRepositoryInterface
    ) {
    }

    /**
     * Yajra datatable response for admin questionnaire
     *
     * @return JsonResponse
     */
    public function getQuestionnaire(): JsonResponse
    {
        $data = $this->questionnaireRepositoryInterface->fetchAll();

        return DataTables::of($data)
            ->editColumn('expiry_date', function ($data) {
                return '
                    <div>
                        <p class="text-muted mb-0 font-size-10">' . $data->expiry_date->format('Y-m-d') . '</p>
                    </div>
                ';
            })
            ->editColumn('created_at', function ($data) {
                return '
                    <div>
                        <p class="text-muted mb-0 font-size-10">' . $data->created_at->diffForHumans() . '</p>
                    </div>
                ';
            })
            ->addColumn('actions', function ($data) {

                    return '
                        <div class="d-flex flex-wrap gap-2">
                            <a
                                 href="' . route('questionnaire.show', $data->id) . '"
                                type="button"
                                class="btn btn-primary waves-effect waves-light btn-md"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Show Car Model"
                                data-bs-original-title="Show Car Model"
                            ><i class="bx bxs-show font-size-16 align-middle"></i></a>

                            <a
                                 href="' . route('questionnaire.edit', $data) . '"
                                type="button"
                                class="btn btn-success waves-effect waves-light btn-md"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Edit"
                                data-bs-original-title="Edit"
                            ><i class="bx bx-pencil font-size-16 align-middle"></i></a>

                            <a
                                href="#"
                                id="delete-btn"
                                data-id="' . $data->id . '"
                                type="button"
                                class="btn btn-danger waves-effect waves-light btn-md"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Delete"
                                data-bs-original-title="Delete"
                            ><i class="bx bx-trash font-size-16 align-middle"></i></a>
                        </div>
                    ';
                
            })
            ->addIndexColumn()
            ->rawColumns(['expiry_date', 'created_at', 'actions'])
            ->make(true);
    }

    /**
     * Yajra datatable response for student questionnaire
     *
     * @return JsonResponse
     */
    public function listQuestionnaireForList(): JsonResponse
    {
        $data = $this->questionnaireRepositoryInterface->fetchAll();

        return DataTables::of($data)
            ->editColumn('expiry_date', function ($data) {
                return '
                    <div>
                        <p class="text-muted mb-0 font-size-10">' . $data->expiry_date->format('Y-m-d') . '</p>
                    </div>
                ';
            })
            ->editColumn('created_at', function ($data) {
                return '
                    <div>
                        <p class="text-muted mb-0 font-size-10">' . $data->created_at->diffForHumans() . '</p>
                    </div>
                ';
            })
            ->addColumn('actions', function ($data) {

                    return '
                        <div class="d-flex flex-wrap gap-2">
                            <a
                                href="' . route('questionnaire.start', $data->id) . '"
                                type="button"
                                class="btn btn-primary waves-effect waves-light btn-md"
                                data-bs-toggle="tooltip"
                                data-bs-placement="top"
                                title="Play Quiz"
                                data-bs-original-title="Play Quiz"
                            ><i class="bx bx-play font-size-16 align-middle"></i></a>
                        </div>
                    ';
                
            })
            ->addIndexColumn()
            ->rawColumns(['expiry_date', 'created_at', 'actions'])
            ->make(true);
    }

    /**
     * Store questionnaire
     *
     * @param array $data
     *
     * @return void
     */
    public function storeQuestionnaire(array $data): void
    {
        $questionnaire = $this->questionnaireRepositoryInterface->store($data);

        $physicsQuestions = $this->getRandomQuestions(SubjectTypeEnum::PHYSICS->value, 5);
        $this->questionnaireRepositoryInterface->sync(
            $questionnaire,
            "questions",
            $physicsQuestions,
            false
        );

        $chemistryQuestions = $this->getRandomQuestions(SubjectTypeEnum::CHEMISTRY->value, 5);
        $this->questionnaireRepositoryInterface->sync(
            $questionnaire,
            "questions",
            $chemistryQuestions,
            false
        );

        SendQuestionnaireInvitationsJob::dispatch($questionnaire);
    }

    /**
     * Show single questionnaire
     *
     * @param string $id
     *
     * @return object
     */
    public function showQuestionnaire(string $id): object
    {
        return $this->questionnaireRepositoryInterface->fetch($id, ['questions']);
    }

    /**
     * Show single questionnaire by token passed in email
     *
     * @param string $id
     * @param string $token
     *
     * @return object
     */
    public function showQuestionnaireByToken(string $id, string $token): object
    {
        return $this->questionnaireRepositoryInterface->fetchByToken($id, $token, ['questions']);
    }

    /**
     * Update questionnaire
     *
     * @param array $data
     * @param string $id
     *
     * @return void
     */
    public function updateQuestionnaire(array $data, string $id): void
    {
        $this->questionnaireRepositoryInterface->update( $data, $id);
    }

    /**
     * Delete Questionnaire
     *
     * @param string $id
     *
     * @return object
     */
    public function deleteQuestionnaire(string $id): object
    {
        return $this->questionnaireRepositoryInterface->delete($id);
    }

    /**
     * Store quiz result
     *
     * @param string $id
     * @param array $data
     *
     * @return array
     */
    public function quizResult(string $id, array $data = []): array
    {
        $questionnaire = $this->showQuestionnaire($id);
        $questions = $questionnaire->questions;
        $userAnswers = $data;
        $score = 0;
        foreach ($questions as $question) {
            if (isset($userAnswers[$question->id]) && $userAnswers[$question->id] === $question->answer) {
                $score++;
            }
        }

        return [
                'score' => $score,
                'questionnaire' => $questionnaire
            ];
    }

    /**
     * Get Random questions
     *
     * @param string $subject
     * @param int $count
     *
     * @return mixed
     */
    private function getRandomQuestions(string $subject, int $count): mixed
    {
        $questions = Question::where('subject', $subject)->inRandomOrder()->take($count)->pluck("id");
        return $questions->toArray();
    }
}
