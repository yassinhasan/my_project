let loggedUser = {};
let allDataChatuser = {};
let allChatusers  = {};
let allChatusersId = {};

//  load all users who iam follow them

function  fetchChatusers()
{
    let url = "/home";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => {
         
          let users = data.users;
          let loggedUserId = data.loggedUserId;
            
        if (users.length > 0) {
            for (var i = users.length; i--;) 
            {

            
                if(users[i].id ==  loggedUserId)
                {
                    loggedUser = users[i];
                } else
                {
                    allChatusers["user_"+users[i].id] = users[i];
                    let diff = isOffline(users[i].lastActivity);
                    if( diff > 3 && allChatusers["user_"+users[i].id].userStatus == 1)
                    {
                        console.log("yes : " +  users[i].firstName + " --- " + diff)   
                        allChatusers["user_"+users[i].id].userStatus = 0;
                        allChatusers["user_"+users[i].id].lastSeen = diff;
                       
                    }  
                    console.log(allChatusers["user_"+users[i].id].firstName + "--" + allChatusers["user_"+users[i].id].lastActivity)
                    console.log(allChatusers["user_"+users[i].id].firstName + "--" +allChatusers["user_"+users[i].id].userStatus)
                    console.log(allChatusers["user_"+users[i].id].firstName + "--" + diff)
                                   
                } 
            }
        }
      
        })  
}

if(window.location.href.split("/").pop() == "home")
{
   fetchChatusers(); 
  
}



function updateLastActivity()
{
    
    let url = "/updateLastActivity";
fetch(url, {
        method: "POST"
    })
    .then(resp => resp.json())
    .then(data => {
        if(data.succ)
        {
           fetchChatusers();
        }
    })

}


function updateLastActivityById(id , userStatus)
{
    
    let url = "/updateLastActivityById";
    let form = new FormData();
    form.append("id" , id);
    form.append("userSatus", userStatus)
fetch(url, {
        method: "POST" , 
        body: form
    })
    .then(resp => resp.json())
    .then(data => {
        if(data.succ)
        {
           fetchChatusers();
        }
    })

}

function isOffline(lastActivity)
{
    let n = new Date();
    let nowInSeconds = n.getTime();

    let dateInSeconds = new Date(lastActivity);
    let lastActivityInSeconds = dateInSeconds.getTime();

       
    let diff = Math.round((nowInSeconds - lastActivityInSeconds) /( 1000 * 60 ));
    
    
    return diff;
    
}

setInterval(updateLastActivity, 60000);


