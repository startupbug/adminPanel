

    $('#userTable').DataTable();
     $('#activityTable').DataTable({
        "order": [[ 3, "desc" ]]
});


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

	/* Add Todo Task */
	$("#addTask, #editTask").on("submit", function(e){
		e.preventDefault();
		
		console.log(e.target.id);
		console.log();

		//return false;
	     

		if(e.target.id == 'addTask'){
			//add Task
			var taskName = $('#taskName').val();
			data = {'taskName': taskName };

		}else if(e.target.id == 'editTask'){
			//edit Task
			var taskName = $('#taskNameEdit').val();
			//;
			data = {'taskName': taskName, 'taskEditId': $(this).closest('div').find("#taskEditId").val() };
		}


	  	$.ajaxSetup({
	      headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
	  	});

		$.ajax({
		  type: "POST",
		  url: $(this).attr('action'),
		  data: data,
		  success: function(data){
		  	console.log(data); 
		  	//$('#addTask').modal('toggle');

		  	if(data.status==200){

		  		toastr.success(data.msg);

		 		if(e.target.id == 'addTask'){
		 			$("#myModalNorm").modal('toggle');

			  		setTimeout(function(){ 
			  			location.reload();
			  		}, 600);

		 		}else if(e.target.id == 'editTask'){
		 			$("#myModalNormEdit").modal('toggle');
		 			
			  		setTimeout(function(){ 
			  			location.reload();
			  		}, 600);

		 		}


		  	}else if(data.status=202){
		  		toastr.error(data.msg)
		  	}
		  },
		  error: function(data){
		  	toastr.error("Something went wrong, Please Try again.");
		  }
		});
	});

	$(".todoEdit").on('click', function(e){
		e.preventDefault();
		var taskId = $(this).data('id');

	  	$.ajaxSetup({
	      headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
	  	});

		$.ajax({
		  type: "GET",
		  url: $(this).data('url'),
		  data: {'taskId': taskId },
		  success: function(data){
		  	console.log(data);
		  	// $('#addTask').modal('toggle');
		  	$("#taskNameEdit").val(data.task);
		  	$("#taskEditId").val(data.id);
		  },
		  error: function(data){
		  	toastr.error("Something went wrong, Please Try again.");
		  }
		});

	});

	/* Delete Todo */
	$(".todoDel").on('click', function(e){
		e.preventDefault();
		var taskId = $(this).data('id');

	  	$.ajaxSetup({
	      headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
	  	});

		$.ajax({
		  type: "POST",
		  url: $(this).data('url'),
		  data: {'taskId': taskId },
		  success: function(data){
		  	console.log(data);
		  	// $('#addTask').modal('toggle');

		  	if(data.status==200){
		  		toastr.success(data.msg);
		  		//$(this).closest('.liTodo').hide();
		  		setTimeout(function(){ 
		  			location.reload();
		  		}, 500);

		  	}else if(data.status=202){
		  		toastr.error(data.msg)
		  	}

		  },
		  error: function(data){
		  	toastr.error("Something went wrong, Please Try again.");
		  }
		});

	});


	$(".toDoCheck").change(function() {
	    
	    var status;
	    if(this.checked) {
	    	status = 1;
	    	$(this).siblings('span.text').css('text-decoration', 'line-through');
	    	$(this).siblings('span.text').css('color', '#c9cbcf');
	    	$(this).closest('li').find('.label-success').css('background-color', 'rgb(201, 203, 207)');
	    }
	    else{
	    	status = 0;
	    	$(this).siblings('span.text').css('text-decoration', 'none');
	    	$(this).siblings('span.text').css('color', '#000');
	    	$(this).closest('li').find('.label-success').css('background-color', '#00a65a');
	    }

	  	$.ajaxSetup({
	      headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
	  	});

		$.ajax({
		  type: "POST",
		  url: $(this).data('url'),
		  data: {'taskId': $(this).data('id'), 'checked' : status},
		  success: function(data){
		  	console.log(123);
		  	console.log(data);
		  	// $('#addTask').modal('toggle');

		  	if(data.status==200){
		  		toastr.success(data.msg);
		  	}else if(data.status=202){
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
	CKEDITOR.replace( 'editor2' );	
});