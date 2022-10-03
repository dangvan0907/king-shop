<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        $roles = $this->roleService->search($request);
        return view('admin.roles.index', compact('roles'));
    }

    public function show($id)
    {
        $role = $this->getById($id);
        return view('admin.roles.show', compact('role'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(RoleCreateRequest $request)
    {
        $this->roleService->create($request);
        return redirect(route('roles.index'))->with('message', 'Create success!');
    }

    public function edit($id)
    {
        $role = $this->getById($id);
        return view('admin.roles.edit', compact('role'));
    }

    public function update(RoleUpdateRequest $request, $id)
    {
        $role = $this->roleService->update($request, $id);
        $role->update($request->all());
        return redirect(route('roles.index'))->with('message', 'Update success!');
    }

    public function destroy($id)
    {
        $this->roleService->destroy($id);
        return redirect(route('roles.index'))->with('message', 'Delete success!');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->roleService->findById($id);
    }
}
