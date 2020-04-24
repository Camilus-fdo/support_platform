<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    @include('includes.head')
  </head>
  <body>
    <header>
        @include('includes.header')
    </header>
    <div class="container">
      <div class="row justify-content">
        <div class="form-template issue-form">
          <h4 class="form-title">Open a support ticket</h4>
          <form id="issue_form">
            <div class="form-group">
              <label for="name">Name:</label>
              <input name="name" type="text" class="form-control" id="name">
              <span id="customer_name_error"></span>
            </div>
            <div class="form-group">
              <label for="type">Problem Descirption:</label>
              
            </div>
            <div class="form-group">
              <textarea name="descirption" id="descirption" rows="4" cols="50"> 
              </textarea> 
            </div>
            <span id="description_error"></span>
            <div class="form-group">
              <label for="price">Email:</label>
              <input name="email" type="email" class="form-control" id="email">
              <span id="email_error"></span>
              
            </div>
            <div class="form-group">
              <label for="phone_number">Phone Number:</label>
              <input name="phone" type="text" class="form-control" id="phone">
              <span id="phone_number_error"></span>
            </div>
            <button class="btn btn-primary btn-submit">Submit</button>
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

        var name          = $("input[name=name]").val();
        var description   = $. trim($("#descirption"). val());
        var email         = $("input[name=email]").val();
        var phone         = $("input[name=phone]").val();

        $.ajax({
           type   :'POST',
           url    :'/guset/issue_ticket',
           data   :{customer_name:name, description:description, email:email, phone_number:phone},
           success:function(data){
              alert("This is your ticket" + data.data)
              window.location.replace("{{ url('/') }}");
           },
            error: function (reject) {
                  if( reject.status === 400 ) {
                      $("#customer_name_error").text('')
                      $("#description_error").text('')
                      $("#email_error").text('')
                      $("#phone_number_error").text('')
                      var errors = reject.responseJSON.errors;
                      $.each(errors, function (key, val) {
                          $("#" + key + "_error").text(val[0]);
                      });
                  }
              }
            
        });
  });

</script>