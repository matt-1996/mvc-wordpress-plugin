<?php 

function view($file , $data = []){
    $filePath = DASHPATH . 'views/' . $file . '-view' . '.php';
    if(isFileValid($filePath)){
        extract($data);
     require_once DASHPATH . 'views/' . $file . '-view' . '.php';
    }else{
        var_dump('File Not Found');
    }
}

function isFileValid($filePath){
    return file_exists($filePath) && is_readable($filePath);
}