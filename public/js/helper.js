
// get element by classname 
function getElm(elm)
{
    return document.querySelector(`.${elm}`);
}
// get elements by classname 
function getAllElm(elms)
{
    return document.querySelectorAll(`.${elms}`);
}

// hide elments  

function hideAll(elms)
{
    if(elms)
    {
        elms.forEach(element => {
            element.style.display = "none"
        });
    }
}
function showAll(elms)
{
    if(elms)
    {

        elms.forEach(element => {
            if(element.classList.contains("hide"))
            {
                element.classList.remove("hide")
            }else
            {
                element.style.display = "block"
            }
        });
    }
}
function hide(elm)
{
    if(elm)
    {
        elm.style.display = "none"
    }
}
function show(elm)
{

    if(elm.classList.contains("hide"))
    {
        elm.classList.remove("hide")
    }else
    {
        elm.style.display = "block"
    }
}


function showLoadSpinner()
{
    let elm =  
    `
    <div class="overlay_spinner"></div>
    <div class="load_spinner">
    
        <div class="spinner-grow text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-secondary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-info" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
  </div>`;

  document.body.insertAdjacentHTML("beforeend" , elm)
}


function removeLoadSpinner()
{
    document.querySelector(".load_spinner").remove();
    document.querySelector(".overlay_spinner").remove();
}


// validation 
function makeInvalidInput(inputName ,msg )
{
     let input ;
     input = document.querySelector("[name='"+inputName+"']");
    if(input == null)
    {
        input = document.querySelector("."+inputName);  
    }
    input.classList.add("is-invalid");
    let div_error_msg = `<div class="invalid-feedback">${msg}</div>`;
     input.insertAdjacentHTML("afterend" , div_error_msg);
}

function makevalidInput(inputName , msg)
{
    let input ;
     input = document.querySelector("[name='"+inputName+"']");
    if(input == null)
    {
        input = document.querySelector("."+inputName);  
    }
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

function repairMsg(msg)
{
    let pattern = /يحمولي|حمولي/gi //no quotes
    let godword = "حسن المحترم " ;
  if(msg.includes("حمولي"))
  {
 
   msg =   msg.replace(pattern , godword);
  
 }
 return msg;
}