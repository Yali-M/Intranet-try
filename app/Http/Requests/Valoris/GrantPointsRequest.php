namespace App\Http\Requests\Valoris;

use Illuminate\Foundation\Http\FormRequest;

class GrantPointsRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()?->isManager() || auth()->user()?->isAdmin();
    }

    public function rules()
    {
        return [
            'user_id' => ['required','exists:users,id'],
            'points' => ['required','integer','min:1'],
            'reason' => ['nullable','string']
        ];
    }
}
