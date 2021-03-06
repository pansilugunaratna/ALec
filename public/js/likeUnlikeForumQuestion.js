let liked = "rgb(255, 165, 0)";
let unliked = "rgb(0, 0, 0)";

$(document).ready(function () {
    $(document).delegate('.vote-highlight', 'click', function () {
        changeVote(this);
        changeColor(this);
    });

    function changeColor(element) {
        const colorValue = $(element).css("color");

        if (colorValue == unliked) {
            $(element).css("color", liked);
        } else if (colorValue == liked) {
            $(element).css("color", unliked);
        }
    }

    function changeVote(element) {
        const colorValue = $(element).css("color");
        const questionId = $(element).parent().parent().parent().children().first().val();

        //Change Number - START
        const pointsTag = $(element).next();
        var points = parseInt(pointsTag.text());

        if (colorValue == unliked) {
            points++;
        } else if (colorValue == liked) {
            points--;
        }

        pointsTag.text(points);
        //Change Number - END

        $.ajax({
            type: "GET",

            url: "http://localhost/ALec/sessionLiveForumStudent/changeVote/" + questionId
        })
    }

});