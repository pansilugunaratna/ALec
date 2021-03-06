document.getElementById("search").addEventListener('submit', function (event) {
    event.preventDefault();
});

$(document).ready(function () {
    // LIVE SEARCH START
    function loadData() {
        const formData = $("#search").serialize();

        $.post(
            "http://localhost/ALec/courseDetails/search/",
            formData,
            function (response) {
                $("#table-content").html(response);
            }
        );

    }

    $("#search-tag").keyup(function () {
        let search = $(this).val();

        if (search !== "") {
            // console.log(search);
            loadData();
        }
    });
    // LIVE SEARCH END

    $("#year").change(function () {
        const temp = $(this).val();

        $.ajax({
            type: "GET",

            url: "http://localhost/ALec/courseDetails/ajaxCourseDetails/" + temp,
            dataType: "html",
            success: function (response) {
                $("#table-content").html(response);
            }
        })
    });

})