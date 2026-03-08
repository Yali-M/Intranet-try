namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index', ['users' => User::all()]);
    }

    public function store(CreateUserRequest $request)
    {
        User::create($request->validated());
        return redirect()->back()->with('success', 'User created!');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return redirect()->back()->with('success', 'User updated!');
    }
}
