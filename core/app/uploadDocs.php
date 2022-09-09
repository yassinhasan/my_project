<?php
namespace core\app;

class uploadDocs extends upload
{

    const ALLOWD_FILE_SIZE = 30;
    private $allowed_Extension = [
        "doc","docx", "odt" , "xls" , "pdf","xlsx" , "ods" , "ppt" , "pptx" ,"txt" ,"vnd.ms-excel"
    ];
    public function __construct($file)
    {
        parent::__construct($file);
       
        $this->checkErrors();

    }
    public function isAllowedExtension()
    {
        return in_array($this->file_extension, $this->allowed_Extension);
    }
    public function isAllowedSize()
    {
        return ($this->file_size /  1048576) < self::ALLOWD_FILE_SIZE;
    }
    public function checkErrors()
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
