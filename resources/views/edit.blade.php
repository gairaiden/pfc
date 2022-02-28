@extends('layouts.app')

@section('content')
<div class="col-md-6 p-0">
    <div class="card w-100">
        <div class="card-header d-flex justify-content-between">メモ編集
            <form method='POST' action="{{ route('update', ['id' => $memo['id'] ] ) }}" id='delete-form'>
                @csrf
                <button class='p-0 mr-2' style='border:none;'><i id='delete-button' class="fas fa-trash"></i></button>
            </form>  
        </div>
        <div class="card-body">
            <form method='POST' action="{{ route('update', ['id' => $memo['id'] ] ) }}">
                @csrf
                <input type='hidden' name='user_id' value="{{ $user['id'] }}">
                <div class="form-group d-block'">
                    <label for="diet">食事</label>
                    <input name='diet' type="text" class="form-control" id="diet" placeholder="{{ $memo['diet'] }}">
                </div>
                <br>
                <div id="target"></div>
                <div class="form-group">
                    <label for="protein">P</label>
                    <br>
                    <input name="protein" type="number" placeholder="{{ $memo['protein'] }}">
                </div>
                <br>
                <div class="form-group d-block'">
                    <label for="fat">F</label>
                    <br>
                    <input name="fat" type="number" placeholder="{{ $memo['fat'] }}">
                </div>
                <br>
                <div class="form-group d-block'">
                    <label for="carbo">C</label>
                    <br>
                    <input name="carbo" type="number" placeholder="{{ $memo['carbo'] }}">
                </div>
                <br>
                <button type='submit' class="btn btn-primary btn-lg">更新</button>
            </form>
        </div>
        
    </div>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    (function() {
      'use strict';

        // パッケージのロード
        google.charts.load('current', {packages: ['corechart']});
        // コールバックの登録
        google.charts.setOnLoadCallback(drawChart);

        // コールバック関数の実装
        function drawChart() {
            // データの準備
            var data　= new google.visualization.DataTable();
            data.addColumn('string', 'Love');
            data.addColumn('number', 'Votes');
            data.addRow(['P', {{ $memo['protein'] }}*4 ]);
            data.addRow(['F', {{ $memo['fat'] }}*9 ]);
            data.addRow(['C', {{ $memo['carbo'] }}*4 ]);

            // オプションの準備
            var options = {
                title: '{{ $memo['diet'] }}のPFCバランス(kcal)',
                width: 500,
                height: 300
            };

            // 描画用インスタンスの生成および描画メソッドの呼び出し
            var chart = new google.visualization.PieChart(document.getElementById('target'));
            chart.draw(data, options);
        }


    })();
  </script>
</div>
@endsection
