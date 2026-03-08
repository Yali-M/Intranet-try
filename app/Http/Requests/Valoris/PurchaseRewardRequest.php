namespace App\Http\Requests\Valoris;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRewardRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'reward_id' => ['required','exists:rewards,id']
        ];
    }
}
