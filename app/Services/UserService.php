<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserService
{
    /**
    * QuestionService constructor.
    *
    * @param UserRepositoryInterface $userRepositoryInterface
    */
    public function __construct(
        protected UserRepositoryInterface $userRepositoryInterface
    ) {
    }

    /**
     * Yajra datatable response for user
     *
     * @return JsonResponse
     */
    public function getUser(): JsonResponse
    {
        $data = $this->userRepositoryInterface->fetchAll(['role']);

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
                                 href="' . route('user.edit', $data) . '"
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
     * Store User
     *
     * @param array $data
     *
     * @return void
     */
    public function storeUser(array $data): void
    {
        $this->userRepositoryInterface->store($data);
    }

    /**
     * Show user
     *
     * @param string $id
     *
     * @return object
     */
    public function showUser(string $id): object
    {
        return $this->userRepositoryInterface->fetch($id);
    }

    /**
     * Update User
     *
     * @param array $data
     * @param string $id
     *
     * @return void
     */
    public function updateUser(array $data, string $id): void
    {
        if (is_null($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }
        $this->userRepositoryInterface->update($data, $id);
    }

    /**
     * Delete User
     *
     * @param string $id
     *
     * @return object
     */
    public function deleteUser(string $id): object
    {
        return $this->userRepositoryInterface->delete($id);
    }
}