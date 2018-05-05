

    $('#userTable').DataTable();

//$( document ).ready(function() {

//Permission Addition to Role Ajax request
$("input[name ='permission']").on("change", function(e){
	e.preventDefault();
	console.log($(this).val());
});

//});