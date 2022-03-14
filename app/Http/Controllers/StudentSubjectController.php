<?php

namespace App\Http\Controllers;

use App\Models\StudentSubject;
use Illuminate\Http\Request;

/**
 * Class StudentSubjectController
 * @package App\Http\Controllers
 */
class StudentSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentSubjects = StudentSubject::paginate();

        return view('student-subject.index', compact('studentSubjects'))
            ->with('i', (request()->input('page', 1) - 1) * $studentSubjects->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studentSubject = new StudentSubject();
        return view('student-subject.create', compact('studentSubject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(StudentSubject::$rules);

        $studentSubject = StudentSubject::create($request->all());

        return redirect()->route('student-subjects.index')
            ->with('success', 'StudentSubject created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentSubject = StudentSubject::find($id);

        return view('student-subject.show', compact('studentSubject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studentSubject = StudentSubject::find($id);

        return view('student-subject.edit', compact('studentSubject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  StudentSubject $studentSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentSubject $studentSubject)
    {
        request()->validate(StudentSubject::$rules);

        $studentSubject->update($request->all());

        return redirect()->route('student-subjects.index')
            ->with('success', 'StudentSubject updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $studentSubject = StudentSubject::find($id)->delete();

        return redirect()->route('student-subjects.index')
            ->with('success', 'StudentSubject deleted successfully');
    }

    /**
     * Guardamos los  datos del estudiante en la tabla de relaciones con las asignaturas
     */
    public function setSubjectsStudent($data){
        $studentSubject = StudentSubject::create($data);
        return $studentSubject;
    }

}
