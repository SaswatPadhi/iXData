$(function() {
    $("form[name=courseregister] input").blur(function() {
        $("#fieldAlert").animate({
            opacity: 0.0
        }, 500);
    });

    $("form[name=courseregister] input[name=courseCode]").focus(function() {
        $("#fieldAlert").stop().removeClass().addClass("alert alert-info")
                        .html("Course Code is a unique 8 character identifier for a course.")
                        .animate({
                            opacity: 1.0
                        }, 500);
    });

    $("form[name=courseregister] input[name=courseName]").focus(function() {
        $("#fieldAlert").stop().removeClass().addClass("alert alert-info")
                        .html("Course Name is the title of the course. It can be as long as you wish.")
                        .animate({
                            opacity: 1.0
                        }, 500);
    });

    $("form[name=courseregister] input[name=rollnoPRE]").focus(function() {
        $("#fieldAlert").stop().removeClass().addClass("alert alert-info")
                        .html("A Roll No. Prefix should be common to all roll numbers in the 'Range'.")
                        .animate({
                            opacity: 1.0
                        }, 500);
    });

    $("form[name=courseregister] input[name=rollnoLL]").focus(function() {
        $("#fieldAlert").stop().removeClass().addClass("alert alert-info")
                        .html("The initial suffix of the roll number, to be appended after the prefix.")
                        .animate({
                            opacity: 1.0
                        }, 500);
    });

    $("form[name=courseregister] input[name=rollnoUL]").focus(function() {
        $("#fieldAlert").stop().removeClass().addClass("alert alert-info")
                        .html("The suffix that appears after the prefix, in the very last roll number.")
                        .animate({
                            opacity: 1.0
                        }, 500);
    });

    $("form[name=courseregister] input[name=rollno]").focus(function() {
        $("#fieldAlert").stop().removeClass().addClass("alert alert-warning")
                        .html("Please enter any additional roll numbers, separated by COMMA ( , ) or SEMI-COLON ( ; ).")
                        .animate({
                            opacity: 1.0
                        }, 500);
    });

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
    return true;
}
