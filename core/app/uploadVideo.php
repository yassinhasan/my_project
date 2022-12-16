<?php
namespace core\app;

class uploadVideo extends upload
{

    const ALLOWD_FILE_SIZE = 30000;
    private $allowed_Extension = [
        "webm,mkv,webm,avi,flv,wmv,mp4,mpeg4,mpeg-1,mpeg-2,mpeg4,mpg,mpegps,3gpp,dnxhr,prores,cineform,hevc (h265)"

    ];
    public function __construct($file)
    {
        parent::__construct($file);
        $this->checkErrors();

    }
    public function isAllowedExtension()
    {
        return in_array(strtolower($this->file_extension) , $this->allowed_Extension);
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
