function getNotifications() {
    let url = "/getNotifications";
    fetch(url, {
            method: "POST"
        })
        .then(resp => resp.json())
        .then(data => {
          let notification = data.notification;
        
          let notfication_box = document.querySelector(".notfication_box");
          // if has notification
          if(notification .length > 0 )
          {
              
             notfication_box.classList.remove(".no_notification");
             let no_notification_span = notfication_box.querySelector(".no_notification_span");
             no_notification_span.innerHTML = "";
             let notication_string = "";
             let postId;
             let chatId;
            for(let i = 0;
             i < notification.length;
            i++) {
                
                // console.log(notification[i])
              let userName = notification[i].fromUsername;
              postId = notification[i].postId;
              chatId = notification[i].ChatId;
              let notificationId = notification[i].notificationId;
              let noti_count = document.querySelector(".noti_count");
              let noti_count_number = notification.length;
              noti_count.innerHTML = noti_count_number;
              noti_count.style.display = "block" ;
              if(notification[i].type == "post")
              {
                   notication_string += `
                       <div class="notcation_details" data-notificationId=${notificationId} data-notificationType="post"> <span class="comment_username">${userName}</span> has added comment at you post <a href="/showPost?postId=${postId}" class="comment_link">click here</a> to show comment
                       </div>`;                  
              }if(notification[i].type == "chat")
              {
                      notication_string += `
                       <div class="notcation_details" data-notificationId=${notificationId} data-notificationType="chat"> <span class="comment_username">${userName}</span> sent you message </div> `;  
              }

             
          }
           notfication_box.innerHTML = notication_string;
          }
          else // if no notification
          {
              notfication_box.classList.add(".no_notification");
              let noti_count = document.querySelector(".noti_count");
              noti_count.innerHTML = "";
              noti_count.style.display = "none";
              let no_notification_span = notfication_box.querySelector(".no_notification_span");
              no_notification_span.innerHTML = "No new notification";
          }
          
         
            
        })

}


function onClickNotification()
{
    window.addEventListener("click",(e)=>
    {
       
        if(e.target.classList.contains("notcation_details") )
        {
            let notificationId = e.target.getAttribute("data-notificationId");
            let notificationType = e.target.getAttribute("data-notificationType");
            let comment_link = e.target.querySelector(".comment_link");
                
            let url = "/updateNotification";
            let form = new FormData();
            form.append("notificationId", notificationId);
            form.append("notificationType", notificationType);
            fetch(url, {
                  method: "POST" ,
                   body: form
                  })
            .then(resp => resp.json())
            .then(data => {
            if(data.update == "success" && data.type == "post")
              {
                   window.location.href = comment_link.href;
              }else if (data.update == "success" && data.type == "chat")
              {
                let noti_count = document.querySelector(".noti_count");
                let noti_count_number ;
                noti_count_number = parseInt(noti_count.innerHTML);
                if(noti_count_number == 1)
                {
                    noti_count.innerHTML = "";
                    noti_count.style.display = "none" ;
                    let notfication_box = document.querySelector(".notfication_box");
                    notfication_box.classList.remove(".no_notification");
                    notfication_box.innerHTML = `<span class="no_notification_span"> no notification  found </span>`;
                }else
                {
                   noti_count_number -- ; 
                }
                noti_count.innerHTML = noti_count_number;
                e.target.remove()
              }
          })  
        }
    })


}
onClickNotification()