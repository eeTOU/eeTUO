<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;
use Session;
use App\ProUser;
use App\student;
use App\CourseReg;
use App\Lecture;
use Illuminate\Support\Facedes\DB;

class LoginController extends Controller
{
    private $student_id;
    public function __construct()
    {
        if (!Auth::check()){
            $student_id = "";
            
        }
        
        return 'NO';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prouseremail = Session::get('prouseremail');
        return view('register', compact('prouseremail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $prouser_name = $request->prouser_name;
        $prouser_email = $request->prouser_email;
        $prouser_password = $request->prouser_password;

        $check_email = App\ProUser::where('prouser_email',$prouser_email)->get();

        if(count($check_email)>0)
        {
            return redirect('/register')->with('errors','Bu mail adresine sahip bir kullanıcı bulumaktadır.
                Lütfen farklı bir mail adresi kullanın.');

        }else 
        {
            $login= new App\ProUser;

            $login->prouser_name =$prouser_name;
            $login->prouser_email =$prouser_email;
            $login->prouser_password =$prouser_password;
            $login->check_pro = 1;

            $created = $login->save();

            if($created){
                return redirect('/register')->with('success','Uzman kullanıcı başarılı bir şekilde eklendi.');
            }
        } //else 
    }


    public function login()
    {
        return view('login');
    }

    public function studentLogin()
    {
        return view('studentLogin');
    }


    public function checkLogin(Request $request)
    {
        $prouser_email = $request->prouser_email;
        $prouser_password = $request->prouser_password;

        $users = App\ProUser::where('prouser_email', $prouser_email)->where('prouser_password', $prouser_password)->get();


        if(count($users)>0){

            $request->session()->put('user_id', $users[0]->id);
            $request->session()->put('user_name', $users[0]->prouser_name);
            $request->session()->put('check_pro', $users[0]->check_pro);
            Session::put('prouseremail', $users[0]->prouser_email );


            return redirect('/welcome');
        }else {

            return redirect('/login')->with('msg', 'Oturum açılamadı. Mail adresiniz veya şifreniz hatalı. ');
        }        
    }

    public function checkStudentLogin(Request $request)
    {
        $student_email = $request->prouser_email;
        $student_password = $request->prouser_password;

        $users = App\student::where('email', $student_email)->where('code', $student_password)->get();

        if(count($users)>0){

            Session::put('studentname', $users[0]->name );
            Session::put('studentsurname', $users[0]->surname );
            $request->session()->put('user_id', $users[0]->id);
            $request->session()->put('user_name', $users[0]->name);
            $this->student_id = $users[0]->id;

            return redirect('/studentWelcome');
        }else {

            return redirect('/studentLogin')->with('msg', 'Oturum açılamadı. Mail adresiniz veya şifreniz hatalı. ');
        }        
    }


    public function protect(Request $request)
    {
        $prouseremail = Session::get('prouseremail');
        if($request->session()->get('user_id') == '')
        {
            return redirect('/login');
        }else {
            return view('protect', compact('prouseremail'));
        }
    }

    public function studentProtect(Request $request)
    {
        if($request->session()->get('user_id') == '')
        {
            return redirect('/login');
        }else {

            $username = $request->session()->get('user_name');
            $userid = $request->session()->get('user_id');

            $username = Session::get('studentname');
            $studentsurname = Session::get('studentsurname');
            $this->student_id = array('userid' => $userid);

            $courseRegs = App\CourseReg::all()->toArray();
            $lectures = App\Lecture::all()->toArray();

            return view('studentProtect', compact('courseRegs', 'lectures', 'username', 'studentsurname' ));
        }
    }

    public function submitLecture($id)
    {
        $lectures = App\Lecture::find($id)->get();

        if($lectures->get('ismandatory') == 0){
            $code = "ZD$id";
        }else{
            $code = "SD$id";
        }

        $courseReg= new App\CourseReg;

        $courseReg->code =$code;
        $courseReg->facultymembercode ='';
        $courseReg->studentcode =$this->student_id;
        $courseReg->classroomcode = '';
        $courseReg->lecturecode = $lectures[0]->code;

        $courseReg->save();

        
        $courseRegs = App\CourseReg::all()->toArray();
        $lectures = App\Lecture::all()->toArray();


        return view('studentWelcome', compact('courseRegs', 'lectures'))->with('success', 'Ders Eklendi');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->forget('user_name');
        Session::forget('studentname');
        Session::forget('studentsurname');
        Session::forget('prouseremail');

        return redirect('/');
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courseReg = App\CourseReg::find($id);
        $courseReg->delete();

        $courseRegs = App\CourseReg::all()->toArray();
        $lectures = App\Lecture::all()->toArray();

        return redirect()->route('studentWelcome', compact('courseRegs', 'lectures'))->with('success', 'Ders Silindi');
    }
}
