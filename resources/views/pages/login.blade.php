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
      <div class="form-template login-form">
        <h3 class="form-title">Sign in</h3>
        <div class="alert alert-danger" id="login_fail"></div>
        <form>
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" id="email">
            <span id="email_error"></span>
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" id="pwd">
            <span id="password_error"></span>
          </div>
          <button class="btn btn-primary btn-submit login-button">Login</button>
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

        var email         = $("input[name=email]").val();
        var password      = $("input[name=password]").val();

        $.ajax({
           type   :'POST',
           url    :'/checklogin',
           data   :{email:email, password:password},
           success:function(data){
              if(data.success == true){
                window.location.replace("{{ url('/support') }}");
              }
           },
            error: function (reject) {
                  if(reject.status === 302){
                    var errors = reject.responseJSON.message
                    $("#login_fail").text(errors)
                  }
                  if( reject.status === 400 ) {
                      var errors = reject.responseJSON.errors;
                      $.each(errors, function (key, val) {
                          $("#" + key + "_error").text(val[0]);
                      });
                  }
              }
            
        });
  });

</script>
