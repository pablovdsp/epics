<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserLog;

class UserLogController extends Controller
{

    public function index()
    {
        $userLogs = UserLog::paginate();
        return $userLogs;
    }

    public function show($id)
    {
        $userLogs = UserLog::where('user_id',$id)->paginate();
        return $userLogs;
    }
}
