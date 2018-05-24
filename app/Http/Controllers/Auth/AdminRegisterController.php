<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Model\userModel;
use App\Model\listPemdaModel;
use App\Model\dinasModel;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use DB;

class AdminRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */


    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = "kategorisasi-admin/pemda";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
          'idPemda' => 'required|string|unique:users',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6|confirmed',
          'file' => 'required|file|max:2000',
          'nama-pegawai' => 'required|string',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $uploadedFile = $data['file'];
        $path = $uploadedFile->store('public/files');
        return User::create([
            'idPemda'  => $data['idPemda'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'file' => $path,
            'nama-pegawai' => $data['nama-pegawai'],
            'verified' => false,
        ]);
    }

    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    public function showRegistrationForm() {
        $datas = listPemdaModel::all();
        return view ('auth.admin-register', ['datas' => $datas]);
    }
}
