<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['login','register']]);
    }


    // Register new user
    public function register(Request $request) {
        $validated_data = $request->validate([
            'first_name' => "required|String|min:3|max:255",
            'last_name' => "required|String|min:3|max:255",
            'phone' => "required|string|min:8|max:8",
            'address' => "required|string"
        ]);

        $new_user = User::create([
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'phone' => $validated_data['phone'],
            'address' => $validated_data['address']
        ]);

        if(!is_null($new_user)) {
            // $random_password = Hash::make(Str::random(9));
            $random_password = Hash::make("password");
            $new_user->password = $random_password;
            $new_user->save();

            return response()->json([
                'user'      => $new_user,
                'token'     => $new_user->createToken('secret')->plainTextToken
            ], Response::HTTP_ACCEPTED);
        }

        return response()->json(["message" => "Un problème est survenu lors de l'enregistrement"], 404);
    }


    // Login user
    public function login(Request $request){
        $request->validate([
            'phone' => "required|digits:8",
            'password' => "required|string|min:8"
        ]);


        // !Auth::attempt(['email' => $validated_data['email'], 'password' => $validated_data['password']]));
        $credentials = $request->only('phone', 'password');
        $token = Auth::attempt($credentials);
        if(!$token)
        {
            return response()->json([
                    "status" => "error",
                    "message" => "Identifiants invalides"
                ],
                Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token = $user->createToken('secret')->plainTextToken;


        // dd($token);
        // $cookie = cookie('jwt', $token, 60*24);
        // return response(["message" => "Success"])->withCookie($cookie);

        if ($user->patient) {
            return response()->json([
                "status" => "success",
                "type" => "patient",
                "user" => $user,
                "token" => $token,
            ], 200);
        }

        if($user->doctor)
        {
            return response()->json([
                "status" => "success",
                "type" => "doctor",
                "user" => $user,
                "token" => $token,
            ], 200);
        }


        return response()->json([
            "status" => "success",
            "user" => $user,
            "token" => $token,
        ], 200);
    }


    // Get user details
    public function user(Request $request) {
        $request->validate([
            'user_id' => "required|numeric"
        ]);

        print($request->user_id);
        $user = User::find($request->user_id);

        if($user->patient)
        {
            return response()->json([
                // "status" => 'success',
                // "type" => 'patient',
                "user" => $user,
            ],200);

        } elseif($user->doctor)
        {

            return response()->json([
                // "type" => 'doctor',
                // "status" => 'success',
                "user" => $user,
            ],200);
        }
        else
        {

            return response()->json([
                // "status" => 'success',
                "user" => $user,
            ],200);
        }

    }

    // Logout authenticated user
    public function logout(){
        $user = Auth::user();
        $user()->tokens()->delete();

         return response()->json([
            "status" => "success",
            "message" => "Deconnecté avec succès"
        ]);
    }


    public function refresh()
    {
        // return $this->generateToken(auth()->refresh());
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }


    /**
     * Generate token
    */
    protected function generateToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => auth()->user()
        ]);
    }
}
