// Enable pusher logging - don't include this in production
// Pusher.logToConsole = true;
singlePost.isSinglePost = true;


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
 

//edit posts
import {postEdit } from "./home/edit.js"
postEdit();


// must be after uplaod 
import {showEditBox , postDelete , updatePost} from "./home/posts.js"
showEditBox();
postDelete(true);
updatePost();

// import notifications  getNotifications
import {getNotifications} from "./home/notifications.js"
getNotifications();