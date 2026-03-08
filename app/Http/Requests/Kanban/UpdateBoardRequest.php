namespace App\Http\Requests\Kanban;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBoardRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'name' => ['required','string','max:255'],
            'description' => ['nullable','string','max:1000'],
            'visibility' => ['required','in:private,team,public']
        ];
    }
}
