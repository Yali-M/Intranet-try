namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PointsService;
use App\Models\User;

class ValorisMonthlyPoints extends Command
{
    protected $signature = 'valoris:monthly-points';
    protected $description = 'Crédit mensuel des points Valoris pour tous les utilisateurs';

    protected PointsService $pointsService;

    public function __construct(PointsService $pointsService)
    {
        parent::__construct();
        $this->pointsService = $pointsService;
    }

    public function handle()
    {
        $users = User::all();
        foreach($users as $user) {
            $this->pointsService->credit($user, 100, 'Monthly reward');
        }

        $this->info('Monthly points distributed successfully.');
    }
}
