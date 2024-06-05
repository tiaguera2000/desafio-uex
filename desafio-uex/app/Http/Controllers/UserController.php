<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Address;
use App\Models\Contact;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function me(){

        return view("user.me", ["user" => Auth::user()]);
    }

    public function update(UpdateProfileRequest $request, User $user){

        try{

            $user->update($request->all());
            return redirect()->route("home")->with("success", "Perfil atualizado com sucesso.");
        }
        catch(Exception $e){
            
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function destroy(DestroyProfileRequest $request, User $user){

        try{

            DB::beginTransaction();
            Contact::where("user_id", $user->id)->delete();
            $user->delete();
            Auth::logout();
            DB::commit();
            return redirect()->route("/")->with("success", "Perfil excluído com sucesso.");
        }
        catch(Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }
}
