@extends('layouts.master')
@section('title','討論區')
@section('pagename','討論區')
@section('content')
<style>
    .tableStyle > td {
        width: 20%;
    }
    textarea {
        border: #cff09e 6px double;
        border-radius: 9px;
        background:transparent;
        resize: none;
    }
</style>
<script language="javascript">
    var number = 0;
    function getForm(arrIndex,trueID){
        var wrapItem = $('#item_'+arrIndex);
        $('#EditName').val(wrapItem.children().html());
        $('#EditIntro').val(wrapItem.children().next().html());
        $('#index').attr('action','{{route('forum.update')}}/'+trueID);
    }
</script>
<a role="button" class="button button-thirdary" style="position: relative;font-size: 20px;left: 87%" data-toggle="modal" data-target="#AddForm">新增</a>

    <table class="tableStyle">
    <tr>    
        <td>討論區名稱</td>
        <td>規則大綱</td>
        <td>最後更新</td>
        <td></td>
    </tr>
    @foreach($results as $key => $item)
    <tr class="tableContent" id= "item_{{$key}}">
        <td>{{str_limit($item->title,10)}}</td>
        <td>{{str_limit($item->content,20)}}</td>
        <td>{{$item->updated_at}}</td>
        <td>
            <a role="button" class="button  button-secondary" style="font-size: 20px;" onclick = "getForm({{$key}},{{$item->id}})" data-toggle="modal" data-target="#EditForm">編輯</a>
        </td>
    </tr>
    @endforeach
    </table>
    <center>{{$results->render()}}</center>
@endsection
@section('EditForm')
    {!!Form::open(['class'=> 'form-horizontal', 'id' => 'index', 'role'=> 'form', 'method' => 'patch'])!!}
        <div class="modal-body">
                <div class="form-group">
                {!!Form::label('EditName','討論區名稱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('name',null,['class' => 'form-control' , 'id' => 'EditName', 'placeholder' => '輸入名稱'])!!}
                    </div>
                </div>
                <div class="form-group">
                {!!Form::label('EditIntro','規則大綱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::textarea('content',null,['class' => 'form-control' , 'id' => 'EditIntro'])!!}
                    </div>
                </div>        
        </div>
        <div class="modal-footer">
            {!!Form::button('取消',['class' => 'btn btn-default','data-dismiss' => 'modal'])!!}
            {!!Form::submit('更新',['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
@endsection
