<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        $roles = $this->role->all();
        return view('admin.roles.index', compact('roles'));
    }

    public function show($id)
    {
        $role = $this->role->findOrFail($id);
        return view('admin.roles.show', compact('role'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $this->role->create($request->all());
        return redirect(route('roles.index'));
    }

    public function edit($id)
    {
        $role = $this->role->findOrFail($id);
        return view('admin.roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = $this->role->findOrFail($id);
        $role->update($request->all());
        return redirect(route('roles.index'));
    }

    public function destroy($id)
    {
        $this->role->delete($id);
        return redirect(route('roles.index'));
    }
}
