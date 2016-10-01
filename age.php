<?php

function birthage()
{
	$birthdate = $_POST['birthdate'];

	$age="";
	$age = floor((time() - strtotime($birthdate)) / 31556926);
	echo  $age;
}

//here you can do some "routing"
$action = ( array_key_exists( 'action', $_POST) ? $_POST['action'] : "" ); //remember to escape it
																																											
switch ($action) {
    case 'birthage':
        birthage();
        break;
    default:
        //function not found, error or something
        break;
}

?>