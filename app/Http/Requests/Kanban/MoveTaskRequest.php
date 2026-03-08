namespace App\Http\Requests\Kanban;

use Illuminate\Foundation\Http\FormRequest;

class MoveTaskRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'column_id' => ['required','integer','exists:kanboard_colonnes,id'],
            'position' => ['required','integer','min:0']
        ];
    }
}
