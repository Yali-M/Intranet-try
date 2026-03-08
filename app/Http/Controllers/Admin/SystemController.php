namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SystemSettingsRequest;

class SystemController extends Controller
{
    public function update(SystemSettingsRequest $request)
    {
        config(['intranet.settings' => $request->validated()]);
        return redirect()->back()->with('success', 'Settings updated');
    }
}
