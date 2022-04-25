<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function count()
    {
        return $this->userRepository->count();
    }

    public function search($request)
    {
        $dataSearch = $this->getDataSearch($request);
        return $this->userRepository->search($dataSearch)->appends($request->all());
    }

    public function create($request)
    {
        $dataCreate = $this->getDataCreate($request);
        $user = $this->userRepository->create($dataCreate);
        $user->assignRoles($dataCreate['role_ids']);
        return $user;
    }

    public function findById($id)
    {
        return $this->userRepository->find($id);
    }

    public function update($request, $id)
    {
        $dataUpdate = $request->all();
        $user = $this->findById($id);
        $dataUpdate['role_ids'] = $request->role_ids ?? [];
        $user->update($dataUpdate);
        $user->syncRoles($dataUpdate['role_ids']);
        return $user;
    }

    public function destroy($id)
    {
        return $this->userRepository->delete($id);
    }

    public function getAllUser()
    {
        return $this->userRepository->all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getDataSearch($request)
    {
        $dataSearch = $request->all();
        $dataSearch['emailSearch'] = $request->email ?? '';
        $dataSearch['nameSearch'] = $request->name ?? '';
        $dataSearch['role_idSearch'] = $request->role_id != '0' ? $request->role_id : '';
        return $dataSearch;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getDataCreate($request)
    {
        $dataCreate = $request->all();
        $dataCreate['password'] = Hash::make($dataCreate['password']);
        $dataCreate['role_ids'] = $request->role_ids ?? '';
        return $dataCreate;
    }
}
