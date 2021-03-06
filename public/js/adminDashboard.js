// Create Multiple User Accounts - START
$(document).ready(function () {

    $('#lecturers-create').click(function () {
        $('#btn-create-download').attr('onclick', getLink(1));
        $('#regNo').html("LecturerNo");
        $('input[name=upload-user-type]').val('2');
    });


    $('#students-create').click(function () {
        $('#btn-create-download').attr('onclick', getLink(2));
        $('#regNo').html("IndexNo");
        $('input[name=upload-user-type]').val('3');
    });

    // Delete Multiple User Accounts - START

    $('#lecturers-delete').click(function () {
        $('#btn-delete-download').attr('onclick', getLink(4));
        $('#regNo-del').html("LecturerNo");
        $('input[name=upload-user-type]').val('2');
    });


    $('#students-delete').click(function () {
        $('#btn-delete-download').attr('onclick', getLink(3));
        $('#regNo-del').html("IndexNo");
        $('input[name=upload-user-type]').val('3');
    });

    // Delete Multiple User Accounts - END
});

function getLink(num) {
    return `location.href='http://localhost/ALec/adminDashboard/download/${num}'`;
}
// Create Multiple User Accounts - END

// Manage Students Enrolment - START
$(document).ready(function () {
    $('#year-mode').click(function () {
        $('#file-mode-div').hide();
        $('#year-mode-div').show();
        $('#manage-users-btn').show();
        $('#model-cancel-btn').show();
    });

    $('#file-mode').click(function () {
        $('#year-mode-div').hide();
        $('#file-mode-div').show();
        $('#manage-users-btn').hide();
        $('#model-cancel-btn').hide();
    });

    $("#btn-create-download-enrollment").click(function (event) {
        event.preventDefault();
    });

    $('#assign-users').click(function () {
        $("#manage-users-btn").prop("value", "Assign Students");
        $("#manage-users-file-btn").prop("value", "Assign Students");
    });

    $('#delete-users').click(function () {
        $("#manage-users-btn").prop("value", "Remove Students");
        $("#manage-users-file-btn").prop("value", "Remove Students");
    });
});
// Manage Students Enrolment - END