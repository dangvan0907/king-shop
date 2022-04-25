<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;
    protected $roleService;

    public function __construct(UserService $userService,RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService=$roleService;
        VIew::share('roles',$this->roleService->getRoleWithOutSuperAdmin());
    }

    public function index()
    {
        $users = $this->userservice->get
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $this->user->create($request->all());
        return redirect(route('users.index'));
    }

    public function edit($id)
    {
        $user = $this->user->findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = $this->user->findOrFail($id);
        $user->update($request->all());
        return redirect(route('users.index'));
    }

    public function destroy($id)
    {
        $this->user->delete($id);
        return redirect(route('users.index'));
    }
}
