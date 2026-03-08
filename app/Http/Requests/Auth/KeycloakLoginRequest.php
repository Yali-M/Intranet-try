namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class KeycloakLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'code' => ['required','string'],
            'state' => ['required','string'],
            'session_state' => ['nullable','string']
        ];
    }
}
