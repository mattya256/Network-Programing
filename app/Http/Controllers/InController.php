<?php

namespace App\Http\Controllers;

use DB;
use Log;
use Illuminate\Http\Request;

class InController extends Controller
{

	public function input()
    {
    	 return view('input',[
        ]);
    }
    public function inputResults()
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
            'wc_match.ordering AS DATE',
            'wc_result.outcome AS result_outcome',
            't0.name AS team0_name',
            't1.name AS team1_name')   
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
        
        $tournament_id=request('tournament_id');
        $tournament_name=request('tournament_name');
        $tournament_date=request('tournament_date');
        $tournament_year=request('tournament_year');
        $tournament_country=request('tournament_country');
            
        if($tournament_id != null && $tournament_name!=null && $tournament_date!=null && $tournament_year!=null && $tournament_country!=null ){
        	DB::table('wc_tournament')->insert(
   				['id' => $tournament_id, 'name' => $tournament_name, 'start_date' => $tournament_date ,
   				'year' => $tournament_year ,'country'=>$tournament_country]
			);
		}
		
		$round_id=request('round_id');
        $round_tournament_id=request('round_tournament_id');
        $round_name=request('round_name');
        $round_ordering=request('round_ordering');
        $round_knockout=request('round_knockout');
        $round_start_date=request('round_start_date');
        $round_end_date=request('round_end_date');
            
        if($round_id != null && $round_tournament_id!=null && $round_name!=null && $round_ordering!=null 
        && $round_knockout!=null && $round_start_date!=null && $round_end_date!=null ){
        	DB::table('wc_round')->insert(
   				['id' => $round_id, "tournament_id"=> $round_tournament_id ,'name' => $round_name, 'ordering'=>$round_ordering,
   				'knockout' => $round_knockout ,"start_date" => $round_start_date ,"end_date"=>$round_end_date]
			);
		}
		
		$match_id=request('match_id');
        $match_round_id=request('match_round_id');
        $match_group_id=request('match_group_id');
        $match_start_date=request('match_start_date');
        $match_ordering=request('match_ordering');
        $match_knockout=request('match_knockout');
            
        if($match_id != null && $match_round_id!=null && $round_name!=null && $match_group_id!=null 
        && $match_start_date!=null && $match_ordering!=null && $match_knockout!=null ){
        	DB::table('wc_match')->insert(
   				['id' => $match_id, "round_id"=> $match_round_id ,'group_id' => $match_group_id, 
   				'start_date' => $match_start_date ,"ordering" => $match_ordering ,"knockout"=>$match_knockout]
			);
		}
		
		$group_id=request('group_id');
        $group_name=request('group_name');
        $group_ordering=request('group_ordering');
            
        if($group_id != null && $group_name!=null && $round_name!=null && $group_ordering!=null  ){
        	DB::table('wc_group')->insert(
   				['id' => $group_id ,"name"=> $group_name ,'name' => $group_name, 'ordering'=>$group_ordering]
			);
		}
		
		$result_id=request('result_id');
        $result_match_id=request('result_match_id');
        $result_team_id0=request('result_team_id0');
        $result_team_id1=request('result_team_id1');
        $result_rs=request('result_rs');
        $result_rs_extra=request('result_rs_extra');
        $result_rs_pk=request('result_rs_pk');
        $result_ra=request('result_ra');
        $result_ra_extra=request('result_ra_extra');
        $result_ra_pk=request('result_ra_pk');
        $result_difference=request('result_difference');
        $result_outcome=request('result_outcome');
        $result_outcome_90min=request('result_outcome_90min');
        $result_count_win=request('result_count_win');
        $result_count_lose=request('result_count_lose');
        $result_count_stillmate=request('result_stillmate');
        $result_point=request('result_point');
        $result_extra=request('result_extra');
        $result_pk=request('result_pk');
        $result_duplicate=request('result_duplicate');
        
        if($result_rs_extra==null){$result_rs_extra='';}
        if($result_rs_pk==null){$result_rs_pk='';}
        if($result_ra_extra==null){$result_ra_extra='';}
        if($result_ra_pk==null){$result_ra_pk='';}
            
        if($result_id != null && $result_match_id != null &&  $result_team_id0 != null &&  $result_team_id1 != null &&  
            $result_rs != null &&   $result_ra != null &&  
            $result_difference != null &&  $result_outcome != null &&  
        	$result_outcome_90min != null && $result_count_win != null &&  $result_count_lose != null &&  $result_count_stillmate != null &&  
        	$result_point != null && $result_extra != null &&  $result_pk != null &&  $result_duplicate != null     )
        	{
        	    DB::table('wc_result')->insert(
   				['id' => $result_id ,"match_id"=> $result_match_id ,'team_id0' => $result_team_id0, 'team_id1'=>$result_team_id1,
   				'rs' => $result_rs ,"rs_extra"=> $result_rs_extra ,'rs_pk' => $result_rs_pk, 'ra'=>$result_ra,
   				'ra_extra' => $result_ra_extra ,"ra_pk"=> $result_ra_pk ,'difference' => $result_difference, 'outcome'=>$result_outcome,
   				'outcome_90min' => $result_outcome_90min ,"count_win"=> $result_count_win ,'count_lose' => $result_count_lose, 'count_stillmate'=>$result_count_stillmate,
   				'point' => $result_point ,"extra"=> $result_extra ,'pk' => $result_pk, 'duplicate'=>$result_duplicate
   				]
			);
		}
		
		$team_id=request('team_id');
        $team_name=request('team_name');
        $team_country=request('team_country');
        $team_country_now=request('team_country_now');
        $team_area=request('team_area');
        $team_lat=request('team_lat');
        $team_lng=request('team_lng');
            
        if($team_id != null && $team_name!=null && $team_country!=null && $team_country_now!=null 
        && $team_area!=null && $team_lat!=null && $team_lng!=null ){
        	DB::table('wc_team')->insert(
   				['id' => $team_id, "name"=> $team_name ,'country' => $team_country, 'country_now' => $team_country_now, 
   				'area' => $team_area ,"lat" => $team_lat ,"lng"=>$team_lng]
			);
		}
		

            
          

        // show page based on the template: sql/search_win_matchers.blade.php with parameters: team, data
        
        return view('input_results',[

        ]);
    }
}
