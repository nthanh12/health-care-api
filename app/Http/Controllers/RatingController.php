<?php

namespace App\Http\Controllers;

use App\Http\Service\RatingService;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //
    protected $ratingService;
    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService;
    }
    public function getTop3RatingCommentMedicine($idMedicine){
        return $this->ratingService->getTop3RatingCommentMedicine($idMedicine);
    }
    public function addRatingMedicine(Request $request){
        return $this->ratingService->addRatingMedicine($request);
    }
}
