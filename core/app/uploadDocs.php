<?php
namespace core\app;

class uploadDocs extends upload
{

    const ALLOWD_FILE_SIZE = 30;
    private $allowed_Extension = [
        "DOC","DOCX", "ODT" , "XLS" , "PDF","XLSX" , "ODS" , "PPT" , "PPTX" ,"TXT"
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
    public function isDocument()
    {
        return $this->file_type === "document" ? true : false;
    }

    public function checkErrors()
    {
        if(! $this->isDocument())
        {
            $this->error[] = "sorry this file is not document";
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
