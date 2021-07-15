<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lecture;
use Session;
use DB;
class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prouseremail = Session::get('prouseremail');
        $lectures = Lecture::all()->toArray();
        return view('lecture.index', compact('lectures','prouseremail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prouseremail = Session::get('prouseremail');

        return view('lecture.create', compact('prouseremail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code'  => 'required',
            'name'  => 'required',
            'ismandatory'  => 'required',
            'day'  => 'required',
            'hour'  => 'required'
        ]);

        $checkCode = Lecture::where('code', '=', $request->get('code'))->get();

        if ($checkCode->count() > 0){
            return redirect()->route('lecture.index', compact('prouseremail'))->with('errors', 'Bu ders kodu kullanılıyor. Lütfen başka bir kod giriniz.');
        }else {

            $lecture = new Lecture([
                'code'  => $request->get('code'),
                'name'  => $request->get('name'),
                'ismandatory'  => $request->get('ismandatory'),
                'day'  => $request->get('day'),
                'hour'  => $request->get('hour')
            ]);

            $lecture->save();
            return redirect()->route('lecture.index', compact('prouseremail'))->with('success', 'Ders Eklendi');
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
        $lecture = Lecture::find($id);
        return view('lecture.edit', compact('lecture', 'id','prouseremail'));
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
        $this->validate($request, [
            'name'  => 'required',
            'ismandatory'  => 'required',
            'day'  => 'required',
            'hour'  => 'required'
        ]);

        $lecture = Lecture::find($id);
        $lecture->name =$request->get('name');
        $lecture->ismandatory =$request->get('ismandatory');
        $lecture->day =$request->get('day');
        $lecture->hour =$request->get('hour');

        $lecture->save();

        return redirect()->route('lecture.index')->with('success', 'Değişiklikler kaydedildi.' );

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lecture = Lecture::find($id);
        $lecture->delete();

        return redirect()->route('lecture.index')->with('success', 'Kayıt silindi.');
    }


    public function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = DB::table('lectures')
         ->where('name', 'like', '%'.$query.'%')
         ->orWhere('code', 'like', '%'.$query.'%')
         ->get();
         
      }
      else
      {
       $data = DB::table('lectures')
         ->orderBy('id', 'desc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->code.'</td>
         <td>'.$row->name.'</td>
         <td>'.$row->ismandatory.'</td>
         <td>'.$row->day.'</td>
         <td>'.$row->hour.'</td>
         <td><a href=" '. action("LectureController@edit", $lecture["id"]) .' "
                 class="btn btn-warning"> Düzenle </a> </td>
         <td>
            <form method="post" class="delete_form" 
                action=" '. action("LectureController@destroy", $lecture["id"]) .'">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE" />
                        <button type="submit" class="btn btn-danger"> Sil </button>
            </form>  
        </td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">Sunuç bulunamadı.</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
    
}
