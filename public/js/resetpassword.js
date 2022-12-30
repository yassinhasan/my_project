
let reset_passwrod_btn = getElm("reset_password_btn");
let form = getElm("form");
reset_passwrod_btn.addEventListener("click",(e)=>
{
    e.preventDefault();
    showLoadSpinner();
    removeAnyValidation()
    let data = new FormData(form);
    let url = form.action; 
    console.log(url)
    let url2 = new URLSearchParams(window.location.search);
    let code = url2.get("code");
    data.append("code" , code)
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
         makeInvalidInput(err  ,data.errors[err] )
        }
       
    }else if(data.success)
    {
       
        showAlert('success' , 'Success' , data.success)
        setTimeout(function()
        {
            window.location.href = "/"
        },3000)
      
    }else if(data.update_error)
    {
      //  showAlert('error' , 'Error' , "sorry there is somthing error please try in another time");
          //   swett alert
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            
            Toast.fire({
              icon: 'error',
              title:"sorry there is somthing error please try in another time"
            })
            //  
    }
   })
})


