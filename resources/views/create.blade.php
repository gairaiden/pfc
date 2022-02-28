@extends('layouts.app')

@section('content')
<div class="col-md-6 p-0">
    <div class="card w-100">
        <div class="card-header">新規メモ</div>
        <div class="card-body">
            <form method='POST' action="/store">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group d-block'">
                    <label for="diet">食事</label>
                    <input name='diet' type="text" class="form-control" id="diet" placeholder="例)カレーライス">
                </div>
                <br>
                <div class="form-group">
                    <label for="protein">P</label>
                    <input name="protein" type="number">
                </div>
                <br>
                <div class="form-group d-block'">
                    <label for="fat">F</label>
                    <input name="fat" type="number">
                </div>
                <br>
                <div class="form-group d-block'">
                    <label for="carbo">C</label>
                    <input name="carbo" type="number">
                </div>
                <br>
                <div class="form-group d-block">
                    <label for="date">日付</label>
                    <input type="date" name="date" class="form-control">
                </div>
                <br>
                <button type='submit' class="btn btn-primary btn-lg">保存</button>
            </form>
        </div>
    </div>
</div>
@endsection