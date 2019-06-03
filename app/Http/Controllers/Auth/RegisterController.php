<?php

namespace App\Http\Controllers\Auth;

use App\Domain\User\UseCases\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 * @property UserService $service
 */
class RegisterController extends Controller
{
    private $service;
    private $response_status = null;
    private $response_message = null;

    public function __construct(UserService $service)
    {
        $this->service = $service;
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $user = $this->service->register($request);
            $this->setResponseMessage(
                'success',
                "{$user->name} Check your email and click on the link to verify."
            );
        } catch (\Exception $e) {
            $this->setResponseMessage(
                'error',
                $e->getMessage()
            );
        }
        return redirect()->route('login')
            ->with($this->response_status, $this->response_message);
    }


    public function verify($token)
    {
        try {
            $this->service->verify($token);
            $this->setResponseMessage(
                'success',
                'Your email is verified. You can now login.'
            );
        } catch (\Exception $e) {
            $this->setResponseMessage(
                'error',
                $e->getMessage()
            );
        }
        return redirect()->route('login')
            ->with($this->response_status, $this->response_message);
    }


    private function setResponseMessage($status, $message)
    {
        $this->response_status = $status;
        $this->response_message = $message;
    }


}
