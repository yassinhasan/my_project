let user = 
{
 loggedUserId : null , 
 loggedUserName : null
}
let logged_user_name_link = getElm("logged_user_name");
if(logged_user_name_link)
{
    
 let username = logged_user_name_link.querySelector(".username").innerHTML
  user.loggedUserId = parseInt((logged_user_name_link.getAttribute("data-loggedUserId")).trim()) ;
  user.loggedUserName = username.trim();

}
console.log(user)
export {user}