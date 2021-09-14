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

    <!-- <div class="form-container">
        <form name="form" onsubmit="return validateForm()">
            <h2>Registration Form</h2>

            <div class="row">
                <div class="box">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                    <div class="error" id="error"></div>
                </div>

                <div class="box">
                    <label for="regno">Registration No</label>
                    <input type="text" name="regno" id="regno">
                    <div class="error" id="error"></div>
                </div>
            </div>



            <div class="row">
                <div class="box">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname">
                    <div class="error" id="error"></div>
                </div>

                <div class="box">
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname">
                    <div class="error" id="error"></div>
                </div>
            </div>

            <div class="row">
                <div class="box">
                    <label>Type</label>
                    <select name="type" id="type">
                        <option>Lecturer</option>
                        <option>Student</option>
                    </select>
                    <div class="error" id="error"></div>
                </div>

                <div class="box">
                    <label for="password1">Password</label>
                    <input type="text" name="password1" id="password1">
                    <div class="error" id="error"></div>
                </div>
            </div>


            <div class="box">
                <input type="submit" value="Register" class="center">
            </div>
        </form>
    </div> -->

    <div class="wrapper center">

        <div class="form-container">
            <div class="slide-controls">
                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Lecturer</label>
                <label for="signup" class="slide signup">Student</label>
                <div class="slider-tab"></div>
            </div>


            <div class="form-inner">

                <!-- LECTURER FORM START -->
                <form method="post" action="<?php echo BASEURL . '/register/index'; ?>" class="login" id="registerForm" onsubmit="validateAll()">
                    <!-- Used to identify user type -->
                    <input type='hidden' name='type' value='2' />

                    <div class="field">
                        <input type="text" placeholder="Email Address" name="email" id="email" onfocusout="validateEmail()">
                        <div class="error" id="error"><?php echo $errors["email"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Employee No" name="regNo" id="regNo" onfocusout="validateEmployeeNo()">
                        <div class="error" id="error"><?php echo $errors["regNo"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="First Name" name="fName" id="fName" onfocusout="validateFirstName()">
                        <div class="error" id="error"><?php echo $errors["fName"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Last Name" name="lName" id="lName" onfocusout="validateLastName()">
                        <div class="error" id="error"><?php echo $errors["lName"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Password" name="password" id="password" onfocusout="validatePassword()">
                        <div class="error" id="error"><?php echo $errors["password"] ?></div>
                    </div>

                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Register">
                    </div>
                </form>
                <!-- LECTURER FORM END -->

                <!-- STUDENT FORM START -->
                <form method="post" action="<?php echo BASEURL . '/register/index'; ?>" class="login" id="registerForm1" onsubmit="validateAll1()">
                    <!-- Used to identify user type -->
                    <input type='hidden' name='type' value='3' />

                    <div class="field">
                        <input type="text" placeholder="Email Address" name="email" id="email1" onfocusout="validateEmail1()">
                        <div class="error" id="error"><?php echo $errors["email"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Index No" name="regNo" id="regNo1" onfocusout="validateEmployeeNo1()">
                        <div class="error" id="error"><?php echo $errors["regNo"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="First Name" name="fName" id="fName1" onfocusout="validateFirstName1()">
                        <div class="error" id="error"><?php echo $errors["fName"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Last Name" name="lName" id="lName1" onfocusout="validateLastName1()">
                        <div class="error" id="error"><?php echo $errors["lName"] ?></div>
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Password" name="password" id="password1" onfocusout="validatePassword1()">
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

    <?php linkPhp("notification"); ?>

    <?php linkPhp("footer"); ?>

    <?php linkJS("registerStyle"); ?>

    <?php linkJS("lecturerRegisterValidation"); ?>

    <?php linkJS("studentRegisterValidation"); ?>

</body>

</html>