<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->search($request);
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->getById($id);
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserCreateRequest $request)
    {
        $this->userService->create($request);
        return redirect(route('users.index'))->with('message', 'Create success!');
    }

    public function edit($id)
    {
        $user = $this->getById($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $this->userService->update($request, $id);
        return redirect(route('users.index'))->with('message', 'Update success!');
    }

    public function destroy($id)
    {
        $this->userService->destroy($id);
        return redirect(route('users.index'))->with('message', 'Delete success!');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->userService->findById($id);
    }
}
