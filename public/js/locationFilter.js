$("#sCountry").change(function () {
    var idCountry=$("#sCountry").val();
    var token=$("#sCountry").parent().find("input").val();
    $.ajax({
        url: "/site2/filterLocations",
        type: "post",
        data:{
            "idCountry":idCountry,
            "_token":token
        },
        success:function (data) {
            $("#sLocation").html(data);
        }
    });
});