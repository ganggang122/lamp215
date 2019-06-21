@extends('admin.layout.layout')
@section('css')
    <style type="text/css">
        #abc ul,#abc li{
            margin:0;
            padding:0;
            list-style-type: none;
        }
        #abc a,#abc span{
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        #abc .active span{
            background-color: #1BE7ED;
            color:#fff;
        }
    </style>

@show
@section('content')
    
    <div class="mws-panel grid_8">
        <div class="mws-panel-header" style="height:50px">
            <span><i class="icon-table"></i> 新闻列表</span>
        </div>
        <div class="mws-panel-body no-padding">
            <table class="mws-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>新闻标题</th>
                        <th>图片</th>
                        <th>内容</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($news as $k=>$v)
                    <tr>
                        <td>{{$v->id}}</td>
                        <td>{{$v->title}}</td>
                        <td>
                            <img src="/uploads/{{$v->image}}" style="width:100px">
                            
                        </td>
                        <td>{{$v->content}}</td>
                        <td>
                             <a href="/admin/news/{{ $v->id }}/edit" class="btn btn-warning">修改</a>
                             <form action="/admin/news/{{ $v->id }}" method='post' style='display:inline-block'>
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <input type="submit" value='删除' class='btn btn-danger' >
                                
                            </form> 
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
             
        </div>
    </div>
@endsection