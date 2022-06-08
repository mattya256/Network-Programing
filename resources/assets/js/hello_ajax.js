/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 
 

const app = new Vue({
    el: '#hello_ajax',
    data: {
        message: "",
        serverSelectData:""
    },
    methods: {
        showMessage1: function () {
            let url = "/ajax/hello_ajax_message2";
            axios.get(url).then((res) => {
                this.message = res.data.message1;
            });
        },
        showMessage2: async function () {
            let url = "/ajax/hello_ajax_message2";
            let res = await axios.get(url);
            this.message = res.data.message2;
            this.serverSelectData = res.data.select;
        },    
    	clickChoice: async function (){
 			console.log("func");
 		}
    }

});

$(function(){
	var tournament_id="";
	var knockout="";
	var groupname="";
	var team_id="";
	var outcome="";
	document.getElementById("Group").style.display = "none";
	document.getElementById("Group2").style.display = "none";
	document.getElementById("Outcome").style.display = "none";
	document.getElementById("Outcome2").style.display = "none";
	$('[id=tournament]').on('change', async function(){//トーナメントid入力時
		  console.log("change touranemnt");
		  console.log("tou_id="+tournament_id+" :knock="+knockout+
		  " :gro="+groupname+" :team="+team_id+" :out="+outcome);
          tournament_id = $(this).val();
            let url = "/ajax/hello_ajax_message2";
            let res = await axios.get(url, {
  				params: {
    			tournament: tournament_id,
    			Round     : knockout,
    			Group     : groupname,
    			Team      : team_id,
    			utcome   : outcome
  				}
			});
			var tournaments = res.data.tournament;
            var rounds = res.data.round;
            var groups = res.data.group;
            var teams0 = res.data.team0;
            var teams1 = res.data.team1;
            var outcomes = res.data.outcome;
            var results = res.data.result;
            $('.Tournament option').remove();
            $.each(tournaments, function(id,data){
              $('.Tournament').append($('<option>').text(data.name).attr('value', data.id));
            });
            $('.Tournament').append($('<option>').text("").attr('value', ""));
            $('.Round option').remove();
            $('.Round').append($('<option>').text("").attr('value', ""));
            $.each(rounds, function(id,data){
              if(data.knockout==1){var knockoutname= "決勝リーグ";}
              else {var knockoutname= "予選リーグ";} 
              $('.Round').append($('<option>').text(knockoutname).attr('value', data.knockout));
            });
            
            $('.Group option').remove();
            $('.Group').append($('<option>').text("").attr('value', ""));
            $.each(groups, function(id,data){
              $('.Group').append($('<option>').text(data.name).attr('value', data.name));
            });
            
            $('.Team option').remove();
            $('.Team').append($('<option>').text("").attr('value', ""));
            $.each(teams0, function(id,data){
              $('.Team').append($('<option>').text(data.name0).attr('value', data.id0));
            });
            $.each(teams1, function(id,data){
              $('.Team').append($('<option>').text(data.name1).attr('value', data.id1));
            });
            $('.Outcome option').remove();
            $('.Outcome').append($('<option>').text("").attr('value', ""));
            $.each(outcomes, function(id,data){
              $('.Outcome').append($('<option>').text(data.outcome).attr('value', data.outcome));
            });
            console.log("tou_id="+tournament_id+" :knock="+knockout+
		    " :gro="+groupname+" :team="+team_id+" :out="+outcome);
	});
	$('[id=Round]').on('change', async function(){//knockout入力時
		  console.log("change round");
		  console.log("tou_id="+tournament_id+" :knock="+knockout+
		  " :gro="+groupname+" :team="+team_id+" :out="+outcome);
          knockout = $(this).val();
			if(knockout==2){
        	  document.getElementById("Group").style.display = "block";
			  document.getElementById("Group2").style.display = "block";
			}
            let url = "/ajax/hello_ajax_message2";
            let res = await axios.get(url, {
  				params: {
    			tournament: tournament_id,
    			Round     : knockout,
    			Group     : groupname,
    			Team      : team_id,
    			utcome   : outcome
  				}
			});
			var tournaments = res.data.tournament;
            var rounds = res.data.round;
            var groups = res.data.group;
            var teams0 = res.data.team0;
            var teams1 = res.data.team1;
            var outcomes = res.data.outcome;
            var results = res.data.result;

            $('.Round option').remove();
            $.each(rounds, function(id,data){
              if(data.knockout==1){var knockoutname= "決勝リーグ";}
              else {var knockoutname= "予選リーグ";} 
              $('.Round').append($('<option>').text(knockoutname).attr('value', data.knockout));
            });
            $('.Round').append($('<option>').text("").attr('value', ""));
            $('.Group option').remove();
            $('.Group').append($('<option>').text("").attr('value', ""));
            $.each(groups, function(id,data){
              $('.Group').append($('<option>').text(data.name).attr('value', data.name));
            });
            $('.Team option').remove();
            $('.Team').append($('<option>').text("").attr('value', ""));
            $.each(teams0, function(id,data){
              $('.Team').append($('<option>').text(data.name0).attr('value', data.id0));
            });
            $.each(teams1, function(id,data){
              $('.Team').append($('<option>').text(data.name1).attr('value', data.id1));
            });;
            $('.Outcome option').remove();
            $('.Outcome').append($('<option>').text("").attr('value', ""));
            $.each(outcomes, function(id,data){
              $('.Outcome').append($('<option>').text(data.outcome).attr('value', data.outcome));
            });
            console.log("tou_id="+tournament_id+" :knock="+knockout+
		    " :gro="+groupname+" :team="+team_id+" :out="+outcome);
	});
	$('[id=Group]').on('change', async function(){//group入力時
		  console.log("change group");
		  console.log("tou_id="+tournament_id+" :knock="+knockout+
		  " :gro="+groupname+" :team="+team_id+" :out="+outcome);
          groupname = $(this).val();
            let url = "/ajax/hello_ajax_message2";
            let res = await axios.get(url, {
  				params: {
    			tournament: tournament_id,
    			Round     : knockout,
    			Group     : groupname,
    			Team      : team_id,
    			utcome   : outcome
  				}
			});
			var tournaments = res.data.tournament;
            var rounds = res.data.round;
            var groups = res.data.group;
            var teams0 = res.data.team0;
            var teams1 = res.data.team1;
            var outcomes = res.data.outcome;
            var results = res.data.result;

            $('.Group option').remove();
            $.each(groups, function(id,data){
              $('.Group').append($('<option>').text(data.name).attr('value', data.name));
            });
            $('.Group').append($('<option>').text("").attr('value', ""));
            $('.Team option').remove();
            $('.Team').append($('<option>').text("").attr('value', ""));
            $.each(teams0, function(id,data){
              $('.Team').append($('<option>').text(data.name0).attr('value', data.id0));
            });
            $.each(teams1, function(id,data){
              $('.Team').append($('<option>').text(data.name1).attr('value', data.id1));
            });
            $('.Outcome option').remove();
            $('.Outcome').append($('<option>').text("").attr('value', ""));
            $.each(outcomes, function(id,data){
              $('.Outcome').append($('<option>').text(data.outcome).attr('value', data.outcome));
            });
            console.log("tou_id="+tournament_id+" :knock="+knockout+
		    " :gro="+groupname+" :team="+team_id+" :out="+outcome);
	});
	$('[id=Team]').on('change', async function(){//team入力時
		document.getElementById("Outcome").style.display = "block";
		document.getElementById("Outcome2").style.display = "block";
		  console.log("change team");
		  console.log("tou_id="+tournament_id+" :knock="+knockout+
		  " :gro="+groupname+" :team="+team_id+" :out="+outcome);
		  console.log($(this).val());
          team_id = $(this).val();
            let url = "/ajax/hello_ajax_message2";
            let res = await axios.get(url, {
  				params: {
    			tournament: tournament_id,
    			Round     : knockout,
    			Group     : groupname,
    			Team      : team_id,
    			utcome   : outcome
  				}
			});
			var tournaments = res.data.tournament;
            var rounds = res.data.round;
            var groups = res.data.group;
            var teams0 = res.data.team0;
            var teams1 = res.data.team1;
            var outcomes = res.data.outcome;
            var results = res.data.result;

            $('.Team option').remove();
            $('.Team').append($('<option>').text(team_id).attr('value', team_id));
            $('.Team').append($('<option>').text("").attr('value', ""));
            $('.Outcome option').remove();
            $('.Outcome').append($('<option>').text("").attr('value', ""));
            $.each(outcomes, function(id,data){
              $('.Outcome').append($('<option>').text(data.outcome).attr('value', data.outcome));
            });
            console.log("tou_id="+tournament_id+" :knock="+knockout+
		    " :gro="+groupname+" :team="+team_id+" :out="+outcome);
	});
	$('[id=Outcome]').on('change', async function(){//outcome入力時
		  console.log("change outcome");
		  console.log("tou_id="+tournament_id+" :knock="+knockout+
		  " :gro="+groupname+" :team="+team_id+" :out="+outcome);
          outcome = $(this).val();
            let url = "/ajax/hello_ajax_message2";
            let res = await axios.get(url, {
  				params: {
    			tournament: tournament_id,
    			Round     : knockout,
    			Group     : groupname,
    			Team      : team_id,
    			outcome   : outcome
  				}
			});
			var tournaments = res.data.tournament;
            var rounds = res.data.round;
            var groups = res.data.group;
            var teams0 = res.data.team0;
            var teams1 = res.data.team1;
            var outcomes = res.data.outcome;
            var results = res.data.result;

            $('.Outcome option').remove();
            $('.Outcome').append($('<option>').text(outcome).attr('value', outcome));
            $('.Outcome').append($('<option>').text("").attr('value', ""));
            console.log("tou_id="+tournament_id+" :knock="+knockout+
		    " :gro="+groupname+" :team="+team_id+" :out="+outcome);
	});
});
