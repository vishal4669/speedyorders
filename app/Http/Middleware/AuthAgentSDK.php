<?php

namespace App\Http\Middleware;

use App\Models\AgentLicense;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Utils\Option;
use App\Utils\License;

class AuthAgentSDK
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $accessToken = JWTAuth::getToken();
        if ( $accessToken == null ) {
            return response()->json([
                'success' => false,
                'data' => [
                    'error' => 'Invalid Access Token.'
                ]
            ], 200);
        }

        if ( !isset($request['licenseString']) || $request['licenseString'] == null || $request['licenseString'] == '' ) {
            return response()->json([
                'success' => false,
                'data' => [
                    'error' => 'Invalid license value.'
                ]
            ], 200);
        }

        try {

            $agentDetails = auth('auth-agent-sdk')->setToken($accessToken)->authenticate();
            if ( $agentDetails )
                return $next($request);

        } catch (\Exception $e) {

           /* return response()->json([
                'success' => false,
                'data' => [
                    'error' => 'Unauthorised User. License expired/invalid'
                ]
            ], 200);*/

            /**
             * UNAUTHORIZED CASE
             * CASE I: Token invalid
             * CASE II: Token ttl expired
             */
            $decryptedLicense = License::validateLicense($request);
            if ( !$decryptedLicense['success'] ) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'error' => $decryptedLicense['error']
                    ]
                ], 200);
            }
            $decryptedLicense = $decryptedLicense['decryptedLicense'];
            $tokenTTL = Option::get('token_ttl_sdk');
            $agentLicenseDetails = AgentLicense::with(['agent'])->where('package_name',$decryptedLicense)
                ->where('status','1')
                ->first();

            if ( !$agentLicenseDetails ) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'error' => 'Unauthorised User. License expired/invalid'
                    ]
                ], 200);
            }

            if ( $agentLicenseDetails->package_name != $decryptedLicense ) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'error' => 'Unauthorised User. License expired/invalid'
                    ]
                ], 200);
            }

            if ( !isset($agentLicenseDetails->agent) || !$agentLicenseDetails->agent ) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'error' => 'User status is inactive. Access-Token not granted.'
                    ]
                ], 200);
            }

            if ( $agentLicenseDetails->agent->status == 0) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'error' => 'User status is inactive. Access-Token not granted.'
                    ]
                ], 200);
            }

            if ( $agentLicenseDetails->agent->is_approved == 0) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'error' => 'User is not approved for api use. Access-Token not granted.'
                    ]
                ], 200);
            }

            if (!$token = auth('auth-agent-sdk')->setTTL($tokenTTL)->login($agentLicenseDetails->agent)) {
                return response()->json([
                    'success' => false,
                    'data' => [
                        'error' => 'Invalid credentials.'
                    ]
                ], 200);
            }

            return $next($request);
        }

        return response()->json([
            'success' => false,
            'data' => [
                'error' => 'Unauthorised User. License expired/invalid'
            ]
        ], 200);

    }
}
