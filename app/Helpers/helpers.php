<?php

function formate_title_url(String $value){
    
    // Verify the string doesn't have '%' 
    $value = str_replace('%', '', $value);

    // Exchange spaces for middle dash
    $value = str_replace(' ', '-', $value);
    return $value;
}

function sub_string_titles(String $value){
    
    if(strlen($value) > 50)
        $value = substr($value, 0, 50) . '...';

    return $value;
}