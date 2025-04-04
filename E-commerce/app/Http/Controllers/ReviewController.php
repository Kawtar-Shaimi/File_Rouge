<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:client')->except(['index', 'show', 'delete']);
        $this->middleware('auth:admin')->only(['index', 'show', 'delete']);
    }

    public function index()
    {
        try {
            $reviews = Review::with(['client', 'book'])->paginate(10);

            return view('admin.reviews.index', compact('reviews'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while getting reviews try again later.');
        }
    }

    public function show(Review $review)
    {
        $review->load('client');
        return view('admin.reviews.show', compact('review'));
    }

    public function store(Request $request, Book $book)
    {
        try{
            $request->validate([
                'rate' => 'required|numeric',
                'content' => 'required'
            ]);

            $review = Review::create([
                'rate' => $request->rate,
                'content' => $request->content,
                'client_id' =>  Auth::guard('client')->id(),
                'book_id' => $book->id
            ]);

            if (!$review) {
                return response()->json([
                    'status' => 'faild',
                    'message' => 'Error while adding review',
                ], 500)->header('Content-Type', 'application/json');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Review added successfully',
                'data' => [
                    'review_id' => $review->id,
                    'name' => Auth::guard('client')->user()->name
                ]
            ], 200)->header('Content-Type', 'application/json');

        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while adding review',
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    public function update(Request $request, Review $review)
    {
        try{
            $request->validate([
                'rate' => 'required|numeric',
                'content' => 'required'
            ]);

            $oldRating = $review->rate;

            $isUpdated = $review->update([
                'rate' => $request->rate,
                'content' => $request->content
            ]);

            if (!$isUpdated) {
                return response()->json([
                    'status' => 'faild',
                    'message' => 'Error while updating review',
                ], 500)->header('Content-Type', 'application/json');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Review updated successfully',
                'data' => [
                    'old_rating' => $oldRating,
                    'name' => Auth::guard('client')->user()->name
                ]
            ], 200)->header('Content-Type', 'application/json');

        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => 'Error while updating review',
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    public function destroy(Review $review)
    {
        try{

            $oldRating = $review->rate;

            $isDelete = $review->delete();

            if (!$isDelete) {
                return response()->json([
                    'status' => 'faild',
                    'message' => 'Error while deleting review',
                ], 500)->header('Content-Type', 'application/json');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Review deleted successfully',
                'data' => [
                    'old_rating' => $oldRating,
                    'count' => Review::where('book_id', $review->book_id)->count(),
                    'client_count' => Review::where('client_id', $review->client_id)->where('book_id', $review->book_id)->count()
                ]
            ], 200)->header('Content-Type', 'application/json');

        }catch(Exception $e) {
            return response()->json([
                'status' => 'faild',
                'message' => $review,
            ], 500)->header('Content-Type', 'application/json');
        }
    }

    public function delete(Review $review)
    {
        try {
            $isDeleted = $review->delete();

            if (!$isDeleted) {
                return back()->with('error', 'Review not deleted.');
            }

            return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Error while deleting review try again later.');
        }
    }
}
