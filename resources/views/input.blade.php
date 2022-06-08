@extends('common.layout')
@section('addTitle')
<title>Search World Cup Database</title>
@stop
@section('addMeta')
<meta name="csrf-token" content="{{csrf_token()}}">
@stop
@section('addCSS')
@stop
@include('common.header')
@section('content')

<style>
    #search_form_area {
        padding: 0.5em 1em;
        margin: 2em 0;
        background: #f0f7ff;
        border: dashed 2px #5b8bd0;
    }
</style>  
        
        
    <div class="title">Input World Cup Database</div>

    <form action="./input_results" method="POST">
        {{ csrf_field() }}
   
        <div id="search_form_area">
            <div class="title">Input Form</div>
            <div class="form-group">
            	Tournament<br>
            	大会idを入力：<input type="text" name="tournament_id"><br>
            	大会名を入力：<input type="text" name="tournament_name"><br>
            	大会開催日を入力：<input type="text" name="tournament_date"><br>
            	大会開催年を入力：<input type="text" name="tournament_year"><br>
            	大会開催国を入力：<input type="text" name="tournament_country"><br>
            	
            	Round<br>
            	ラウンドidを入力：<input type="text" name="round_id"><br>
            	トーナメントidを入力：<input type="text" name="round_tournament_id"><br>
            	ラウンド名を入力：<input type="text" name="round_name"><br>
            	ラウンド並び順を入力：<input type="text" name="round_ordering"><br>
            	ノックアウト方式ラウンドを入力：<input type="text" name="round_knockout"><br>
            	ラウンド開始日付を入力：<input type="text" name="round_start_date"><br>
            	ラウンド終了日付を入力：<input type="text" name="round_end_date"><br>
            	
            	Match<br>
            	マッチidを入力：<input type="text" name="match_id"><br>
            	ラウンドidを入力：<input type="text" name="match_round_id"><br>
            	グループidを入力：<input type="text" name="match_group_id"><br>
            	試合開始日時を入力：<input type="text" name="match_start_date"><br>
            	試合並び順を入力：<input type="text" name="match_ordering"><br>
            	ノックアウト方式試合を入力：<input type="text" name="match_knockout"><br>
            	
            	Group<br>
            	グループidを入力：<input type="text" name="group_id"><br>
            	グループ名を入力：<input type="text" name="group_name"><br>
            	グループ並び順を入力：<input type="text" name="group_ordering"><br>
            	
            	Result<br>
            	試合結果IDを入力：<input type="text" name="result_id"><br>
            	試合IDを入力：<input type="text" name="result_match_id"><br>
            	チームIDを入力：<input type="text" name="result_team_id0"><br>
            	相手チームIDを入力：<input type="text" name="result_team_id1"><br>
            	得点を入力：<input type="text" name="result_rs"><br>
            	得点(延長戦)を入力：<input type="text" name="result_rs_extra"><br>
            	得点(PK戦)を入力：<input type="text" name="result_rs_pk"><br>
            	失点を入力：<input type="text" name="result_ra"><br>
            	失点(延長戦)を入力：<input type="text" name="result_ra_extra"><br>
            	失点(PK戦)を入力：<input type="text" name="result_ra_pk"><br>
            	得失点差を入力：<input type="text" name="result_difference"><br>
            	勝敗を入力：<input type="text" name="result_outcome"><br>
            	勝敗(90分)を入力：<input type="text" name="result_outcome_90min"><br>
            	勝利数を入力：<input type="text" name="result_count_win"><br>
            	敗北数を入力：<input type="text" name="result_count_lose"><br>
            	引き分け数を入力：<input type="text" name="result_stillmate"><br>
            	勝点を入力：<input type="text" name="result_point"><br>
            	延長戦を入力：<input type="text" name="result_extra"><br>
            	PK戦を入力：<input type="text" name="result_pk"><br>
            	試合結果の重複表示を入力：<input type="text" name="result_duplicate"><br>
            	
            	Team<br>
            	チームidを入力：<input type="text" name="team_id"><br>
            	チーム名を入力：<input type="text" name="team_name"><br>
            	国名を入力：<input type="text" name="team_country"><br>
            	現在の国名を入力：<input type="text" name="team_country_now"><br>
            	地域名を入力：<input type="text" name="team_area"><br>
            	緯度を入力：<input type="text" name="team_lat"><br>
            	経度を入力：<input type="text" name="team_lng"><br>
            	
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    

@stop
@include('common.footer')
