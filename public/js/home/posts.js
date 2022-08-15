let share_post_btn = getElm("share_post_btn");
let form = getElm("share_post_form");
let textarea_text = getElm("textarea_text");
let shar_post_box = getElm("shar_post_box"); 
let post_box = getElm("post_box");
  function clickedShareBtn()
{
   
share_post_btn.addEventListener("click", (e) => {
    e.preventDefault();
    removeAnyValidation();
    showCustomeSpinner(shar_post_box);
    let data = new FormData(form);
    let url = form.action;
    fetch(url, {
            method: "post",
            body: data
        })
        .then(resp => resp.json())
        .then(data => {
            removeCustomSpinner(shar_post_box);
            if (data.errors) {
                for (let err in data.errors) {

                    makeInvalidInput(err, "textarea", data.errors[err])
                    //  showAlert('danger' , 'Error' , data.errors[err])
                }

            }
            else if (data.success) {

                textarea_text.value = "";
                makevalidInput("post", data.success);
                preparePostBox(data);
                //  showAlert('danger' , 'Error' , data.errors[err])


            }
            else if (data.sql_error) {

                showAlert('error', 'Error', data.sql_error)
            }
        })
});
}


 function preparePostBox(data) {
    if (data.posts) {
        
        let allPosts = data.posts;
       
        
        if (allPosts.length > 0) {
            post_box.innerHTML = "";
            for (var i = allPosts.length; i--;) {
                let  postId = allPosts[i].id;
                let image = allPosts[i].image == null ? 'avatar.jpg' : `${allPosts[i].firstName}${allPosts[i].lastName}/${allPosts[i].image}`;
                post_box.innerHTML += `
                        <div class="post_box_details"  id="post_box_details_${postId}">
                              <div class="card-header">
                                ${allPosts[i].firstName} ${allPosts[i].lastName}
                              </div>
                              <div class="card-body big_card_body">
                                <div class="row g-0">
                                    <div class="col-md-4 post_image_box">
                                        <img src="../../public/uploades/images/profile/${image}"  class="img-fluid rounded-start  post_user_image" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                      <div class="card-body">
                                        <p class="card-text">${allPosts[i].postText}</p>
                                        <p class="card-text"><small class="text-muted">Post Date : ${allPosts[i].postDate}</small></p>
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
                                 <div class="comments_form_box hidden" id="comments_form_box_${postId}">
                                 </div>
                                <!-- end form of comments -->
                                <!-- end here comments -->
                            </div>
                            
                            <!-- likes -->
                                    <div class="likes_box">
                                        <div data-postId="${postId}" id="likes_box_${postId}">
                                            <div class="is_like">
                                                 <span class="likes_num no_of_likes">          ${allPosts[i].liked} </span>
                                                 <i class="fas fa-thumbs-up like_btn" data-type="like"></i>
                                            </div>
                                             <div class="i_dislike">
                                                 <span class="dislikes_num no_of_likes">      ${allPosts[i].disliked} </span>                                 
                                                 <i class="fas fa-thumbs-down dislike_btn"        data-type="unlike"></i> 
                                             </div>
                                        </div>

                                </div>
                            <!-- end likes -->
                        </div>
                        `;
            }

        }
        else

        {
            post_box.innerHTML = "No Posts";
        }
        
        removeCustomSpinner(post_box);

    }
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

function prepareTextarea()
{
    textarea_text.addEventListener("keydown", () => {
    textarea_text.classList.remove("is-invalid");
    textarea_text.classList.remove("is-valid");
})
}

export {fetchPostsUrl , clickedShareBtn , preparePostBox  , prepareTextarea}