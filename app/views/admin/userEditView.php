<?php $errors = $data['errors'] ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Simple HTML Form</title>

    <?php linkCSS('register'); ?>

    <!-- <script src="js/form.js"></script> -->
</head>

<body>

    <?php linkPhp("navigationBarAdmin"); ?>

    <div class="wrapper center">

        <div class="form-container">
            <div class="slide-controls">

                <?php
                if ($data["userDetails"]["user_type"] == "stu") {
                    echo '
                    <input type="radio" name="slide" id="login" disabled>
                    <input type="radio" name="slide" id="signup" checked>
                    <label for="login" class="slide login" style="cursor: unset;"></label>
                <label for="signup" class="slide signup" style="cursor: unset;">Edit Student</label>
                    ';
                } else if ($data["userDetails"]["user_type"] == "lec") {
                    echo '
                    <input type="radio" name="slide" id="login" checked>
                    <input type="radio" name="slide" id="signup" disabled>
                    <label for="login" class="slide login" style="cursor: unset;">Edit Lecturer</label>
                    <label for="signup" class="slide signup" style="cursor: unset;"></label>
                    ';
                }
                ?>

                <!-- <label for="login" class="slide login" style="cursor: unset;">Edit Lecturer</label>
                <label for="signup" class="slide signup" style="cursor: unset;">Edit Student</label> -->
                <div class="slider-tab"></div>
            </div>


            <div class="form-inner">

                <!-- LECTURER FORM START -->
                <form method="post" action="<?php echo BASEURL . '/userEdit/index'; ?>" class="login" id="registerForm" onsubmit="validateAll()">
                    <!-- Used to identify user type -->
                    <input type='hidden' name='userID' value='<?php echo $data["userDetails"]["user_id"]; ?>' />
                    <input type='hidden' name='type' value='2' />

                    <div class="field">
                        <input type="text" placeholder="Email Address" name="email" id="email" onfocusout="validateEmail()" value='<?php echo $data["userDetails"]["email"]; ?>'>
                        <div class="error" id="error"><?php echo $errors["email"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Employee No" name="regNo" id="regNo" onfocusout="validateEmployeeNo()" value='<?php echo $data["userDetails"]["reg_no"]; ?>'>
                        <div class="error" id="error"><?php echo $errors["regNo"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="First Name" name="fName" id="fName" onfocusout="validateFirstName()" value='<?php echo $data["userDetails"]["first_name"]; ?>'>
                        <div class="error" id="error"><?php echo $errors["fName"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Last Name" name="lName" id="lName" onfocusout="validateLastName()" value='<?php echo $data["userDetails"]["last_name"]; ?>'>
                        <div class="error" id="error"><?php echo $errors["lName"] ?></div>
                    </div>

                    <div style="padding-top: 20px;">
                        <input type="checkbox" name="changePassword" onclick="ShowHideDiv(this)" id="changePassword" value="1">
                        Change Password
                    </div>

                    <div class="field" style="margin-top: 20px;">
                        <input type="text" placeholder="Password" name="password" id="password" onfocusout="validatePassword()" style="display: none;">
                        <div class="error" id="error"><?php echo $errors["password"] ?></div>
                    </div>



                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Register">
                    </div>
                </form>
                <!-- LECTURER FORM END -->

                <!-- STUDENT FORM START -->
                <form method="post" action="<?php echo BASEURL . '/userEdit/index'; ?>" class="login" id="registerForm1" onsubmit="validateAll1()">
                    <!-- Used to identify user type -->
                    <input type='hidden' name='userID' value='<?php echo $data["userDetails"]["user_id"]; ?>' />
                    <input type='hidden' name='type' value='3' />

                    <div class="field">
                        <input type="text" placeholder="Email Address" name="email" id="email1" onfocusout="validateEmail1()" value='<?php echo $data["userDetails"]["email"]; ?>'>
                        <div class="error" id="error"><?php echo $errors["email"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Index No" name="regNo" id="regNo1" onfocusout="validateEmployeeNo1()" value='<?php echo $data["userDetails"]["reg_no"]; ?>'>
                        <div class="error" id="error"><?php echo $errors["regNo"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="First Name" name="fName" id="fName1" onfocusout="validateFirstName1()" value='<?php echo $data["userDetails"]["first_name"]; ?>'>
                        <div class="error" id="error"><?php echo $errors["fName"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Last Name" name="lName" id="lName1" onfocusout="validateLastName1()" value='<?php echo $data["userDetails"]["last_name"]; ?>'>
                        <div class="error" id="error"><?php echo $errors["lName"] ?></div>
                    </div>

                    <div style="padding-top: 20px;">
                        <input type="checkbox" name="changePassword" onclick="ShowHideDiv1(this)" id="changePassword1" value="1">
                        Change Password
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Password" name="password" id="password1" onfocusout="validatePassword1()" style="display: none;">
                        <div class="error" id="error"><?php echo $errors["password"] ?></div>
                    </div>


                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Register">
                    </div>
                </form>
                <!-- STUDENT FORM END -->

            </div>
        </div>
    </div>

    <!-- JS code -->
    <?php
    if ($data["userDetails"]["user_type"] == "stu") {
        echo '<script>
        const loginText = document.querySelector(".title-text .login");
        const loginForm = document.querySelector("form.login");

        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
    </script>';
    }
    ?>



    <?php linkPhp("notification"); ?>

    <?php linkPhp("footer"); ?>

    <?php linkJS("userEditView"); ?>

    <?php linkJS("editLecturerRegisterValidation"); ?>

    <?php linkJS("editStudentRegisterValidation"); ?>

</body>

</html>