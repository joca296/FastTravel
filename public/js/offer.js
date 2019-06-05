$("#modalImageSmall").hover(function(){
    $(this).find(".centered").toggle();
});

$("#reserve").submit(function(e){
    e.preventDefault();

    var idOffer = $("#idOffer").val();
    var numberOfPeople = $("#numberOfPeople").val();
    var token = $("input[type='hidden']").val();

    if(isNaN(numberOfPeople) || numberOfPeople == "" || numberOfPeople==0){
        alert("Invalid input.");
    }
    else{
        $.ajax({
            url: "/site2/reserve/"+idOffer,
            type: "post",
            data:{
                "numberOfPeople":numberOfPeople,
                "_token":token
            },
            success:function (data) {
                alert("You have successfully reserved this offer.");
            },
            error:function (error) {
                console.log(error);
            }
        });
    }
});