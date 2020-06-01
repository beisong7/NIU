<?php

namespace App\Http\Controllers;

use App\Services\RegistrationServices;
use App\Traits\Utility;
use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use Utility;
    private $regService;
    public function __construct(RegistrationServices $registrationServices){
        $this->regService = $registrationServices;
    }
    //

    public function mobileReg(Request $request){

//        return $request->all();

        return $this->regService->store($request, "mobile");

    }

    public function createUser(Request $request){
        return $this->regService->store($request, "admin");

    }
}
