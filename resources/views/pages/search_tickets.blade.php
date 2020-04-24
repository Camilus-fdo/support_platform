<!DOCTYPE html>
<html>
<head>
	@include('includes.head')
</head>
<body>
	<header>
        @include('includes.header')
    </header>
    <div class="container">
    	<div class="row justify-content-center">
    		<input type="text" name="search" placeholder="Search Ticket">
    		<button class="btn btn-primary btn-submit">Submit</button>
    	</div>
    	<div class="row justify-content-center">
        <div class="form-template issue-form">
          <div id="search_fail""></div>
  		    <form id="solution_form">
  		        <div class="form-group">
  		        	<label for="name">Ticket ID:</label>
  		        	<input name="id" type="text" class="form-control" id="ticket_id" disabled>
  		        </div>
  		        <label for="type">Type Solution here:</label>
  		        <div class="form-group"> 
  		        	<textarea name="descirption" id="descirption" rows="5" cols="100"> 
  		        	</textarea>
  		        </div>		        
  		    </form>
        </div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $(".btn-submit").click(function(e){
        e.preventDefault();

        var id = $("input[name=search]").val();
        $.ajax({
           type   :'POST',
           url    :'/ticket_result',
           data   :{id:id},
           success:function(data){
              console.log('ssss', data.data.ticket_id)
              $('#ticket_id').val(data.data.ticket_id)
              $('textarea#descirption').val(data.data.solution)
           },
           error: function (reject) {
                  if( reject.status === 403 ) {
                      
                      var errors = reject.responseJSON.message;
                      $("#search_fail").text(errors)
                  }
              }
        });
  });

</script>