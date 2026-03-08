namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;

class CreateAbsenceRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'type' => ['required','string'],                   // Exemple : "congé", "maladie"
            'start_date' => ['required','date'],              // Date de début
            'end_date' => ['required','date','after_or_equal:start_date'], // Date de fin
            'comment' => ['nullable','string','max:500']
        ];
    }
}
