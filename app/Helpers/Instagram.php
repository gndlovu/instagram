<?php
namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;

class Instagram
{
    public function get($path = '/', $options = [])
    {
        return $this->request('GET', $path, $options);
    }
    
    public function post($path = '/', $options = [])
    {
        return $this->request('POST', $path, $options);
    }

    private function request($method = 'GET', $path = '/', $options = [])
    {
        $instagramApiUrl = env('INSTAGRAM_API_URL', 'https://api.instagram.com');
        $client = new Client();

        try
        {
            $response = $client->request($method, $instagramApiUrl . $path, $options);
        }
        catch (RequestException $ex) {
            $response = $ex->getResponse();
        }
        catch (ConnectException $ex) {
            $response = $ex->getResponse();
        } 
        catch (ClientException $ex) {
            $response = $ex->getResponse();
        } 
        catch (ServerException $ex) {
            $response = $ex->getResponse();
        }
        
        $response = ($response) ? $response->getBody()->getContents() : null;
        $response = json_decode($response, true);
        if(!$response) {
            return ['status' => false, 'error_description' => 'An internal server error occured, please try again!'];
        }

        return ['status' => true, 'payload' => $response];
    }

    public function setToken($token)
    {
        session()->put('token', $token);
    }

    public function getToken()
    {
        return session()->get('token');
    }
}