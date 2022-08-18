

let users_box = getElm("users_box");
function fetchUsers() {
    showCustomeSpinner(users_box);
    let url = "/fetchUsers";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => { prepareUsersBox(data) })

}
function prepareUsersBox(data) {
    
    if (data.users) {
       
        let allUsers = data.users;
        //   console.log(data.users)
        if (allUsers.length > 0) {
            users_box.innerHTML = "";
            for (var i = allUsers.length; i--;) 
            {
                let image = allUsers[i].image == null ? 'avatar.jpg' : `${allUsers[i].firstName}${allUsers[i].lastName}/${allUsers[i].image}`;
                let follow;
                let follow_class;
                if (allUsers[i].status == null || allUsers[i].status == 'NULL' || allUsers[i].status == 'null') {
                    follow = 'follow' ; 
                    follow_class = "follow"
                }
                else if (allUsers[i].status == 'pending') {
                    follow = 'pending';
                    follow_class = "follow"
                }
                else {
                    follow = 'unfollow';
                    follow_class = "unfollow"
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
                                  <button class="btn  follow_btn ${follow_class} col-7" type="submit" name="follow">
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

         removeCustomSpinner(users_box);

    }
}

export {fetchUsers
, prepareUsersBox}