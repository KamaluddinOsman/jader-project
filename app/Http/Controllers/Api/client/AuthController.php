<?php

namespace App\Http\Controllers\Api\client;

use App\BankAccount;
use App\Client;
use App\Mail\ResetPassword;
use App\RequestLog;
use App\Token;
use File;
use http\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Client as ClientResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;

class AuthController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth:client', ['except' => ['facebookAuth', 'login', 'register', 'newPassword']]);
//    }

    protected $baseAuthFailedResponse = [
        'status' => false,
        'message' => 'Base authentication failed'
    ];
    protected $facebookAuthFailedResponse = [
        'status' => false,
        'message' => 'Facebook authentication failed'
    ];
    protected $vkAuthFailedResponse = [
        'status' => false,
        'message' => 'VK authentication failed'
    ];


    /**
     * Echo function
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return response()->json($request);
    }

    /**
     * Authorise user with base authorisation using email and password
     *
     * @param Request $request - expects fields: email, password
     * @return \Illuminate\Http\JsonResponse
     */
    public function baseAuth(Request $request)
    {
        $isAuthorised = Auth::attempt(
            array(
                'email' => $request->input('email'),
                'password' => $request->input('password')
            )
        );
        if ($isAuthorised) {
            return response()->json(Auth::user());
        }

        return response()->json($this->baseAuthFailedResponse);
    }

    /**
     * Authorise user using facebook accessToken received in the request
     *
     * @param Request $request - expects fields: accessToken, username, fullName, email
     * @return \Illuminate\Http\JsonResponse
     */
    public function facebookAuth(Request $request, LaravelFacebookSdk $fb)
    {
        if (!Auth::check()) {
            // Receive access token request.
            $accessToken = $request->input('accessToken');
            // Make a request to the /me Facebook graph using the facebook access token
            try {
                $response = $fb->get('/me?fields=id,name,email', $accessToken);
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                $this->facebookAuthFailedResponse['details']['message'] = $e->getMessage();
                $this->facebookAuthFailedResponse['details']['error_code'] = $e->getCode();

                return response()->json($this->facebookAuthFailedResponse);
            }

            // Verify that the Facebook user exists and match to a user in my database or create new one

            // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
            $facebookUser = $response->getGraphUser();

            // Create the user if it does not exist or update the existing entry.
            // This will only work if you've added the SyncableGraphNodeTrait to your User model.
            $user = Client::createOrUpdateGraphNode($facebookUser);

            Auth::login($user, true);
        }

        return response()->json(Auth::user());
    }

    public function vkAuth(Request $request)
    {
        return response()->json($this->vkAuthFailedResponse);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */




    public function checkUser(Request $request)
    {
        RequestLog::create(['service' => 'login']);

        $validator = validator()->make($request->all(), [
            "phone" => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null, null);
        }

        $client = Client::where('phone', $request->phone)->first();
        $code =   mt_rand(1000, 9000);
        $message = "
        كلمة مرور صالحة لمرة واحدة
        رمز: [$code]
        لـ: تسجيل الدخول لتطبيق قدها
        ";



        if ($client) {
            
           /// test
           if($request->phone === '503454825'){
                  
           return ResponseJson('200', ' تحقق من رسايل هاتفك', $code);
  }
                  
            $client->update([
                'verification_code' => $code
            ]);
            
            
        

            if ($client) {
              
                $code = rand(1111, 9999);
                $first_name = $client->first_name;
                $phone = $client->phone;
                $update = $client->update(['verification_code' => $code]);

//                $username = 'Almalkisms';
//                $password = '557002096';
//                $sender = 'EP';
//                $url = 'https://www.enjazsms.com/api/sendsms.php?';


                if ($update) {
                    $username = settings()->sms_USERNAME;
                    $password = settings()->sms_PASSWORD;
                    $sender = settings()->sms_SENDER;
                    $url = settings()->sms_URL;

                    $msg = 'مرحبا' . ' ' . $first_name . ' ' . 'كود تعديل الرقم الخاص بك ' . ' ' . $code;
                    $url = $url;

                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,
                        "username=" . $username . "&password=" . $password . "&message=" . $msg . "&numbers=" . $phone . "&sender=" . $sender . "&unicode=E&return=full");


                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                   $server_output = curl_exec($ch);

                    curl_close($ch);

                    return ResponseJson('200', ' تحقق من رسايل هاتفك', $code);

                }

            } else {
                return ResponseJson('300', 'هذا الحساب غير موجود');
            }
  
 
               return ResponseJson('200', 'Successfully, The message will take a few minutes' , $data);

        }

        return ResponseJson('300', 'غير موجود', null);
    }
    
    
    


    public function activeAccount(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "code" => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null, null);
        }

         

        $client = Client::where('verification_code', $request->code)->first();

        if ($client) {
            
            /// test
              if($request->code != '1000'){
                  
              $update = $client->update([
                'verification_code' => null,
                'activated' => 1,
               ]);
             
              }
       

            $token = JWTAuth::fromUser($client);
    
    
            try {
                
            $data = new ClientResource(Client::find($client->id));

            } catch (JWTException $e) {
                return response()->json(['error' => 'could_not_create_token'], 500);
            }


            if ($client->activated == 1) {
                return ResponseJson('200', 'تم تسجيل الدخول بنجاح', compact('token', 'data'));
            } elseif ($client->activated == 2) {
                return ResponseJson('2', 'يرجى ادخال كود التحقق المرسل لهاتفك', null);
            } else {
                return ResponseJson('0', 'حسابك متوقف الان يرجى التحدث مع الاداره', null);
            }
   
   
   
   
        } else {
            return ResponseJson('400', 'نرجو التحقق من كود التفعيل', null);
        }


    }

    public function checkPhone(Request $request)
    {
        $validator = validator()->make($request->all(), [
            "phone" => 'required| numeric|unique:addresses',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null, null);
        }

        return ResponseJson('300', 'غير موجود', null);

    }

    public function login(Request $request)
    {
        RequestLog::create(['content' => $request->except('password'), 'service' => 'login']);

        $validator = validator()->make($request->all(), [
            "phone" => 'required',
            "password" => 'required '
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null, null);
        }

        $client = Client::where('phone', $request->phone)->first();
        $credentials = $request->only('phone', 'password');

        try {
            if (!$token = auth('client')->attempt($credentials)) {

                return ResponseJson('400', 'نرجو التحقق من البيانات', null);

            } else {
                $data = new ClientResource(Client::find($client->id));
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                if ($client->activated == 1) {
                    return ResponseJson('200', 'تم تسجيل الدخول بنجاح', compact('token', 'data'));
                } elseif ($client->activated == 2) {
                    return ResponseJson('2', 'يرجى ادخال كود التحقق المرسل لهاتفك', null);
                } else {
                    return ResponseJson('0', 'حسابك متوقف الان يرجى التحدث مع الاداره', null);
                }

            }

        }
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        RequestLog::create(['content' => $request->except('password'), 'service' => 'register']);

        $validator = validator()->make($request->all(), [
            "first_name" => 'required|string|between:2,100',
            "last_name" => 'required|string|between:2,100',
//            "gender" => 'required',
//            'email' => 'string|email|max:100|unique:clients',
//            "district_id" => 'required | exists:districts,id',
            "phone" => 'required | numeric |unique:clients',
            'password' => 'required|string|min:6',
//            'image' => 'mimes:jpeg,jpg,png',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null, null);

        }

        $request->merge(['full_name' => $request->first_name . ' ' . $request->last_name]);
        $request->merge(['activated' => 2]);
        $request->merge(['phone' => '+966' . $request->phone]);
        $code = rand(1111, 9999);

        $client = Client::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)],
            ['full_name' => $request->first_name . ' ' . $request->last_name],
            ['verification_code' => $code]

        ));

        //Upload Image
        if ($file = $request->file('image')) {
            $client->image = uploadImage($file, 'client');
        }

        $client->save();

        $username = settings()->sms_USERNAME;
        $password = settings()->sms_PASSWORD;
        $sender = settings()->sms_SENDER;
        $url = settings()->sms_URL;
