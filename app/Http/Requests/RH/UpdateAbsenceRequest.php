namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAbsenceRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'type' => ['required','string'],
            'start_date' => ['required','date'],
            'end_date' => ['required','date','after_or_equal:start_date'],
            'comment' => ['nullable','string','max:500']
        ];
    }
}
