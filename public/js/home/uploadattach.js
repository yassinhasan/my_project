import {remove_attach , attachNeedUpdate } from "./edit.js"
let attachmentType = 
{
    type : null
}
function uploadAttach(main_box ,default_clicked_elm  , edit =false) {
    let textarea_text = main_box.querySelector(".textarea_text");
    let textarea_text_box = main_box.querySelector(".textarea_text_box");
    let video_type = "video/";
    let limit_video_size = 50;
    const image_type = "image/";
    const limit_image_size = 2;
    default_clicked_elm.addEventListener("click", (e) => {
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
        let input = `<input type="file" name="attachment" id="attach_input" class="attachment"style="display: none">`;
        textarea_text_box.insertAdjacentHTML("afterbegin", input);
        let attach_input = main_box.querySelector(".attachment");
        attach_input.click();
         attach_input.addEventListener("change", e => {
            attachmentType.type = null;
            let file = e.target.files[0];
             if(file)
             {
                 let fileReader = new FileReader();
                 if (file.type.includes(image_type)) {
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
                 else if (file.type.includes(video_type)) {
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
                 attachNeedUpdate.need = true;                 
             }

             });
     });          
   

}


export { uploadAttach  , attachmentType }