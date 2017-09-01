$(document).ready(function(){
	$(".do_act").click(function(){
		var count=$('#count').val();
		var str1='';
		var count_new=parseInt(count)+1;
		if (count=='1')
		{
			str1='<script type="text/javascript" src="js/answer1.js"></script>';
		}else{
			str1='';
		}
		var str='<script type="text/javascript" src="js/answer.js"></script><p class="underline" current="'+count_new+'">选　　项<span class="count_span">'+count_new+'</span>：<input class="in1 in2" id="answer'+count_new+'" name="answer'+count_new+'" type="text"/> <span class="do_act">添加选项</span></p>';
		$('.answerBox').append(str);
		$('#count').val(count_new);
		
		$(this).parent().append('<span class="do_del" onClick="del('+count+')">删除</span>');
		$(this).remove();
		
		
	})

		
})
