namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()?->isAdmin();
    }

    public function rules()
    {
        return [
            'role' => ['required','string','exists:roles,name'],
            'permissions' => ['required','array'],
            'permissions.*' => ['string','exists:permissions,name']
        ];
    }
}
