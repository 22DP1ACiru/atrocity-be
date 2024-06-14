<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Get the list of conversations for the authenticated user.
     */
    public function getConversations()
    {
        $userID = Auth::id();

        // Get distinct conversations for the authenticated user
        $conversations = Message::where('senderID', $userID)
            ->orWhere('receiverID', $userID)
            ->orderBy('sent_at', 'desc')
            ->get()
            ->groupBy(function ($message) use ($userID) {
                return $message->senderID === $userID ? $message->receiverID : $message->senderID;
            });

        // Fetch user information for each conversation
        $conversationsData = [];
        foreach ($conversations as $conversationID => $messages) {
            $otherUser = User::find($conversationID);
            $latestMessage = $messages->first();
            $conversationsData[] = [
                'user' => $otherUser,
                'latestMessage' => $latestMessage,
            ];
        }

        return response()->json($conversationsData);
    }

    /**
     * Send a message.
     */
    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'receiverID' => 'required|exists:users,userID',
            'message' => 'required|string',
        ]);

        $message = new Message();
        $message->senderID = Auth::id();
        $message->receiverID = $validated['receiverID'];
        $message->message = $validated['message'];
        $message->save();

        return response()->json(['status' => 'Message sent successfully!', 'message' => $message]);
    }

    /**
     * Get messages for a specific conversation.
     */
    public function getMessages($userID)
    {
        $authID = Auth::id();

        // Ensure the authenticated user is part of the conversation
        $messages = Message::where(function($query) use ($authID, $userID) {
                $query->where('senderID', $authID)
                      ->where('receiverID', $userID);
            })->orWhere(function($query) use ($authID, $userID) {
                $query->where('senderID', $userID)
                      ->where('receiverID', $authID);
            })->orderBy('sent_at', 'asc')
            ->get();

        return response()->json($messages);
    }
}
