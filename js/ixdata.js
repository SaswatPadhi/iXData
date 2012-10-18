$(function(){
    $("form[name=loginForm] button[type=submit]").click(function(){
        if($("#ldapUser").val() == "") {
            $("#loginMsg").html("<b><i class='icon-minus-sign icon-large'></i> The username field cannot be empty!</b>");
            $("#loginMsg").addClass("alert-error");
            $("#loginMsg").removeClass("alert-info");
            return false;
        }
        if($("#ldapPass").val() == "") {
            $("#loginMsg").html("<b><i class='icon-minus-sign icon-large'></i> The password field cannot be empty!</b>");
            $("#loginMsg").addClass("alert-error");
            $("#loginMsg").removeClass("alert-info");
            return false;
        }

        $("#loginMsg").html("<b><i class='icon-search icon-large'></i> Trying to log you in. Please hold on.</b>");
        $("#loginMsg").addClass("alert-info");
        $("#loginMsg").removeClass("alert-error");
        $.ajax({
            cache:      false,
            type:       'POST',
            url:        'lib/ajaxLogin.php',
            data:       'ldapUser='+ $("#ldapUser").val() + '&ldapPass=' + $('#ldapPass').val(),
            dataType:   'json',
            success:    function(data) {
                if(data.result) {
                    window.location = "./";
                } else {
                    $("#loginMsg").html("<b><i class='icon-minus-sign icon-large'></i> " + data.message + "</b>");
                    $("#loginMsg").addClass("alert-error");
                    $("#loginMsg").removeClass("alert-info");
                }
            },
            error:      function(jqXHR, textStatus, errorThrown) {
                $("#loginMsg").html("<b><i class='icon-minus-sign icon-large'></i> Connection Error: " + errorThrown + "</b>");
                $("#loginMsg").addClass("alert-error");
                $("#loginMsg").removeClass("alert-info");
            }
        });

        return false;
    });
})
