
let login_btn = getElm("login_btn");
let form = getElm("form");
login_btn.addEventListener("click",(e)=>
{
    e.preventDefault();
    showLoadSpinner();
    removeAnyValidation()
    let data = new FormData(form);
    let url = login_btn.getAttribute("data_target"); 
   fetch(url , {
       method: "post" , 
        body: data
   })
   .then(resp=>resp.json())
   .then(data=>{
    
    if(data.errors)
    {
        removeLoadSpinner();
        for(let err in data.errors)
        {
         makeInvalidInput(err  ,null,data.errors[err] )
        }
       
    }else if(data.success)
    {
       
        window.location.href = "/home"
      
    }else if(data.success_admin)
    {
       
        window.location.href = "/dashboard"
      
    }else if(data.sql_error)
    {
        removeLoadSpinner();
        showAlert('error' , 'Error' , data.sql_error)
    }else if(data.message_error)
    {
        removeLoadSpinner();
        showAlert('error' , 'Error' , data.message_error)
    }
   })
})


