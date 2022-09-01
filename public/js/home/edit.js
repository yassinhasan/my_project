import {uploadAttach , attachmentType} from "./uploadattach.js";
let attachNeedUpdate = 
{
    need : false , 
    alreadyHasAttach : false
}
function postEdit() {
    document.body.addEventListener("click", e => {
            if (e.target.classList.contains("edit_box_edit")) {
                attachNeedUpdate.need = false;
                
                e.target.parentElement.classList.remove("show");
                    let postId = e.target.getAttribute("data-postId");
                    let post_box_details = document.getElementById("post_box_details_"+postId);
                    let postEditModal = document.getElementById("postEditModal");
                    postEditModal.setAttribute("data-postId", postId);
                    let userName = post_box_details.querySelector(".userPosts_link").innerHTML;
                    
                    let post_attachment_div = post_box_details.querySelector(".post_attachment_div");
                    let attach_div = "";
                    if(post_attachment_div)
                    {
                        let postAttach = post_box_details.querySelector(".post_attachment_div");
                        let attach_type = postAttach.getAttribute("data-type");
                        let attach = postAttach.querySelector(".post_attachment");
                        let postAttachSrc;
                       
                       switch (attach_type) {
                           case 'image':
                                 postAttachSrc = attach.src;  
                               attach_div = ` 
                               <img class="post_image img-fluid"  src="${postAttachSrc}" alt="" data-type="${attach_type}"/>
                               <i class="fas fa-close remove_attach"></i>
                               `;
                               attachNeedUpdate.alreadyHasAttach  = true;
                               break;
                           case 'video':
                               let videoHasSrc = postAttach.getElementsByTagName("source")[0];
                                postAttachSrc = videoHasSrc.src;
                                attach_div = `
                                    <video  controls  class="img-fluid" loading="lazy">
                                      <source src="${postAttachSrc}"  type="video/mp4" >
                                      Your browser does not support the video tag.
                                    </video>
                                    <i class="fas fa-close remove_attach"></i>
                                    `
                                     attachNeedUpdate.alreadyHasAttach  = true;
                                break;
                           default:
                              attach_div =   "";
                       }
                      
                    }
                    
                    let post_text = post_box_details.querySelector(".post_text");
                    let post = post_text.innerHTML;
                document.querySelector(".modal-title").innerHTML =    userName;
                let modal_body = `
                   <div class="card">
                          <div class="card-body shar_post_box">
                              <form class="share_post_form" action="/postEdit" enctype="multipart/form-data">
                                <div class="mb-3" style="margin-bottom: 5px">
                                    <div class="textarea_text_box">
                                    <div class="post_edit_image"> 
                                        ${attach_div}
                                        
                                    </div>
                                     
                                        <textarea  name="post" class="form-control textarea_text update_input" id="Write_Post" >${post}</textarea>
                                    </div>
                                </div>
                                <div class="share_post_attach row ">
                                     <div class="add_attach col-1">
                                     <i class="fa-solid fa-photo-film"></i>
                                    </div>
                                    <div class="add_audio col-1">
                                        <i class="fa-solid fa-volume-high"></i>
                                    </div>
                                </div>
                              </form>
        
                          </div>
                        </div>
                    <div class="progress_div">
                        <span class="progress"></span>
                    </div>
                `;
                document.querySelector(".modal-body").innerHTML = modal_body;
            let post_image = postEditModal.querySelector(".post_image");
            let default_clicked_elm  = postEditModal.querySelector(".fa-photo-film");
            let file_input = postEditModal.querySelector(".attachment");
            if (file_input) {
             file_input.remove();
            }
            uploadAttach(postEditModal  ,default_clicked_elm,true);
            if(post_image) uploadAttach(postEditModal ,post_image ,true);
            remove_attach()
            }
    })
}


function remove_attach()
{
                //remove attah when click
    let remove_attach = getElm("remove_attach");
 
    if(remove_attach)
    {
         remove_attach.addEventListener("click",e=>
          {
              
             attachmentType.type = null;
             attachNeedUpdate.need = true;
             remove_attach.parentElement.innerHTML = "";
          })
    }
}


export {postEdit , remove_attach , attachNeedUpdate}
