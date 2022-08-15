

import {fetchPostsUrl, clickedShareBtn , preparePostBox , prepareTextarea} from "./home/posts.js"
clickedShareBtn()
prepareTextarea();
// function fetch all posts 
fetchPostsUrl()


//fetch all users
import {fetchUsers , prepareUsersBox} from "./home/users.js"
fetchUsers();


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
