<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseReg extends Model
{

    // Verilen dokümanda Ders Kayıt Tablosu için  StudentCode kolonunun açıklamasına Ders Kodu 
    //  yazılmış hatalı yazıldığını düşünerek ve  Ders Kodu kolununun da bu tabloda tutulması gerektiğini 
    // düşünerek lecturecode sütünunu ekliyorum. 
    protected $fillable = ['code', 'facultymembercode', 'studentcode', 'classroomcode', 'lecturecode'];
}