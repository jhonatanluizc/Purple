	<?php
	session_start();
	session_destroy();
	//header('Location:javascript:history.go(-1)');
	echo "<script>javascript:history.go(-1);</script>";
	?>
