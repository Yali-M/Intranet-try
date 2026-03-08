namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Auth\KeycloakService;
use App\Models\User;

class SyncUsersFromKeycloak extends Command
{
    protected $signature = 'sync:keycloak-users';
    protected $description = 'Synchronise les utilisateurs depuis Keycloak';

    protected KeycloakService $keycloakService;

    public function __construct(KeycloakService $keycloakService)
    {
        parent::__construct();
        $this->keycloakService = $keycloakService;
    }

    public function handle()
    {
        $users = $this->keycloakService->getAllUsers();

        foreach($users as $kcUser) {
            User::updateOrCreate(
                ['email' => $kcUser->email],
                ['name' => $kcUser->name, 'role_id' => $kcUser->role_id]
            );
        }

        $this->info("Keycloak users synced successfully.");
    }
}
