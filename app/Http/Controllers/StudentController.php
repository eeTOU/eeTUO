<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\student;
use Session;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prouseremail = Session::get('prouseremail');
        $students = student::all()->toArray();
        return view('student.index', compact('students', 'prouseremail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prouseremail = Session::get('prouseremail');
        return view('student.create', compact('prouseremail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prouseremail = Session::get('prouseremail');
        $this->validate($request, [
            'code'  => 'required',
            'name'  => 'required|max:50',
            'surname'  => 'required|max:50',
            'email'  => 'required'
        ]);

        $student = new student([
            'code'  => $request->get('code'),
            'name'  => $request->get('name'),
            'surname'  => $request->get('surname'),
            'email'  => $request->get('email')
        ]);
        $student->save();
        return redirect()->route('student.index', compact('prouseremail'))->with('success', 'Öğrenci Eklendi');
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
        $prouseremail = Session::get('prouseremail');
        $student = student::find($id);
        return view('student.edit', compact('student', 'id', 'prouseremail'));
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
        $prouseremail = Session::get('prouseremail');
        $this->validate($request, [
            'code'     =>   'required',
            'name'     =>   'required',
            'surname'     =>   'required',
            'email'     =>   'required'
        ]);

        $student = student::find($id);
        $student->code = $request->get('code');
        $student->name = $request->get('name');
        $student->surname = $request->get('surname');
        $student->email = $request->get('email');

        $student->save();

        return redirect()->route('student.index', compact('prouseremail'))->with('success', 'Değişiklikler kaydedildi.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prouseremail = Session::get('prouseremail');
        $student = student::find($id);
        $student->delete();

        return redirect()->route('student.index', compact('prouseremail'))->with('success', 'Kayıt silindi.');
    }
    
}
