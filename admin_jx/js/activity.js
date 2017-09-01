$(function(){
	$("#type1").change(function(){
		var type1=$("#type1").val();
		if(type1=='1'){
			$("#type2").hide();
		}else{
			
			$.post("activity.ajax.php", { 
							'type' :type1
							
					}, function (data, textStatus){
						$('#type2').empty();
						$('#type2').append(data);	
								
			});
			$("#type2").show();
		}
	})
})