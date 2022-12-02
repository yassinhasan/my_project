

let allcomments = {};
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
            let comments_form_box = parent.querySelector(".comments_form_box");
            let postuserId = comments_form_box.getAttribute("data-postuserId");
            if(!parent.querySelector(".comments_form_box").classList.contains("hidden"))
            {
                showCustomeSpinner(comments_form_box);
                fetchComments(comments_form_box , postId ,postuserId)
            }
        }
    }); 
}


// function loadCommentsForm(div ,postId) {
//     let alreadyform = document.querySelector(".comments_form_box");
//     let form = `<form class="comments_form" data-postId=${postId}>
//     <textarea class="comments_form_textarea form-control" placeholder="write your comments" name="comments_form_textarea" maxlength="200"></textarea>
//     <button class="btn btn-info add_comment_btn" name="add_comment" type="submit" data-postId=${postId}>
//         Add Comment
//     </button>
// `;
//     div.insertAdjacentHTML("afterend",form);
// }

function loadComments(commentsData , postId , postuserId)
{
   let comments_form_box = document.getElementById("comments_form_box_"+postId);
   let allcomments_div = comments_form_box.querySelector(".allcomments_div");
   if(allcomments_div){
   allcomments_div.innerHTML = "";
   }
   let comments = `<div class="user_comments_box">`;
   
     if(commentsData.length > 0)
     {
    //   console.log("looged useer = " + loggedUser.id)
    //   console.log("who add commnet useer = " + loggedUser.id)
       for (var i = commentsData.length; i--;) {
        let editbox = ``;
        if(loggedUser.id == postuserId)
        {

            if(commentsData[i].userId == loggedUser.id)
            {
               editbox = `<div class="edit_comment" data-postId="${postId}">
                       <i class="fa-solid fa-trash-can delete_comment_icon" data-commentId=${commentsData[i].id}></i>
                       <i class="fa-solid fa-pen-to-square edit_comment_icon" data-commentId=${commentsData[i].id}></i>
                </div>`;
            }if(commentsData[i].userId != loggedUser.id)
            {
                editbox = `<div class="edit_comment" data-postId="${postId}">
                       <i class="fa-solid fa-trash-can delete_comment_icon" data-commentId=${commentsData[i].id}></i>
                </div>`;
            }
        }else if (commentsData[i].userId == loggedUser.id && loggedUser.id != postuserId)
        {

            editbox = `<div class="edit_comment" data-postId="${postId}">
                       <i class="fa-solid fa-trash-can delete_comment_icon" data-commentId=${commentsData[i].id}></i>
                       <i class="fa-solid fa-pen-to-square edit_comment_icon" data-commentId=${commentsData[i].id}></i>
                </div>`; 
        }else
        {
            editbox = ``;
        }



        let image = commentsData[i].profileImage == null ? 'avatar.jpg' : `${commentsData[i].firstName}${commentsData[i].lastName}/${commentsData[i].profileImage}`;
        comments +=  `
        <!-- start comment -->
          <div class="users_comments row" id="users_comments_${commentsData[i].id}">
                <div class="users_comments_image col-2">
                         <img src="../../public/uploades/images/profile/${image}" 
                         class = ""
                         alt = "..." >
                </div>
                <div class="users_comments_comment_area col-10 row" >
                    <div  class="user_comments_name">  
                        <a href="/userPosts?id=${commentsData[i].userId}" style="color: #795548 ; text-decoration: none;font-size:14px"> ${commentsData[i].firstName} ${commentsData[i].lastName}</a>
                        <span class="users_comments_comment_area_date">${commentsData[i].commentDate}</span>
                    </div>
                     <div>
                     <p class="users_comments_comment_area_comment">${commentsData[i].comment}</p>
                    </div>
                </div>
               <!-- edit -->
                     ${editbox}
                <!-- edit -->
         </div>
        <!-- end comment -->
        </div>
        `;
                  
              }
         
     }else
     {
        comments +=  ` <span class="post_han_no_comment"> Posts Has No Comments </pan> </div>`; 
     }
     
    if(allcomments_div){
    allcomments_div.insertAdjacentHTML("afterbegin",comments);
    }
    let comments_form = comments_form_box.querySelector(".comments_form_wraper");
    if(comments_form){
    comments_form.innerHTML = `<form class="comments_form" data-postId=${postId}>
                <textarea class="comments_form_textarea form-control" placeholder="write your comments" name="comments_form_textarea" maxlength="200"></textarea>
                <button class="btn btn-info add_comment_btn" name="add_comment" type="submit" data-postId=${postId}>
                Add Comment
                </button>
             `;
    }
 
}

