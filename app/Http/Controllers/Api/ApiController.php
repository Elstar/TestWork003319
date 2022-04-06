<?php


namespace App\Http\Controllers\Api;

use App\Traits\APIResponse;
use App\Http\Controllers\Controller;

abstract class ApiController extends Controller
{
    use APIResponse;
}
