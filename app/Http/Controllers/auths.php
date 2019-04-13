<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use Auth;
use App\datamodel;
class auths extends Controller
{
    public function reg(Request $req){
       $val=Validator::make($req->all(),[
           'name' =>'required|min:5|',
           'email' =>'required|email|unique:users',
           'password'=>'required|min:5'
       ]);
       if($val->fails()){
           return response()->json(['msg'=>$val->errors()],401);
       }
       $inh=bcrypt($req->email);
       User::create([
           'name'=>$req->name,
           'email'=>$req->email,
           'api_token'=>$inh,
           'password'=>bcrypt($req->password),
       ]);
       return response()->json(['msg'=>'register Success','token'=>$inh]);
    }
    public function logs(Request $reqs){
        $vals=Validator::make($reqs->all(),[
            'name'=>'required|min:5',
            'password'=>'required|min:5',
        ]);
        if($vals->fails()){
            return response()->json([
                'msg'=>$vals->errors()
            ],401);
        }
        $r=Auth::attempt([
            'name'=>$reqs->name,
            'password'=>$reqs->password
        ]);
        if($r){
            $v=Auth::user($r);
            return response()->json(['msg'=>'successLogin','token'=>Auth::user()->api_token,'user'=>$v]);
        }else {
            return response()->json(['msg'=>'wrong user and password']);
        }
        
    }
    public function opt(User $r){
        $r=Auth::check();
        return response()->json(['msq'=>$r,'user'=>Auth::user()]);
    }
    public function log(){
        Auth::logout();
        return response()->json(['msg'=>'succes']);
    }
    public function resxt(){
        return response()->json([
            'auth'=>'terauth',
            'username'=>Auth::user()->name,
            'email'=> Auth::user()->email,
            
            ]);
    }
    public function show(){
        $e=datamodel::all();
        return $e;
    }
    public function added(Request $reqsf){
        $d=validator::make($reqsf->all(),[
            'name_product'=>'required',
            'discription'=>'required',
        ]);
        if($d->fails()){
            return response()->json(['msg'=>$d->errors(),401]);
        }
        datamodel::create([
          'name_product'=>$reqsf->name_product,
          'discription'=>$reqsf->discription,
        ]);
        return response()->json(['msg'=>'save succes'],200);
    }
    public function del($id){
        $rt=datamodel::findorfail($id);
        $rt->delete();
        return response()->json(['msg'=>'succes delete'],200);
    }
    public function updt(Request $request, $id){
        $ch=validator::make($request->all(),[
            'name_product'=>'required',
            'discription'=>'required',
        ]);

        if($ch->fails()){
            return response()->json(['msg'=>$ch->errors()],501);
        }else{

            $t=datamodel::findorfail($id);
        $t->name_product=$request->get('name_product');
        $t->discription=$request->get('discription');
        $t->update();
              return response()->json(['msg'=>'success update'],200);
        }
        
    }
    public function one($id){
        $n=datamodel::findOrfail($id);
        return response()->json([$n]);
    }

}
