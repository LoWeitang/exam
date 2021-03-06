@extends('layouts.app')
@section('content')
    <h1 class="text-center">{{$exam->title}}
    	@role('老師')
    	<a href="{{route('exam.edit', $exam->id)}}" class="btn btn-warning">編輯</a>
    	<form action="{{route('exam.destroy', $exam->id)}}" method="POST" style="display:inline">
    	    {{ csrf_field() }}
    	    <button type="submit" name="_method" value="DELETE" class="btn btn-danger">刪除</button>
    	</form>
    	@endrole
    </h1>
 
    <div class="text-center">
        發布於 {{$exam->created_at->format("Y年m月d日 H:i:s")}} / 最後更新： {{$exam->updated_at->format("Y年m月d日 H:i:s")}}
    </div>
    <hr>
 
 	@role('老師')
 		@if(isset($topic->id))
 		    @form(['url' => '/topic/'.$topic->id, 'class' => 'form-horizontal', 'framework' => 'bootstrap4', 'method' => 'patch'])
 		        @textarea('topic', $topic->topic, ['placeholder' => '請輸入題目內容', 'label' => '題目內容', 'rows' => 3])
 		        @text('opt1', $topic->opt1, ['placeholder' => '輸入選項1', 'label' => '選項1'])
 		        @text('opt2', $topic->opt2, ['placeholder' => '輸入選項2', 'label' => '選項2'])
 		        @text('opt3', $topic->opt3, ['placeholder' => '輸入選項3', 'label' => '選項3'])
 		        @text('opt4', $topic->opt4, ['placeholder' => '輸入選項4', 'label' => '選項4'])
 		        @select ('ans', [1=>1, 2=>2, 3=>3, 4=>4], $topic->ans, ['placeholder' => '請設定正確解答', 'label' => '正確解答'])
 		        @hidden('exam_id', $exam->id)
 		        @submit('儲存', ['class' => 'btn btn-success'])
 		    @endform
 		@else
	 	    @form(['url' => '/topic', 'class' => 'form-horizontal', 'framework' => 'bootstrap4'])
	 	        @textarea('topic', '', ['placeholder' => '請輸入題目內容', 'label' => '題目內容', 'rows' => 3])
	 	        @text('opt1', '', ['placeholder' => '輸入選項1', 'label' => '選項1'])
	 	        @text('opt2', '', ['placeholder' => '輸入選項2', 'label' => '選項2'])
	 	        @text('opt3', '', ['placeholder' => '輸入選項3', 'label' => '選項3'])
	 	        @text('opt4', '', ['placeholder' => '輸入選項4', 'label' => '選項4'])
	 	        @select ('ans', [1=>1, 2=>2, 3=>3, 4=>4], null, ['placeholder' => '請設定正確解答', 'label' => '正確解答'])
	 	        @hidden('exam_id', $exam->id)
	 	        @submit('儲存', ['class' => 'btn btn-success'])
	 	    @endform
	 	@endif
 	    <hr>
 	@endrole
 	@role('學生')
 	    @form(['url' => '/test', 'class' => 'form-horizontal', 'framework' => 'bootstrap4'])
 	@endrole
 	<dl>
 	    @forelse ($exam->topics as $key => $topic)
 	        <dt>
 	            <h3>           
 	            @role('老師')
 	            	<a href="{{route('topic.edit', $topic->id)}}" class="btn btn-warning">編輯</a>
 	            	<form action="{{route('topic.destroy', $topic->id)}}" method="POST" style="display:inline">
 	            	    {{ csrf_field() }}
 	            	    <button type="submit" name="_method" value="DELETE" class="btn btn-danger">刪除</button>
 	            	</form>
 	            	（{{$topic->ans}}）
 	            @endrole
 	           	{!!$key + 1!!} {{$topic->topic}}
 	            </h3>
 	        </dt>
 	        <dd>
 	            <label class="mx-2">
 	                <input type="radio" name="ans[{{$topic->id}}]" value="1">
 	                <span class="opt">&#10102;</span> {{$topic->opt1}}
 	            </label>
 	            <label class="mx-2">
 	                <input type="radio" name="ans[{{$topic->id}}]" value="2">
 	                <span class="opt">&#10103;</span> {{$topic->opt2}}
 	            </label>
 	            <label class="mx-2">
 	                <input type="radio" name="ans[{{$topic->id}}]" value="3">
 	                <span class="opt">&#10104;</span> {{$topic->opt3}}
 	            </label>
 	            <label class="mx-2">
 	                <input type="radio" name="ans[{{$topic->id}}]" value="4">
 	                <span class="opt">&#10105;</span> {{$topic->opt4}}
 	            </label>
 	        </dd>
 	    @empty
 	        <div class="alert alert-danger">尚無任何題目</div>
 	    @endforelse
 	</dl>
 	@role('學生')
 	        @hidden('exam_id', $exam->id)
 	        @hidden('user_id', $user_id)
 	        @submit('寫完送出計分', ['class' => 'btn btn-success'])
 	    @endform
 	@endrole
    <div class="text-center">
        <a href="{!!route('exam.index')!!}" class="btn btn-info">回首頁</a>
    </div>
@endsection
