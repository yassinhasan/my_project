

function showAlert(type , MainMsg , Msg){
    let alertDiV = `<div class="alert alert-${type} alert-dismissible fade show custom_alert" role="alert">
    <strong>${MainMsg}</strong> ${Msg}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>`;
    document.body.insertAdjacentHTML("afterbegin" , alertDiV)
}

function hideAlert()
{
    let alertDiV = document.querySelector(".custom_alert");
    if(alertDiV)
    {
        alertDiV.style.display = "none";
        alertDiV.remove();
        
    }
}
