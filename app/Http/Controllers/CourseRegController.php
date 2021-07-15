<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseReg;
use App\Lecture;
use Session;

class CourseRegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $username = Session::get('studentname');
        $studentsurname = Session::get('studentsurname');
        $courseRegs = CourseReg::all()->toArray();
        $lectures = Lecture::all()->toArray();

        return view('courseReg.index', compact('courseRegs', 'lectures','username', 'studentsurname'));
    }


    public function submitLecture($id)
    {
        $var = 0;  // Zorunlu dersin adet değişkeni
        $temp = 0;   // Seçmeli dersin adet değişkeni
        $username = Session::get('studentname');
        $studentsurname = Session::get('studentsurname');
        
        $lectures =  Lecture::where('id', '=', $id)->get();
        $courseRegList =  CourseReg::where('lecturecode', '=', $lectures[0]->code)->get();

        if( $this->checkLecturePermission() ){

            $courseRegs = CourseReg::all()->toArray();
            $lectures = Lecture::all()->toArray();
            // Dersin daha önce alınıp alınmadığını kontrol ediyoruz. //
            //Ders daha önce alınmış. //
            if(count($courseRegList)>0){                
                return redirect()->route('courseReg.index', compact('courseRegs', 'lectures','username','studentsurname'))->with('errors', 'Bu dersi daha önce aldığınız için tekrar alamazsınız. Lütfen farklı bir ders seçiniz.');

            }else{

                //Ders daha önce alınmamış. // 
                $lectures1 =  Lecture::where('id', '=', $id)->get();

                 
                if($lectures1[0]->ismandatory == 1){ // seçilen ders zorunlu ise

                    //alınan derslerden kaçı zorunlu ona bakıyoruz
                    $x = 0;
                    while( $x < count($courseRegs)){ // alınan derslerin toplam sayısınca döngü

                        $courseRegs = CourseReg::all();

                        //açılan derslerden alınan dersleri bulup
                        $lcode = $courseRegs[$x]->lecturecode; // alınan dersin lecturecode
                        $lectures2 =  Lecture::where('code', '=', $lcode)->get();
                        //ismandatory özelikklerini karşılaştırıyoruz
                        if($lectures2[0]->ismandatory == 1){
                            $var ++;
                        }

                        $x++;;
                    }

                    
                    if($var > 2 ){
                        return redirect()->route('courseReg.index', compact('courseRegs', 'lectures','username','studentsurname'))->with('errors', 'Ders eklenmedi. Bu dönem toplam 3 adet zorunlu ders alabilirsiniz.');
                    }
                    
                }else {

                    //alınan derslerden kaçı seçmeli ona bakıyoruz
                    $x = 0;
                    while( $x < count($courseRegs)){ // alınan derslerin toplam sayısınca döngü

                        $courseRegs = CourseReg::all();  // alınan dersler

                        //açılan derslerden aldığım dersleri bulup
                        $lcode = $courseRegs[$x]->lecturecode; // alınan dersin lecturecode
                        $lectures2 =  Lecture::where('code', '=', $lcode)->get();
                        //ismandatory özeliklerini karşılaştırıyoruz
                        if($lectures2[0]->ismandatory == 0){
                            $temp ++;
                        }

                        $x++;;
                    }


                    if($temp > 1 ){
                        return redirect()->route('courseReg.index', compact('courseRegs', 'lectures','username','studentsurname'))->with('errors', 'Ders eklenmedi. Bu dönem toplam 2 adet Seçmeli ders alabilirsiniz.');
                    }

                }

                // Code sürunu hakkında bir bilgi verilmediği için bir dersin id kullanılarak bir kod oluşturuluyor. Ders kodları unique olduğundan bir sorun çıkmayacaktır burada da 
                if($lectures1[0]->ismandatory == 1){
                    $code = "ZD$id";
                }else{
                    $code = "SD$id";
                }
        
                $lectures1 =  Lecture::where('id', '=', $id)->get();

                $courseReg= new CourseReg;
        
                $courseReg->code =$code;
                $courseReg->facultymembercode ='';
                $courseReg->studentcode =1;
                $courseReg->classroomcode = '';
                $courseReg->lecturecode = $lectures1[0]->code;
        
                $courseReg->save();
        
                $courseRegs = CourseReg::all()->toArray();
                $lectures = Lecture::all()->toArray();
        
        
                return view('courseReg.index', compact('courseRegs', 'lectures','username','studentsurname'))->with('success', 'Ders Eklendi');
            }


        } // checkLecturePermission function if
        else{
            return redirect()->route('courseReg.index', compact('courseRegs', 'lectures', 'username','studentsurname'))->with('errors', 'Ders eklenmedi. Bu dönem toplam 5 adet ders alabilirsiniz.');

        }


        
    }

    public function checkLecturePermission(){
        $lectures = CourseReg::all()->toArray();
        if(count($lectures) <= 4){
            return true;
        }else {
            return false;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $courseReg = CourseReg::find($id);
        $courseReg->delete();

        $lectures = Lecture::all()->toArray();

        return redirect()->route('courseReg.index')->with('success', 'Ders kaydı silindi.');
    }
}
