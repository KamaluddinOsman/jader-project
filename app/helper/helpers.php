<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function ResponseJson($code, $msg, $data = [], $count = 0)
{
    $response = [
        'statues' => $code,
        'msg' => $msg,
        'data' => $data,
        'count' => $count,
    ];

    return response()->json($response);
}

function uploadImage($file, $dir)
{
    $user_id  = Auth::id();
    $fileName = $user_id . time() . rand (1111,9999) . '.' . $file->getClientOriginalExtension();
    $path = public_path('storage/images/'.$dir .'/' . $fileName);
    $global = config('constants.image_Url');
    $url = $global . $dir . '/' . $fileName;
    Image::make($file->getRealPath())->save($path, 100);
    return $url;
}


function settings()
{
    $setting = \App\Setting::find(1);

    if ($setting) {
        return $setting;
    } else {
        return new \App\Setting();
    }
}


function notifyByFirebase($title, $body, $tokens, $data = [])
    // paramete 5 =>>>> $type
{
// https://gist.github.com/rolinger/d6500d65128db95f004041c2b636753a
// API access key from Google FCM App Console
    // env('FCM_API_ACCESS_KEY'));

//    $singleID = 'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd';
//    $registrationIDs = array(
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
//        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd'
//    );
    $registrationIDs = $tokens;

    // prep the bundle
// to see all the options for FCM to/notification payload:
// https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support

// 'vibrate' available in GCM, but not in FCM
    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );
// I haven't figured 'color' out yet.
// On one phone 'color' was the background color behind the actual app icon.  (ie Samsung Galaxy S5)
// On another phone, it was the color of the app icon. (ie: LG K20 Plush)

// 'to' => $singleID ;      // expecting a single ID
// 'registration_ids' => $registrationIDs ;     // expects an array of ids
// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => $data
    );

    $headers = array(
        'Authorization: key=AAAA9L93ElQ:APA91bFuYrXo0O_k8psWkdcvV7jvJ1Gks2EfdgruN2hv17DaOc3v-mZ4GHVWXQKc82sXhd_T5KPghNUTm9RkYnQkDkXAJ8CsI6V9JjI4cE8EgAXoCOa7eveJG2jBiJbzPtBMVUJZ_Sa6',
        'Content-Type: application/json'

    );

    $ch = Curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;

}


function getDistance($late1, $lang1, $late2, $lang2)
{
    $earthRadius = 6371;
    $latFrom = deg2rad($late1);
    $lanFrom = deg2rad($lang1);
    $latTo = deg2rad($late2);
    $lanTo = deg2rad($lang2);

    $lateDelta = $latTo - $latFrom;
    $langDelta = $lanTo - $lanFrom;

    $angle = 2 * asin(sqrt(pow(sin($lateDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($langDelta / 2), 2)));

    $distance = round($angle * $earthRadius);

    return $distance;
}



function getMoreDistance($dests, $to_latlong, $time = null, $oneToOne = false)
{
    $googleApi  = 'AIzaSyBAObTSaOrJaLTvbTxLVsQuJWgLgBcHmvk';
    if ($oneToOne == true) {
        $from_latlong = $dests;
    }else{
        $from_latlong = implode("|", $dests);
    }

    $distance_data = file_get_contents(
        'https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins='.$from_latlong.'&destinations='.$to_latlong.'&key='.$googleApi
    );

    $distance_arr = json_decode($distance_data);

    if ($distance_arr->status !== 'OK'){
        return false;
    }

    foreach ( $distance_arr->rows[0] as  $key => $element )  {
        foreach ($element as $k => $e){
            $distance = $e->distance->text;
            $duration = $e->duration->text;
            // The matching ID
            $id = $dests[$k];

            $distance = preg_replace("/[^0-9.]/", "",  $distance);
            $duration = preg_replace("/[^0-9.]/", "",  $duration);

            // $distance=$distance * 1.609344;

            $kilometers = $distance * 1.609344;
            $meters = $kilometers * 1000;

            if(floor($duration / 60) != 0){
                $duration = floor($duration / 60) . " " ."h";
            }else{
                $duration = $duration . ' ' ."m";
            }

            if ( floor( $kilometers ) <= 0){
                $distance = floor($kilometers * 1000) . " " .'M';
            }else{
                $distance = floor($distance * 1.609344) . " " .'K';
            }


            // $distance=number_format($distance, 1, '.', '');
            // $duration=number_format($duration, 1, '.', '');
        }
    }


    return compact('distance','duration');



}



