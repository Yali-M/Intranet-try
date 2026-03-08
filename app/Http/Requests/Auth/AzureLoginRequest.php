namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class AzureLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id_token' => ['required','string'],
            'access_token' => ['nullable','string'],
            'expires_in' => ['nullable','integer'],
            'token_type' => ['nullable','string']
        ];
    }
}



