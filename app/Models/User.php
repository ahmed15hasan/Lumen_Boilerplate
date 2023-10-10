<?php

namespace App\Models;

use App\Models\OauthClients;
use Exception;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use HasApiTokens, Authenticatable, Authorizable, HasFactory;

    // rest of the model

    // maintain parameters and call passport oauth
    public static function issueToken(Request $request) {

        // get client id and token from oauth_clients table
        $client = OauthClients::where('password_client', '1')->orderBy('id', 'desc')->first();

        if(empty($client)) {
            return ['statusCode' => '402'];
        }

        $params = [
            'grant_type' => 'password',
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'username' => $request->email,
            'password' => $request->password,
            'scope' => '*',
        ];
        /**
         * Issuing access_token manually for only for testing environment
         */
        if(env('APP_ENV') == 'testing'){
            $user = User::where('email', $request->email)->first();
            $data = $user->createToken('access_token')->accessToken;
            return [
                'access_token'=> $user->createToken('access_token')->accessToken,
                'statusCode' => 200
            ];
        }

        $data = self::passportCall('oauth/token', $params);
        return $data;
    }

    /** Passport token call
    * @param $url
    * @param $params
    */
    public static function passportCall($url, $params) {

        try{
            $passport = curlRequest('POST',config('app.url').($url),['form_params' => $params]);
            $response = json_decode($passport->getBody()->getContents(), true);

            $response['statusCode'] = $passport->getStatusCode();
        }
        catch(ClientException $exception){

            $response['statusCode'] = $exception->getResponse()->getStatusCode();
            $response['message'] = $exception->getResponse()->getReasonPhrase();
        }
        catch(Exception $exception){
            \Log::info('EXCEPTION PASSPORT === > '. print_r($exception->getMessage(), 1));

            // its just for safe side.
            $response['statusCode'] = $exception->getResponse()->getStatusCode();
        }

        return $response;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
