<?php

const BASE_DIR = __DIR__;

spl_autoload_register(
    function ($class_name) {
        include 'src/' . $class_name . '.php';
    }
);

echo new Exercise();