//            $username = 'Almalkisms';
//            $password = '557002096';
//            $sender = 'EP';
//            $url = 'https://www.enjazsms.com/api/sendsms.php?';

        $msg = 'مرحبا' . ' ' . $request->first_name . ' ' . 'كود تفعيل حسابك لدى تطبيق Jadeeer ' . ' ' . $code;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "username=" . $username . "&password=" . $password . "&message=" . $msg . "&numbers=+966" . $request->phone . "&sender=" . $sender . "&unicode=E&return=full");


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);

        curl_close($ch);

//        $token = JWTAuth::fromUser($client);
        return ResponseJson('200', 'سوف يصل لك كود تفعيل حسابك لدينا على هاتفك', compact('client'));
    }

    public function ResetPassword(Request $request)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'ResetPassword']);

        $validator = validator()->make($request->all(), [
            "phone" => 'required | numeric',
        ]);
        if ($validator->fails()) {
            return ResponseJson('0', 'أعد التحقق من كتابة رقم الهاتف', null);
        }

        $client = Client::where('phone', $request->phone)->first();

        if ($client) {
            $code = rand(1111, 9999);
            $first_name = $client->first_name;
            $phone = $client->phone;
            $update = $client->update(['verification_code' => $code]);

//                $username = 'Almalkisms';
//                $password = '557002096';
//                $sender = 'EP';
//                $url = 'https://www.enjazsms.com/api/sendsms.php?';


            if ($update) {
                $username = settings()->sms_USERNAME;
                $password = settings()->sms_PASSWORD;
                $sender = settings()->sms_SENDER;
                $url = settings()->sms_URL;

                $msg = 'مرحبا' . ' ' . $first_name . ' ' . 'كود تعديل الرقم الخاص بك ' . ' ' . $code;
                $url = $url;

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "username=" . $username . "&password=" . $password . "&message=" . $msg . "&numbers=" . $phone . "&sender=" . $sender . "&unicode=E&return=full");


                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $server_output = curl_exec($ch);

                curl_close($ch);

                return ResponseJson('200', 'تحقق من هاتفك', null);

            }

        } else {
            return ResponseJson('0', 'هذا الحساب غير موجود');
        }
    }

    public function newPassword(Request $request)
    {
        RequestLog::create(['content' => $request->except('password', 'password_confirmation'), 'service' => 'newPassword']);

        $validator = validator()->make($request->all(), [
            "verification_code" => 'required | numeric',
            'password' => 'required|confirmed|min:6',
            "password_confirmation" => 'required '
        ]);
        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $data = [];

        $client = Client::where('verification_code', $request->verification_code)->first();

        if ($client) {
            $data[] = [
                "first_name" => $client->first_name,
                "last_name" => $client->last_name,
                "email" => $client->email,
                "phone" => $client->phone,
            ];

            $client->update(['password' => bcrypt($request->password), 'verification_code' => null]);
            return ResponseJson('200', 'تم تعديل الرقم السرى ', $data);

        } else {

            return ResponseJson('0', 'رمز التحقق خاطئ ');

        }
    }


    public function get_profile(Request $request)
    {
        $client = $request->user();
        $data = new ClientResource(Client::find($client->id));

        return ResponseJson('200', 'بيانات العميل ', $data);

    }

    public function profile(Request $request)
    {
        $validator = validator()->make($request->all(), [
        
            "phone" => 'numeric |unique:Clients,phone,' . $request->user()->id,
            "district_id" => 'exists:districts,id',
            'image' => 'mimes:jpeg,jpg,png',
        ], [

        ]);
        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $client = $request->user();

        if ($client->api_token === $request->api_token) {
            //Upload Image
            if ($request->hasFile('image')) {

                File::delete('storage/images/client/' . $client->image);

                $image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    $filename = time() . '.' . $image_tmp->getClientOriginalExtension();
                    $path = public_path('storage/images/client/' . $filename);
                    $global = config('constants.image_Url');
                    $url = $global . 'client/' . $filename;
                    Image::make($image_tmp->getRealPath())->resize(468, 249)->save($path);
                    $client->image = $url;
                }
            }


            $client->first_name = ($request->first_name == null) ? $client->first_name : $request->first_name;
            $client->last_name = ($request->last_name == null) ? $client->last_name : $request->last_name;
            $client->phone = ($request->phone == null) ? $client->phone : $request->phone;
            $client->email = ($request->email == null) ? $client->email : $request->email;
            $client->district_id = ($request->district_id == null) ? $client->district_id : $request->district_id;
            $client->image = (!$request->hasFile('image')) ? $client->image : $url;
        
            $client->save();
            return ResponseJson('200', 'تم تعديل البيانات ', $client);
        } else {
            return ResponseJson('0', 'يجب تسجيل الدخول ');

        }
    }


//    Register notification token
    public function RegisterNotificationToken(Request $request)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'RegisterNotificationToken']);

        $validator = validator()->make($request->all(), [
            "platform" => 'required|in:android,ios',
            "token" => 'required ',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        Token::where('token', $request->token)->first();

//        Token::where('token', $request->token)->delete();

        Auth()->user()->tokens()->create($request->all());
        return ResponseJson('200', 'تم الحفظ');
    }

    //Remove notification token
    public function RemoveNotificationToken(Request $request)
    {
        RequestLog::create(['content' => $request->all(), 'service' => 'RemoveNotificationToken']);

        $validator = validator()->make($request->all(), [
            "platform" => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseJson('0', $validator->errors()->first(), null);
        }

        $token = Token::where(['tokntable_id' => $request->user()->id, 'platform' => $request->platform])->delete();

        if ($token) {
            return ResponseJson('200', 'تم الحذف');
        } else {
            return ResponseJson('0', 'تحقق من البيانات');
        }
    }

}
