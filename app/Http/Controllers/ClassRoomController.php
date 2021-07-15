<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClassRoom;
use Session;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prouseremail = Session::get('prouseremail');

        $classrooms = ClassRoom::all()->toArray();
        return view('classRoom.index', compact('classrooms', 'prouseremail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prouseremail = Session::get('prouseremail');
        return view('classRoom.create', compact('prouseremail'));
    }

    public function createClass()
    {
        $prouseremail = Session::get('prouseremail');

        $classrooms = ClassRoom::where('type', '=', 0)->get();
        return view('classRoom.createClass', compact('classrooms', 'prouseremail'));
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
            'type'  => 'required'
        ]);

        $checkCode = ClassRoom::where('code', '=', $request->get('code'))->get();

        if ($checkCode->count() > 0){
            return redirect()->route('classRoom.index', compact('prouseremail'))->with('errors', 'Bu sınıf kodu kullanılıyor. Lütfen başka bir kod giriniz.');
        }else {

            if($request->get('parentcode') == ""){

                $classroom = new ClassRoom([
                    'code'  => $request->get('code'),
                    'name'  => $request->get('name'),
                    'parentcode'  => '',
                    'type'  => $request->get('type')
                ]);

            }else{

                $classroom = new ClassRoom([
                    'code'  => $request->get('code'),
                    'name'  => $request->get('name'),
                    'parentcode'  => $request->get('parentcode'),
                    'type'  => $request->get('type')
                ]);
            }


            $classroom->save();
            return redirect()->route('classRoom.index', compact('prouseremail'))->with('success', 'İşlem Başarılı. Tebrikler...');
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
        $classroom = ClassRoom::find($id);

        $class_check = 0;
        if($classroom->parentcode == " "){
            $class_check = 0; //Kat
        }else{
            $class_check = 1; // Sınıf
        }

        return view('classRoom.edit', compact('classroom', 'id', 'class_check', 'prouseremail'));
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
            'name'  => 'required',
            'type'  => 'required'
        ]);

        if($request->get('parentcode') == ""){

            $classroom = ClassRoom::find($id);
            $classroom->name =$request->get('name');
            $classroom->parentcode ='';
            $classroom->type =$request->get('type');

        }else{

            $classroom = ClassRoom::find($id);
            $classroom->name =$request->get('name');
            $classroom->parentcode =$request->get('parentcode');
            $classroom->type =$request->get('type');
        }    

        $classroom->save();

        return redirect()->route('classRoom.index', compact('prouseremail'))->with('success', 'Değişiklikler kaydedildi.' );
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
        $classroom = ClassRoom::find($id);
        $classroom->delete();

        return redirect()->route('classRoom.index', compact('prouseremail'))->with('success', 'Kayıt silindi.');
    }
}
