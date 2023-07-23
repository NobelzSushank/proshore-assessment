<?php

namespace App\Services;

use App\Repositories\Contracts\QuestionRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\DataTables;

class QuestionService
{
    /**
    * QuestionService constructor.
    *
    * @param QuestionRepositoryInterface $questionRepositoryInterface
    */
    public function __construct(
        protected QuestionRepositoryInterface $questionRepositoryInterface
    ) {
    }

    /**
     * Yajra datatable response for questions
     *
     * @return JsonResponse
     */
    public function getQuestion(): JsonResponse
    {
        $data = $this->questionRepositoryInterface->fetchAll();

        return DataTables::of($data)
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
                                 href="' . route('question.edit', $data) . '"
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
            ->rawColumns(['created_at', 'actions'])
            ->make(true);
    }

    /**
     * Store questions
     *
     * @param array $data
     *
     * @return void
     */
    public function storeQuestion(array $data): void
    {
        $this->questionRepositoryInterface->store($data);
    }

    /**
     * Show questions
     *
     * @param string $id
     *
     * @return object
     */
    public function showQuestion(string $id): object
    {
        return $this->questionRepositoryInterface->fetch($id);
    }

    /**
     * Update questions
     *
     * @param array $data
     * @param string $id
     *
     * @return void
     */
    public function updateQuestion(array $data, string $id): void
    {
        $this->questionRepositoryInterface->update($data, $id);
    }

    /**
     * Delete questions
     *
     * @param string $id
     *
     * @return object
     */
    public function deleteQuestion(string $id): object
    {
        return $this->questionRepositoryInterface->delete($id);
    }
}