<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Log;


class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
       
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        try {
            $messages = Messages::create([
                'title'     => $request->title,
                'body'      => $request->body,
            ]);
            return response()->json(new MessagesResource($messages),"status",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json("Error", 201);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        try {
            return  response()->json(new MessagesResource($message),"status",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return  response()->json(null,"user not found",404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        try {
                if ($request->has('title')) {
                    $message->title = $request->title;
                }
                if ($request->has('body')) {
                    $message->body = $request->body;
                }
                $message->save();
            return $this->customeResponse(new MessageResource($message),"Message updated successfully",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error!!,there is something not correct",500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
       
        try {
            $message->delete();
            return $this->customeResponse("","Message deleted",200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null,"Error!!,there is something not correct",500);
        }
    }
}
