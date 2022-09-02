<div class="container">
  <form method="POST" action="/register" class="form register_form">
    <div class="row">
        <div class="mb-3 col-6 form-group">
          <label for="firstName" class="form-label">First Name </label>
          <input type="text" class="form-control " id="firstName" name="firstName" value="">
       </div>
       <div class="mb-3 col-6">
         <label for="lastName" class="form-label">Last Name </label>
         <input type="text" class="form-control " id="lastName" name="lastName" value="">
       </div>
       <div class="mb-3 ">
         <label for="email" class="form-label">Type Your Email </label>
         <input type="email" class="form-control " id="email" name="email" value="">
       </div>
       <div class="mb-3 ">
         <label for="password" class="form-label">Type Your Password </label>
         <input type="password" class="form-control " id="password" name="password" value="" autocomplete="true">
         <small>please enter password contain at least Captial letter min 8 letters</small>
      </div> 
      <div class="mb-3 form-group">
        <label for="confirmPassword" class="form-label">Confirm Your Password </label>
        <input type="password" class="form-control " id="confirmPassword" name="confirmPassword" value="" autocomplete="true">
  
      </div>
      <div class="mb-3 form-group">
        <button type="submit" class="btn btn-primary btn-sm register_btn" name="save">submit
        </button>
      </div>

   </div>
  </form>
</div>