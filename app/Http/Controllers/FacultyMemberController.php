<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FacultyMember;
use Illuminate\Validation\Rule;
use Session;

class FacultyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prouseremail = Session::get('prouseremail');
        
        $facultyMembers = FacultyMember::all()->toArray();
        return view('facultyMember.index', compact('facultyMembers','prouseremail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prouseremail = Session::get('prouseremail');

        return view('facultyMember.create', compact('prouseremail'));
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
            'name'  => 'required',
            'surname'  => 'required',
            'email'  => 'required',
            'startdate'  => 'required'
        ]);

        $checkCode = FacultyMember::where('code', '=', $request->get('code'))->get();

        if ($checkCode->count() > 0){
            return redirect()->route('facultyMember.index', compact('prouseremail'))->with('errors', 'Bu öğretim görevlisi kodu kullanılıyor. Lütfen başka bir kod giriniz.');
        }else {

            $facultyMember = new FacultyMember([
                'code'  => $request->get('code'),
                'name'  => $request->get('name'),
                'surname'  => $request->get('surname'),
                'email'  => $request->get('email'),
                'startdate'  => $request->get('startdate')
            ]);

            $facultyMember->save();
            return redirect()->route('facultyMember.index',compact('prouseremail'))->with('success', 'Öğretim Görevlisi Eklendi');
        }
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

        $facultyMember = FacultyMember::find($id);
        return view('facultyMember.edit', compact('facultyMember', 'id','prouseremail'));
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
            'name'     =>   'required',
            'surname'     =>   'required',
            'email'     =>   'required|email',
            'startdate'     =>   'required'
        ]);

        $checkCode = FacultyMember::where('code', '=', $request->get('code'))->get();

        if ($checkCode->count() > 0){
            return redirect()->route('facultyMember.index', compact('prouseremail'))->with('errors', 'Bu öğretim görevlisi kodu kullanılıyor. Lütfen başka bir kod giriniz.');
        }else {

            $facultyMember = FacultyMember::find($id);
            $facultyMember->name = $request->get('name');
            $facultyMember->surname = $request->get('surname');
            $facultyMember->email = $request->get('email');
            $facultyMember->startdate = $request->get('startdate');

            $facultyMember->save();

            return redirect()->route('facultyMember.index', compact('prouseremail'))->with('success', 'Değişiklikler kaydedildi.' );

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facultyMember = FacultyMember::find($id);
        $facultyMember->delete();

        return redirect()->route('facultyMember.index')->with('success', 'Kayıt silindi.');
    
    }
}
