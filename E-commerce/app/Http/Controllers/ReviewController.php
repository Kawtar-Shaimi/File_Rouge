<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Book;
use App\Models\Review;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:client')->except(['index', 'show', 'delete']);
        $this->middleware('auth:admin')->only(['index', 'show', 'delete']);
    }

    public function index()
    {
        $reviews = Review::with(['client', 'book'])->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function show(string $uuid)
    {
        $review = Review::where('uuid', $uuid)->firstOrFail();
        $review->load('client');
        return view('admin.reviews.show', compact('review'));
    }

    public function store(ReviewRequest $request, string $uuid)
    {
        $book = Book::where('uuid', $uuid)->firstOrFail();

        $review = Review::create([
            'uuid' => Str::uuid(),
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
                'review_id' => $review->uuid,
                'name' => Auth::guard('client')->user()->name
            ]
        ], 200)->header('Content-Type', 'application/json');
    }

    public function update(ReviewRequest $request, string $uuid)
    {
        $review = Review::where('uuid', $uuid)->firstOrFail();

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
    }

    public function destroy(string $uuid)
    {
        $review = Review::where('uuid', $uuid)->firstOrFail();

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
    }

    public function delete(string $uuid)
    {
        $review = Review::where('uuid', $uuid)->firstOrFail();

        $isDeleted = $review->delete();

        if (!$isDeleted) {
            return back()->with('error', 'Review not deleted.');
        }

        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully.');
    }
}
