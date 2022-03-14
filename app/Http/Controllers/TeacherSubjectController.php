<?php

namespace App\Http\Controllers;

use App\Models\TeacherSubject;
use Illuminate\Http\Request;

/**
 * Class TeacherSubjectController
 * @package App\Http\Controllers
 */
class TeacherSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacherSubjects = TeacherSubject::paginate();

        return view('teacher-subject.index', compact('teacherSubjects'))
            ->with('i', (request()->input('page', 1) - 1) * $teacherSubjects->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teacherSubject = new TeacherSubject();
        return view('teacher-subject.create', compact('teacherSubject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TeacherSubject::$rules);

        $teacherSubject = TeacherSubject::create($request->all());

        return redirect()->route('teacher-subjects.index')
            ->with('success', 'TeacherSubject created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teacherSubject = TeacherSubject::find($id);

        return view('teacher-subject.show', compact('teacherSubject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacherSubject = TeacherSubject::find($id);

        return view('teacher-subject.edit', compact('teacherSubject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TeacherSubject $teacherSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TeacherSubject $teacherSubject)
    {
        request()->validate(TeacherSubject::$rules);

        $teacherSubject->update($request->all());

        return redirect()->route('teacher-subjects.index')
            ->with('success', 'TeacherSubject updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $teacherSubject = TeacherSubject::find($id)->delete();

        return redirect()->route('teacher-subjects.index')
            ->with('success', 'TeacherSubject deleted successfully');
    }

    /**
     * Guardamos los  datos del docente en la tabla de relaciones con las asignaturas
     */
    public function setSubjectsTeacher($data){
        $teacherSubject = TeacherSubject::create($data);
        return $teacherSubject;
    }

}
