<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Gate;
class AuthAPIController extends Controller
{
     /**
     * @OA\Post(
     *     path="/oauth/token",
     *     tags={"Auth"},
     *     summary="Authority: None | Authenticate an existing client/user",
     *     description="All fields are compulsory",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                @OA\RequestBody(
     *                    required=true,
     *                    content="application/json",
     *                 ),
     *                 @OA\Property(
     *                     property="client_id",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="client_secret",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="username",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="grant_type",
     *                     type="string"
     *                 ),
     *                 example={"client_id":"Your Client ID","client_secret":"Your Client Secret","username":"Your email address",
     *                      "password":"Your password", "grant_type":"password"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Successful Authentication. Access Token Returned"),
     *     @OA\Response(response="400", description="Bad Request")
     * )
     */

     /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     tags={"Auth"},
     *     summary="Authority: None | Alternative to Authenticate an existing user",
     *     description="All fields are compulsory",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                @OA\RequestBody(
     *                    required=true,
     *                    content="application/json",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                 ),
     *                  @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"email":"Your email address", "password":"Your password"}
     *             )
     *         )
     *     ),
     *     @OA\Response(response="200", description="Successful Authentication. Access Token Returned")
     * )
     */
    public function login(Request $request) {
        $data = [
            "email" => $request->input("email"),
            "password" => $request->input("password"),
        ];
        if(Auth::attempt($data)){
            echo $usertype = Auth::user()->role;
            switch ($usertype){
                case (auth()->user()->hasRole('Administrator'));
                    $message = "Administrator";
                break;
                case (auth()->user()->hasRole('Customer'));
                    $message = "Customer";
                    auth()->user()->givePermissionTo([ 'Add Customer', 'Edit Customer', 'Update Customer' ]);
                break;
                case (auth()->user()->hasRole('Owner'));
                    $message = "Owner";
                    auth()->user()->givePermissionTo(['Add Vehicle', 'Edit Vehicle', 'Update Vehicle', 'Add Operator', 'Edit Operator', 'Update Operator']);
                break;
                case (auth()->user()->hasRole('Operator'));
                    $message = "Operator";
                    auth()->user()->givePermissionTo(['Edit Operator', 'Update Operator']);
                break;
                default:
                $message = "un Authorised User";
            }

                if(!empty($usertype)){
                    $user = $request->user();

                    if(auth()->user()->hasRole('Administrator')){
                        return response()->json([
                            'error' => true,
                            'message' => 'Please Use The Webiste To Access The Administrator Dashboard',
                            'data' => [
                                "user" => $user
                            ],
                        ], 200);
                    }else{
                        $tokenResult = $user->createToken('Personal Access Token');
                        $token = $tokenResult->token;
                        $token->expires_at = Carbon::now()->addWeeks(1);
                        $token->save();
                        return response()->json([
                            'access_token' => $tokenResult->accessToken,
                            'token_type' => 'Bearer',
                            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
                            'success' => true,
                            'message' => $request->input("email").' Welcome to ' . $message. ' Dashboard',
                            'data' => [
                                "user" => $user
                            ],
                        ], 200);
                    }


                }else{
                    return response()->json([
                        'error' => true,
                        'message' => 'Unauthorized User',
                        'data' => [],
                    ], 401);
                }

        }else{
            return response()->json([
                'error' => true,
                'message' => 'Invalid User Name of Password',
                'data' => [],
            ], 401);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/auth/logout",
     *     tags={"Auth"},
     *     summary="Authority: User | Logout the currently logged in user",
     *     description="Revokes token",
     *     @OA\Response(response="200", description="User Logged out successfully"),
     *     @OA\Response(response="401", description="Unauthenticated. Token needed")
     * )
     */

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'User logged out successfully.'
        ]);
    }
}
