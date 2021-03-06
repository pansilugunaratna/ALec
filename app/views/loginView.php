<?php $errors = $data['errors'] ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALec</title>

    <!-- CSS file -->
    <?php linkCSS('login'); ?>

    <!-- Shortcut Icon -->
    <?php shortIcon('logo1.jpg'); ?>
</head>

<body>
    <!--    <img --><?php //srcIMG("wave.png") 
                    ?>
    <!-- alt="Wave image" class="wave">-->
    <img <?php srcIMG("wave_blue.svg") ?> alt="Wave image" class="wave">

    <div class="container">
        <div class="img">
            <!--            <img --><?php //srcIMG("education_img.svg") 
                                    ?>
            <!-- alt="Education image">-->
            <img <?php srcIMG("book_lover_blue.svg") ?> alt="Education image">
        </div>

        <div class="login-container">
            <form method="post" action="<?php echo BASEURL . '/login/index'; ?>" id="loginForm" onsubmit="validateAll()">
                <!--                <img --><?php //srcIMG("profile_pic.svg") 
                                            ?>
                <!-- alt="Profile picture" class="avatar">-->
                <img <?php srcIMG("logo3.png") ?> alt="ALec logo" class="avatar">

                <h2>Welcome</h2>

                <div class="input-div one" id="div-email">
                    <div class="i">
                        <i class="fas fa-user" id="icon-email"></i>
                    </div>
                    <div>
                        <h5><label for="email">Email</label></h5>
                        <input type="text" class="input" id="email" onfocusout="validateEmail()" name="email" value="<?php if (isset($data['email'])) echo $data['email']; ?>">
                    </div>
                </div>
                <div class="helper-text" id="helper-email"><?php echo $errors['email']; ?></div>

                <div class="input-div two" id="div-password">
                    <div class="i">
                        <i class="fas fa-lock" id="icon-password"></i>
                    </div>
                    <div>
                        <h5><label for="password"></label>Password</h5>
                        <input type="password" class="input" id="password" onfocusout="validateLoginPassword()" name="password">
                    </div>
                </div>
                <div class="helper-text" id="helper-password"><?php echo $errors['password']; ?></div>

                <a href="javascript:forgotPassword()">Forgot Password ?</a>

                <input type="submit" name="login" class="btn" value="Login">
            </form>
        </div>
    </div>
    45

    <!-- Login validation and other related things -->
    <?php linkJS("loginValidation") ?>
    <?php linkJS("loginStyle") ?>

    <!-- FontAwesome Icon -->
    <script src="https://kit.fontawesome.com/3220c9480a.js" crossorigin="anonymous"></script>
</body>

</html>