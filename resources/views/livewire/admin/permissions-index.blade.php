<div class="p-6 bg-white rounded shadow">
    <h2 class="text-xl font-bold mb-4">Gestion des Permissions</h2>

    <div class="mb-4 flex justify-between items-center">
        <input type="text" wire:model="search" placeholder="Rechercher..."
               class="border rounded px-3 py-2 w-1/3">
        <button wire:click="createPermission" class="bg-blue-500 text-white px-4 py-2 rounded">
            Ajouter Permission
        </button>
    </div>

    <table class="min-w-full border">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left">Nom</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $permission->name }}</td>
                    <td class="px-4 py-2 text-center">
                        <button wire:click="editPermission({{ $permission->id }})"
                                class="bg-yellow-500 text-white px-2 py-1 rounded">Modifier</button>
                        <button wire:click="deletePermission({{ $permission->id }})"
                                class="bg-red-500 text-white px-2 py-1 rounded">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $permissions->links() }}
    </div>
</div>
  
