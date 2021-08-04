<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\UserNotification;
use Illuminate\Notifications\Notification;
trait userTrait
{
    function saveImage($file,$folder)
    {
            $extention =$file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $path = $folder;
            $file->move($path,$filename);

            return $filename;
    }
    function deleteFile($file_old,$file_path)
    {
        unlink(public_path($file_path.$file_old));
    }
    static function getSinceTimePast($updated_at)
    {
        $dateAndTime = explode(' ',$updated_at); 
        $notifyTime = explode(':',$dateAndTime[1]);
        $notifyHour = $notifyTime[0];
        $notifyMin = $notifyTime[1];
        
        $notifyDate = date("Y M d",strtotime($dateAndTime[0]));
        $notifyDate = explode(' ',$notifyDate);
        $notifyDay = $notifyDate[2];
        $notifyMonth = $notifyDate[1];

        $currentDate = date("Y M d",strtotime(Carbon::now()));
        $currentDate = explode(' ',$currentDate);
        $currentDay = $currentDate[2];
        $currentMonth = $currentDate[1];
        
        $currentTime = date("h:i:A",strtotime(Carbon::now()));
        $currentTime = explode(':',$currentTime);
        $currentHour = $currentTime[0];
        $currentMin = $currentTime[1];
        $currentPeriod = $currentTime[2];
        $currentHour += $currentPeriod == 'PM' ? 12:0;
        if($notifyMonth == $currentMonth){
            if ($currentDay == $notifyDay) {
                if($currentHour == $notifyHour){
                    if($currentMin == $notifyMin)
                        $since = 'الان';
                    else{
                        $dif = $currentMin - $notifyMin;
                        $since = 'منذ '.$dif.' دقيقة';
                    }
                }
                else {
                    if($currentHour-1 == $notifyHour){
                        $dif = (60 - $notifyMin) + $currentMin;
                        $since = 'منذ '.$dif.' دقيقة';
                    }
                    else{
                        $dif = $currentHour - $notifyHour;
                        $since = 'منذ '.$dif.' ساعة';
                    }
                }
            } else {
                if($currentDay-1 == $notifyDay){
                    $dif = 24 - $notifyHour;
                    $dif += $currentHour;
                    if($dif == 24)
                        $since = 'منذ يوم';
                    else
                        $since = 'منذ '.$dif.' ساعة';
                }
                else{
                    if($notifyDay < $currentDay){
                        $dif = $currentDay - $notifyDay;
                        $since = 'منذ '.$dif.' يوم';
                    }
                    else
                        $since = 'منذ الشهر الماضي';
                }
            }
        } else {
            $since = 'منذ '.$dateAndTime[0];
        }
        return $since;
    }
    static function getRouteReadNotification($title)
    {
        if ($title == 'مهام')
            $route = 'show.tasks';
        elseif($title == 'اطباء')
            $route = 'show.doctors';
        elseif($title == 'عملاء')
            $route = 'show.customers';
        elseif($title == 'خطط')
            $route = 'show.plans';
        elseif($title == 'اختبارات')
            $route = 'show.tests';
        elseif($title == 'اهداف')
            $route = 'show.objectives';
        elseif($title == 'دراسات')
            $route = 'show.studies';
        elseif($title == 'خدمات')
            $route = 'show.services';
        elseif($title == 'مواد')
            $route = 'show.courses';

        return $route;
    }
    function unreadNotify($id)
    {
        $unreadNotify = Auth::user()
                                ->unreadNotifications
                                ->where('id',$id)
                                ->first();
            if($unreadNotify)
                $unreadNotify->markAsRead();
    }
    function notifyUser($title,$content,$id)
    {
        $data = ['title' => $title , 'content' => $content];
        User::find($id)->notify(new UserNotification($data));
    }
}
