namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RolesController extends Controller
{
    public function index()
    {
        return view('admin.roles.index', ['roles' => Role::all()]);
    }
}
