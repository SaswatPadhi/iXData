$(function() {
	$('#deadlineA').datetimepicker();
	$('#deadlineB').datetimepicker();
	$('#deadlineC').datetimepicker();
});


function validateExerciseInfo() {
    var question = $("#question").val();

    if(question == "") {
        alert("Enter some Question or cancel !");
        return false;
    }
    return true;
}
