namespace App\Http\Requests\Valoris;

use Illuminate\Foundation\Http\FormRequest;

class TransferPointsRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'recipient_id' => ['required','exists:users,id'],
            'points' => ['required','integer','min:1'],
            'message' => ['nullable','string']
        ];
    }
}
