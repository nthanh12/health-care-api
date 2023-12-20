<?php

namespace App\Http\Service;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserService
{
    public function getAll(){
        $users = User::get();

        // Định dạng ngày trong JSON
        return response()->json($users);
    }
    public function getUser($email){
        $user = User::where('email', $email)->first();
        return $user;
    }
    public function addUser($request){
        try {
            DB::beginTransaction();
            $user = User::where('email', $request->input('email'))->first();
            if (!$user){
                User::create([
                    'nameUser' => $request->input('nameUser'),
                    'email' => $request->input('email'),
                    'avatar' => $request->input('avatar')
                ]);
            }
            DB::commit();
            return response()->json(['status' => 'success']);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $ex->getMessage()]);
        }
    }
}
