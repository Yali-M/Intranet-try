namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ValorisProduit;

class ValorisAdminController extends Controller
{
    public function products()
    {
        return view('admin.valoris.products', ['products' => ValorisProduit::all()]);
    }
}
