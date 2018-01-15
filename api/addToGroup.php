<?php
session_start();



require '../model/Database.php';
require '../model/FamilyGroup.php';

$fam = FamilyGroup::getGroup();

if($fam->addToGroup($_POST["id"])){
    echo true;
}
else{
    echo false;
}
?>