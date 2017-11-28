<?php
use \STI\SemantifyIt\Controller\SemantifyItWrapperController;

include_once "../model/domain/SemantifyItWrapper.php";
include_once "SemantifyItWrapperController.php";


$sem = new SemantifyItWrapperController("ByYz_MJdb");

$sem->setError(true);
//echo $sem->getAnnotation("rJL4cNBsg");
echo "<pre>";
var_dump($sem->getAnnotationList());
