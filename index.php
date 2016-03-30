<?php

include_once 'vendor/autoload.php';

$math = new \Deimos\Math();

$math->a = 89;

var_dump($math->evaluate("2+2*2+a"));