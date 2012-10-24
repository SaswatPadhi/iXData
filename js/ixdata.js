$(function(){
    $("form[name=loginForm] button[type=submit]").click(function(){
        if($("#ldapUser").val() == "") {
            $("#loginMsg")  .removeClass()
                            .addClass("alert alert-error")
                            .html("<b><i class='icon-minus-sign icon-large'></i> The username field cannot be empty!</b>");
            return false;
        }
        if($("#ldapPass").val() == "") {
            $("#loginMsg")  .removeClass()
                            .addClass("alert alert-error")
                            .html("<b><i class='icon-minus-sign icon-large'></i> The password field cannot be empty!</b>");
            return false;
        }

        $("#loginMsg")  .removeClass()
                        .addClass("alert alert-info")
                        .html("<b><i class='icon-search icon-large'></i> Trying to log you in. Please hold on.</b>");
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
                    $("#loginMsg")  .removeClass()
                                    .addClass("alert alert-error")
                                    .html("<b><i class='icon-minus-sign icon-large'></i> " + data.message + "</b>");
                }
            },
            error:      function(jqXHR, textStatus, errorThrown) {
                $("#loginMsg")  .removeClass()
                                .addClass("alert alert-error")
                                .html("<b><i class='icon-minus-sign icon-large'></i> Connection Error: " + errorThrown + "</b>");
            }
        });

        return false;
    });
})
