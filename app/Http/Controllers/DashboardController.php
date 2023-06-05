<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function category()
    {
        return view('admin.category');
    }

    public function gender()
    {
        return view('admin.gender');
    }

    public function posts()
    {
        return view('admin.posts');
    }

    public function reciclebin()
    {
        return view('admin.reciclebin');
    }
}