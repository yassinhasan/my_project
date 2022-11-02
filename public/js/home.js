



// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;
// follow un follow system 
import {clickedOnFollowBtn} from "./home/follow.js"
clickedOnFollowBtn();


// comments area

import { clickedOnCommentsDiv , clickedOnCommentTextarea , clickedOnAddCommentBtn} from "./home/comments.js"
 clickedOnCommentsDiv();
clickedOnCommentTextarea();
clickedOnAddCommentBtn();


// likes

import { clickedOnAddLiketBtn } from "./home/likes.js"
 clickedOnAddLiketBtn();

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

import { showPrivateChatArea , sendChatMessages } from "./home/chat.js"

showPrivateChatArea();
sendChatMessages();

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


