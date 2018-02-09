<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Topic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ExamRequest;


class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return view('welcome');
        // $exams = Exam::all();
        // 加入條件
        // $exams = Exam::where('enable', 1)
        //     ->orderBy('created_at', 'desc')
        //     ->take(10)
        //     ->get();
        // 兩個AND 用法
        // $exams = Exam::where('enable', 1)
        //     ->where('created_at', '>', '2017-12-16')

        // OR 用法
        // $exams = Exam::where(function ($query) {
        //     $query->where('enable', 1)
        //         ->orWhere('user_id', 1);
        // })

        // 加入分頁
        $exams = Exam::where('enable', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(2);

        return view('exam.index',compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if (Auth::check()) {
              if (Auth::user()->hasPermissionTo('建立測驗')) {
                  $user_id = Auth::id();
                  return view('exam.create', compact('user_id'));
              } else {
                  return view('welcome');
              }
          } else {
              return view('auth.login');
          }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        // 表單驗證
        // $this->validate($request, [
        //     'title'   => 'required|min:2|max:255',
        // ]);
        // 表單驗證及需要文字
        // $this->validate($request, [
        //     'title'   => 'required|min:2|max:255',
        // ], [
        //     'required' => '必填欄位',
        //     'min'      => '至少要 :min 個字',
        //     'max'      => '最多只能 :max 個字',
        // ]);
        // 使用Request
        //
        //一般新增
        // $exam          = new Exam;
        // $exam->title   = $request->title;
        // $exam->user_id = $request->user_id;
        // $exam->enable  = $request->enable;
        // $exam->save();
        //批量新增
        // $exam = Exam::create([
        //     'title'   => $request->title,
        //     'user_id' => $request->user_id,
        //     'enable'  => $request->enable,
        // ]);

        //用 $request->all() 取得使用者填寫的所有資料陣列
        $exam = Exam::create($request->all());
        return redirect()->route('exam.index');
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
        $exam = Exam::find($id);
        // $topics = Topic::where('exam_id', $id)->get();
        if (Auth::user()->hasPermissionTo('進行測驗')) {
            $exam->topics = $exam->topics->random(10);
            $user_id = Auth::id();
            return view('exam.show', compact('exam', 'user_id'));
        }else{
            return view('exam.show', compact('exam', 'topics'));
        }

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
        $exam = Exam::find($id);
        return view('exam.edit', compact('exam'));
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
        $exam = Exam::find($id);
        $exam->update($request->all());
        return redirect()->route('exam.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Exam::destroy($id);
        return redirect()->route('exam.index');
    }
}
