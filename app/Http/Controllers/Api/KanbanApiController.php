namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Kanban\CreateTaskRequest;
use App\Models\KanboardTache;

class KanbanApiController extends Controller
{
    public function storeTask(CreateTaskRequest $request)
    {
        $task = KanboardTache::create($request->validated());
        return response()->json($task, 201);
    }
}
