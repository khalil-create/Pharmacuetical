<?php

namespace App\Http\Controllers\Notifications;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getAllUnReadNotifications()
    {
        return view('notifications.allUnReadNotifications');
    }
    public function unReadNotification()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
}
