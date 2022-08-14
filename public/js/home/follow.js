import {fetchPostsUrl } from "./posts.js"
function follow_unfollow_System(parent , follow_btn ,follower_num , followerId,status){
        let f_number = parseInt(follower_num.innerHTML);
        if(status == "approve")
        {
            f_number -= 1 ;
           follower_num.innerHTML = f_number;
            follow_btn.innerHTML = "follow"; 
            follow_btn.classList.remove("unfollow");
            follow_btn.classList.add("follow");
        }else
        {
            f_number += 1;
            follower_num.innerHTML = f_number;
            follow_btn.innerHTML = "unfollow";
            follow_btn.classList.add("unfollow");
              follow_btn.classList.remove("follow");
        }
        let changedStatus ;
        if (status == "approve")
        {
            changedStatus = 'NULL';
        }else
        {
            changedStatus = "approve";
        }
        
        parent.setAttribute("data-status" , changedStatus)
        fetchUpdateUserFollowSystem(followerId , changedStatus)
}

function fetchUpdateUserFollowSystem(followerId , status)
{
   let formData = new FormData();
    formData.append('status', status);
    formData.append('followerId', followerId);
    let url = "/fetchUpdateUserFollowSystem";
    fetch(url, {
            method: "POST" ,
            body  : formData
        })
        .then(resp => resp.json())
        .then(data =>  {fetchPostsUrl()} )
}

function clickedOnFollowBtn()
{
  document.body.addEventListener("click",(e)=>
{
    if(e.target.classList.contains("follow_btn"))
    {
        let follow_btn = e.target;
        let parent = follow_btn.parentElement;
        let follower_num = parent.querySelector(".follower_num");
        let followerId = parent.getAttribute("data-id");
        let status = parent.getAttribute("data-status");
        follow_unfollow_System(parent , follow_btn , follower_num,followerId,status);
    }
})  
}

export {clickedOnFollowBtn}



