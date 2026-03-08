<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionsIndex extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $permissions = Permission::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.permissions-index', [
            'permissions' => $permissions
        ]);
    }

    public function createPermission()
    {
        $this->emit('openPermissionModal');
    }

    public function editPermission($id)
    {
        $this->emit('editPermission', $id);
    }

    public function deletePermission($id)
    {
        Permission::find($id)?->delete();
        session()->flash('message', 'Permission supprimée avec succès.');
    }
}
