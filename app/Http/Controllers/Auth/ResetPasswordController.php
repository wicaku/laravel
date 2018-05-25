<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth;

use DateTime;
use DateTimeZone;
use MongoDB\BSON\UTCDateTime;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function broker()
    {
        return new class(app()) extends \Jenssegers\Mongodb\Auth\PasswordBrokerManager {

            protected function createTokenRepository(array $config)
            {
                $c = $this->app['db']->connection();
                $h = $this->app['hash'];
                $t = $config['table'];
                $k = $this->app['config']['app.key'];
                $e = $config['expire'];

                return new class($c, $h, $t, $k, $e) extends \Illuminate\Auth\Passwords\DatabaseTokenRepository {

                    protected function getPayload($email, $token)
                    {
                        return ['email' => $email, 'token' => $this->hasher->make($token), 'created_at' => new UTCDateTime(time() * 1000)];
                    }

                    protected function tokenExpired($token)
                    {
                        // Convert UTCDateTime to a date string.
                        if ($token instanceof UTCDateTime) {
                            $date = $token->toDateTime();
                            $date->setTimezone(new DateTimeZone(date_default_timezone_get()));
                            $token = $date->format('Y-m-d H:i:s');
                        } elseif (is_array($token) and isset($token['date'])) {
                            $date = new DateTime($token['date'], new DateTimeZone(isset($token['timezone']) ? $token['timezone'] : 'UTC'));
                            $date->setTimezone(new DateTimeZone(date_default_timezone_get()));
                            $token = $date->format('Y-m-d H:i:s');
                        }

                        return parent::tokenExpired($token);
                    }
                };
            }
        };
    }
}
