let loggedUser = {}
// let loggedUser2 = {}
// function fetchLoggedUser()
// {
//       let url = "/";
//     fetch(url, {
//             method: "POST"
//         })
//         .then(resp => resp.json())
//         .then(data => {
//          loggedUser2 = data.loggedUser
//         })
//         return  loggedUser2;
// }


let logged_user_name_link = getElm("logged_user_name");
if(logged_user_name_link)
{
    
  let username = logged_user_name_link.querySelector(".username").innerHTML;
  loggedUser.name = username.trim();
  let srcimage = logged_user_name_link.querySelector(".user_profile_image").src;
  loggedUser.image = srcimage.split("/").pop();
  loggedUser.id = parseInt((logged_user_name_link.getAttribute("data-loggedUserId")).trim()) ;


}
export {loggedUser  }