<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    //
    protected $fillable = [
        'topic', 'exam_id', 'opt1', 'opt2', 'opt3', 'opt4', 'ans',
    ];

    //讀取全部資料（抓出來的$topics 由於是多筆，所以$topics 是Collection類別，可以當物件用，亦可當陣列用，甚至可以輸出json）
    //$topics=\App\Topic::all();
    //以主索引取出單筆資料（抓出來的$topic 由於只有一筆，所以$topic 是一個Model）
    // $topic=\App\Topic::find(12);
	// 以主索引取出多筆資料
	// $topic=\App\Topic::find([2,7,12,35]);
	// 設定排序
	// $topic=\App\Topic::where('欄位' , '條件' ,'值');
	// 串連使用
	// $topic=\App\Topic::where('欄位' , '條件' ,'值')->orderBy('欄位' '排序方式')->get();
	// 隨機抓幾筆
	// $topic=\App\Topic::random(數量);
	// 輸出成 json
	// $topic->toJson();

	// 從模型設定關聯
	// 1. 從題目（topic）的角度來看，每個題目都有一個所屬（belongsTo）的測驗（exam），所以，開啟題目的模型 /app/Topic.php，加入對測驗的 belongsTo 關聯：
	public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

}
