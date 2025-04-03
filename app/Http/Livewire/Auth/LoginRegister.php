<?php

namespace App\Http\Livewire\Auth;

use App\Enums\DesignationTypes;
use App\Models\User;
use App\Models\Scheme;
use Livewire\Component;
use App\Models\Department;
use Illuminate\Support\Str;
use App\Services\OtpSmsService;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginRegister extends Component
{
    public $schemeId;

    public $name;
    public $phone;
    public $department;
    public $designation;
    public $otpCode;
    public $otpPhone;
    public $otpSent = false;
    public $otpStatusMessage;
    public $successMessage;

    public function requestOtp()
    {
        $validated = $this->validate([
            'otpPhone' => ['required', 'digits:10']
        ]);

        $response = OtpSmsService::make("6495363bd6fc057aeb47d6e2")
            ->to($validated['otpPhone'])
            ->sendOtp();

        if ($response['type'] === 'success') {
            $this->otpStatusMessage = 'An OTP has been sent to your mobile';
            $this->otpSent = true;
        } else {
            $this->otpStatusMessage = 'Something went wrong. Try again.';
            $this->otpSent = false;
        }
    }

    public function resendOtp()
    {
        $response = OtpSmsService::make("6621eafbd6fc0524384762d3")
            ->to($this->otpPhone)
            ->resendOtp();

        if ($response['type'] === 'success') {
            $this->otpStatusMessage = 'An OTP has been sent to your mobile';
            $this->otpSent = true;
        } else {
            $this->otpStatusMessage = 'Something went wrong. Try again.';
            $this->otpSent = false;
        }
    }

    public function getDepartmentsProperty()
    {
        return Department::pluck('name', 'id')->all();
    }
    
    public function login()
    {
        $validated = $this->validate([
            'otpCode' => ['required', 'digits:6']
        ]);

        $response = OtpSmsService::make()
            ->to($this->otpPhone)
            ->otp($validated['otpCode'])
            ->verifyOtp();
 
        if ($response['type'] === 'success') {
            $user = User::where('phone', $this->otpPhone)->first();

            if ($user) {
                Auth::login($user);
                $this->dispatchBrowserEvent('redirect-to-seven');
                // return redirect()->route('schemes.qrcodeDetails', $this->schemeId);
            } else {
                throw ValidationException::withMessages([
                    'otpCode' => ['The provided otp is incorrect.'],
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'otpCode' => ['The provided otp is incorrect.'],
            ]);
        }
    }

    public function register()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'department' => ['required'],
            'designation' => ['required', Rule::in(DesignationTypes::values())],
            'phone' => ['required', 'digits:10', Rule::unique('users', 'phone')]
        ]);

        User::create([
            'department_id' => $validated['department'],
            'designation' => $validated['designation'],
            'name' => $validated['name'],
            'email' => trim($validated['phone']) . '@jjmbrain.in',
            'phone' => trim($validated['phone']),
            'password' => bcrypt(Str::random(8)),
            'role' => 'inspector'
        ]);

        $this->reset(['name', 'phone']);

        $this->successMessage = 'You have successfully registered. Please login to continue.';
    }

    public function getSchemeProperty()
    {
        return Scheme::findOrFail($this->schemeId);
    }

    public function getDesignationsProperty()
    {
        return DesignationTypes::cases();
    }

    public function render()
    {
        return view('livewire.auth.login-register');
    }
}
