<?php

namespace App\Http\Controllers;

use App\Models\Qualification;
use App\Models\rol;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function index($rol = '')
    {
        if (!empty($rol)) {
            /**
             * Buscamos el ID del rol recibido
             */
            $rol_id = rol::searchRolName($rol);

            if ($rol_id['status'] == true && count($rol_id['data']['id']) > 0 ) {

                $rol = ['rols_id' => $rol_id['data']['id'][0]->id];

                $users = User::listUsers($rol);
                if($users['status'] == true ){

                    $users = $users['data'][0];
                    
                    return view('user.index', compact('users'))
                    ->with('i', count($users));

                }
            }
        }
        return 'Ocurrio un error, por favor actualice e intente nuevamente.';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(User::$rules);

        $user = User::create($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        request()->validate(User::$rules);

        $user->update($request->all());

        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Buscamos la informacion relacionada al estudiante
     * @param array $data
     */
    public function getInfoStudent(array $data = [])
    {

        $result = [
            'error' => 'Ocurrio un error inesperado, por favor actualiza e intenta nuevamente.'
        ];

        if (!empty($data)) {
            $result = [
                'error' => 'Error al consultar el usuario, por favor actualiza e intenta nuevamente.'
            ];

            $student = User::getUser($data['student']);
            $teacher = User::getUser($data['teacher']);

            if ($student['status'] or $teacher['status'] ) {

                $valConnection = Qualification::valUserTeacher($data);

                if ($valConnection['status']) {
                    $result = [
                        'student' => $student,
                        'teacher' => $teacher,
                        'error' => ''
                    ];  
                }
            }

        }

        return $result;

    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
