<?php
echo $_POST['id'].'</br>';
echo password_hash($_POST['pwd'],PASSWORD_DEFAULT);
?>
