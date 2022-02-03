<?php

if (! function_exists('aurl')) {
    function aurl($url=null){
        return url('admin/'.$url);
    }
}

if(!function_exists('admin')){
    function admin(){
        return auth()->guard('admin');
    }
}

if(!function_exists('NotificationsTypeURL')){
    function NotificationsTypeURL($notification){
        $type = $notification->type;
        if($type == "App\Notifications\AddComment"){
            $text = $notification->data['text'];
            if($text == 'تم الرد على تعليقك'){
                $comment = App\Models\Comment::find($notification->data['object_id']);
                $post_id = $comment->post->slug;

                return $post_id;

            } else {
                return "comments";
            }
        }
        if($type == "App\Notifications\AddReport"){
            return "reports";
        }
        if($type == "App\Notifications\ContactMessage"){
            return "contacts";
        }

        if($type == "App\Notifications\BlockUser"){
            return "#";
        }
        if($type == "App\Notifications\DeleteComment"){
            return "#";
        }
        if($type == "App\Notifications\ReportResponse"){
            return "#";
        }
    }
}

if(!function_exists('MonthNameAR')){
    function MonthNameAR($month){
        if($month == 1){$monthname = "يناير";} 
        if($month == 2){$monthname = "فبراير";}
        if($month == 3){$monthname = "مارس";} 
        if($month == 4){$monthname = "أبريل";} 
        if($month == 5){$monthname = "مايو";} 
        if($month == 6){$monthname = "يونيو";} 
        if($month == 7){$monthname = "يوليو";} 
        if($month == 8){$monthname = "أغسطس";} 
        if($month == 9){$monthname = "سبتمبر";} 
        if($month == 10){$monthname = "أكتوبر";}
        if($month == 11){$monthname = "نوفمبر";} 
        if($month == 12){$monthname = "ديسمبر";}
        return $monthname;
    }
}
