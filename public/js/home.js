



// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;



// comments area

import { clickedOnCommentsDiv , clickedOnCommentTextarea , clickedOnAddCommentBtn} from "./home/comments.js"
 clickedOnCommentsDiv();
clickedOnCommentTextarea();
clickedOnAddCommentBtn();


// likes

import { clickedOnAddLiketBtn } from "./home/likes.js"
 clickedOnAddLiketBtn();


// import notifications  getNotifications

getNotifications();
 // realTimeNoti( 1 ,"hasn meady" , "is online now");

import {uploadAttach} from "./home/uploadattach.js";

let share_post_box = getElm("shar_post_box");
let attach_elm  = share_post_box.querySelector(".fa-photo-film"); 
uploadAttach(share_post_box , attach_elm);



// must be after uplaod 
import {fetchPostsUrl, clickedShareBtn , preparePostBox , prepareTextarea ,showEditBox , postDelete , updatePost } from "./home/posts.js";

clickedShareBtn();
prepareTextarea();
showEditBox();
postDelete();
updatePost();
fetchPostsUrl();



//edit posts
import {postEdit } from "./home/edit.js"
postEdit();
//fetch all users
import {fetchUsers , prepareUsersBox} from "./home/users.js"
fetchUsers();
// chat 

import { showPrivateChatArea  } from "./home/chat.js"
showPrivateChatArea();
function notifyMe() {
 if (Notification.permission !== 'granted')
  Notification.requestPermission();
 
}
notifyMe();


// import {Newpost} from "./home/newpost.js"

// let ha = new Newpost();
// ha.setPostId("1");
// ha.setPost("helllasd iam hasan")
// let st = ha.getPost();
// console.log(st);
// follow un follow system 
import {clickedOnFollowBtn} from "./home/follow.js"
clickedOnFollowBtn();
window.addEventListener("scroll", function(e) { 
 
    let post_box = document.querySelector(".post_box");
    let offset = post_box.childElementCount;
    let reach = false;
    if ((window.innerHeight +  Math.round(window.scrollY)) >= document.body.offsetHeight  ) {
        // you're at the bottom of the page
        
          // showCustomeSpinner(post_box);
          reach = true;
          let form = new FormData();
          form.append("offset", offset);
         let url = "/fetchPosts";
         fetch(url, {
            method: "POST" , 
            body: form
         })
        .then(resp => resp.json())
        .then(data => {
          
            preparePostBox(data , offset)

        })
    }
});

