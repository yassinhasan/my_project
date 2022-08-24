let fa_photo_film = getElm("fa-photo-film");
let video_type = "video/";
let limit_video_size = 50;
const image_type = "image/";
const limit_image_size = 2;
let  textarea_text = getElm("textarea_text");
function uploadAttach()
{
   fa_photo_film.addEventListener("click",(e)=>
    {
        let input  = `<input type="file" name="postImages" id="attach_input" class="postImages"style="display: none">`;
        textarea_text.insertAdjacentHTML("afterbegin" , input);
        let attach_input = document.querySelector(".postImages");
        attach_input.click();
       attach_input.addEventListener("change",e=>{
          let file = e.target.files[0];
          let reader = new FileReader();
          reader.addEventListener("load",()=>
                {
                     let src = reader.result;
                     if(file.type.includes(image_type))
                    {
                     let textarea_text  = getElm("textarea_text ");
                     let image_thumb = `<img src="${src}" style="max-width:100px ; max - height: 100 px ;"/>`;
                     textarea_text.insertAdjacentHTML("afterbegin" , image_thumb);
                      }else if(file.type.includes(video_type))
                     {
                     console.log("video file");
                    }
                   
                 })
             reader.readAsDataURL(file);
        }); 
       })
       



    return true;
}


export {uploadAttach }