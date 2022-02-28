<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    public function myMemo($user_id){
        $date = \Request::query('date');
        if(empty($date)){
            return $this::select('memos.*')
            ->where('user_id', $user_id)
            ->where('status', 1)
            ->get();      
        }else{
          $memos = $this::select('memos.*')
              ->leftJoin('dates','dates.id','=','memos.date_id')
              ->where('dates.date', $date)
              ->where('dates.user_id', $user_id)
              ->where('memos.user_id', $user_id)
              ->get();
          return $memos;
        }
    }
}
