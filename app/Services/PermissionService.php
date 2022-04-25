<?php

namespace App\Services;



use App\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }
    public function search($request)
    {
        $dataSearch = $request->all();
        $dataSearch['role_ids'] = $request->name ?? '';
        return $this->roleRepository->search($dataSearch)->appends($request->all());
    }
    public function getAllRole(){
        return $this->roleRepository->all();
    }
}

