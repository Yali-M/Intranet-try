namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SystemSettingsRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()?->isAdmin();
    }

    public function rules()
    {
        return [
            'app_name' => ['required','string','max:255'],
            'timezone' => ['required','string'],
            'support_email' => ['required','email'],
            'maintenance_mode' => ['boolean']
        ];
    }
}
