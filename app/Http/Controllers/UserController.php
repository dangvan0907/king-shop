<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->all();
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
        $this->user->update($request->all());
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
