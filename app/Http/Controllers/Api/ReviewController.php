<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store($project_id, StoreReviewRequest $request)
    {
        $reviewData = $request->validated();

        $new_review = new Review();
            $new_review->project_id = $project_id;
            $new_review->user_name = $reviewData['user_name'];
            $new_review->text_review = $reviewData['text_review'];
        $new_review->save();
    }
}
