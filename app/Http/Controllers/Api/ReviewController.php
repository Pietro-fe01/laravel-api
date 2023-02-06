<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Mail\NewReview;
use App\Models\Project;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReviewController extends Controller
{
    public function store(Project $project, StoreReviewRequest $request)
    {
        $reviewData = $request->validated();

        $new_review = new Review();
            $new_review->project_id = $project->id;
            $new_review->user_name = $reviewData['user_name'];
            $new_review->text_review = $reviewData['text_review'];
            $new_review->review_created = Carbon::now();
        $new_review->save();

        if($new_review) {
            // Send an e-mail every time someone send a review to a project
            Mail::to('info@boolprojects.com')->send(new NewReview($new_review));
        }

        return $new_review;
    }
}
