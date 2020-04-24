<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App/Mailers/AppMailer;
use App\Ticket;
use Validator;


class TicketsController extends Controller
{

    public function index()
    {
        $tickets = DB::table('tickets')->where('status', '!=', 2)->orderBy('id', 'desc')->paginate(5);

        return view('pages/support',compact('tickets'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function resolve($id,$problem)
    {
        $status = Ticket::where('ticket_id', $id)->update(['status' =>1]);

        return view('pages/resolve_page', ['id'=>$id, 'problem'=>$problem]);   
        
    }

    public function createTicket(Request $request)
    {

    	$validator = Validator::make($request->all(), [
            'customer_name'	=> 'required',
            'description'	=> 'required',
            'email'			=> 'required|email',
            'phone_number'	=> 'numeric|digits:10',
    	]);

    	if(!$validator->fails())
    	{
    		$random_number = $this->randomStrings();
            $email = $request->input('email');
    		$ticket = new Ticket([
	            'ticket_id' 	=> $random_number,
	            'customer_name'	=> $request->input('customer_name'),
	            'problem'		=> $request->input('description'),
	            'email'			=> $request->input('email'),
	            'phone_number' 	=> $request->input('phone_number'),
        	]);

    		$ticket->save();

            // $mailer->sendTicketInformation(Auth::user(), $ticket);

    		$response = [
    			'success' => true,
                'data'    => $random_number,
    			'message' => 'successfully ticket created!'
    		];
    		
    		return response()->json($response, 201);
    	}else{
            $response = [
                'success' => false,
                'errors'  => $validator->errors(),
                'message' => 'Validation Error'
            ];
            return response()->json($response, 400);
    	}

    }

    private function randomStrings()
    {
    	$str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

    	return substr(str_shuffle($str_result), 0, 10);
    }

}
