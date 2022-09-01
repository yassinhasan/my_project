let loggedUserId;
let logged_user_name_link = getElm("logged_user_name");

if (logged_user_name_link) {
    loggedUserId = parseInt((logged_user_name_link.getAttribute("data-loggedUserId")).trim());
    let loggedUserName = (logged_user_name_link.innerHTML).trim();
}
let share_post_btn = getElm("share_post_btn");
let form = getElm("share_post_form");
let textarea_text = getElm("textarea_text");
let shar_post_box = getElm("shar_post_box");
let post_box = getElm("post_box");
let post_image = getElm("post_image");
let progress_div = getElm("progress_div");
let progress = getElm("progress");
let attach_input = document.querySelector(".attachment");

import { attachmentType  } from "./uploadattach.js";
import { attachNeedUpdate  } from "./edit.js";


function sharePost(mainSharePox , update = false)
{
        
      
        let form = mainSharePox.querySelector(".share_post_form");
        let textarea_text = mainSharePox.querySelector(".textarea_text");
        let shar_post_box =  mainSharePox.querySelector(".shar_post_box");
        let post_image = mainSharePox.querySelector(".post_image");
        let progress_div = mainSharePox.querySelector(".progress_div");
        let progress = mainSharePox.querySelector(".progress");
        let attach_input = document.querySelector(".attachment");
        let postId = mainSharePox.getAttribute("data-postId")
        removeAnyValidation();
        showCustomeSpinner(shar_post_box);
        
        let data = new FormData(form);
        data.append("attachmentType",  attachmentType.type);
     
        if(postId)
        {
              data.append("postId", postId);
              data.append("attachNeedUpdate", attachNeedUpdate.need);
              data.append("alreadyHasAttach", attachNeedUpdate.alreadyHasAttach);
              
        }
        let url = form.action;
        const req = new XMLHttpRequest(); // Initialize request
        req.open('POST', url); 
        req.upload.addEventListener('progress', function(e) {
           
            const percentComplete = (Math.floor(e.loaded) / Math.floor(e.total)) * 100;
            if ( attachmentType.type != null) {
                progress_div.style.display = "block";
                progress.style.width = percentComplete + "%";
                progress.innerHTML = "Uploading " + Math.floor(percentComplete) + "%";
                if (percentComplete == 100) {
                    progress.innerHTML = "Uploading complete ... be patient Until Post Your Post";
                    progress.style.backgroundColor = "#2b705c";
                }
            }

        })

        // Fires when upload is complete
        req.addEventListener('load', function() {
            if (req.status == 200) {
                let data = JSON.parse(req.response);
                removeCustomSpinner(shar_post_box);
                if (data.errors && data.errors.attachment == null) {
                    for (let err in data.errors) {
                        
                        if(update)
                        {
                             makeInvalidInput("update_input", data.errors[err])
                        }else
                        {
                             makeInvalidInput( err, data.errors[err])
                        }
                       
                        //  showAlert('danger' , 'Error' , data.errors[err])
                    }

                }
                else if (data.attachment) {
                    showAlert('danger', 'Error', data.attachment.attachment);

                }
                else if (data.success) {
                    textarea_text.value = "";
                    makevalidInput("post", data.success);
                    textarea_text.innerHTML = "";
                    preparePostBox(data);
                    //  showAlert('danger' , 'Error' , data.errors[err]);
                    progress_div.style.display = "none";
                    let post_image  = getElm("post_image");
                    if (post_image ) {
                        post_image .remove()
                    }
                    let remove_attach  = getElm("remove_attach");
                    if (remove_attach ) {
                        remove_attach .remove()
                    }
                    // hide modal
                }
                else if (data.sql_error) {

                    showAlert('error', 'Error', data.sql_error)
                }
                else if(data.updatePostOnly)
                {
                        updatePostOnly(data.updatePostOnly);
                        var myModal = document.getElementById('postEditModal');
                        let close_modal = myModal.querySelector(".close_modal");
                        close_modal.click()
                }
                progress_div.style.display = "none";
                let post_image  = getElm("post_image");
                if (post_image ) {
                    post_image .remove()
                }
                let remove_attach  = getElm("remove_attach");
                if (remove_attach ) {
                    remove_attach .remove()
                }
          
            }
            let attach_input = getElm("attachment");
            if (attach_input) {
                attach_input.remove();
                form.reset();
                attachmentType.type = null;
            }

        })

        req.send(data);
}

