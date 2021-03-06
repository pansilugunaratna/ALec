let validColor = '#38d39f';
let invalidColor = '#f44336';

let courseName = document.getElementById("c_name");
let courseDescription = document.getElementById("c_desc");
let courseYear = document.getElementById("year-selection");
let regiter = document.getElementById("registerForm");

regiter.addEventListener('submit', function (event) {
    event.preventDefault();

    if (validateCourseName() && validateCourseDescription() && validateCourseYear()) {
        regiter.submit();
    }
})

// Check the validity of form at once
function validateAll() {
    validateCourseName();
    validateCourseDescription();
    validateCourseYear();
}

// Change input box color to green
function setValid(field) {
    field.style.borderColor = validColor;
    field.nextElementSibling.innerHTML = "";
}

// Change input box color to red
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

// Check that entered string is in the given range
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

// Check that entered string has the specified length
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

// process the regex matching
function matchWithRegEx(regEx, field, message) {
    if (field.value.match(regEx)) {
        setValid(field);
        return true;
    } else {
        setInvalid(field, message);
        return false;
    }
}

// process different regex matching
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
            //No white space
            regEx = /^\S+$/;
            return matchWithRegEx(regEx, field, `${field.getAttribute("placeholder")} must not contain white spaces`);

        case 9:
            //No special characters
            regEx = /^[\w\-\s]+$/;
            return matchWithRegEx(regEx, field, `${field.getAttribute("placeholder")} must not contain special characters`);

        default:
            return false;
    }
}

// Validate the entered course name
function validateCourseName() {
    if (checkIfEmpty(courseName)) {
        return false;
    }

    if (!containsCharacters(courseName, 9)) {
        return false;
    }

    if (!meetLength(courseName, 5, 50)) {
        return false;
    }

    return true;
}

// Validate the entered course description
function validateCourseDescription() {
    if (!meetLength(courseDescription, 0, 2000)) {
        return false;
    }

    return true;
}

// Validate the selected course year
function validateCourseYear() {
    if (checkIfEmpty(courseYear)) {
        return false;
    }

    if (!containsCharacters(courseYear, 6)) {
        return false;
    }

    if (!fixedLength(courseYear, 1)) {
        return false;
    }

    return true;
}