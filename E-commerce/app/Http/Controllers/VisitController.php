<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Exception;
use Illuminate\Http\Request;

class VisitController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        try {
            $visits = Visit::paginate(10);

            return view('admin.visits.index', compact('visits'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting visits try again later.');
        }
    }

    public function destroy(string $uuid)
    {
        try {
            $visit = Visit::where('uuid', $uuid)->firstOrFail();
            
            $isDeleted = $visit->delete();

            if (!$isDeleted) {
                return back()->with('error', 'Visit not deleted.');
            }

            return redirect()->route('admin.visits.index')->with('success', 'Visit deleted successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while deleting visit try again later.');
        }
    }
}
