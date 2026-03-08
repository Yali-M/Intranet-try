<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RolesIndex extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $roles = Role::query()
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy('name')
            ->paginate(10);

        return view('livewire.admin.roles-index', [
            'roles' => $roles
        ]);
    }

    public function createRole()
    {
        $this->emit('openRoleModal');
    }

    public function editRole($id)
    {
        $this->emit('editRole', $id);
    }

    public function deleteRole($id)
    {
        Role::find($id)?->delete();
        session()->flash('message', 'Rôle supprimé avec succès.');
    }
}
