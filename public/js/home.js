let share_post_btn = getElm("share_post_btn");
let form = getElm("share_post_form");
let textarea_text = getElm("textarea_text");
let shar_post_box = getElm("shar_post_box");
let post_box = getElm("post_box");
let users_box = getElm("users_box");

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
            removeCustomSpinner();
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

textarea_text.addEventListener("keydown", () => {
    textarea_text.classList.remove("is-invalid");
    textarea_text.classList.remove("is-valid");
})


// function fetch all posts 

function fetchPosts(data) {
    for (let post in data) {
        console.log(post)
    }
}

function fetchPostsUrl() {
    let url = "/fetchPosts";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => { preparePostBox(data) })

}
fetchPostsUrl()

function preparePostBox(data) {
    showCustomeSpinner(post_box);
    if (data.posts) {
        removeCustomSpinner();
        let allPosts = data.posts;
        if (allPosts.length > 0) {
            post_box.innerHTML = "";
            for (var i = allPosts.length; i--;) {
                let image = allPosts[i].image == null ? 'avatar.jpg' : `${allPosts[i].firstName}${allPosts[i].lastName}/${allPosts[i].image}`;
                post_box.innerHTML += `
                        <div class="post_box_details">
                              <div class="card-header bg bg-info text-light">
                                ${allPosts[i].firstName} ${allPosts[i].lastName}
                              </div>
                              <div class="card-body">
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
                            </div>
                        </div>
                        `;
            }

        }
        else

        {
            post_box.innerHTML = "No Posts";
        }

    }
}

function fetchUsers() {
    let url = "/fetchUsers";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => { prepareUsersBox(data) })

}
fetchUsers();

function prepareUsersBox(data) {
    showCustomeSpinner(post_box);
    if (data.users) {
        removeCustomSpinner();
        let allUsers = data.users;
        //   console.log(data.users)
        if (allUsers.length > 0) {
            users_box.innerHTML = "";
            for (var i = allUsers.length; i--;) 
            {
                let image = allUsers[i].image == null ? 'avatar.jpg' : `${allUsers[i].firstName}${allUsers[i].lastName}/${allUsers[i].image}`;
                let follow;
                if (allUsers[i].status == null || allUsers[i].status == 'NULL' || allUsers[i].status == 'null') {
                    follow = 'follow'
                }
                else if (allUsers[i].status == 'pending') {
                    follow = 'pending'
                }
                else {
                    follow = 'unfollow'
                }
                users_box.innerHTML += `
                <div class="card-body users_box_details">
                    <div class="row g-0">
                        <div class="col-md-4 user_image_box">
                            <img src="../../public/uploades/images/profile/${image}"  class="img-fluid rounded-start ifno_user_image" alt="...">
                        </div>
                        <div class="col-md-8" style="width: 100%;">
                          <div class="card-body">
                              <div class="card-header users_box_name">
                               ${allUsers[i].firstName} ${allUsers[i].lastName}
                              </div>
                              <div class="users_box_follow row" data-id="${allUsers[i].id}" data-status="${allUsers[i].status}">
                                  <button class="btn  follow_btn col-7" type="submit" name="follow">
                                      ${follow}
                                  </button>
                                   <div class="card-text col-4"><span class="follower_num">${allUsers[i].followers}</span> <span class="follower_text">Followers </span></div>
                              </div>
                             </div>
                          </div>
                      </div>
                 </div>
                        `;
               }
        }
        else
        {
            post_box.innerHTML = "No Users";
        }

    }
}



function follow_unfollow_System(parent , follow_btn ,follower_num , followerId,status){
        let f_number = parseInt(follower_num.innerHTML);
        console.log(f_number)
        console.log(status)
        if(status == "approve")
        {
            f_number -= 1 ;
           follower_num.innerHTML = f_number;
            follow_btn.innerHTML = "follow"; 
        }else
        {
            f_number += 1;
            follower_num.innerHTML = f_number;
            follow_btn.innerHTML = "unfollow";
        }
        let changedStatus ;
        if (status == "approve")
        {
            changedStatus = 'NULL';
        }else
        {
            changedStatus = "approve";
        }
         console.log("changed : " + changedStatus)
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

document.body.addEventListener("click",(e)=>
{
    if(e.target.classList.contains("follow_btn"))
    {
        let follow_btn = e.target;
        let parent = follow_btn.parentElement;
        let follower_num = parent.querySelector(".follower_num");
        let followerId = parent.getAttribute("data-id");
        let status = parent.getAttribute("data-status");
        console.log("iam staus before if of id : "+ followerId + " = " + status)
        follow_unfollow_System(parent , follow_btn , follower_num,followerId,status);
    }
})



