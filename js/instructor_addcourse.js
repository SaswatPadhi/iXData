$(function() {
    $("form[name=courseregister] input")
        .popover({
            trigger: 'manual',
            delay:  {show: 400, hide: 100}
        })
        .blur(function(e) {
            $(this).popover('hide');
            e.preventDefault();
        })
        .focus(function(e) {
            $(this).popover('show');
            e.preventDefault();
        });

    checkCourse();
});

function validateCourseInfo() {
    var rollnoLL = $("#rollnoLL").val();
    var rollnoLL = $("#rollnoUL").val();
    var rollno = $("#rollno").val();
    var CN = $("#courseName").val();
    var CC = $("#courseCode").val();

    if(CC == "" || CN == "") {
        alert("Enter some courseCode and courseNumber");
        return false;
    }

    checkCourse();

    return true;
}

function checkCourse() {
    $("form[name=courseregister] input[name=courseCode]").blur(function() {
        $.ajax({
            cache:      false,
            type:       'POST',
            url:        '../lib/AJAX.php',
            data:       'ajaxFunction=CHK_SEMESTER&courseCode='+ $("#courseCode").val(),
            dataType:   'json',
            success:    function(data) {
                if(!data.result) {
                    $('#courseDuplicateLable').html('Course already running!');
                    $('#courseDuplicate div.modal-body div').html('This course has already been registered for the current semester.');
                    $('#courseDuplicate').modal('show');
                } else {
                    $.ajax({
                        cache:      false,
                        type:       'POST',
                        url:        '../lib/AJAX.php',
                        data:       'ajaxFunction=CHK_COURSE&courseCode='+ $("#courseCode").val(),
                        dataType:   'json',
                        success:    function(data) {
                            if(!data.result) {
                                $('#courseDuplicateLable').html('Course already exists!');
                                $('#courseDuplicate div.modal-body div').html('A course with the same course code already exists!');
                                $('#courseDuplicate').modal('show');
                            }
                        }
                    });
                }
            }
        });
    });
}
