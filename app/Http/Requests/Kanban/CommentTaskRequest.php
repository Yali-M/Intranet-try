namespace App\Http\Requests\Kanban;

use Illuminate\Foundation\Http\FormRequest;

class CommentTaskRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'task_id' => ['required','exists:tasks,id'],
            'comment' => ['required','string','max:2000']
        ];
    }
}
