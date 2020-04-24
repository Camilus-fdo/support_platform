
<html>
<head>
	@include('includes.head')
</head>
<body>
	<header>
        @include('includes.header')
    </header>
    @if(isset(Auth::user()->email))
    <div class="container">
    	<div class="row justify-content">
    		<div class="form-template issue-form">
    			<h4 class="form-title">Support agent reply form</h4>
			    <form id="solution_form">
			        <div class="form-group">
			        	<label for="name">Ticket ID:</label>
			        	<input name="id" type="text" class="form-control" id="id" value="{{$id}}" disabled>
			        </div>
			        <label for="type">Problem:</label>
			        <div class="form-group"> 
			        	<textarea name="descirption" id="descirption" rows="5" cols="100" disabled>
			        		{{$problem}}
			        	</textarea>
			        </div>
			        <label for="type">Type Solution here:</label>
			        <div class="form-group"> 
			        	<textarea name="solution" id="solution" rows="5" cols="100"> 
			        	</textarea>
			        </div>
			        <span id="solution_error"></span>
			        <button class="btn btn-primary btn-submit">Reply</button>
			        <!-- <button class="btn btn-primary" href="{{ url('/support') }}">Skip</button> -->
			    </form>
			</div>
		</div>
	</div>
	@endif  
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

        var id          = $("input[name=id]").val();
        var description = $. trim($("#solution"). val());

        $.ajax({
           type   :'POST',
           url    :'/support/issue_solution',
           data   :{id:id, solution:description},
           success:function(data){              
              if(data.success == true){
              	alert("Successfuly reply");	
              	window.location.replace("{{ url('/support') }}");
              }
           },
            error: function (reject) {
                  if( reject.status === 400 ) {
                      $("#solution_error").text('')
                      var errors = reject.responseJSON.errors;
                      $.each(errors, function (key, val) {
                          $("#" + key + "_error").text(val[0]);
                      });
                  }
              }
        });
  });

</script>