// when click on add comment button
function clickedOnAddCommentBtn()
{
    document.body.addEventListener("click", e =>{
    if(e.target.classList.contains("add_comment_btn"))
    {
        let add_comment_btn = e.target;
        e.preventDefault();
        let comments_form= add_comment_btn.parentElement;
        let comments_form_wraper= comments_form.parentElement;
        let comments_form_box = comments_form_wraper.parentElement;
        let comments_form_textarea = add_comment_btn.parentElement.querySelector(".comments_form_textarea");
        let allcomments_div = comments_form_box.querySelector(".allcomments_div");
        let comment = comments_form_textarea.value;
        let postId = comments_form.getAttribute("data-postId");
        let postUserId = comments_form_box.getAttribute("data-postUserId");
        let addnotfication = false; 
        
        if(!emptyObj(allcomments))
        {
           
            if(allcomments["postId"+postId].commentsNo == 0 &&  loggedUser.id == postUserId)
            {
                addnotfication = false;
            }else if(allcomments["postId"+postId].commentsNo > 0 &&  allcomments["postId"+postId].allcommentsUsers.length > 1 )
            {
                addnotfication = true;
            }else if(allcomments["postId"+postId].commentsNo >= 0 &&  loggedUser.id != postUserId )
            {
                 addnotfication = true;
            }  
        }
   
         showCustomeSpinner(comments_form_wraper);
        // 
        if (comment != "") {
            let formData = new FormData();
            formData.append('comment', comment);
            formData.append('postId', postId);
            formData.append('postUserId', postUserId);
            formData.append('addnotfication', addnotfication);
            formData.append("userName" , loggedUser.name);
            if(addnotfication == true)
            {
               formData.append('allcommentsUsers', allcomments["postId"+postId].allcommentsUsers.toString()); 
            }
            let url = "/addComment";
            fetch(url, {
                    method: "POST",
                    body: formData
                })
                .then(resp => resp.json())
                .then(data => {
                  comments_form_textarea.value = "";
                  fetchComments(comments_form_box, postId ,postUserId);
                 
                })
        
        }else
        {
           removeCustomSpinner(comments_form_wraper);
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
function fetchComments(div ,postId , postUserId)
{

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
              allcomments["postId"+postId] = {
                  commentsNo: parseInt(data.comment[0].comments),
                  allcommentsUsers : data.comment[0].allcommentsUsers.split(",")

              };
              ;

      }else
      {
            comments_num_span.innerHTML = 0;
      }
      
      
      loadComments(data.comment ,postId, postUserId)
      removeCustomSpinner(div);

     
     })
    
}
function editComment()
{
    let comment_tobedit ={};
    let edit = false;
    document.body.addEventListener("click", e =>{
       
    if(e.target.classList.contains("edit_comment_icon") && edit == false)
    {
       let edit_comment_icon = e.target;
       let users_comments_comment_area = edit_comment_icon.parentElement.parentElement;
       let commentId = edit_comment_icon.getAttribute("data-commentId");
       let users_comments_comment_area_comment = users_comments_comment_area.querySelector(".users_comments_comment_area_comment");
       comment_tobedit.comment = users_comments_comment_area.querySelector(".users_comments_comment_area_comment").innerHTML;
       let postId = users_comments_comment_area.parentElement.parentElement.getAttribute("data-postId");
       users_comments_comment_area_comment.innerHTML = `<textarea class="users_comments_comment_area_comment_textarea form-control" name="users_comments_comment_area_comment_textarea" maxlength="200">${comment_tobedit.comment}</textarea>`;
       edit = true;
       let users_comments_comment_area_comment_textarea = users_comments_comment_area_comment.querySelector(".users_comments_comment_area_comment_textarea");
       users_comments_comment_area_comment_textarea.addEventListener("blur",(e)=>
       {
          
           users_comments_comment_area_comment.innerHTML = users_comments_comment_area_comment_textarea.value ;
           let form = new FormData();
           form.append('comment', users_comments_comment_area_comment_textarea.value);
           form.append('id', commentId);
           fetch("/updateComment" ,
           {    
              method: "POST",
              body: form
           })
           .then(resp => resp.json())
           .then(data => {
               if (data.update) {
                   edit = false;
               }else
               {
                   console.log("error")
               }
           })
           
       })
        
    }
    else if(e.target.classList.contains("delete_comment_icon"))
    {
      
       let delete_comment_icon = e.target;
       
       let edit_box = delete_comment_icon.parentElement;
       let postId = edit_box.getAttribute("data-postId");
       let postBox = document.getElementById("comments_" + postId);
       let comment_num_span = postBox.querySelector(".comments_num");
       let comment_num = parseInt(comment_num_span.innerHTML);
       comment_num_span.innerHTML = comment_num - 1 ;
       let commentId = delete_comment_icon.getAttribute("data-commentId"); 
       let users_comments = document.getElementById("users_comments_"+commentId)
       users_comments.remove();
           let form = new FormData();
           form.append('id', commentId);
           fetch("/deleteComment" ,
           {    
              method: "POST",
              body: form
           })
           .then(resp => resp.json())
           .then(data => {
               if (data.delete) {
                     console.log("delete done");
                   
               }else
               {
                   console.log("error")
               }
           })
    }
    
})

}
editComment()
export { clickedOnCommentsDiv , clickedOnCommentTextarea , clickedOnAddCommentBtn} 