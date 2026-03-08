use App\Http\Controllers\KanbanController;
use App\Http\Controllers\ValorisController;
use App\Http\Controllers\OutilsController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

// Routes protégées par connexion
Route::middleware(['connected'])->group(function () {

    // Dashboard Kanban
    Route::get('/kanban', [KanbanController::class, 'index']);
    Route::post('/kanban/task', [KanbanController::class, 'storeTask']);
    Route::put('/kanban/task/{task}', [KanbanController::class, 'updateTask']);
    Route::post('/kanban/task/move', [KanbanController::class, 'moveTask']);

    // Valoris
    Route::get('/valoris/catalog', [ValorisController::class, 'catalog']);
    Route::post('/valoris/purchase', [ValorisController::class, 'purchase']);
    Route::get('/valoris/balance', [ValorisController::class, 'pointsBalance']);

    // Outils intranet
    Route::get('/outils', [OutilsController::class, 'index']);
    Route::post('/outils/link', [OutilsController::class, 'store']);
    Route::put('/outils/link/{link}', [OutilsController::class, 'update']);
});
