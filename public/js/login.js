
let login_btn = getElm("login_btn");
let form = getElm("form");
let container = getElm("container");
let body = document.body;
login_btn.addEventListener("click",(e)=>
{
    e.preventDefault();
    showCustomeSpinner(body);
    removeAnyValidation()
    let data = new FormData(form);
    let url = form.action; 
   fetch(url , {
       method: "post" , 
        body: data
   })
   .then(resp=>resp.json())
   .then(data=>{
    
    
    if(data.errors)
    {
     
        for(let err in data.errors)
        {
         makeInvalidInput(err,data.errors[err] );
           removeCustomSpinner(body);
        }
       
    }else if(data.success)
    {
       
        window.location.href = "/home"
          removeCustomSpinner(body);
    }else if(data.success_admin)
    {
       
        window.location.href = "/dashboard";
        removeCustomSpinner(body);
      
    }else if(data.sql_error)
    {
       
        showAlert('error' , 'Error' , data.sql_error);
          removeCustomSpinner(body);
    }else if(data.message_error)
    {
      
        showAlert('error' , 'Error' , data.message_error);
          removeCustomSpinner(body);
    }
     
   })
})


