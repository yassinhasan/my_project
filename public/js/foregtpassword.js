
let reset_passwrod_btn = getElm("reset_password_btn");
let form = getElm("form");
reset_passwrod_btn.addEventListener("click",(e)=>
{
    e.preventDefault();
    showLoadSpinner();
    removeAnyValidation()
    let data = new FormData(form);
    let url = reset_passwrod_btn.getAttribute("data_target");
   fetch(url , {
       method: "post" , 
        body: data
   })
   .then(resp=>resp.json())
   .then(data=>{
   
    if(data.errors)
    {
        removeLoadSpinner();
        makeInvalidInput("email"  ,data.errors )
    }else if(data.success)
    {
        removeLoadSpinner();
        makevalidInput("email"  ,data.success )
    }
   })
})



function makeInvalidInput(inputName , msg)
{
    let input = document.querySelector("input[name='"+inputName+"']");
    input.classList.add("is-invalid");
    let div_error_msg = `<div class="invalid-feedback">${msg}</div>`;
     input.insertAdjacentHTML("afterend" , div_error_msg);
}

function makevalidInput(inputName , msg)
{
    let input = document.querySelector("input[name='"+inputName+"']");
    input.classList.add("is-valid");
    let div_success_msg = `<div class="valid-feedback">${msg}</div>`;
    input.insertAdjacentHTML("afterend" , div_success_msg);
}

function removeAnyValidation()
{
   let allInputs = getAllElm("form-control");
   allInputs.forEach(element => {
       if(element.classList.contains("is-valid"))
       {
        element.classList.remove("is-valid");
       }else if(element.classList.contains("is-invalid"))
       {
        element.classList.remove("is-invalid");
       }
   });

   let all_div_has_valid = getAllElm("valid-feedback");
   if(all_div_has_valid)
   {
    all_div_has_valid.forEach(element => {
           element.remove();
       });
   }
   let all_div_has_invalid = getAllElm("invalid-feedback");
   if(all_div_has_invalid)
   {
    all_div_has_invalid.forEach(element => {
           element.remove();
       });
   }
}