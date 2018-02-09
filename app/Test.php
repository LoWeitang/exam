<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $fillable = [
            'content', 'user_id', 'exam_id', 'score',
        ];
    // 從考試（test）的角度來看，每個考試都有一個所屬（belongsTo）的測驗（exam），
    // 所以，開啟題目的模型 /app/Test.php，加入對測驗的 belongsTo 關聯
    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }
    // 一個考試，也一定會有一個考生，所以，我們也順便加入使用者的關聯
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
