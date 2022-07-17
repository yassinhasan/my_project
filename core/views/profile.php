<?php

use core\app\user;
$this->view->getFlashMsg("success_profile" , "success" );
?>
<div class="card" style="width: 18rem;margin-top: 50px">
    <!-- card head contain profile image -->
    <div class="card-head d-flex justify-content-center align-items-center">
        <?php $this->view->startFileForm($model , "/profile/updateProfileImage" ,"file_form"); ?> 
        <div class="error_image image_div">
            <img src="<?= user::displayImage() ?>" class="card-img-top profile_iamge" alt="image">
        </div>
        <input type="file" class='profile_image_input' name='image'>
        <!-- name of profile -->
        <span class="text-center display_name"><?= user::displayName()  ?></span>
        <!--  after choose of image button show cancel or update -->
        <div class="row div_buttons" style="justify-content: center;">
            <button type="button" class="btn btn-outline-dark btn-success btn-sm update_profile_image hide" style="width: fit-content;margin-right: 10px">Update</button>
            <button type="button" class="btn btn-outline-dark btn-sm cancel_profile_image hide" style="width: fit-content;">cancel</button>
        </div>
        <?php $this->view->endForm(); ?>
    </div>
    <!-- card body -->
    <div class="card-body">
    <?php $this->view->startPostForm($model ,"/profile/saveProfile"); ?>
        <ul class="list-group">

            <li class="main-list list-group-item d-flex justify-content-between align-items-start">
                <button type="button" class="list-group-item list-group-item-action active" aria-current="true">
                    Profile Info
                    <button type="button" class="btn btn-outline-light btn-sm edit_profile">Edit</button>
                </button>
            </li>

            <li class="list-group-item">
                    <div class="ms-2 me-auto">
                    <div class="fw-bold">Email</div>
                        <span class="info"> <?= user::displayEmail()?></span>
                    </div>
                    <div class="input_profile hide">
                        <input type="email" class="form-control" value="<?= user::displayEmail() ?>" name="email"
                        placeholder="type your Email">
                    </div>
                            
                
            </li>
            <!-- gender  -->
            <li class="list-group-item">
                    <div class="ms-2 me-auto">
                    <div class="fw-bold">Gender</div>
                <span class="info"> <?= (user::displayGender()) ?? 'not set' ?></span>
                    </div>
                    <div class="input_profile hide ">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male" value="male"
                            <?= (user::displayGender() == null || user::displayGender() == 'male') ? 'checked' : ''?> 
                            >
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female" value="female"
                            <?=  user::displayGender() == 'female' ? 'checked' : ''?> 
                            >
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                    </div>
                
            </li>
            <!-- mobile -->
            <li class="list-group-item">
                    <div class="ms-2 me-auto">
                    <div class="fw-bold">Mobile</div>
                    <span class="info"><?= user::displayMobile()?></span>
                    </div>
                    <div class="input_profile hide">
                        <input type="text" class="form-control" value="<?= user::displayMobile() ?>" name="mobile" placeholder="type your Mobile Number">
                    </div>
                
            </li>
            <!-- bio -->
            <li class="list-group-item">
                    <div class="ms-2 me-auto">
                    <div class="fw-bold">Bio</div>
                    <span class="info"> <?= user::displayBio()?></span>
                    </div>
                    <div class="input_profile hide">
                        <!-- <input type="text" class="form-control" value="<?= user::displayBio() ?>" name="bio"
                        placeholder="write about your self"> -->
                        <textarea name="bio" placeholder="write about your self" class="form-control" maxlength="200" style="max-height: 80px;"><?= user::displayBio() ?></textarea>
                    </div>
                
            </li>
            <!-- save or cancel -->
            <li class="main-list list-group-item d-flex justify-content-between align-items-start list_edit hide" style="margin-top: 10px;">
                <button type="button" class="btn btn-success btn-sm save_profile">save</button>
                <button type="button" class="btn btn-secondary btn-sm cancel_profile">cancel</button>
            </li>
        </ul>
    </div>
    </div>
<?php $this->view->endForm(); ?>