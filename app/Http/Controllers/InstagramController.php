<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Instagram;

class InstagramController extends Controller
{
    /**
     * Returns top 10 images from instagram
     */
    public function dashboard()
    {
        $recentMedia = [];
        $token = Instagram::getToken();
        if($token) {
            $res = Instagram::get("/v1/users/self/media/recent/?access_token=$token&count=10");
            $recentMedia = isset($res['payload']['data']) ? $res['payload']['data'] : [];
        }

        return view('instagram-dashboard', compact('recentMedia'));
    }

    /**
     * Redirect to Instagram for authorization.
     */
    public function redirectToInstagram()
    {
        $instagramApiUrl = env('INSTAGRAM_API_URL', 'https://api.instagram.com');
        $instagramCallbackUrl = env('INSTAGRAM_CALBACK_URL', 'localhost');
        $instagram_client_id = env('INSTAGRAM_CLIENT_ID', '*******');
        $instagram_secret_id = env('INSTAGRAM_CLIENT_SECRET', '*******');
        
        return redirect("$instagramApiUrl/oauth/authorize/?client_id=$instagram_client_id&redirect_uri=$instagramCallbackUrl&response_type=code");
    }

    /**
     *  Receive the redirect from Instagram
     */
    public function callback(Request $request)
    {
        $code = $request->query('code');
        if($code) {
            $instagramApiUrl = env('INSTAGRAM_API_URL', 'https://api.instagram.com');
	        $instagramCallbackUrl = env('INSTAGRAM_CALBACK_URL', 'localhost');
	        $instagram_client_id = env('INSTAGRAM_CLIENT_ID', '*******');
	        $instagram_secret_id = env('INSTAGRAM_CLIENT_SECRET', '*******');

            $res = Instagram::post('/oauth/access_token', [
                'form_params' => [
                    'client_id'     => $instagram_client_id,
                    'client_secret' => $instagram_secret_id,
                    'grant_type'    => 'authorization_code',
                    'redirect_uri'  => $instagramCallbackUrl,
                    'code'          => $code,
                ],
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ]
            ]);
           
            if($res['status'] == true) {
                $token = isset($res['payload']['access_token']) ? $res['payload']['access_token'] : null;
                if($token) {
                    Instagram::setToken($token);
                    return redirect('/dashboard');
                } else {
                    $error = isset($res['payload']['error_message']) ? $res['payload']['error_message'] : "An internal server error occured, please try again!";
                }
            } else {
                $error = "An internal server error occured, please try again!";
            }
        } else {
            $error = "No authorization from instagram, please try again!";
        }

        return redirect('/dashboard')->with(['flash_error' => $error]);
    }
}
