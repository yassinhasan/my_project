<?php
namespace core\app;

class upload
{
    protected $file;
    protected $file_name;
    protected $file_size;
    protected $file_type;
    protected $file_error;
    protected $file_extension;
    protected $file_temp_name;
    protected $error = [];
    public  $file_saved_name_in_db = null;

    public function __construct($file)
    {
        $this->file = $_FILES[$file];
        $this->getFileInfo($this->file);
        return $this;
    }

    public function getFileInfo($file)
    {
      $this->file_error = $file['error'];
      if(! $this->isUploaded($file)){
            $this->error['upload']['nofile'] = "sorry no file uploaded";
            
        }else
        {
            $this->file = $file;
            $this->file_name = $file['name'];
            $this->file_size = $file['size'];
            $this->file_temp_name = $file['tmp_name'];
            $file_extension = explode("/",$file['type']);
            $this->file_type = array_shift($file_extension);
            $this->file_extension = $file_extension[0]; 
        }
    }

    private function isUploaded()
    {
       if(isset($this->file))
       {
         return $this->file_error === 0 ? true : false;           
       } 

    }
    public function noError()
    {
        return empty($this->error);
    }

    public function move($destionaion)
    {
        if($this->noError())
        {
 
            $filename = \time().sha1(rand(0,1000)).".".$this->file_extension;        
            if(move_uploaded_file($this->file_temp_name,$destionaion.$filename))
            {
                $this->file_saved_name_in_db = $filename;
                return true;
            }
           
        }
        return false; 
        
    }
    public function getFileSavedNameInDb()
    {

        return $this->file_saved_name_in_db ;
    }

    public function showErrors()
    {
        return $this->error;
    }

}


/*
            // if not image

*/
/*
    //scenari
    /**
     * in request class
     * 
     * private file = [];
     * it will be like 
     * i will use /syste/http/fileupload
     * $this->request->file($file)
     * {
     * $fileinfo = $this->request->file($file);
     *  $this->file['file'] = new uploadfile($fileinfo);
     * return e$this->file['fil'];
     * 
     * }
     * 
     * */ 
    // secnario in fileupload class
    /**
     * so when i will write 
     * $file = $this->request->file($file); === it will create object from fileupload(contain file info)
     * so in fileupload class it will recieve file info
     * in constructor
     *  public function __construct($fileinfo)
     * {
     *  $this->file = $fileinfo /// array of file information
     * }
     * 
     * so  method file will return object of file upload 
     * 
     * in constrcutor method getfileinfoo() will return all info 
     *  pubblic function getinfo()
     * {
     *  $this->filename = $this->file['filename'];
     * use method pathinfo($filename); // will get extension and file name witouh extension
     * $info = pathinfo($this->filename);
     * 
     *  $this->filenameonly = $info['filename'];
     *  $this->extension = $info['filename'];
     *  $this->mimitype = $info['type'];
     *  $this->size = $this->file['type'];
     *  $this->error = $this->file['type'];
     * }
     * 
     * public function isfile()
     * {
     *   return ($this->error != upload_file_ok); 
     * }
     * 
     * pubcli function moveto($target , $filename = null)
     * {
     *      first prepare 
     * filename  =  sha1(math.rand(0,1000))."_".sha1(math.rand(0,1100));
     * filename .= $this->fileextemsion;
     * 
     * $target
     * }
     */
