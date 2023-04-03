<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\EditorCredential;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class EditorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editors = User::where('role', 'ADMIN')
                        ->orderBy('id', 'DESC')
                        ->simplePaginate(10);
        return view('admin.editors.index', compact('editors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.editors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Valido el request
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        // Generate Password
        $password = strtoupper(str_replace(' ', '', $data['name']) . '_' . rand(1212,8768));

        $data = array_merge($data, [
            'password' => Hash::make($password),
            'role' => 'ADMIN'
        ]);

        $user = User::create($data);

        $editor_data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password
        ];

        // Send a email with the credentials to the editor
        $user->notify(new EditorCredential($editor_data));

        toast('¡Editor creado con éxito!','success');
        return redirect()->route('editors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //This validation can be improved (with roles like SUPERADMIN or something like that)
        if(Auth::user()->id == 1){
            $editor = User::find($id);
            return view('admin.editors.edit', compact('editor'));
        } else {
            toast('No cuenta con los permisos necesarios para editar redactores','info');
            return redirect()->route('editors.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //This validation can be improved (with roles like SUPERADMIN or something like that)
        if(Auth::user()->id == 1){
            //Valido el request
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            ]);

            User::updateOrCreate(
                [ 'id' => $id ],
                $data
            );

            toast('¡Editor actualizado con éxito!','success');
        } else {
            toast('No cuenta con los permisos necesarios para eliminar redactores','info');
        }

        return redirect()->route('editors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //This validation can be improved (with roles like SUPERADMIN or something like that)
        if(Auth::user()->id == 1 && $id != 1){
            $editor = User::find($id);
            $editor->delete();
            toast('Redactor eliminado con éxito','success');
        } else {
            toast('No cuenta con los permisos necesarios para eliminar redactores','info');
        }
        
        return redirect()->route('editors.index');
    }
}
