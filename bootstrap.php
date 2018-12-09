<?php 
require 'core/ClassLoader.php';

$loader=new ClassLoader();
$loader ->registerDir(dirname(__FIlE__).'/core');
$loader ->registerDir(dirname(__FIlE__).'/models');
$loader ->register();




?>