namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()?->isAdmin();
    }

    public function rules()
    {
        return [
            'name' => ['required','string','max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users','email')->ignore($this->route('user'))
            ],
            'password' => ['nullable','string','min:8']
        ];
    }
}
