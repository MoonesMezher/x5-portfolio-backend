<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;

class MessageController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();

        return $this->apiResponse(true , 'get messages successfully' , $messages , Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        Log::error($request);

        try {
            $messages = Message::create([
                'name' => $request->name,
                'body'  => $request->body,
                'email' => $request->email
            ]);

            return $this->apiResponse(true , 'created new message sucessfully' , $messages , Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->apiResponse(false , 'created new message failed' , $th , Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return $this->apiResponse(true , 'message deleted' , $message , Response::HTTP_OK);
    }
}
