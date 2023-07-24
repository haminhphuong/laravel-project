<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = Contact::all();
        if ($request->ajax()) {
            return DataTables::of($contacts)->addColumn('action', function ($contact) {
                $button = '<div class="d-flex"><form action="'.route("admin.contacts.updateStatus", $contact).'" method="POST" class="btn btn-block d-flex btn-sm">';
                $button .= csrf_field();
                $button .= method_field('PUT');
                $button .= '<select name="status" class="form-select form-select-lg btn-sm btn btn-block">';
                $button .= '<option value="0"'. ($contact->status == '0' ? ' selected' : '') .'>Pending</option>';
                $button .= '<option value="1"'. ($contact->status == '1' ? ' selected' : '') .'>Completed</option>';
                $button .= '</select>';
                $button .= '<button type="submit" class="btn btn-danger btn-sm m-1">Update Status</button>';
                $button .= '</form>';

                $button .= '<form action="'.route('admin.contacts.destroy', $contact->id).'" method="POST" style="display: inline-block;" class="btn btn-sm">';
                $button .= csrf_field();
                $button .= method_field('DELETE');
                $button .= '<button type="submit" class="btn btn-danger d-flex" onclick="return confirm(\'Are you sure?\')">Delete</button>';
                $button .= '</form></div>';

                return $button;
            })
                ->rawColumns(['action'])
                ->make(true);

        }
        return view('admin.contacts.index', compact('contacts'));
    }

    public function updateStatus(Request $request, Contact $contact)
    {
        $request->validate([
            'status' => 'required|in:0,1',
        ]);

        $contact->status = $request->status;
        $contact->save();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact status updated successfully.');
    }
}
