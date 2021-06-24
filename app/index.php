<?php
const FOLDER_INPUTS = 'inputs';

const DIR_BASE   = __DIR__;
const DIR_INPUTS = DIR_BASE . DIRECTORY_SEPARATOR . FOLDER_INPUTS. DIRECTORY_SEPARATOR;

spl_autoload_register(
    function ($class_name) {
        include 'src/' . $class_name . '.php';
    }
);

echo new Exercise();

