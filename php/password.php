<?php
/**
 * Created by PhpStorm.
 * User: Abdulkadir Ekici
 * Date: 14-4-2015
 * Time: 13:51
 */

//echo password_hash("lol", PASSWORD_DEFAULT)."\n";

//$postwaarde = "lol";

//$options = [
//    'cost' => 12,
//];

//echo password_hash("lol", PASSWORD_BCRYPT, $options)."\n";

$postwaarde ="dkfnd" ;

$hash =  password_hash($postwaarde, PASSWORD_BCRYPT);

if (password_verify($postwaarde, $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
echo strlen($hash);

//if (password_verify('rasmuslerdorf', $hash)) {
//    echo 'Password is valid!';
//} else {
//    echo 'Invalid password.';
//}


//$wachtwoord = "test1234";
//$wachtwoord2 = "blabla";
//
//$options2

//select data van datbank
$password = "haahah";

$crypt = password_hash($password, PASSWORD_BCRYPT);

//input veld
$user = "haahah";


//checken
if(hash_equals($crypt, crypt($user, $crypt))) {
    echo "valid";
}
else    {
    echo "not valid";
}

