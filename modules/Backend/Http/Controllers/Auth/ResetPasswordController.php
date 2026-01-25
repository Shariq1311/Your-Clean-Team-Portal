<?php

namespace MojarCMS\Backend\Http\Controllers\Auth;

use MojarCMS\CMS\Http\Controllers\Controller;
use MojarCMS\CMS\Traits\Auth\AuthResetPassword;

class ResetPasswordController extends Controller
{
    use AuthResetPassword;
}
