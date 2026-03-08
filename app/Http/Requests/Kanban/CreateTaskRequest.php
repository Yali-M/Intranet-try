namespace App\Http\Requests\Kanban;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'board_id' => ['required','exists:kanboards,id'],
            'assigned_to' => ['nullable','exists:users,id'],
            'due_date' => ['nullable','date']
        ];
    }
}
