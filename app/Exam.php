<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $fillable   = [
        'title', 'user_id', 'enable',
    ];
    // 保護無法輸入
    // protected $guarded = ['id', 'password'];


    // 設定好關聯後，在取得 $exam 內容時，就會自動加入 $exam->topics資料陣列，
    // 所以，可以利用「 $exam->topics['欄位名稱']」或「 $exam->topics->欄位名稱」的方式來取得題目的相關資料
    public function topics()
    {
        return $this->hasMany('App\Topic');
    }
}
