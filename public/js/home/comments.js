
let logged_user_name_link = getElm("logged_user_name");
let loggedUserId = parseInt((logged_user_name_link.getAttribute("data-loggedUserId")).trim());
let loggedUserName = (logged_user_name_link.innerHTML).trim();

function clickedOnCommentsDiv()
{
   document.body.addEventListener("click",e=>
    {
       
        if(e.target.classList.contains("comments")  )
        {   
            let parent = e.target.parentElement.parentElement;
             let postId = e.target.getAttribute("data-postId");
            e.target.parentElement.classList.toggle("show");
            parent.querySelector(".comments_form_box").classList.toggle("hidden");
            let comments_form_box = parent.querySelector(".comments_form_box")
            if(!parent.querySelector(".comments_form_box").classList.contains("hidden"))
            {
     
                 comments_form_box.innerHTML = "";
                showCustomeSpinner(comments_form_box);
                prepareCommentsArea(postId)
            }
        }
    }); 
}

function prepareCommentsArea(postId)
{

         fetchComments(postId)
         loadCommentsForm(postId)

}

function loadCommentsForm(postId) {
   let comments_form_box = document.getElementById("comments_form_box_"+postId);
    let form = `<form class="comments_form" >
    <textarea class="comments_form_textarea form-control" placeholder="write your comments" name="comments_form_textarea" maxlength="200"></textarea>
    <button class="btn btn-secondary add_comment_btn" name="add_comment" type="submit" data-postId=${postId}>
        Add Comment
    </button>
`;
    comments_form_box.insertAdjacentHTML("beforeend",form);
}

function loadComments(data ,postId)
{
   let comments_form_box = document.getElementById("comments_form_box_"+postId);
   let commentsData = data.comment;
   let comments = `<div class="user_comments_box">`;
     if(commentsData.length > 0)
     {
        
       for (var i = commentsData.length; i--;) {
        let image = commentsData[i].profileImage == null ? 'avatar.jpg' : `${commentsData[i].firstName}${commentsData[i].lastName}/${commentsData[i].profileImage}`;
        comments +=  `
        <!-- start comment -->
          <div class="users_comments row">
                <div class="users_comments_image col-2">
                         <img src="../../public/uploades/images/profile/${image}" 
                         class = ""
                         alt = "..." >
                </div>
                <div class="users_comments_comment_area col-10">
                    <p class="user_comments_name">  <a href="/userPosts?id=${commentsData[i].userId}" style="color: #795548 ; text-decoration: none"> ${commentsData[i].firstName} ${commentsData[i].lastName}</a>
                        <span class="users_comments_comment_area_date">${commentsData[i].commentDate}</span>
                    </p>
                    <p class="users_comments_comment_area_comment">${commentsData[i].comment}</p>
              </div>
         </div>
        <!-- end comment -->
        </div>
        `;
                  
              }
         
     }else
     {
        comments +=  ` <span> Posts Has No Comments </pan> </div>`; 
     }
     
    comments_form_box.insertAdjacentHTML("afterbegin",comments);
     
}


// when click on add comment button

function clickedOnAddCommentBtn()
{
    document.body.addEventListener("click", e =>{
    if(e.target.classList.contains("add_comment_btn"))
    {
        let add_comment_btn = e.target;
        e.preventDefault();
        let comments_form_textarea = add_comment_btn.parentElement.querySelector(".comments_form_textarea");
        let comment = comments_form_textarea.value;
        let postId = add_comment_btn.getAttribute("data-postId");
        // 
        let comments_form_box = document.getElementById("comments_form_box_"+postId);
         showCustomeSpinner(comments_form_box);
        // 
        if (comment != "") {
            let formData = new FormData();
            formData.append('comment', comment);
            formData.append('postId', postId);
            let url = "/addComment";
            fetch(url, {
                    method: "POST",
                    body: formData
                })
                .then(resp => resp.json())
                .then(data => {
                  comments_form_textarea.value = "";
                  fetchComments(postId);
                  loadCommentsForm(postId);
                })
        
        }else
        {
            makeInvalidInput("comments_form_textarea" , "soory there is no comment added");
        }

    }
    });
}

function clickedOnCommentTextarea()
{
    document.body.addEventListener("keydown", e => {
    if(e.target.classList.contains("comments_form_textarea"))
    {
        removeAnyValidation()
    }
    })
}





function fetchComments(postId)
{

    let comments_form_box = document.getElementById("comments_form_box_"+postId);
    let formData = new FormData();
    formData.append('postId', postId);
    let url = "/fetchComments";
    
    fetch(url, {
                    method: "POST",
                    body: formData
    })
     .then(resp => resp.json())
     .then(data => {

      let comments_num_parents = document.getElementById("comments_"+postId);
      let comments_num_span = comments_num_parents.querySelector(".comments_num");
      if(data.comment.length > 0)
      {
              comments_num_span.innerHTML = data.comment[0].comments;  
      }else
      {
            comments_num_span.innerHTML = 0;
      }


      
      loadComments(data ,postId)
      removeCustomSpinner(comments_form_box);
      channel.bind('addComment', function(data) {

        console.log(data)
        let user_name  = "";
        if(data.userId == loggedUserId)
        {
           user_name = "You ";
        }else
        {
           user_name = data.userName ;
        } 
        realTimeNoti( data.userId ,user_name , " added comment ");
        });
     
     })
    
}

export { clickedOnCommentsDiv , clickedOnCommentTextarea , clickedOnAddCommentBtn} 