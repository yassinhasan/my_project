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

    $cut_post ="";
    $remian_post ="";
    if(strlen($post) > 300)
    {
        $cut_post = substr($post,0 ,300);
        $remian_post = substr($post , 300);
        $post = "<span class='cut_post'>$cut_post</span><a href='/showPost?postId=$postId'> ... read More </a><p class='remain_post'>$remian_post</p>";

    }else
    {
        $post = "<p class='cut_post'>$post</p>";
    }
    return $post;
}
function handle_file_name($file_name)
{
    if(strlen($file_name) > 15)
    {
        $file_name = explode(".",$file_name);
        $extension = end($file_name);
        $startfilename = substr($file_name[0],0 ,8);
        $lastfilename=  substr($file_name[0],-4);;
        $file_name = $startfilename."...".$lastfilename.".".$extension;
    }
    
    return $file_name;
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
