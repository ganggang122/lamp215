@extends('admin.layout.layout')

@section('content')
	<div>
		<input type='hidden' id='gid' name='gid' value='46'>
		<button onclick='collect(this)'>{{ $collect ? ' 已收藏 ': '点击收藏' }}</button>
	</div>
	<script>
		function collect(obj)
		{
			//获取商品id
			let gid = $('#gid').val();
			$.get('/home/collect/collect',{'gid':gid},function(res){
				if( res == 'ok') {
					$(obj).html('已收藏');
				} 
				if ( res == 'del') {
					$(obj).html('点击收藏');
				}
			},'json')
		}
	</script>
@endsection