function clickedShareBtn() {
    let share_post_box = getElm("share_post_box");
    let clickedElm = share_post_box.querySelector(".share_post_btn");
    clickedElm.addEventListener("click", (e) => {
        e.preventDefault();
        sharePost(share_post_box);
    })
     
}
function updatePost(){
    
    let postEditModal = document.getElementById("postEditModal");
    let clickedElm = postEditModal.querySelector(".share_post_btn");
    clickedElm.addEventListener("click", (e) => {
        e.preventDefault();
        
        sharePost(postEditModal , true);
    })
}

function updatePostOnly(data)
{
    let post_box_details = document.getElementById("post_box_details_"+data.id);
    post_box_details.querySelector(".post_text").innerHTML = data.postText;
    post_box_details.querySelector(".post_date_release").innerHTML = "Modified at : "+data.postDateModified;
}
function preparePostBox(data) {
    
       let allPosts;
       if(data.lastPost)
       {
                 
             allPosts = data.lastPost; 
        }else if(data.posts)
        {
              post_box.innerHTML = "";
              allPosts = data.posts;
        }
        
        let post = "";
        if (allPosts.length > 0) {
            console.log(allPosts);
            for (var i = allPosts.length; i--;) {
                let type = allPosts[i].likeType;
                let postId = allPosts[i].id;
                let attachment = allPosts[i].attachment == null ? null : allPosts[i].attachment;
                let attachment_div = "";
                let attachment_type = allPosts[i].attachmentType;
               
                let post = allPosts[i].postText == "null" ? "" : allPosts[i].postText;
                if (attachment_type == "image") {
                    attachment_div = `
                    
                    <div class="post_attachment_div" data-type="${attachment_type}">
                    <img src="../../public/uploades/images/posts/image/${postId}/${attachment} " loading="lazy" class="post_attachment"/>
                    </div>`
                    ;
                }
                else if (attachment_type == "video") {
                    let src = attachment.split(".");
                    let filename = src[0];
                    let type = src[1];

                    attachment_div = `<div class="post_attachment_div" data-type="${attachment_type}">
                        <video  controls  class="video_attach post_attachment" loading="lazy">
                          <source src="../../public/uploades/images/posts/video/${postId}/${attachment}"  type="video/mp4" >
                          Your browser does not support the video tag.
                        </video>
                   </div>`;

                }
                let image = allPosts[i].profileImage == null ? 'avatar.jpg' : `${allPosts[i].firstName}${allPosts[i].lastName}/${allPosts[i].profileImage}`;
                let addEditBox = (loggedUserId != allPosts[i].userId) ? "" : `
                     <div class="edit_big_box col-1 showt_edit_div" data-show=${i}>
                                    <i class="fas fa-ellipsis-v"></i>
                                    <div class="edit_box" id="edit_box_${i}">
                                        <div class="edit_box_edit" data-postId="${postId}" data-bs-toggle="modal" data-bs-target="#postEditModal">edit</div>
                                        <div class="edit_box_delete" data-postId="${postId}">delete</div>
                                    </div>
                    </div>
                `;
                // start add post
                 post = `
                        <div class="post_box_details"  id="post_box_details_${postId}">
                              <div class="card-header row post_card_header">
                                <div class="col-11">
                                      <a href="/userPosts?id=${allPosts[i].userId}" class="userPosts_link">${allPosts[i].firstName} ${allPosts[i].lastName}</a>
                                </div>
                                  <!-- here edit -->
                                  ${addEditBox}
                                  <!-- here end edit -->
                              </div>
                            
                              <div class="card-body big_card_body">
                                <div class="row g-0">
                                    <div class="col-2 post_image_box">
                                        <img src="../../public/uploades/images/profile/${image}"  class="post_user_image" alt="...">
                                    </div>
                                    <div class="col-9">
                                      <div class="card-body">
                                        ${attachment_div}
                                        <p class="card-text post_text">${post}</p>
                                        <p class="card-text"><small class="text-muted post_date_release">${allPosts[i].postDate}</small></p>
                                    </div>
                                </div>
                               </div>
                                <!-- here comments -->
                               
                               <div class="card-body comments_box"> 
                                    <div class="comments" data-postId=${postId} id="comments_${postId}">
                                        <div class="comments-stats">
                                             <span class="comments_num">${allPosts[i].comments}</span>
                                             <span> comments</span>
                                        </div>
                               </div>
                                <!-- here form of comments -->
                                 <div class="comments_form_box hidden" id="comments_form_box_${postId}" data-postId=${postId}>
                                 </div>
                                <!-- end form of comments -->
                                <!-- end here comments -->
                            </div>
                            
                            <!-- likes -->
                                    <div class="likes_box">
                                        <div data-postId="${postId}" id="likes_box_${postId}">
                                            <div class="is_like">
                                                 <span class="likes_num no_of_likes">${allPosts[i].liked} </span>
                                                 <i class="fas fa-thumbs-up like_btn
                                                 ${type == 'like' ? 'active' : ''}" data-type="like"></i>
                                            </div>
                                             <div class="i_dislike">
                                                 <span class="dislikes_num no_of_likes"> ${allPosts[i].disliked} </span>                                 
                                                 <i class="fas fa-thumbs-down dislike_btn 
                                                 ${type == 'unlike' ? 'active' : ''}" data-type="unlike"></i> 
                                             </div>
                                        </div>

                                </div>
                            <!-- end likes -->
                        </div>
                        `;
                 if(data.lastPost)
                {
                    post_box.insertAdjacentHTML("afterbegin" , post)
                }
                else if(data.posts)
                {
                    post_box.innerHTML += post;
                }        
            }
            

        }
        else

        {
            post_box.innerHTML = "";
        }
        
        
         removeCustomSpinner(post_box);

    
}


