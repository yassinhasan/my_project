    <!-- Bootstrap CSS -->
    <?php 
       echo  "<link href='".$this->request->cssUrl("bootstrap.min")."?10' rel='stylesheet'> " ;
       echo  "<link href='".$this->request->cssUrl("vendor/all.min")."?10' rel='stylesheet'> " ;
   ?>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <?php 
       
        if(!empty($links["css"])) :
            foreach ($links["css"] as $link) :
                $file =  $this->request->cssUrl($link);
               echo  "<link href='".$file."?10' rel='stylesheet'> " ;
            endforeach;
        endif;
        echo  "<link href='".$this->request->cssUrl("main")."?10' rel='stylesheet'> " ;
    ?>
