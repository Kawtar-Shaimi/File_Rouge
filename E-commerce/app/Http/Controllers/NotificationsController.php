<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    public function client(){
        return view('client.notifications.index');
    }

    public function publisher(){
        return view('publisher.notifications.index');
    }

    public function admin(){
        return view('admin.notifications.index');
    }

    public function readNotification($id){

        $notification = DatabaseNotification::findOrFail($id);
        $notification->markAsRead();

        return redirect()->route('notifications.client')
        ->with('success', 'Notification marked as read');
    }

    public function deleteNotification($guard, $id){

        $notification = DatabaseNotification::findOrFail($id);
        $notification->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Notification deleted',
            'data' => [
                'count' => User::find(Auth::guard($guard)->user()->id)->notifications->count(),
                'unread_count' => User::find(Auth::guard($guard)->user()->id)->unreadNotifications()->count()
            ]
        ], 200)->header('Content-Type', 'application/json');
    }

    public function markAsRead($guard, $id){

        $notification = DatabaseNotification::findOrFail($id);
        $notification->markAsRead();

        return response()->json([
            'status' => 'success',
            'message' => 'Notification marked as read',
            'data' => [
                'count' => User::find(Auth::guard($guard)->user()->id)->unreadNotifications()->count()
            ]
        ], 200)->header('Content-Type', 'application/json');
    }
}