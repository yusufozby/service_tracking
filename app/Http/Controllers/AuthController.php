<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function register() {
        return view('auth.register');
    }
    public function verifyCode()  {
        return view('auth.verify-code');
    }
    public function forgotPassword(){
        return view('auth.forgot-password');
    }
    public function verifyCodeForm(Request $request)
    {
        $userId = session('2fa_user_id');
        $user = User::where('two_factor_code', $request->code)
            ->where('id', $userId)
            ->first();
        if(!$user){
            return back()->withErrors([
                'code' => 'girdiğiniz kod yanlış'
            ]);
        }
        if(now()->greaterThan($user->two_factor_expires_at)){
            $code = random_int(100000,999999);
        $user->update([            'email_verified_at'=>null,
            'two_factor_code'=>$code,
            'two_factor_expires_at'=>now()->addMinutes(10)]

        );

  return back()->withErrors([
                'code' => 'girdiğiniz kodun süresi doldu. Yeni bir kod gönderildi. Lütfen mailinizi kontrol edin.'
            ]);
        }
        $user->update([
            'email_verified_at'=>now(),
            'two_factor_code'=>null,
            'two_factor_expires_at'=>null


        ]);

        return redirect()->route('login');
    }
    public function loginForm(Request $request){
    $user = User::where('email',$request->email)->first();
    if(!$user){
        return back()->withErrors([
            'email' => 'ilgili kullanıcı bulunamadı'
        ]);

    }
    if(!Hash::check($request->password, $user->password)){
          return back()->withErrors([
            'password'=>'şifre yanlış.',
          ]);
    }
    if($user->email_verified_at == null){

        return redirect()->route('verify-code');

    }
    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->route('dashboard.index');




    }
    public function createUser(Request $request){

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Ad soyad alanı zorunludur.',
            'email.required' => 'E-posta alanı zorunludur.',
            'email.email' => 'Geçerli bir e-posta adresi giriniz.',
            'email.unique' => 'Bu e-posta adresi zaten kullanılıyor.',
            'password.required' => 'Şifre alanı zorunludur.',
            'password.min' => 'Şifre en az 8 karakter olmalıdır.',
            'password.confirmed' => 'Şifreler birbiriyle uyuşmuyor.',
        ]);
           $code = random_int(100000, 999999);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>$request->password,
            'email_verified_at'=>null,
            'two_factor_code'=>$code,
            'two_factor_expires_at'=>now()->addMinutes(10)
        ]);

              Mail::raw(
            "Doğrulama kodunuz: {$code}\n\nBu kod 10 dakika içinde geçerliliğini yitirecektir.",
            function ($m) use ($user) {
                $m->to($user->email)
                    ->subject('E-posta Doğrulama Kodu');
            }
        );
      session([
        '2fa_user_id'=>$user->id
      ]);
        return redirect()->route('verify-code');
    }
    public function logout(Request $request){
        Auth::logout();
         $request->session()->regenerateToken();
         $request->session()->invalidate();
         return redirect()->route('login');
    }


    //
}
