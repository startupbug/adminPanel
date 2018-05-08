

    $('#userTable').DataTable();



	//Permission Addition to Role Ajax request
	$(".permission").on("change", function(e){
		e.preventDefault();

	  	$.ajaxSetup({
	      headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
	  	});

		$.ajax({
		  type: "POST",
		  url: $(this).find(':selected').data('url'),
		  data: {'role_id':$(this).find(':selected').data('role'), 'permission_id':$(this).val()},
		  success: function(data){
		  	console.log(data);
		  	if(data.status==200){
		  		toastr.success(data.msg);
		  		
		  		setTimeout(function(){ 
		  			location.reload();
		  		}, 1200);

		  	}else if(data.status=202){
		  		toastr.warning(data.msg);
		  	}else if(data.status=204){
		  		toastr.error(data.msg);
		  	}
		  },
		  error: function(data){
		  	toastr.error("Something went wrong, Please Try again.");
		  }
		});

	});

	//deleting permission from ajax
	$(".permissionDel").on("click", function(e){
		e.preventDefault();

	  	$.ajaxSetup({
	      headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
	  	});

		$.ajax({
		  type: "POST",
		  url: $(this).data('url'),
		  data: {'role_id':$(this).data('role'), 'permission_id':$(this).val()},
		  success: function(data){
		  	console.log(data);
		  	if(data.status==200){
		  		toastr.success(data.msg);
		  		
		  		setTimeout(function(){ 
		  			location.reload();
		  		}, 1200);

		  	}else if(data.status=204){
		  		toastr.error(data.msg)
		  	}
		  },
		  error: function(data){
		  	toastr.error("Something went wrong, Please Try again.");
		  }
		});

	});

$( document ).ready(function() {
	CKEDITOR.replace( 'editor1' );
});