$("#survey").on("submit",function (e) {
    e.preventDefault();

    var idAnswer1=$("#question1").val();
    var idAnswer2=$("#question2").val();
    var comment=$("#comment").val();
    var token = $("input[type='hidden']").val();

    var isOK=1;

    if(idAnswer1 == ""){
        alert("You havent answered the first question.");
        isOK=0;
    }

    if(idAnswer2 == ""){
        alert("You havent answered the second question.");
        isOK=0;
    }

    if(isOK == 1) $.ajax({
        url: "/site2/survey",
        type: "post",
        data:{
            "question1":idAnswer1,
            "question2":idAnswer2,
            "comment":comment,
            "_token":token
        },
        success: function (data) {
            $("#surveyDiv").html(data);
        },
        error: function (error) {
            alert(error);
        }
    });
});