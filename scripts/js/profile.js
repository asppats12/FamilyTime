$(document).ready(function(){
    $("input").hide();
    var inputFName = $("input[name='fname']");
    var inputLName = $("input[name='lname']");
    var inputEmail = $("input[name='email']");
    var inputDate = $("input[name='dateOfBirth']");

    $("#btnProfile").click(function(){
        event.preventDefault();
        $("#lblFName").toggle();
        $(inputFName).toggle();
        if ($(inputFName).is(':visible')) {
            $(this).text("X");
        } else {
            $(this).text("Edit");
        }
    });

    $("#btnFName").click(function(){
        event.preventDefault();
        $("#lblFName").toggle();
        $(inputFName).toggle();
        if ($(inputFName).is(':visible')) {
            $(this).text("X");
        } else {
            $(this).text("Edit");
        }
    });

    $("#btnLName").click(function(){
        event.preventDefault();
        $("#lblLName").toggle();
        $(inputLName).toggle();
        if ($(inputLName).is(':visible')) {
            $(this).text("X");
        } else {
            $(this).text("Edit");
        }
    });

    $("#btnDateOfBirth").click(function(){
        event.preventDefault();
        $("#lblDateOfBirth").toggle();
        $(inputDate).toggle();
        if ($(inputDate).is(':visible')) {
            $(this).text("X");
        } else {
            $(this).text("Edit");
        }
    });

    $("#btnEmail").click(function(){
        event.preventDefault();
        $("#lblEmail").toggle();
        $(inputEmail).toggle();
        if ($(inputEmail).is(':visible')) {
            $(this).text("X");
        } else {
            $(this).text("Edit");
        }
    });


});