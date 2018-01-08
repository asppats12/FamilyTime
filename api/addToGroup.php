<?php
session_start();



require '../model/Database.php';
require '../model/FamilyGroup.php';

$fam = FamilyGroup::getGroup();

if($fam->addToGroup($_POST["id"])){
    echo true;
    exit();
}
else{
    echo false;
    exit();
}
?>