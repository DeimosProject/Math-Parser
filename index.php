<?php

include_once 'vendor/autoload.php';

$math = new \Deimos\Math();

$math->a = 89;

var_dump($math->parse("2+2*2+a"));