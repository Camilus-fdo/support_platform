<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Ticket;
use App\Support;

class SupportController extends Controller
{
    public function issueSolution(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'solution'	=> 'required',
    	]);

    	if(!$validator->fails())
    	{
    		$solution = new Support([
	            'ticket_id' 	=> $request->input('id'),
	            'solution'		=> $request->input('solution'),
        	]);

        	$solution->save();

            $this->updateIssueStatus($request->input('id'));

    		$response = [
    			'success' => true,
    			'message' => 'successfully solution created!'
    		];
    		
    		return response()->json($response, 201);
    	}else{
            $response = [
                'success'   => false,
                'errors'    => $validator->errors(),   
                'message' => 'VAlidation Errors'
            ];
            
            return response()->json($response, 400);
    	}    
    }

    private function updateIssueStatus($id)
    {
        $status = Ticket::where('ticket_id', $id)->update(['status' =>2]);
    }

    public function ticketResult(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'id'	=> 'required',
    	]);

    	if(!$validator->fails())
    	{
    		$details = DB::table('supports')->where('ticket_id', $request->id)->first();
    		
    		if(isset($details) || !empty($details)){
    			$response = [
	    			'success' 	=> true,
	    			'data'		=> $details
    			];

    			return response()->json($response, 200);
    		}else{
    			$response = [
	    			'success' 	=> false,
	    			'message'		=> 'Sorry, still support team no reply to your issue'
    			];

    			return response()->json($response, 403);
    		}

    		
    	}else{
    		
    	}
    }
}
