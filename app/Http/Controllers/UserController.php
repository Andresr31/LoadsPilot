<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    /**
     * Obtener todos los elementos y retornar la vista para su visualización
     * GET
     */
    public function index()
    {
       if(Auth::user()->role->name != 'Admin'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        // $users = User::all();
        $users = User::paginate(10);
        return view('elements.users.index')->with('users',$users);
    }

    /**
     * Retornar la vista con el formulario para la creación del elemento con los registros que requiera
     * GET
     */
    public function create()
    {
        if(Auth::user()->role->name != 'Admin'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        $roles = Role::all();
        return view('elements.users.create')->with('roles',$roles);

    }

    /**
     * Recibir solicitud del formulario de creación del elemento y creación del registro
     * POST
     */
    public function store(UserRequest $request)
    {
        if(Auth::user()->role->name != 'Admin'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        $user = new User;

        $user->fullname = $request->fullname;
        $user->email = $request->email;

        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;

        if($user->save()){
            return redirect('users')->with('message','El usuario: '.$user->fullname.' ha sido creado existosamente!!');
        }


    }

    /**
     * Retornar la vista para visualizar un elemento
     * GET
     */
    public function show(string $id)
    {
        if(Auth::user()->role->name != 'Admin'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        $user = User::find($id);
        return view('elements.users.show')->with('user',$user);
    }

    /**
     * Retornar la vista para editar un elemento en especifico
     * GET
     */
    public function edit(string $id)
    {
        if(Auth::user()->role->name != 'Admin'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        $user = User::find($id);
        $roles = Role::all();
        return view('elements.users.edit')->with('user',$user)->with('roles',$roles);
    }

    /**
     * Recibe la solicitud de actualización de un elemento y actualiza el registro
     * PUT
     */
    public function update(UserRequest $request, string $id)
    {
        if(Auth::user()->role->name != 'Admin'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }
        $user = User::find($id);

        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;

        if($user->save()){
            return redirect('users')->with('message','El usuario: '.$user->fullname.' ha sido actualizado existosamente!!');
        }
    }

    /**
     * Eliminar un registro
     * DELETE
     */
    public function destroy(User $user)
    {
        if(Auth::user()->role->name != 'Admin'){
            return redirect('home')->with('error','No puede acceder a este recurso');
       }

        if($user->delete()){
            return redirect('users')->with('message','El usuario: '.$user->fullname.' ha sido eliminado existosamente!!');
        }

    }
}
