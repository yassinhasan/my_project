let share_post_btn = getElm("share_post_btn");
let form = getElm("share_post_form");
let textarea_text = getElm("textarea_text");
let shar_post_box = getElm("shar_post_box");
let post_box  = getElm("post_box");
share_post_btn.addEventListener("click",(e)=>
{
    e.preventDefault();
     removeAnyValidation();
     showCustomeSpinner(shar_post_box);
    let data = new FormData(form);
    let url = form.action; 
   fetch(url , {
       method: "post" , 
        body: data
   })
   .then(resp=>resp.json())
   .then(data=>{
   removeCustomSpinner();
    if(data.errors)
    {
        for(let err in data.errors)
        {
            
           makeInvalidInput(err  , "textarea", data.errors[err] )
         //  showAlert('danger' , 'Error' , data.errors[err])
        }
       
    }else if(data.success)
    {

           textarea_text.value = ""; 
           makevalidInput("post" , data.success );
           preparePostBox(data);
         //  showAlert('danger' , 'Error' , data.errors[err])

      
    }else if(data.sql_error)
    {
       
        showAlert('error' , 'Error' , data.sql_error)
    }
   })
});

textarea_text.addEventListener("keydown",()=>
{
    textarea_text.classList.remove("is-invalid");
     textarea_text.classList.remove("is-valid");
})


// function fetch all posts 

function fetchPosts(data)
{
       for(let post in data)
       {
           console.log(post)
       }
}

function fetchPostsUrl()
{
    let url = "/fetchPosts";
    fetch(url,{
        method: "POST"
    })
        .then(resp => resp.json())
        .then(data => {preparePostBox(data)})

}
fetchPostsUrl()

function preparePostBox(data)
{
      if(data.posts)
          {
              let allPosts = data.posts ;
              if(allPosts.length > 0)
              {
                  post_box .innerHTML = "";
                  for (var i = allPosts.length; i--; ) {
                
                        post_box.innerHTML += `
                  <div class="card-header bg bg-info text-light">
                    ${allPosts[i].firstName} ${allPosts[i].lastName}
                  </div>
                  <div class="card-body">
                    <div class="row g-0">
                        <div class="col-md-4 post_image_box">
                            <img src="../../public/uploades/images/profile/${allPosts[i].firstName}${allPosts[i].lastName}/${allPosts[i].image}"  class="img-fluid rounded-start  post_user_image" alt="...">
                        </div>
                        <div class="col-md-8">
                          <div class="card-body">
                            <p class="card-text">${allPosts[i].postText}</p>
                            <p class="card-text"><small class="text-muted">Post Date : ${allPosts[i].postDate}</small></p>
                        </div>
                   </div>
                </div>
                        `;
                    }
                  
              }else
              
              {
                  post_box.innerHTML = "No Posts";
              }
              
          }
}

