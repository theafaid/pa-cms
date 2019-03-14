<?php

/**
 * Get Dashboard Path
 */

if(! function_exists('aurl')){
    function aurl($url = null){
        return "/dashboard/{$url}";
    }
}