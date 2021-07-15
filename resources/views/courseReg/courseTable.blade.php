
<div class="row" style="padding-left: 5px; padding-right: 2px">
                <div class='right'>
                    <h4>Aldığınız Dersler</h4>
                </div>
                <br />                  
                
                <table class='table table-bordered'>
                    <tr>
                        <th>Kodu</th>
                        <th>Ders Kodu</th>
                        <th>Sınıf Kodu</th>
                        <th>Öğretim Üyesi Kodu</th>
                        <th>Sil</th>
                    </tr>

                    @foreach($courseRegs as $courseReg)
                    <tr>
                        <td>{{ $courseReg['code'] }}</td>
                        <td>{{ $courseReg['lecturecode'] }}</td>
                        <td>{{ $courseReg['classroomcode'] }}</td>
                        <td>{{ $courseReg['facultymembercode'] }}</td>
                        <td>
                            <form method='post' class='delete_form' 
                            action='{{action("CourseRegController@destroy", $courseReg["id"])}}'>
                                {{csrf_field()}}
                                <input type='hidden' name='_method' value='DELETE' />
                                <button type='submit' class='btn btn-danger'> Sil </button>
                            </form>  
                        </td>
                    </tr>
                    @endforeach

                </table>
            </div>

            <a class="btn btn-warning" href='{{ url("/courseRegIndex" )}}'> Ders Ekle</a>
