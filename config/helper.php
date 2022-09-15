<?php

if(!function_exists("pre"))
{
    /**
     *  functio to print variables in pretty format
     *  @param variable $var
     *  @return void
     */
    function pre($var)
    {
        
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }
} 

function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}

function readMore($post , $postId)
{
    if(strlen($post) > 300)
    {
        $post = substr($post,0 ,300);
        $href = "<a href='/showPost?postId=$postId'> read More... </a>";
        $post = $post."  ".$href;
    }
    return $post;
}

function tolower($array)
{
   $newarray =  array_map("makelower" , $array);
   $newstring = join(",",$newarray);
   pre($newstring);
}

function makelower($var)
{
    return strtolower($var);
}
// $allowed_Extension = [
//     "WebM","MKV", "WebM" , "AVI" ,"FLV" , "WMV" , "MP4", "MPEG4" ,"MPEG-1","MPEG-2","MPEG4","MPG","MPEGPS","3GPP","DNxHR","ProRes","CineForm","HEVC (h265)"
// ];
// tolower($allowed_Extension);
