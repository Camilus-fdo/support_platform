<html>
<head>
	@include('includes.head')
</head>
<body>
	<header>
        @include('includes.header')
    </header>
    <div class="container"> 
    @if(isset(Auth::user()->email))
	    <div class="alert alert-danger success-block">
		    <strong>Welcome {{ Auth::user()->name }}</strong>
			<br />
	    	<a href="{{ url('/logout') }}">Logout</a>
	    </div>
	    <!-- <input type="text" class="form-controller" id="search" name="search"></input> -->
	    <table class="table table-bordered">
	        <tr>
	            <th>Number</th>
	            <th>Ticket id</th>
	            <th>Name</th>
	            <th>Problem</th>
	            <th>Email</th>
	            <th>Phone number</th>
	            <th width="280px">Actions</th>
	        </tr>
	        <tbody onload="reload()">
		    @foreach ($tickets as $ticket)
	            <tr class="{{$ticket->status == 0 ? 'pending-rows':''}}">
	                <td>{{ $ticket->id }}</td>
	                <td>{{ $ticket->ticket_id }}</td>
	                <td>{{ $ticket->customer_name }}</td>
	                <td>{{ $ticket->problem}}</td>
	                <td>{{ $ticket->email }}</td>
	                <td>{{ $ticket->phone_number }}</td>
	                <td>
	                    <form>
	                        <a class="btn btn-primary" href="{{ route('resolve',['id' => $ticket->ticket_id, 'problem'=>$ticket->problem]) }}">Open Ticket</a>
	                    </form>
                	</td>
	                
	            </tr>
	        @endforeach
	    	</tbody>
        </table>
        <div class="pagination justify-content-center">
 			{{ $tickets->links() }}
		</div>
   @else
    	<script>window.location = "/login";</script>
   @endif
	</div>
</body>
</html>

<script type="text/javascript">

</script>