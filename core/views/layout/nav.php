<?php

use core\app\Application;
use core\app\user;
$user = user::findUser();

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/home"><?= PROJECT_NAME ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <?php
            if(!$user): ?>
            <li class="nav-item">
            <a class="nav-link" href="/register">register</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">|</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/login">login</a>
            </li>
            <?php  endif ;?>
        </ul>
        <ul class="d-flex" style="list-style: none;">
            <li class="nav-item dropdown">
            <?php
            if($user): ?>
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?= $user->firstName." ".$user->lastName?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/profile">profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="/logout">logout</a></li>
                </ul>
            <?php endif;?>

            </li>
        </ul>
        </div>
    </div>
    </nav>