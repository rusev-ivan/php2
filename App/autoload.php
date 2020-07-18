<?php

function __autoload ($class)
{
    require __DIR__ . '/../' . str_ireplace('\\','/',$class) . '.php';
}