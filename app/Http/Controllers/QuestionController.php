<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Services\QuestionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class QuestionController extends Controller
{
    /**
    * QuestionController constructor.
    *
    * @param QuestionService $questionService
    */
    public function __construct(
        protected QuestionService $questionService
    ) {
        $this->setPageTitle('Question', null);
    }

    /**
     * Display a listing of the question.
     *
     * @return mixed
     */
    public function index(): mixed
    {
        return (request()->ajax())
            ? $this->questionService->getQuestion()
            : view('question.index');
    }

    /**
     * Show the form for creating a new question.
     *
     * @return View
     */
    public function create(): View
    {
        return view('question.create');
    }

    /**
     * Store a newly created question in database.
     *
     * @param QuestionRequest $request
     *
     * @return RedirectResponse
     */
    public function store(QuestionRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->questionService->storeQuestion($data);
        } catch (\Throwable $th) {
            return $this->responseRedirectBack(
                message: 'Some problem occured while saving question.',
                type: 'error',
                error: true,
                withOldInputWhenError: true
            );
        }

        return $this->responseRedirect('question.index', 'Question created successfully', 'success');
    }

    /**
     * Display the specified question.
     *
     * @param string $id
     *
     * @return View
     */
    public function edit(string $id): View
    {
        $question = $this->questionService->showQuestion($id);
        return view('question.edit', compact('question'));
    }

    /**
     * Update the specified question in database.
     *
     * @param QuestionRequest $request
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function update(QuestionRequest $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->questionService->updateQuestion($data, $id);
        } catch (\Throwable $th) {
            return $this->responseRedirectBack(
                message: 'Some problem occured while updating question.',
                type: 'error',
                error: true,
                withOldInputWhenError: true
            );
        }

        return $this->responseRedirect('question.index', 'Question updated successfully.', 'success');
    }

    /**
     * Remove the specified question from database.
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->questionService->deleteQuestion($id);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'There was some issue with the server. Please try again.']);
        }
        return response()->json(['success' => 'Question Successfully Deleted.']);
    }
}
