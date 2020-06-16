<?php

namespace App\Http\Middleware;

use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Task;
use Closure;
use Illuminate\Support\Facades\Auth;

class MustBeTheOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  baseURL $route
     * @return mixed
     */
    public function handle($request, Closure $next, $route)
    {
        // Get route parameter.
        $id = $request->route($route);

        // Check if parameter id exists
        if (!$id) {
            return $next($request);
        }

        // Let request pass thru if they are the owner else, redirect home.
        switch ($route) {
            case 'appointment':
                $item = Appointment::find($id);
                break;

            case 'contact':
                $item = Contact::find($id);
                break;

            case 'task':
                $item = Task::find($id);
                break;

            default :
                $item = null;
        }

        if ($item->user_id == Auth::id()) {
            return $next($request);
        }

        return redirect('home')->withErrors(['access_denied' => 'Your access was denied.']);
    }
}
