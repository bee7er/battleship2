<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Guard;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    const PWD_MIN_LEN = 6;

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->middleware('guest', ['except' => 'getLogout']);

        $this->auth = $auth;
    }

    /**
     * Show the login page to the user.
     *
     * @param Request $request
     * @return Response
     */
    public function getLogin(Request $request)
    {
        $loggedIn = false;
        if ($this->auth->check()) {
            $loggedIn = true;
        }

        //dd(Hash::make('battle101'));

        $errors = [];
        $msgs = [];
        $userName = '';

        return view('auth.login', compact('loggedIn', 'userName', 'errors', 'msgs'));
    }

    /**
     * If valid login show the application dashboard to the user.
     *
     * @param Request $request
     * @return Response
     */
    public function postLogin(Request $request)
    {
        $loggedIn = false;
        if ($this->auth->check()) {
            $loggedIn = true;
        }
        $errors = [];
        $msgs = [];

        $userName = trim($request->get('userName'));
        $password = trim($request->get('password'));

        $redirect = self::loggingIn($userName, $password);
        if (false != $redirect) {
            // Authentication passed...
            return redirect()->intended($redirect);
        }

        $errors[] = 'User name not found or an incorrect password was used.';
        return view('auth.login', compact('loggedIn', 'userName', 'errors', 'msgs'));
    }

    /**
     * Show the register page to the user.
     *
     * @param Request $request
     * @return Response
     */
    public function getRegister(Request $request)
    {
        //dd(Hash::make('battle101'));

        $errors = [];
        $msgs = [];
        $userName = '';

        return view('auth.register', compact('userName', 'errors', 'msgs'));
    }


    /**
     * If valid register show the application home page to the user.
     *
     * @param Request $request
     * @return Response
     */
    public function postRegister(Request $request)
    {
        if ($this->auth->check()) {
            // User is already logged in
            return redirect()->intended('/home');
        }
        $error = false;
        $errors = [];
        $msgs = [];

        try {
            $userName = trim($request->get('userName'));
            if (!isset($userName) || '' == $userName) {
                $errors[] = 'User name is required';
                $error = true;
            }
            $password = trim($request->get('password'));
            if (!isset($password) || '' == $password) {
                $errors[] = 'Password is required';
                $error = true;
            } elseif (strlen($password) < self::PWD_MIN_LEN) {
                $errors[] = 'Password must be at least ' . self::PWD_MIN_LEN . ' in length';
                $error = true;
            }
            if (false == $error) {
                // Get a new user object and create it
                $user = User::getUser();
                $user->name = $userName;
                $user->password = Hash::make($password);
                // Token required for API calls
                $user->user_token = User::getNewToken();
                $user->save();

                // New user, log them in
                $redirect = self::loggingIn($userName, $password);
                if ($redirect) {
                    // Authentication passed...
                    return redirect()->intended($redirect);
                }
            }

        } catch(QueryException $e) {
            $msg = $e->getMessage();
            if (starts_with($msg, 'SQLSTATE[23000]')) {
                // User name already exists in the database
                $errors[] = 'User name must be unique';
                $error = true;
            } else {
                // Some other SQL error
                $errors[] = $msg;
                $error = true;
            }
        } catch(Exception $e) {
            $errors[] = $e->getMessage();
            $error = true;
        }

        if (true == $error) {
            return view('auth.register', compact('userName', 'errors', 'msgs'));
        }

        return redirect()->intended('/auth/login');
    }

    /**
     * We are logging the user in, from register or login page.
     * @param $userName
     * @param $password
     * @return bool|string
     */
    private function loggingIn($userName, $password)
    {
        if (Auth::attempt(['name' => $userName, 'password' => $password])) {
            $user = $this->auth->user();
            // We place the user token in the response so it can be obtained
            // by the client and stored in a cookie
            setSessionVariable(self::SESSION_VAR_USER_TOKEN, $user->user_token);

            // Authentication passed, but check if we are dealing with a player two logging in
            $playerTwoGame = getSessionVariable(self::SESSION_VAR_GAME_TOKEN, false);
            if ($playerTwoGame) {
                // Update the game to show player two
                $playerTwoGame->player_two_id = $user->id;
                $playerTwoGame->save();
                // Clear the player two session variable
                setSessionVariable(self::SESSION_VAR_GAME_TOKEN, null);

                return ('/acceptGame?gameId=' . $playerTwoGame->id);
            }

            // An authenticated user
            return '/home';
        }

        return false;
    }
}
