<?php

namespace App\Http\Controllers;

use App\PromotionalCodeUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PromotionalCodeUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //¡¡
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|numeric',
            'promotional_code_id' => 'required|numeric',
        ]);

        $code = strtolower(Str::random(4));

        // Mientras exista el código, iremos generando códigos únicos nuevos
        while ($this->isCodeAvailable($code)) {
            $code = strtolower(Str::random(4));
        }

        $promotional_code_user = new PromotionalCodeUser([
            'user_id' => $request->user_id,
            'promotional_code_id' => $request->promotional_code_id,
            'code' => $code,
            'active' => false
        ]);

        $promotional_code_user->save();

        return response()->json('Vinculación Realizada Correctamente', 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setActive(Request $request)
    {
        $request->validate([
            'promotional_code_user_id' => 'required|numeric'
        ]);

        $promotional_code_user_id = PromotionalCodeUser::find($request->promotional_code_user_id);

        $promotional_code_user_id->active = true;

        $promotional_code_user_id->save();

        return response()->json("OK", 200);;
    }

    public function getPromotionalCodesFromUser($user_id)
    {

        $promotional_codes_from_user = PromotionalCodeUser::where('user_id', $user_id)->get();

        foreach ($promotional_codes_from_user as $promotional_code)
            $promotional_codes_from_user->promotionalCode = $promotional_code->promotionalCode;
        
        return response()->json($promotional_codes_from_user, 200);

    }

    private function isCodeAvailable($code)
    {
        $userPromotionalCodes = PromotionalCodeUSer::all();

        foreach ($userPromotionalCodes as $promotionalCodeUser) {
            if ($code == $promotionalCodeUser->code) {
                return true;
            };
        }

        return false;

    }

    public function userHasPromotionalCode($promotional_code_id, $user_id) 
    {
        $userPromotionalCodes = PromotionalCodeUser::where('user_id', $user_id)->get();

        foreach($userPromotionalCodes as $userPromotionalCode) {
            if($userPromotionalCode->promotional_code_id == $promotional_code_id)
                return response()->json(true, 200);
        }

        return response()->json(false, 200);
    
    }

}
