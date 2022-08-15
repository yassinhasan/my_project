
// when click on add comment button

function clickedOnAddLiketBtn()
{
    document.body.addEventListener("click", e =>{
    if(e.target.classList.contains("like_btn") || e.target.classList.contains("dislike_btn"))
    {

        let liked_btn = e.target;
        e.preventDefault();
        //parent
        let parent = liked_btn.parentElement;
        // span contain no of likes or dislikes
        let no_of_likes_span = parent.querySelector(".no_of_likes");
        let likes = no_of_likes_span.innerHTML;
        
        let postId = parent.parentElement.getAttribute("data-postId");
        let likes_box = document.getElementById("likes_box_"+postId);
        handleActiveClass(likes_box , liked_btn);
        showCustomeSpinner(likes_box);
        let type = liked_btn.getAttribute("data-type");
        let formData = new FormData();
            formData.append('type', type);
            formData.append('postId', postId);
            let url = "/addLike";
            fetch(url, {
                    method: "POST",
                    body: formData
                })
                .then(resp => resp.json())
                .then(data => {
                  fetchLikes(postId);
                })
        
        }

    
    });
}

// fetch likes
function fetchLikes(postId)
{
    let post_box_details = document.getElementById("post_box_details_"+postId);
    let likes_span = post_box_details.querySelector(".likes_num");
    let dislikes_span = post_box_details.querySelector(".dislikes_num");

    let formData = new FormData();
    formData.append('postId', postId);
    let url = "/fetchLikes";
    
    fetch(url, {
          method: "POST",
          body: formData
    })
     .then(resp => resp.json())
     .then(data => {
            likes_span.innerHTML = data.likes.liked;
            dislikes_span.innerHTML = data.likes.disliked;
            let likes_box = document.getElementById("likes_box_"+postId);
            removeCustomSpinner(likes_box);
     })
  
}

function handleActiveClass(parent , target)
{
    parent.querySelector(".fa-thumbs-down").classList.remove("active");
     parent.querySelector(".fa-thumbs-up").classList.remove("active");
     target.classList.add("active");
}





export { clickedOnAddLiketBtn } 

