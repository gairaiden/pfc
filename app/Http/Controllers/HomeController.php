<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Memo;
use \App\Models\Date;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = \Auth::user();
        $dates = Date::where('user_id', $user['id'])->orderBy('date','DESC')->get();
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->orderBy('updated_at','DESC')->get();
        return view('create',compact('user','dates','memos'));
    }
    public function create()
    {
        $user = \Auth::user();
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->orderBy('updated_at','DESC')->get();
        $dates = Date::where('user_id', $user['id'])->orderBy('date','DESC')->get();
        return view('create' , compact('user','dates','memos'));
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $exist_date = Date::where('date', $data['date'])
            ->where('user_id',$data['user_id'])
            ->first();

        if( empty($exist_date['id']) ){
            $date_id = Date::insertGetId([
                'date' => $data['date'], 
                'user_id' => $data['user_id'],
            ]);
        }else{
            $date_id = $exist_date['id'];
        }

        
        $memo_id = Memo::insertGetId([
            'diet' => $data['diet'], 
            'user_id' => $data['user_id'], 
            'date_id' => $date_id,
            'protein' => $data['protein'],
            'fat' => $data['fat'],
            'carbo' => $data['carbo'],
            'status' => 1
    ]);
        
        // リダイレクト処理
        return redirect()->route('home');
    }
    public function show(){
        
    }
    public function edit($id)
    {
        $user = \Auth::user();
        $memo = Memo::where('status',1)->where('id',$id)->where('user_id',$user['id'])->first();
        $date = Date::where('id',$id)->where('user_id',$user['id'])->first();
        $memos = Memo::where('user_id', $user['id'])->where('status',1)->orderBy('updated_at','DESC')->get();
        $dates = Date::where('user_id', $user['id'])->orderBy('date','DESC')->get();
        return view('edit',compact('memo','date','user','dates','memos'));

    }
    public function update(Request $request,$id){
        $inputs = $request->all();
        Memo::where('id', $id)->update([
            'diet' => $inputs['diet'],  
            'protein' => $inputs['protein'],
            'fat' => $inputs['fat'],
            'carbo' => $inputs['carbo'],
        ]);

        return redirect()->route('home');
    }
    public function delete(Request $request,$id){
        $inputs = $request->all();
        Memo::where('id', $id)->update(['status' => 2]);
        return redirect()->route('home')->with('success','メモの削除が完了しました');
    }
}
