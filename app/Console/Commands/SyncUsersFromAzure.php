 namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\Auth\AzureService;
use App\Models\User;

class SyncUsersFromAzure extends Command
{
    protected $signature = 'sync:azure-users';
    protected $description = 'Synchronise les utilisateurs depuis Azure AD';

    protected AzureService $azureService;

    public function __construct(AzureService $azureService)
    {
        parent::__construct();
        $this->azureService = $azureService;
    }

    public function handle()
    {
        $users = $this->azureService->getAllUsers();

        foreach($users as $azureUser) {
            User::updateOrCreate(
                ['email' => $azureUser->email],
                ['name' => $azureUser->name, 'role_id' => $azureUser->role_id]
            );
        }

        $this->info("Azure users synced successfully.");
    }
}
