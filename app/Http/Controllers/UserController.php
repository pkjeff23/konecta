<?php   
    namespace App\Http\Controllers;

    use App\User;
    use App\Role;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $users = User::all();
        $roles = Role::all();

        return View('users.index')
            ->with('users', $users)
            ->with('roles', $roles);
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->roles()->attach(Role::where('name', $request->role)->first());

        return back()->with('agregar', 'Usuario creado correctamente');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(Request $request, User $user)
    {
        $request->user()->authorizeRoles(['user', 'admin']);
        $roles = Role::all();

        return view('users.edit')
            ->with('user', $user)
            ->with('roles', $roles);

    }

    public function update(Request $request, User $user)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password == $request->hiddenpassword){

        } else {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        $user->roles()->attach(Role::where('name', $request->role)->first());


        return redirect()->route('users.index');
    }

    public function destroy(Request $request, User $user)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $user->delete();

        return redirect()->route('users.index');
    }
}