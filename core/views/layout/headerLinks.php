    <!-- Bootstrap CSS -->
     <link rel="icon" type="image/x-icon" href="../../public/uploades/images/icon.jpg">
    <?php 
       echo  "<link href='".$this->request->cssUrl("bootstrap.min")."?06' rel='stylesheet'> " ;
         echo  "<link href='".$this->request->cssUrl("vendor/all.min")."?06' rel='stylesheet'> " ;
       echo  "<link href='".$this->request->cssUrl("sweetalert2.min")."?06' rel='stylesheet'> " ;
   ?>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <?php 
       
        if(!empty($links["css"])) :
            foreach ($links["css"] as $link) :
                $file =  $this->request->cssUrl($link);
               echo  "<link href='".$file."?06' rel='stylesheet'> " ;
            endforeach;
        endif;
        echo  "<link href='".$this->request->cssUrl("main")."?06' rel='stylesheet'> " ;
    ?>
   <script src="<?= $this->request->jsUrl("sweetalert2.min")?>?50" charset="utf-8" ></script>  
    <!--PUSHER-->
    
    <?php 
       echo  "<script src='https://js.pusher.com/7.2/pusher.min.js'></script> " ;
     

   ?>
