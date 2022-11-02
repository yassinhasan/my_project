import {remove_attach , attachNeedUpdate } from "./edit.js"
let attachmentType = 
{
    type : null
}
let attachmentEroors = 
{
    nofile : true ,
    type: false ,
    size: false,
    allowed_size : null
}
function uploadAttach(main_box ,default_clicked_elm  , edit =false) {
    let video_type = "video/";
    let limit_video_size = 30;
    const image_type = "image/";
    const docs_type = [
        "text/plain" ,
        "application/vnd.ms-excel",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "application/pdf" ,
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document"
        ];
    const limit_document_size = 40;
    const limit_image_size = .1;
    let allowed_type = [
        "text/plain" ,
        "application/vnd.ms-excel",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "application/pdf" ,
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document" ,
        "video/" ,
        "image/jpeg"
        ];
    default_clicked_elm.addEventListener("click", (e) => {
      let  attach_input =  reet(main_box);
      attach_input.click();
      attach_input.addEventListener("change", e => {
      removeAnyValidation();     
            let file = e.target.files[0];
             if(file)
             {
                 
                 attachNeedUpdate.need = true;    
                 attachmentEroors.nofile = false;
 
                  let fileReader = new FileReader();
                  //  image
                  if (file.type.includes(image_type)){
                      
                    if((file.size / 1000000) > limit_image_size) {
                        
                        attachmentEroors.size = true;
                         attachmentEroors.allowed_size = limit_image_size;
                          makeInvalidInput("textarea_text", "Sorry size type not allowed allowed size is "+ attachmentEroors.allowed_size + "MG" ); 
                         
                    }
                     
                       attachmentType.type = "image";
                        fileReader.addEventListener("load", () => {
                         let post_edit_image = main_box.querySelector(".post_edit_image");
                               post_edit_image.innerHTML="";
                                    let image_thumb = `
                                    <img src="${fileReader.result}" class="post_image img-fluid"/>
                                    <i class="fas fa-close remove_attach"></i>
                                    `;
                        post_edit_image.insertAdjacentHTML("afterbegin", image_thumb);
                       
                         remove_attach()
                                    
                        });
                        fileReader.readAsDataURL(file);
                       
                    }
 
                  //  video
                  else if (file.type.includes(video_type) )
                   {
                       if( (file.size / 1000000) > limit_video_size) {
                           attachmentEroors.size = true;
                            attachmentEroors.allowed_size = limit_video_size;
                             makeInvalidInput("textarea_text", "Sorry size type not allowed allowed size is "+ attachmentEroors.allowed_size + "MG" ); 
                       }
                         attachmentType.type = "video";
                        fileReader.onload = function() {
                          var blob = new Blob([fileReader.result], {type: file.type});
                          var url = URL.createObjectURL(blob);
                          var video = document.createElement('video');
                          var timeupdate = function() {
                            if (snapImage()) {
                              video.removeEventListener('timeupdate', timeupdate);
                              video.pause();
                            }
                          };
                          video.addEventListener('loadeddata', function() {
                            if (snapImage()) {
                              video.removeEventListener('timeupdate', timeupdate);
                            }
                          });
                          var snapImage = function() {
                            var canvas = document.createElement('canvas');
                            canvas.width = video.videoWidth;
                            canvas.height = video.videoHeight;
                            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                            var image = canvas.toDataURL();
                            var success = image.length > 100000;
                            if (success) {
                              var img = document.createElement('img');
                              img.src = image;
                                    let post_edit_image = main_box.querySelector(".post_edit_image");
                                    post_edit_image.innerHTML="";
                                    let image_thumb = `
                                    <img src="${image}" class="post_image img-fluid"/>
                                    <i class="fas fa-close remove_attach"></i>
                                     `;
                                    post_edit_image.insertAdjacentHTML("afterbegin", image_thumb);
                                   
                                     remove_attach();
        
                              URL.revokeObjectURL(url);
                            }
                            return success;
                          };
                          video.addEventListener('timeupdate', timeupdate);
                          video.preload = 'metadata';
                          video.src = url;
                          // Load video in Safari / IE11
                          video.muted = true;
                          video.playsInline = true;
                          video.play();
                        };
                        fileReader.readAsArrayBuffer(file);
                       
                  }
                  // document
                  else  if (docs_type.includes(file.type))
                  { 
                          if((file.size / 1000000) > limit_document_size)
                          {
                                attachmentEroors.size = true;
                                attachmentEroors.allowed_size = limit_document_size;
                             makeInvalidInput("textarea_text", "Sorry size type not allowed allowed size is "+ attachmentEroors.allowed_size + "MG" ); 
                          }

                        attachmentType.type = "document";
                        fileReader.addEventListener("load", () => {
                         let post_edit_image = main_box.querySelector(".post_edit_image");
                               post_edit_image.innerHTML="";
                                    let image_thumb = `
                                    <div class="file_thumb_div post_image">
                                        <i class="fas fa-file file_thumb"></i>
                                        <span class="filename">${file.name}</span>
                                    </div>
                                    <i class="fas fa-close remove_attach"></i>
                                    `;
                        post_edit_image.insertAdjacentHTML("afterbegin", image_thumb);
                       
                         remove_attach()
                                    
                        });
                        fileReader.readAsDataURL(file);
                       
                }
                else
                {
                                            attachmentType.type = "document";
                        fileReader.addEventListener("load", () => {
                         let post_edit_image = main_box.querySelector(".post_edit_image");
                               post_edit_image.innerHTML="";
                                    let image_thumb = `
                                    <div class="file_thumb_div post_image">
                                        <i class="fas fa-file file_thumb"></i>
                                        <span class="filename">${file.name}</span>
                                    </div>
                                    <i class="fas fa-close remove_attach"></i>
                                    `;
                        post_edit_image.insertAdjacentHTML("afterbegin", image_thumb);
                       
                         remove_attach()
                                    
                        });
                        fileReader.readAsDataURL(file);
                    attachmentEroors.type = true;
                    makeInvalidInput("textarea_text", "Sorry this type not allowed" ); 
                }
                
             }
                 
               
             
              
             

           
     })          
   
        })

}

function reet(main_box)
{
    attachmentType.type = null;
    attachmentEroors.nofile = true ;
    attachmentEroors.type= false ;
    attachmentEroors.size= false;
    attachmentEroors.allowed_size = null;
    let textarea_text = main_box.querySelector(".textarea_text");
    let textarea_text_box = main_box.querySelector(".textarea_text_box");
    textarea_text.classList.remove("is-invalid");
    textarea_text.classList.remove("is-valid");
    let image_thumb_div = getElm("image_thumb_div");
    if (image_thumb_div) {
            image_thumb_div.innerHTML = "";
            image_thumb_div.remove();
    }
    let file_input = main_box.querySelector(".attachment");
         
    if (file_input) {
            file_input.remove();
   }
   let input = `<input type="file" name="attachment" id="attach_input" class="attachment"style="display: none" > `;
   textarea_text_box.insertAdjacentHTML("afterbegin", input);
   let attach_input = main_box.querySelector(".attachment");
    return attach_input;
}

export { uploadAttach  , attachmentType  , attachmentEroors}