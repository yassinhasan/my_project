// import {readMore , handleFileName} from "./manageposts.js";
// import { attachNeedUpdate  } from "./edit.js";
// export class Newpost
// {
//      status ;
//      postId ;
//      attachment;
//      attachment_type;
//      post;
//      image;
//      edit;
//      constructor(status, postId, attachment, attachment_type, post, image, loggedUser ,edit)
//      {   
//          this.status = status;
//          this.postId = postId;
//          this.attachment = attachment;
//          this.attachment_type = attachment_type;
//          this.post = post;
//          this.image = image;
//          this.edit = edit;
//          this.loggedUser = loggedUser;
//      }   
     

//     getPost()
//     {
//         let post = this.post;
//         post  == "null" ? "" : readMore(post , this.getPostId());
//         return post;
//     }
//     getImage()
//     {
//         let image = this.image;
//         image = this.loggedUser.profileImage == null ? 'avatar.jpg' : `${this.loggedUser.firstName}${this.loggedUser.lastName}/${this.loggedUser.profileImage}`;
//         return image;
//     }
    
//     preapreEditpox()
//     {
//         // show edit and delete if logged user
//      return `<div class="edit_box_edit" data-postId="${this.postId}" data-bs-toggle="modal" data-bs-target="#postEditModal">edit</div>
//                          <div class="edit_box_delete" data-postId="${this.postId}">delete</div>`;
//     }
//     prepareAttachmentdiv()
//     {
//                   let attachment_div = "";
//                   let document_attachment_div = "";
//                   if (this.attachment_type == "image") {
//                     attachment_div = `
//                     <div class='img_container'>
//                     <img src="../../public/uploades/images/posts/image/${this.postId}/${this.attachment} " loading="lazy" class="post_attachment image_attach"/>
//                     </div>
//                     `
//                     ;
//                 }
//                 else if (this.attachment_type == "video") {
//                     let src = this.attachment.split(".");
//                     let filename = src[0];
//                     let type = src[1];

//                     attachment_div = `
//                         <video  controls  class="video_attach post_attachment" loading="lazy">
//                           <source src="../../public/uploades/images/posts/video/${this.postId}/${this.attachment}"  type="video/mp4" >
//                           Your browser does not support the video tag.
//                         </video>
//                   `;

//                 }
//                 else if (this.attachment_type == "document") {
                    
//                     let handled_filename = handleFileName(this.attachment);
//                     document_attachment_div = `
//                     <i class="fas fa-file file_thumb"></i>
//                     <span class="filename"><a href="../../public/uploades/images/posts/document/${this.postId}/${this.attachment}" download class="docs_name">${handled_filename}</a></span>
//                   `;

//                 }
//                 return attachment_div;
//     }
//     prepareNewpost()
//     {
//          if(this.attachment != null) attachNeedUpdate.alreadyHasAttach  = true;
//          let attachment_div = this.prepareAttachmentdiv();
//          let image = this.getImage();
//          let editpox = this.preapreEditpox();
//          let post = `
//                         <div class="post_box_details"  id="post_box_details_${this.postId}">
//                               <div class="card-header row post_card_header">
//                                 <div class="col-11">
//                                     <div class="user_and_status">
//                                       <a href="/userPosts?id=${this.loggedUser.id}" class="userPosts_link">${this.loggedUser.firstName} ${this.loggedUser.lastName}</a>
//                                       <i class="fas fa-circle online_status online_icon_status" data-userId=${this.loggedUser.id} data-status=${this.status}></i>
//                                     </div>
//                                 </div>
//                                   <!-- here edit -->

//                              <div class="edit_big_box col-1 showt_edit_div" data-show=${this.postId}>
//                                             <i class="fas fa-ellipsis-v"></i>
//                                             <div class="edit_box" id="edit_box_${this.postId}">
//                                                  <div class="edit_box_showPost" data-postId="${this.postId}"><a href="/showPost?postId=${this.postId}">Show Post</a></div>
//                                                  ${editpox}
//                                             </div>
//                             </div>
                        
//                                   <!-- here end edit -->
//                               </div>
                            
//                               <div class="card-body big_card_body">
//                                 <div class="row g-0">
//                                     <div class="col-4 post_image_box">
//                                         <img src="../../public/uploades/images/profile/${image}"  class="post_user_image" alt="...">
//                                     </div>
//                                     <div class="col-8">
//                                       <div class="post_attachment_div" data-type="${this.attachment_type}">
//                                             ${attachment_div}
//                                           <div class="post_text">${post}</div>
//                                             <p class="card-text"><small class="text-muted post_date_release">${this.postDate}</small></p>
//                                             ${this.document_attachment_div}
//                                         </div>
//                                     </div>
//                                 </div>
//                               </div>
//                                 <!-- here comments -->
                               
//                               <div class="card-body comments_box"> 
//                                     <div class="comments" data-postId=${this.postId} id="comments_${this.postId}">
//                                         <div class="comments-stats">
//                                              <span class="comments_num">0</span>
//                                              <span> comments</span>
//                                         </div>
//                               </div>
//                                 <!-- here form of comments -->
//                                  <div class="comments_form_box hidden" id="comments_form_box_${this.postId}" data-postId=${this.postId}>
//                                  </div>
//                                 <!-- end form of comments -->
//                                 <!-- end here comments -->
//                             </div>
                            
//                             <!-- likes -->
//                                     <div class="likes_box">
//                                         <div data-postId="${this.postId}" id="likes_box_${this.postId}">
//                                             <div class="is_like">
//                                                  <span class="likes_num no_of_likes">${allPosts[i].liked} </span>
//                                                  <i class="fas fa-thumbs-up like_btn
//                                                  ${this.type == 'like' ? 'active' : ''}" data-type="like"></i>
//                                             </div>
//                                              <div class="i_dislike">
//                                                  <span class="dislikes_num no_of_likes"> ${allPosts[i].disliked} </span>                                 
//                                                  <i class="fas fa-thumbs-down dislike_btn 
//                                                  ${this.type == 'unlike' ? 'active' : ''}" data-type="unlike"></i> 
//                                              </div>
//                                         </div>

//                                 </div>
//                             <!-- end likes -->
//                         </div>
//                         `;
                        
//                         return post;
//     }
    
    
    

    
    
// }

