namespace App\Http\Controllers;

use App\Http\Requests\Outils\CreateLinkRequest;
use App\Http\Requests\Outils\UpdateLinkRequest;
use App\Models\OutilsLink;

class OutilsController extends Controller
{
    public function index()
    {
        $links = OutilsLink::all();
        return view('outils.index', compact('links'));
    }

    public function store(CreateLinkRequest $request)
    {
        OutilsLink::create($request->validated());
        return redirect()->back()->with('success', 'Lien créé !');
    }

    public function update(UpdateLinkRequest $request, OutilsLink $link)
    {
        $link->update($request->validated());
        return redirect()->back()->with('success', 'Lien mis à jour !');
    }
}
