namespace App\Http\Requests\Valoris;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRewardRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()?->isAdmin();
    }

    public function rules()
    {
        return [
            'name' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'points_cost' => ['required','integer','min:1'],
            'stock' => ['required','integer','min:0']
        ];
    }
}
