namespace App\Http\Requests\Kanban;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'priority' => ['nullable','in:low,medium,high'],
            'assigned_to' => ['nullable','integer','exists:users,id'],
            'due_date' => ['nullable','date']
        ];
    }
}
