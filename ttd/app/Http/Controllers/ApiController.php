<?php
namespace App\Http\Controllers;

class ApiController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = auth('api')->user();
    }
}
