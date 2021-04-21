<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotifsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(5);
        return view('notifs.notifs', ['notifications'=>$notifications]);

    }
}
