namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AssignRoleRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()?->isAdmin();
    }

    public function rules()
    {
        return [
            'user_id' => ['required','integer','exists:users,id'],
            'role' => ['required','string','exists:roles,name']
        ];
    }
}
