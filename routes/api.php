use App\Http\Controllers\Api\KanbanApiController;
use App\Http\Controllers\Api\ValorisApiController;
use App\Http\Controllers\Api\RhApiController;
use Illuminate\Support\Facades\Route;

// Middleware spécifique API (auth token, CORS)
Route::middleware(['auth:sanctum'])->group(function() {

    // Kanban API
    Route::get('/kanban/tasks', [KanbanApiController::class, 'index']);
    Route::post('/kanban/tasks', [KanbanApiController::class, 'storeTask']);

    // Valoris API
    Route::post('/valoris/purchase', [ValorisApiController::class, 'purchase']);
    Route::get('/valoris/points', [ValorisApiController::class, 'pointsBalance']);

    // RH API
    Route::get('/rh/absences', [RhApiController::class, 'index']);
    Route::post('/rh/absences', [RhApiController::class, 'store']);
});
