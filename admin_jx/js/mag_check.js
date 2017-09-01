$(document).ready(function(){
	$("#loading").ajaxStart(function(){
	  $(this).show();
	});
	$("#loading").ajaxStop(function(){
	  $(this).hide();
	});
});

function test()
{
	window.location.reload();
}
//链接添加
function issues_add(){
	var appid=$('#app_id').val();
	var name=$('#issues_name').val();
	var url=$('#issues_url').val();
	var magid=$('#mag_id').val();
	
	if (name=='')
	{
		$("#error_issuesname").html('  链接名称不能为空');
		$('#issues_name').focus();
		return false;
	}
	$.post("magcreate_do.php", { 
		                'magid' :magid,
						'appid' : appid,
						'issues_name' :  name,
						'issues_url' :  url,
						'act':'issues_add'
					}, function (data, textStatus){
						 //alert(data);
						if (data=='I')
						{
							$("#datacontent").html('此链接已经存在!');
							return false;
						}else if(data=='F'){
							$("#datacontent").html('链接添加失败!');
							return false;
						}else if(data=='S'){
							$("#datacontent").html('链接添加成功!');
							test();
							return false;
						}else{
							$("#datacontent").html(data);
						}
							
	});


	return false;
}
//链接删除
function issues_del(issues_id){
	var appid=$('#app_id').val();
    var magid=$('#mag_id').val();

	if(confirm('您确定要删除吗？')){
	$.post("magcreate_do.php", { 
                     'magid' : magid,
					 'appid' : appid,
						'id' :  issues_id,
						'act':'issues_del'
					}, function (data, textStatus){
						if (data=='I')
						{
							$(".delcontent").html('链接不存在!');
							return false;
						}else if(data=='F'){
							$(".delcontent").html('删除失败!');
							return false;
						}else if(data=='S'){
							$(".delcontent").html('删除成功!');
							test();
							return false;
						}else{
							$(".delcontent").html(data);
						}
							
	})};


	return false;
}

//链接的编辑
function issues_edit(){
	var magid=$('#mag_id').val();
    var issname=$('#issues_name').val();
    var issurl=$('#issues_url').val();
    var appid=$('#app_id').val();
	var issid=$('#iss_id').val();
	//alert(issname);
    if(confirm('您确定要修改吗？')){
	$.post("magcreate_do.php", { 
                     'magid' : magid,
					 'appid' : appid,
						'id' : issid,
					 'issurl': issurl,
					'issname': issname,
						'act':'issues_edit'
					}, function (data, textStatus){
						//alert(data);
						if (data=='I')
						{
							$(".delcontent").html('链接不存在!');
							return false;
						}else if(data=='F'){
							$(".delcontent").html('删除失败!');
							return false;
						}else if(data=='S'){
							$(".delcontent").html('删除成功!');
							test();
							return false;
						}else{
							$(".delcontent").html(data);
						}
							
	})};


	return false;
}