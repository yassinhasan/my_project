const ALLOWD_TYPE_IMAGE = "image/";
const ALLOWD_SIZE = 2;
let edit_profile = getElm("edit_profile");
let cancel_profile = getElm("cancel_profile");
let save_profile = getElm("save_profile");
let info = getAllElm("info");
let list_edit = getElm("list_edit");
let form = getElm("form");
let formURL = form.action;
let profile_iamge = getElm("profile_iamge");
let profile_image_input = getElm("profile_image_input");
let all_input_profile = getAllElm("input_profile");
let update_profile_image = getElm("update_profile_image");
let cancel_profile_image = getElm("cancel_profile_image");
edit_profile.addEventListener("click",()=>
{
    hideAll(info)
    showAll(all_input_profile)
    hide(edit_profile)
    show(list_edit)
})
cancel_profile.addEventListener("click",()=>
{
    showAll(info)
    hideAll(all_input_profile)
    show(edit_profile)
    hide(list_edit)
})



save_profile.addEventListener("click",(e)=>
{
    e.preventDefault();
    let profile_info_box = getElm("profile_info_box");
    showCustomeSpinner(profile_info_box);
    removeAnyValidation()
    let formdata = new FormData(form);
    fetch(formURL ,
    {
        method: "post" ,
        body  : formdata
    })
    .then(resp=>resp.json())
    .then(data=>{
       
        if(data.errors)
        {
            removeCustomSpinner(profile_info_box);
            for(let err in data.errors)
            {
            
             makeInvalidInput(err  , "bio" ,data.errors[err] )
            }
        }else
        {
            //showAlert('success' , 'Success' , data.success)
            // setTimeout(function()
            // {
                window.location.reload();
            // },2000)
        }
    })
})




profile_iamge.addEventListener("click",()=>
{
     hideAlert();
     profile_image_input.click();
    removeAnyValidation()
})


let oldsrc = profile_iamge.getAttribute("src");

profile_image_input.addEventListener("change",e=>
{
    show(update_profile_image);
    show(cancel_profile_image);
    let file = e.target.files[0];
    let reader = new FileReader();
     reader.addEventListener("load",()=>
      {
        let imagesrc = reader.result;
        if(!file.type.includes(ALLOWD_TYPE_IMAGE))
        {
            hide(update_profile_image);
            hide(cancel_profile_image);
            profile_iamge.src = oldsrc;
           // showAlert('danger', 'Error', "sorry this file not valid")
                             //     //   swett alert
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
              title: `sorry this file not valid`
            })
            //  
        }else
        {
            removeAnyValidation();
            profile_iamge.src =  imagesrc;  

        }      
        })
        reader.readAsDataURL(file);
})

function showImagePorfile()
{
    cancel_profile_image.addEventListener("click",()=>
    {
        hide(update_profile_image);
        hide(cancel_profile_image);
        profile_iamge.src = oldsrc;
        removeAnyValidation()
    })
    update_profile_image.addEventListener("click",()=>
    {
        let file_form = getElm("file_form");
        let file_form_url = file_form.action;
        let profile_iamge_box = getElm("profile_iamge_box");
         showCustomeSpinner(profile_iamge_box);
        fetchUpdateImage(file_form , file_form_url)
    })
}
showImagePorfile();
function fetchUpdateImage(form,url)
{
   
    let formdata = new FormData(form);
    fetch(url ,
    {
        method: "post" ,
        body  : formdata
    })
    
    .then(resp=>resp.json())
    .then(data=>{
        removeAnyValidation()
        if(data.errors)
        {
            for(err in data.errors)
            {
                makeInvalidInput(err   ,data.errors[err] )
            }
        }else
        {
            
            let user_profile_image = getElm("user_profile_image");
            user_profile_image.src = data.image;
            hide(update_profile_image);
            hide(cancel_profile_image);
           
            hideAlert();
            let profile_iamge_box = getElm("profile_iamge_box");
            removeCustomSpinner(profile_iamge_box);
           // showAlert("success" ,"Success !" , " you have updated your profile");
                             //     //   swett alert
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
              icon: 'success',
              title: `you have updated your profile`
            })
            //  
        }
    
    })
}
