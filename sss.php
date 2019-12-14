<?php 

//echo 'fec8';
//echo '<br>';
//echo password_hash('fec8', PASSWORD_DEFAULT);

//$ime = 'fecy';
//$hash = password_hash($ime, PASSWORD_DEFAULT);
//echo password_verify($ime, $hash);

//$password = 123456;
//$password = password_hash($password, PASSWORD_DEFAULT);
//echo $password;


$password = $_POST['password'];
$password = 'input';
$hash = password_hash($password, PASSWORD_DEFAULT);
echo password_verify($password, $hash);


/*if (password_verify($passwordString, $passwordHash)) {
    echo 'logged in';
} else {
    echo 'not good pass!';
}
*/