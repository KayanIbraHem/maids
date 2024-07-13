<?php

namespace App\Http\Services\Admin;

use App\Models\Admin\Admin;

class AdminService
{
    public function getAdmins()
    {
        return Admin::NotSuperAdmin()->paginate(5);
    }
    public function showAdmin(int $admin)
    {
        return $this->findAdminById($admin);
    }
    public function storeAdmin(object $data): Admin
    {
        return Admin::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => hashUserPassword($data->password),
            'image' => uploadImage($data, 'image', 'admins'),
            'type' => $data->type,
        ]);
    }
    public function updateAdmin(object $data, int $id): Admin
    {
        $admin = $this->findAdminById($id);
        $admin->update([
            'name' => $data->name,
            'email' => $data->email,
            'password' => hashUserPassword($data->password),
            'image' => updateImage($data, $admin, 'image', 'admins'),
            'type' => $data->type,
        ]);
        return $admin;
    }
    public function deleteAdmin($id): bool
    {
        $admin = $this->findAdminById($id);
        if (!$admin) {
            throw new \Exception('not_found');
        }
        if ($admin->image) {
            deleteImage($admin->image);
        }
        return $admin->delete();
    }
    private function findAdminById(int $row)
    {
        $admin = Admin::NotSuperAdmin()->whereId($row)->first();
        if (!$admin) {
            throw new \Exception('not_found.');
        }
        return $admin;
    }
}
