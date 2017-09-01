function del(n){
			var index =$('#answer'+n).parent().attr('current');
			alert(n);
			var count=$('#count').val();
			var count_new=parseInt(count)-1;
			for(var i=(index);i<=count;i++){
				$('.underline').eq(i).attr('current',i);
				$('.underline').eq(i).find('input').attr('id','answer'+i);
				$('.underline').eq(i).find('input').attr('name','answer'+i);
				$('.underline').eq(i).find('.count_span').html(i);
				$('.underline').eq(i).find('.do_del').attr('onClick','del('+n+')');
				
			}
			$('#answer'+n).parent().remove();
			$('#count').val(count_new);
}
