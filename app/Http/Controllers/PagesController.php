<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * Display pre-login page.
     */
    public function showWelcome()
    {
        return view('pages.welcome');
    }

    /**
     * Display post-login page.
     */
    public function showHome()
    {
        $user = User::find(Auth::id());
        $appointments = $user->appointments()->orderBy('date_start', 'asc')->get();
        $contacts = $user->contacts()->orderBy('last_name', 'desc')->get();
        $tasks_wdate = $user->tasks()->whereNotNull('due_date')->orderBy('due_date', 'asc')->get();
        $tasks_wodate = $user->tasks()->whereNull('due_date')->orderBy('created_at', 'desc')->get();

        return view('pages.home', [
            'user' => $user,
            'appointments' => $appointments,
            'contacts' => $contacts,
            'tasks_wdate' => $tasks_wdate,
            'tasks_wodate' => $tasks_wodate,
        ]);
    }
}
