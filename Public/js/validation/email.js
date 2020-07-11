$(function()
	{
		$('#vemail').change(function(){
	if($('#email').val() != $('#vemail').val()){
    alert('E-mail Incorreto!');
     $('#vemail').val('');
    return false;
}			
		});
	});