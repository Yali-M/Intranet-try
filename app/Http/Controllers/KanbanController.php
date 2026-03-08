namespace App\Http\Controllers;

use App\Http\Requests\Kanban\CreateTaskRequest;
use App\Http\Requests\Kanban\UpdateTaskRequest;
use App\Http\Requests\Kanban\MoveTaskRequest;
use App\Models\KanboardTache;
use App\Models\KanboardColonne;
use Illuminate\Http\Request;

class KanbanController extends Controller
{
    public function index()
    {
        $boards = auth()->user()->kanbanBoards; // boards de l'utilisateur
        return view('kanban.index', compact('boards'));
    }

    public function storeTask(CreateTaskRequest $request)
    {
        $task = KanboardTache::create($request->validated());
        return redirect()->back()->with('success', 'Tâche créée');
    }

    public function updateTask(UpdateTaskRequest $request, KanboardTache $task)
    {
        $task->update($request->validated());
        return redirect()->back()->with('success', 'Tâche mise à jour');
    }

    public function moveTask(MoveTaskRequest $request)
    {
        $task = KanboardTache::find($request->task_id);
        $task->column_id = $request->column_id;
        $task->position = $request->position;
        $task->save();

        return response()->json(['success' => true]);
    }
}
