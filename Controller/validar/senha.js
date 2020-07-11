$(function()
	{
		$('#vsenha').blur(function(){

	

			if ($('#senha').val().length < 8) {
				$('#senha').val('');

			}

	if($('#senha').val() != $('#vsenha').val()){
    alert('Senha Incorreta!');
     $('#vsenha').val('');

    return false;
}
			

		});
	});