function fetchPostsUrl() {
   
    showCustomeSpinner(post_box);
    let url = "/fetchPosts";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => {
          
            preparePostBox(data)

        })

}
fetchPostsUrl() 
function prepareTextarea() {
    textarea_text.addEventListener("keydown", (e) => {
        textarea_text.classList.remove("is-invalid");
        textarea_text.classList.remove("is-valid");
    })
    textarea_text.addEventListener("click", (e) => {
        textarea_text.classList.remove("is-invalid");
        textarea_text.classList.remove("is-valid");
    })

}

function showEditBox() {
    document.body.addEventListener("click", e => {

        // 2: first if popup is opened so check if i clicked on clsoed btn 
        // get that only pop and check it if contain show class
        // so remove all pop up contain show even that
        //3:  if not also remove all but keep it

        // 4: if clicked ouside popup or in popup or in any area not closed btn // remove only that popup

        // 1:  last if not popup click so oopen and add class show to it

        // this step will not happen at first time but at second time
        let edit_box = document.querySelector(".edit_box.show");
        if (edit_box) {
            if (e.target.classList.contains("showt_edit_div")) {


                // i will get only popup that related to edit btn 
                let id = e.target.getAttribute("data-show");
                let clickedEditBox = document.getElementById("edit_box_" + id);
                // then check if it already opened == answer is yes == so close all even it
                if (clickedEditBox.classList.contains("show")) {
                    let all_edit_box = document.querySelectorAll(".edit_box.show");
                    all_edit_box.forEach(elm => {
                        elm.classList.remove("show");
                    })
                }
                else {
                    // else that mean i click again on me so remove other popup and keep me
                    let all_edit_box = document.querySelectorAll(".edit_box.show");
                    all_edit_box.forEach(elm => {
                        elm.classList.remove("show");
                    })
                    clickedEditBox.classList.add("show");
                }
                return;
            };
            //   this happen only when i clicked outside popup 
            if (e.target != edit_box && e.target.parentElement != edit_box && !e.target.classList.contains("showt_edit_div")) {
                edit_box.classList.remove("show");
                return
            }


        }
        // this will happen when click at first time
        else if (e.target.classList.contains("showt_edit_div") && !edit_box) {

            let edit_box = e.target.querySelector(".edit_box");
            edit_box.classList.toggle("show")
        }

    })


}


function postDelete() {
    document.body.addEventListener("click", e => {
            if (e.target.classList.contains("edit_box_delete")) {
                e.target.parentElement.classList.remove("show");
               
                if(confirm("Are you sure you want to delete this post ?"))
                {
                    let postId = e.target.getAttribute("data-postId");
                    let post_box_details = document.getElementById("post_box_details_"+postId);
                    showCustomeSpinner(post_box_details);
                    let form = new FormData();
                    form.append("postId", postId);
                    let url = "/postDelete";
                    fetch(url, {
                            method: "POST" ,
                            body: form
                        })
                        .then(resp => resp.json())
                        .then(data => {
                           
                            if(data.delete == "success")
                            {
                                removeCustomSpinner(post_box_details);
                                post_box_details.remove();
                                showAlert("success" ,"Success !" , " you have deleted your post");
                            }
                        })                
                }


        }
    })
}
export { fetchPostsUrl, clickedShareBtn, preparePostBox, prepareTextarea, showEditBox , postDelete , updatePost}
