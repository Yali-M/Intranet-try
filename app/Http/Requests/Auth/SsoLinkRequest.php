namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SsoLinkRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'provider' => ['required','in:azure,keycloak'],
            'provider_id' => ['required','string'],
            'email' => ['required','email']
        ];
    }
}
