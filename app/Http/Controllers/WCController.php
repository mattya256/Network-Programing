<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Illuminate\Http\Request;

class WCController extends Controller
{
    public function search()
    {
        DB::enableQueryLog();

        $options = [];
        $tournament_results = DB::table('wc_tournament')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
            
        $round_results = DB::table('wc_round')
            ->selectRaw('distinct knockout')
            ->get();
            
        $group_results = DB::table('wc_group')
            ->selectRaw('distinct name')
            ->get();
            
        $team_results = DB::table('wc_team')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
            
        $outcome_results = DB::table('wc_result')
            ->selectRaw('distinct outcome')
            ->get();

        return view('search',[
            'tournaments' => $tournament_results,
            'rounds' => $round_results,
            'groups' => $group_results,
            'teams' => $team_results,
            'outcomes' => $outcome_results]
        );
    }

    public function searchResults()
    {
        $tournament_id=request('tournament');
        if($tournament_id==''){
        	$tournament_id='%';
        }
        $knockout = request('Round');
        if($knockout ==''){
        	$knockout ='%';
        }
        $group_name = request('Group');
        if($group_name==''){
        	$group_name='%';
        }
        $team_id = request('Team');
        if($team_id==''){
        	$team_id='%';
        }
        $outcome = request('Outcome');
        $t0_outcome;
        $t1_outcome;
        if(strcmp('勝利',$outcome)==0){$t0_outcome='勝利';$t1_outcome='敗北';}
        else if(strcmp('引き分け',$outcome)==0){$t0_outcome='引き分け';$t1_outcome='引き分け';}
        else if(strcmp('敗北',$outcome)==0){$t0_outcome='敗北';$t1_outcome='勝利';}
        else {$t0_outcome='%';$t1_outcome='%';}
        $results = DB::table("wc_tournament")
            ->join('wc_round', 'wc_tournament.id', '=', 'wc_round.tournament_id')
            ->join('wc_match', 'wc_match.round_id', '=', 'wc_round.id')
            ->join('wc_group', 'wc_match.group_id', '=', 'wc_group.id')
            ->join('wc_result', 'wc_result.match_id', '=', 'wc_match.id')
            ->join('wc_team as t0', 't0.id', '=', 'wc_result.team_id0')
            ->join('wc_team as t1', 't1.id', '=', 'wc_result.team_id1')
            ->select(
            'wc_round.name AS round_name',
            'wc_tournament.name AS tournament_name',
            'wc_group.name AS group_name',
            'wc_match.start_date AS DATE',
            'wc_result.outcome AS result_outcome',
            't0.name AS team0_name',
            't1.name AS team1_name',
            't0.lat AS team0_lat',
            't0.lng AS team0_lng',
            't1.lat AS team1_lat',
            't1.lng AS team1_lng')   
            ->whereraw("wc_tournament.id like'".$tournament_id."'
            AND wc_round.knockout like '".$knockout."'
            AND wc_group.name like '".$group_name."%'
            AND ((t0.id like '".$team_id."'
            AND wc_result.outcome like '".$t0_outcome."')
            OR (t1.id like '".$team_id."'
            AND wc_result.outcome like '".$t1_outcome."'
            ))
            ")
            ->get();
            
          

        // show page based on the template: sql/search_win_matchers.blade.php with parameters: team, data
        
        return view('search_results',[
            'data' => $results,
            'test' => $group_name
        ]);
    }
}
