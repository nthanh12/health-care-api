<?php

namespace App\Http\Service;

use App\Models\Work;
use Exception;
use Illuminate\Support\Facades\DB;

class WorkService
{
    public function getListWorkByDate($date){
        $works = Work::where(DB::raw('DATE(`time`)'), $date)->orderby('time')->get();
        $works->transform(function ($work) {
            $work->isCheck = $work->isCheck == 1 ? true : false;
            return $work;
        });
        return $works;
    }
    public function getListWorkToday(){
        $date = now()->toDateString();
        $works = Work::where(DB::raw('DATE(`time`)'), $date)->orderby('time')->get();

        $works->transform(function ($work) {
            $work->isCheck = $work->isCheck == 1 ? true : false;
            return $work;
        });

        return $works;
    }
    public function updateIsCheckWork($request){
        try {
            DB::beginTransaction();
            $isCheck = 0;
            if ($request->isCheck) $isCheck = 1;
            Work::where('idWork', $request->idWork)->update(['isCheck' => $isCheck]);
            DB::commit();
            return response()->json(['status' => 'success']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }
}
