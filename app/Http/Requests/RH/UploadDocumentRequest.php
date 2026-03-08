namespace App\Http\Requests\RH;

use Illuminate\Foundation\Http\FormRequest;

class UploadDocumentRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'file' => ['required','file','max:10240'], // Max 10 MB
            'category' => ['required','string']       // Exemple : "contrat", "fiche de paie"
        ];
    }
}
