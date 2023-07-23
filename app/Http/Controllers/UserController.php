<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
    * UserController constructor.
    *
    * @param UserService $userService
    */
    public function __construct(
        protected UserService $userService
    ) {
        $this->setPageTitle('User', null);
    }

    /**
     * Display a listing of the user.
     *
     * @return mixed
     */
    public function index(): mixed
    {
        return (request()->ajax())
            ? $this->userService->getUser()
            : view('user.index');
    }

    /**
     * Show the form for creating a new user.
     *
     * @return View
     */
    public function create(): View
    {
        return view('user.create', [
            'roles' => Role::get()->sortBy('name')
        ]);
    }

    /**
     * Store a newly created user in database.
     *
     * @param UserRequest $request
     *
     * @return RedirectResponse
     */
    public function store(UserRequest $request): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->userService->storeUser($data);
        } catch (\Throwable $th) {
            return $this->responseRedirectBack(
                message: 'Some problem occured while saving user.',
                type: 'error',
                error: true,
                withOldInputWhenError: true
            );
        }

        return $this->responseRedirect('user.index', 'User created successfully', 'success');
    }

    /**
     * Display the specified user.
     *
     * @param string $id
     *
     * @return View
     */
    public function edit(string $id): View
    {
        $user = $this->userService->showUser($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified user in database.
     *
     * @param UserRequest $request
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function update(UserRequest $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validated();
            $this->userService->updateUser($data, $id);
        } catch (\Throwable $th) {
            return $this->responseRedirectBack(
                message: 'Some problem occured while updating user.',
                type: 'error',
                error: true,
                withOldInputWhenError: true
            );
        }

        return $this->responseRedirect('user.index', 'User updated successfully.', 'success');
    }

    /**
     * Remove the specified user from database.
     *
     * @param string $id
     *
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->userService->deleteUser($id);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'There was some issue with the server. Please try again.']);
        }
        return response()->json(['success' => 'User Successfully Deleted.']);
    }
}
