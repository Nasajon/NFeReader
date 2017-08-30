#!/usr/bin/env php
<?php

require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;

$mem_ini = memory_get_usage();

$application = new Application();

$application->add(
        new \Nasajon\NFeReader\Command\RunCommand()
        );
$application->run();

$mem_end = memory_get_usage();
$mem = $mem_end - $mem_ini;
echo "\nMemoria inicial:" .  convert($mem_ini) . "\nMemoria final:" . convert($mem_end) . "\nTotal de memoria gasta:" .  convert($mem) . "\n";


function convert($size) {
    $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
    return round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
}
