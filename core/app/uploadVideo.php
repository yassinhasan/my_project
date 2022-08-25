<?php
namespace core\app;

class uploadVideo extends upload
{

    const ALLOWD_FILE_SIZE = 20000;
    private $allowed_Extension = [
        "WebM","MKV", "WebM" , "AVI" ,"FLV" , "WMV" , "MP4", "MPEG4" ,"MPEG-1","MPEG-2","MPEG4","MPG","MPEGPS","3GPP","DNxHR","ProRes","CineForm","HEVC (h265)"
    ];
    public function __construct($file)
    {
        parent::__construct($file);
        $this->checkErrors();

    }
    public function isAllowedExtension()
    {
        return in_array(strtoupper($this->file_extension) , $this->allowed_Extension);
    }
    public function isAllowedSize()
    {
        return ($this->file_size /  1048576) < self::ALLOWD_FILE_SIZE;
    }
    public function isVideo()
    {
        return $this->file_type === "video" ? true : false;
    }

    public function checkErrors()
    {
        if(! $this->isVideo())
        {
            $this->error[] = "sorry this file is not video";
        }else
        {
            // if not allowed extension
            if(! $this->isAllowedExtension())
            {
                $this->error[] = "soory this file is not allowed extension";
                
            }
            if(! $this->isAllowedSize())
            {
                $this->error[] = "soory this file is not allowed size";
                
            }
        }
    }

}
