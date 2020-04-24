<nav class="navbar navbar-expand-lg navbar-light bg-faded">
	  	<a class="navbar-brand" href="#">Support Platform</a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  	</button>
	  	<div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
		    <div class="navbar-nav">
			  	<a class="nav-item nav-link active" href="{{ url('/') }}">
			  		Guest <span class="sr-only">(current)</span>
			  	<a class="nav-item nav-link" href="{{ url('/search_tickets') }}">
			  		Check Ticket
			  	</a>	
			  	<a class="nav-item nav-link" href="{{ url('/login') }}">
			  		Login
			  	</a>
			  	<!-- <a class="nav-item nav-link" href="#">Pricing</a> -->
			  	<!-- <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
	    	</div>
  		</div>
	</nav>