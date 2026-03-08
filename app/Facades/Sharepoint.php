namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Sharepoint extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sharepoint';
    }
}
