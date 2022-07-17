<?php
namespace core\app;

class uploadImage extends upload
{

    const ALLOWD_FILE_SIZE = 2;
    private $allowed_Extension = [
        "gif","jpeg", "png" , "pdf"
    ];
    public function __construct($file)
    {
        parent::__construct($file);
        $this->checkErrors();

    }
    public function isAllowedExtension()
    {
        return in_array($this->file_extension , $this->allowed_Extension);
    }
    public function isAllowedSize()
    {
        return ($this->file_size /  1048576) < self::ALLOWD_FILE_SIZE;
    }
    public function isImage()
    {
        return $this->file_type === "image" ? true : false;
    }

    public function checkErrors()
    {
        if(! $this->isImage())
        {
            $this->error[] = "sorry this file is not image";
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
