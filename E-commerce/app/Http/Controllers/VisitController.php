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
        $visits = Visit::paginate(10);

        return view('admin.visits.index', compact('visits'));
    }

    public function destroy(string $uuid)
    {
        $visit = Visit::where('uuid', $uuid)->firstOrFail();

        $isDeleted = $visit->delete();

        if (!$isDeleted) {
            return back()->with('error', 'Visit not deleted.');
        }

        return redirect()->route('admin.visits.index')->with('success', 'Visit deleted successfully.');
    }
}
