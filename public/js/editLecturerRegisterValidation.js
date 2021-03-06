// Color values
let validColor = '#38d39f';
let invalidColor = '#f44336';

let email = document.getElementById("email");
let regNo = document.getElementById("regNo");
let fName = document.getElementById("fName");
let lName = document.getElementById("lName");
let regiter = document.getElementById("registerForm");

regiter.addEventListener('submit', function (event) {
    event.preventDefault();

    if (validateEmail() && validateEmployeeNo() && validateFirstName() && validateLastName()) {
        regiter.submit();
    }
})

function validateAll() {
    validateEmail();
    validateEmployeeNo();
    validateFirstName();
    validateLastName();
}

// email.style.borderColor = invalidColor;
// email.nextElementSibling.innerHTML = "hi";
// var placeholder = document.getElementById("email").getAttribute("placeholder");
// console.log(placeholder);
// field.getAttribute("placeholder")

function setValid(field) {
    field.style.borderColor = validColor;
    field.nextElementSibling.innerHTML = "";
}

function setInvalid(field, message) {
    field.style.borderColor = invalidColor;
    field.nextElementSibling.innerHTML = message;
}

// EMPTY CHECK START
function isEmpty(value) {
    if (value === '') {
        return true;
    } else {
        return false;
    }
}

function checkIfEmpty(field) {
    if (isEmpty(field.value.trim())) {
        setInvalid(field, `${field.getAttribute("placeholder")} must not be empty`);
        return true;
    } else {
        setValid(field);
        return false;
    }
}
// EMPTY CHECK END

function meetLength(field, minLength, maxLength) {
    if (field.value.length >= minLength && field.value.length < maxLength) {
        setValid(field);
        return true;
    } else if (field.value.length < minLength) {
        setInvalid(
            field,
            `${field.getAttribute("placeholder")} must be at least ${minLength} characters long`
        );
        return false;
    } else {
        setInvalid(
            field,
            `${field.getAttribute("placeholder")} must be shorter than ${maxLength} characters`
        );
        return false;
    }
}

function fixedLength(field, length) {
    if (field.value.length === length) {
        setValid(field);
        return true;
    }
    else {
        setInvalid(
            field,
            `${field.getAttribute("placeholder")} must have ${length} characters only`
        );
        return false;
    }
}

function matchWithRegEx(regEx, field, message) {
    if (field.value.match(regEx)) {
        setValid(field);
        return true;
    } else {
        setInvalid(field, message);
        return false;
    }
}

function containsCharacters(field, code) {
    let regEx;

    switch (code) {
        case 1:
            // letters
            regEx = /(?=.*[a-zA-Z])/;
            return matchWithRegEx(regEx, field, 'Must contain at least one letter');

        case 2:
            // letter and numbers
            regEx = /(?=.*\d)(?=.*[a-zA-Z])/;
            return matchWithRegEx(
                regEx,
                field,
                'Must contain at least one letter and one number'
            );

        case 3:
            // uppercase, lowercase and number
            regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/;
            return matchWithRegEx(
                regEx,
                field,
                'Must contain at least one uppercase, one lowercase letter and one number'
            );

        case 4:
            // uppercase, lowercase, number and special char
            regEx = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W)/;
            return matchWithRegEx(
                regEx,
                field,
                'Must contain at least one uppercase, one lowercase letter, one number and one special character'
            );

        case 5:

            // Email pattern
            regEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return matchWithRegEx(regEx, field, 'Must be a valid email address');

        case 6:
            //Numbers only
            regEx = /^[0-9]+$/;
            return matchWithRegEx(regEx, field, `${field.getAttribute("placeholder")} must contain only numbers`);

        case 7:
            //Letters only
            regEx = /^[A-Za-z]+$/;
            return matchWithRegEx(regEx, field, `${field.getAttribute("placeholder")} must contain only letters`);

        case 8:
            regEx = /^\S+$/;
            return matchWithRegEx(regEx, field, `${field.getAttribute("placeholder")} must not contain white spaces`);

        default:
            return false;
    }
}

function validateEmail() {
    if (checkIfEmpty(email)) {
        return false;
    }

    if (!containsCharacters(email, 5)) {
        return false;
    }

    return true;
}

function validateEmployeeNo() {
    if (checkIfEmpty(regNo)) {
        return false;
    }

    if (!containsCharacters(regNo, 6)) {
        return false;
    }

    if (!fixedLength(regNo, 8)) {
        return false;
    }

    return true;
}

function validateFirstName() {
    if (checkIfEmpty(fName)) {
        return false;
    }

    if (!containsCharacters(fName, 8)) {
        return false;
    }

    if (!containsCharacters(fName, 7)) {
        return false;
    }

    if (!meetLength(fName, 3, 50)) {
        return false;
    }

    return true;
}

function validateLastName() {
    if (checkIfEmpty(lName)) {
        return false;
    }

    if (!containsCharacters(lName, 8)) {
        return false;
    }

    if (!containsCharacters(lName, 7)) {
        return false;
    }

    if (!meetLength(lName, 4, 50)) {
        return false;
    }

    return true;
}