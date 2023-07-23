<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionnaireRequest;
use App\Models\Questionnaire;
use App\Services\QuestionnaireService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionnaireController extends Controller
{
    /**
    * QuestionnaireController constructor.
    *
    * @param QuestionnaireService $questionnaireService
    */
    public function __construct(
        protected QuestionnaireService $questionnaireService
    ) {
        $this->setPageTitle('Questionnaire', '');
    }

    /**
     * Display a listing of the questionnaire.
     *
     * @return mixed
     */
    public function index(): mixed
    {
        return (request()->ajax())
            ? $this->questionnaireService->getQuestionnaire()
            : view('questionnaire.index');
    }

    /**
     * Show the form for creating a new questionnaire.
     *
     * @return View
     */
    public function create(): View
    {
        return view('questionnaire.create');
    }

    /**
     * Store a newly created questionnaire in database.
     *
     * @param QuestionnaireRequest $request
     *
     * @return RedirectResponse
     */
    public function store(QuestionnaireRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $this->questionnaireService->storeQuestionnaire($data);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->responseRedirectBack(
                message: $th->getMessage(),
                type: 'error',
                error: true,
                withOldInputWhenError: true
            );
        }

        DB::commit();
        return $this->responseRedirect('questionnaire.index', 'Questionnaire Created Successfully.', 'success');
    }

    /**
     * Display the specified questionnaire.
     *
     * @param string $id
     *
     */
    public function show(string $id)
    {
        $questionnaire = $this->questionnaireService->showQuestionnaire($id);
        return view('questionnaire.show', compact('questionnaire'));
    }

    /**
     * Show the form for editing the specified questionnaire.
     *
     * @param string $id
     *
     * @return View
     */
    public function edit(string $id): View
    {
        $questionnaire = $this->questionnaireService->showQuestionnaire($id);
        return view('questionnaire.edit', compact('questionnaire'));
    }

    /**
     * Update the specified questionnaire in database.
     *
     * @param QuestionnaireRequest $request
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function update(QuestionnaireRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();
        $this->questionnaireService->updateQuestionnaire($data, $id);
        return $this->responseRedirect('questionnaire.index', 'Questionnaire Updated Successfully.', 'success');
    }

    /**
     * Remove the specified questionnaire from database.
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->questionnaireService->deleteQuestionnaire($id);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'There was some issue with the server. Please try again.']);
        }
        return response()->json(['success' => 'Questionnaire Successfully Deleted.']);
    }

    /**
     * Listing questionnaire for students
     */
    public function listQuestionnaireForQuiz()
    {
        return (request()->ajax())
            ? $this->questionnaireService->listQuestionnaireForList()
            : view('questionnaire.questionnaire_list');
    }

    /**
     * Showing questionnaire questions to play quiz
     *
     * @param string $id
     *
     * @return View
     */
    public function startQuiz(string $id): View
    {
        $questionnaire = $this->questionnaireService->showQuestionnaire($id);
        return view('questionnaire.quiz', compact('questionnaire'));
    }

    /**
     * Submitting quiz answers
     *
     * @param Request $request
     * @param string $id
     *
     * @return View
     */
    public function submitQuiz(Request $request, string $id): View
    {
        $answers = $request->answers ?? [];
        $quizResult = $this->questionnaireService->quizResult($id, $answers);

        return view('questionnaire.quiz_result', $quizResult);
    }

    /**
     * Showing questionnaire questions to play quiz by using token
     *
     * @param string $questionnaireId
     * @param string $token
     *
     * @return View
     */
    public function startQuizByInvitationLink(string $questionnaireId, string $token): View
    {
        $questionnaire = $this->questionnaireService->showQuestionnaireByToken($questionnaireId, $token);
        return view('questionnaire.quiz_invitations', compact('questionnaire'));
    }

    /**
     * Submitting invitation quiz answers
     *
     * @param Request $request
     * @param string $id
     *
     * @return View
     */
    public function submitQuizByInvitationLink(Request $request, string $id): View
    {
        $answers = $request->answers ?? [];
        $quizResult = $this->questionnaireService->quizResult($id, $answers);

        return view('questionnaire.quiz_invitation_result', $quizResult);
    }
}
