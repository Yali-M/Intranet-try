namespace App\Events;

use App\Models\KanboardTache;
use Illuminate\Foundation\Events\Dispatchable;

class TaskStatusChanged
{
    use Dispatchable;

    public KanboardTache $task;
    public string $oldStatus;
    public string $newStatus;

    public function __construct(KanboardTache $task, string $oldStatus, string $newStatus)
    {
        $this->task = $task;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
    }
}
