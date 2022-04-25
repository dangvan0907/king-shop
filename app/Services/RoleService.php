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

    public function count()
    {
        return $this->roleRepository->count();
    }

    public function search($request)
    {
        $dataSearch = $this->getDataSearch($request);
        return $this->roleRepository->search($dataSearch)->appends($request->all());
    }

    public function destroy($id)
    {
        return $this->roleRepository->delete($id);
    }

    public function create($request)
    {
        $dataCreate = $this->getDataCreate($request);
        $role = $this->roleRepository->create($dataCreate);
        $role->assignPermissions($dataCreate['permission_ids']);
        return $role;
    }

    public function update($request, $id)
    {
        $dataUpdate = $this->getDataUpdate($request);
        $role = $this->roleRepository->update($dataUpdate, $id);
        $role->syncPermissions($dataUpdate['permission_ids']);
        return $role;
    }

    public function findById($id)
    {
        return $this->roleRepository->find($id);
    }

    public function getAllRole()
    {
        return $this->roleRepository->all();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getDataSearch($request)
    {
        $dataSearch = $request->all();
        $dataSearch['display_name'] = $request->display_name ?? '';
        return $dataSearch;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getDataCreate($request)
    {
        $dataCreate = $request->all();
        $dataCreate['permission_ids'] = $request->permission_ids ?? [];
        return $dataCreate;
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getDataUpdate($request)
    {
        $dataUpdate = $request->all();
        $dataUpdate['permission_ids'] = $request->permission_ids ?? [];
        return $dataUpdate;
    }
}
