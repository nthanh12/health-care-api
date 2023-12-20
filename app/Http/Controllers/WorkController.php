<?php

namespace App\Http\Controllers;

use App\Http\Service\WorkService;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    protected $workService;
    public function __construct(WorkService $workService)
    {
        $this->workService = $workService;
    }
    public function getListWorkByDate($date){
        return $this->workService->getListWorkByDate($date);
    }
    public function getListWorkToday(){
        return $this->workService->getListWorkToday();
    }
    public function updateIsCheckWork(Request $request){
        return $this->workService->updateIsCheckWork($request);
    }
}
