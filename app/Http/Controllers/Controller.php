<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Config;
use Mail;
use MetaTag;

use App\Models\Email;
use App\Models\Seo;
use App\Models\Settings;
define('USER_IMG', asset('public/frontend/images/profile-2.png'));
define('DEFAULT_IMG', asset('public/frontend/images/img_placeholder.jpg'));

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
     public function __construct(Request $request) {
        Config::set('services.facebook.redirect',url('login/facebook/callback'));
        Config::set('services.google.redirect',url('login/google/callback'));
        
         if (!$request->ajax()) {
             $route = Route::currentRouteName();
             $seo = Seo::where(['route' => $route])->first();
             if (empty($seo)) {
                 $seo = new Seo;
                 $seo->route = $route;
                 $seo->save();
             }
            
             if ($seo != NULL) {
                 MetaTag::set('title', $seo->title);
                 MetaTag::set('keyword', $seo->keyword);
                 MetaTag::set('description', $seo->description);
                // MetaTag::set('image', asset('images/locked-logo.png'));
             }
         }
    }

    public function rand_string($digits) {
        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz" . time();
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        return $rand;
    }

    public function rand_number($digits) {
        $alphanum = "123456789" . time();
        $rand = substr(str_shuffle($alphanum), 0, $digits);
        return $rand;
    }

    public function get_email_data($slug, $replacedata = array()) {
        $email_data = Email::where(['slug' => $slug])->first();
        $email_msg = "";
        $email_array = array();
        $email_msg = $email_data->body;
        $subject = $email_data->subject;
        if (!empty($replacedata)) {
            foreach ($replacedata as $key => $value) {
                $email_msg = str_replace("{{" . $key . "}}", $value, $email_msg);
            }
        }
        return array('body' => $email_msg, 'subject' => $subject);
    }

    public function SendMail($data) {
        // print_r($data);exit;
        $template = view('mail.layouts.template')->render();
        $content = view('mail.' . $data['template'], $data['data'])->render();
        $view = str_replace('[[email_message]]', $content, $template);
        
        $data['content'] = $view;
        // print_r($data);exit;
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: admin@laravel.com' . "\r\n" .
//                'Reply-To: no-reply@laravel.com' . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();
//        $va = str_replace('[[email_message]]', $content, $template);
//        return mail($data['to'], $data['subject'], $va, $headers);
        Mail::send([], [], function ($message) use ($data) {
            $message->from(env('MAIL_FROM_ADDRESS', 'support@balloonn.com'), env('PROJECT_NAME', 'Demo'));
            $message->replyTo(env('MAIL_FROM_ADDRESS', 'support@balloonn.com'), env('PROJECT_NAME', 'Demo'));
            $message->subject($data['subject']);
            $message->setBody($data['content'], 'text/html');
            $message->to($data['to']);
        });
    }
}
