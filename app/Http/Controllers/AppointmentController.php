<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    /**
     * Display appointment page with user's appointments & contacts.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        return view('pages.appointment.index', [
            'appointments' => $user->appointments()->orderBy('date_start', 'asc')->get(),
            'contacts' => $user->contacts()->orderBy('last_name', 'asc')->get(),
        ]);
    }

    /**
     * Validate and store appointment.
     */
    public function store(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'location' => 'required',
            'date_start' => 'required',
            'time_start' => 'required',
            'time_end' => 'required'
        ]);

        // Check if attendee have value
        if ($request->attendee == 'attendee_none') {
            return redirect()
                ->back()
                ->withErrors(['attendee_required' => 'Please select attendee.']);
        }

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        // Save appointment record.
        $appointment = new Appointment;
        $appointment->user_id = Auth::id();
        $appointment->contact_id = $request->attendee;
        $appointment->title = $request->title;
        $appointment->location = $request->location;
        $appointment->date_start = $request->date_start;
        $appointment->time_start = $request->time_start;
        $appointment->time_end = $request->time_end;
        $appointment->save();

        return redirect()->back();
    }

    /**
     * Display edit appointment page along with user's appointment and contact list.
     */
    public function edit($id)
    {
        $appointment = Appointment::find($id);
        $contacts = Contact::where('user_id', Auth::id())->where('id', '!=', $appointment->contact_id )->orderBy('last_name', 'asc')->get();
        // dd($appointment);
        return view('pages.appointment.edit', [
            'appointment' => $appointment,
            'contacts' => $contacts
        ]);
    }

    /**
     * Update selected appointment.
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        // Run Check
        $this->appointmentOwner($appointment);

        // Update record
        $appointment->contact_id = $request->attendee;
        $appointment->title = $request->title;
        $appointment->location = $request->location;
        $appointment->date_start = $request->date_start;
        $appointment->time_start = $request->time_start;
        $appointment->time_end = $request->time_end;
        $appointment->save();

        return redirect('appointment');
    }

    /**
     * Delete selected appointment record.
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        // Run Check
        $this->appointmentOwner($appointment);

        // Delete record
        $appointment->delete();
        return redirect()->back();
    }

    /**
     * Check if the logged user own this appointment.
     */
    private function appointmentOwner($appointment)
    {
        if ($appointment->user_id != Auth::id()) {
            return redirect('home')
                ->withErrors(['action_denied' => 'The action was denied.']);
        }
    }
}
