namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;

class CreateDeclarationRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'participants' => ['required','array'],
            'participants.*' => ['exists:users,id'] // Chaque participant doit exister
        ];
    }
}
