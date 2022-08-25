let fa_photo_film = getElm("fa-photo-film");
let video_type = "video/";
let limit_video_size = 50;
const image_type = "image/";
const limit_image_size = 2;
let attachmentType = null;
let textarea_text_box = getElm("textarea_text_box");

function uploadAttach() {
    fa_photo_film.addEventListener("click", (e) => {
        let textarea_text = getElm("textarea_text");
       textarea_text.classList.remove("is-invalid");
        textarea_text.classList.remove("is-valid");
        let image_thumb_div = getElm("image_thumb_div");
        if (image_thumb_div) {
            image_thumb_div.innerHTML = "";
            image_thumb_div.remove();
        }
        let file_input = getElm("attachment");
        if (file_input) {
            file_input.remove();
        }
        let input = `<input type="file" name="attachment" id="attach_input" class="attachment"style="display: none">`;
        textarea_text_box.insertAdjacentHTML("afterbegin", input);
        let attach_input = document.querySelector(".attachment");
        attach_input.click();
         attach_input.addEventListener("change", e => {
            attachmentType = null;
            let file = e.target.files[0];
            let fileReader = new FileReader();
            if (file.type.includes(image_type)) {
                attachmentType = "image";
                fileReader.addEventListener("load", () => {
                    let textarea_text_box = getElm("textarea_text_box");
                    let image_thumb = `<div class="image_thumb_div">
                     <img src="${fileReader.result}" class="image_thumb"/>
                     </div>`;
                    textarea_text_box.insertAdjacentHTML("afterbegin", image_thumb);
                });
                fileReader.readAsDataURL(file);
               
            }
            else if (file.type.includes(video_type)) {
                attachmentType = "video";
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
                     let textarea_text_box = getElm("textarea_text_box");
                     let image_thumb = `<div class="image_thumb_div">
                     <img src="${image}" class="image_thumb"/>
                     </div>`;
                     textarea_text_box.insertAdjacentHTML("afterbegin", image_thumb);
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
             });
     });
}


export { uploadAttach  , attachmentType}
