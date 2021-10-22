<?php
require __DIR__ . '/vendor/autoload.php';

use CodeGenerator\GenerateModelClass;

$class = new GenerateModelClass('Test');
$ini = parse_ini_file(__DIR__ . '/settings.ini');
$class->generateClass();
$class->writeToFile(__DIR__ . $ini['output_folder']);