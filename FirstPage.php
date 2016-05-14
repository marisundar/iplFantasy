<?php 
$TEAM_ID=$_POST['teamid'];
echo "<label id=\"passedId\"  value=\"$TEAM_ID\">$TEAM_ID</label> "; 
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta content="This is a Fantasy league created by Kongu CSE guys based on the IPL scores" name="description"></meta>

	<meta content="Komarufantasyleague,komaru,fantasy,league,Komaru,Fantasy,League,marisundar,mari,sundar,CSE,cse,pangi,pangis,kongu,okkali,okkali guys,Okkali Guys,Okkali,Guys" name="keywords"></meta>

	<meta content="KomaruFantasyLeague" property="og:title"></meta>

	<meta property="og:type" content="Website"/>

  <meta property="og:url" content="http://marisundar.byethost16.com"/>

  <meta property="og:image" content="http://www.theseventechlabs.com/images/logo/logo.png"/>

  <meta property="og:description" content="This is a Fantasy league created by Kongu CSE guys based on the IPL scores"/>


<script>

var i=0;

function startmusic(){
	inter=setInterval(function(){ currentScores(193868); }, 60000);

}
function isArray(what) {
    return Object.prototype.toString.call(what) === '[object Array]';
}
function playpic(){
document.getElementById('score').src='https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20cricket.scorecard%20where%20match_id%3D193867&format=json&diagnostics=true&env=store%3A%2F%2F0TxIGQMQbObzvU4Apia0V0&callback=';
i=i+1;
var response ;
$.ajax({ type: "GET",   
         url: "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20cricket.scorecard%20where%20match_id%3D193867&format=json&diagnostics=true&env=store%3A%2F%2F0TxIGQMQbObzvU4Apia0V0&callback=",   
         async: false,
         success : function(text)
         {
             response = text;
         }
});
//JSON.parse(response);
var FullQuery=response;

var matchDetails=FullQuery.query.results.Scorecard;
var matchDate= matchDetails.place.date;


var team1_Id=matchDetails.teams[0].i;
var team2_Id=matchDetails.teams[1].i;

//document.getElementById('score').innerHTML=response;


}
var matchId=''
function queryForId(matchId){
console.log("started ---  "+matchId);

var response ;
$.ajax({ type: "GET",   
         url: "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20cricket.scorecard%20where%20match_id%3D"+matchId+"&format=json&diagnostics=true&env=store%3A%2F%2F0TxIGQMQbObzvU4Apia0V0&callback=",   
         async: false,
         success : function(text)
         {
             response = text;
         }
});
//JSON.parse(response);
var FullQuery=response;

var matchDetails=FullQuery.query.results.Scorecard;

var matchDate= matchDetails.place.date;


var team1_Id=matchDetails.teams[0].i;
var team2_Id=matchDetails.teams[1].i;
console.log(response);
var keyVal=response.query.results.Scorecard.past_ings;

console.log(keyVal);
	
if(keyVal==null){
	PrevScores();
}

var flag=0;	
var matchStatus="";
if(isArray(keyVal))	{matchStatus=keyVal[0].s.d;

}
else{
flag=1;
firstInnings=keyVal;
matchStatus=keyVal.s.d;
}

if(matchStatus=="Match Ended")
{


console.log("ended match process "+matchId);
//document.getElementById('score').innerHTML=document.getElementById('score').innerHTML+"--"+matchStatus;
}

else{

console.log("started the match in progress for "+matchId);
inter=setInterval(function(){ currentScores(matchId); }, 60000);
return -1;
console.log("Not exited the loop "+matchId);
}

$.post("insertMatchDetails.php",
    {
        MATCH_ID: matchId,
        PLAYED_DATE: matchDate,
		MATCH_INFO:team1_Id+" vs "+team2_Id
    });
	
	var firstInnings=keyVal[0];	
var secondInnings=keyVal[1];
var bat =firstInnings.d.a.t;
var bowl =firstInnings.d.o.t;

var overallConsole = {};
for(var i in bat){
//console.log(bat[i]);
var playerId=bat[i].i;
var runs = bat[i].r;
var fours = bat[i].four;
var six = bat[i].six;
var batsmanBalls=bat[i].b;
var isOut="NO";
//console.log(playerId);
if(bat[i].fd!=0){isOut="YES";}
if(playerId in overallConsole){
var testPlayer=overallConsole[playerId];
testPlayer.runs=runs;
testPlayer.fours=fours;
testPlayer.six=six;
testPlayer.batsmanBalls=batsmanBalls;
testPlayer.isOut=isOut;

delete overallConsole[playerId];
overallConsole[playerId]=testPlayer;
}
else{
var PlayerInfo = {"PlayerId":playerId,"runs":runs,"fours":fours,"six":six,"batsmanBalls":batsmanBalls,"isOut":isOut};
overallConsole[playerId]=PlayerInfo;
}

if(bat[i].fd!=0){

var wicketTakerid=bat[i].fd;
var detailOfWicket=bat[i].dt;
	if(detailOfWicket=='caught'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.catches==null){
		testPlayer.catches=0;
		}
		testPlayer.catches=testPlayer.catches+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"catches":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}
	if(detailOfWicket=='stumped'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.stumping==null){
		testPlayer.stumping=0;
		}
		testPlayer.stumping=testPlayer.stumping+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"stumping":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}
	if(detailOfWicket=='run out'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.runout==null){
		testPlayer.runout=0;
		}
		testPlayer.runout=testPlayer.runout+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"runout":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}


}




}
//console.log(overallConsole);
for(var i in bowl){

//console.log(bat[i]);
var playerId=bowl[i].i;




var wickets = bowl[i].w;
var overs = bowl[i].o;
var maiden = bowl[i].mo;
var bowlingRuns= bowl[i].r;
//console.log(playerId);

if(playerId in overallConsole){
var testPlayer=overallConsole[playerId];
testPlayer.wickets=wickets;
testPlayer.overs=overs;
testPlayer.maiden=maiden;
testPlayer.bowlingRuns=bowlingRuns;
delete overallConsole[playerId];
overallConsole[playerId]=testPlayer;
}
else{
var PlayerInfo = {"PlayerId":playerId,"wickets":wickets,"overs":overs,"maiden":maiden,"bowlingRuns":bowlingRuns};

overallConsole[playerId]=PlayerInfo;
}



}
//////////////////////////////////////////////////////


var bat =secondInnings.d.a.t;
var bowl =secondInnings.d.o.t;

for(var i in bat){
//console.log(bat[i]);
var playerId=bat[i].i;
var runs = bat[i].r;
var fours = bat[i].four;
var six = bat[i].six;
var batsmanBalls=bat[i].b;
var isOut="NO";
//console.log(playerId);
if(bat[i].fd!=0){isOut="YES";}
//console.log(playerId);



if(playerId in overallConsole){
var testPlayer=overallConsole[playerId];
testPlayer.runs=runs;
testPlayer.fours=fours;
testPlayer.six=six;
testPlayer.batsmanBalls=batsmanBalls;
testPlayer.isOut=isOut;
delete overallConsole[playerId];
overallConsole[playerId]=testPlayer;
//console.log(testPlayer);
}
else{
var PlayerInfo = {"PlayerId":playerId,"runs":runs,"fours":fours,"six":six,"batsmanBalls":batsmanBalls,"isOut":isOut};
overallConsole[playerId]=PlayerInfo;
}
var isOut="NO";
if(bat[i].fd!=0){
isOut="YES";
var wicketTakerid=bat[i].fd;
var detailOfWicket=bat[i].dt;
var catches =0,stumping=0;
	if(detailOfWicket=='caught'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		
		if(testPlayer.catches==null){
		testPlayer.catches=0;
		}
		testPlayer.catches=testPlayer.catches+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"catches":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}
	if(detailOfWicket=='stumped'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.stumping==null){
		testPlayer.stumping=0;
		}
		testPlayer.stumping=testPlayer.stumping+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"stumping":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}
	if(detailOfWicket=='run out'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.runout==null){
		testPlayer.runout=0;
		}
		testPlayer.runout=testPlayer.runout+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"runout":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}


}



}

for(var i in bowl){


var playerId=bowl[i].i;

var wickets = bowl[i].w;
var overs = bowl[i].o;
var maiden = bowl[i].mo;
var bowlingRuns= bowl[i].r;
//console.log(playerId);

if(playerId in overallConsole){
var testPlayer=overallConsole[playerId];
testPlayer.wickets=wickets;
testPlayer.overs=overs;
testPlayer.maiden=maiden;
testPlayer.bowlingRuns=bowlingRuns;
delete overallConsole[playerId];
overallConsole[playerId]=testPlayer;
//console.log(testPlayer);
}
else{
var PlayerInfo = {"PlayerId":playerId,"wickets":wickets,"overs":overs,"maiden":maiden,"bowlingRuns":bowlingRuns};

overallConsole[playerId]=PlayerInfo;
}



}



///////////////////////////////////////////////////////
for(var player in overallConsole){


$.post("insertPlayerMatch.php",
    {
        MATCH_ID: matchId,
		PLAYER_ID: overallConsole[player].PlayerId,
		SIX:overallConsole[player].six==null?0:overallConsole[player].six,
		FOUR:overallConsole[player].fours==null?0:overallConsole[player].fours,
		RUNS:overallConsole[player].runs==null?0:overallConsole[player].runs,
		BATSMANBALLS:overallConsole[player].batsmanBalls==null?0:overallConsole[player].batsmanBalls,
		ISOUT:overallConsole[player].isOut==null?0:overallConsole[player].isOut,
		WICKETS:overallConsole[player].wickets==null?0:overallConsole[player].wickets,
		OVERS:overallConsole[player].overs==null?0:overallConsole[player].overs,
		RUNOUT:overallConsole[player].runout==null?0:overallConsole[player].runout,
		STUMPING:overallConsole[player].stumping==null?0:overallConsole[player].stumping,
		MAIDEN:overallConsole[player].maiden==null?0:overallConsole[player].maiden,
		CATCHES:overallConsole[player].catches==null?0:overallConsole[player].catches,
		BOWLINGRUNS:overallConsole[player].bowlingRuns==null?0:overallConsole[player].bowlingRuns,
        PLAYED_DATE: matchDate,
		MATCH_INFO:team1_Id+" vs "+team2_Id
    });
	
	$.post("insertPlayerPoints.php",
    {
        MATCH_ID: matchId,
		PLAYER_ID: overallConsole[player].PlayerId,
		SIX:overallConsole[player].six==null?0:overallConsole[player].six,
		FOUR:overallConsole[player].fours==null?0:overallConsole[player].fours,
		RUNS:overallConsole[player].runs==null?0:overallConsole[player].runs,
		BATSMANBALLS:overallConsole[player].batsmanBalls==null?0:overallConsole[player].batsmanBalls,
		ISOUT:overallConsole[player].isOut==null?0:overallConsole[player].isOut,
		WICKETS:overallConsole[player].wickets==null?0:overallConsole[player].wickets,
		OVERS:overallConsole[player].overs==null?0:overallConsole[player].overs,
		RUNOUT:overallConsole[player].runout==null?0:overallConsole[player].runout,
		STUMPING:overallConsole[player].stumping==null?0:overallConsole[player].stumping,
		MAIDEN:overallConsole[player].maiden==null?0:overallConsole[player].maiden,
		CATCHES:overallConsole[player].catches==null?0:overallConsole[player].catches,
		BOWLINGRUNS:overallConsole[player].bowlingRuns==null?0:overallConsole[player].bowlingRuns,
        PLAYED_DATE: matchDate,
		MATCH_INFO:team1_Id+" vs "+team2_Id
    });
	

console.log("****"+overallConsole[player]);	
}

}

function updateScores(){
	
	intervalSet=setInterval(function(){ giveTime(); }, 60000);
	overAll();
teamScores();

var obj='<?php echo $TEAM_ID?>';


var checkRetains =$.ajax({ type: "POST",   
                        url: "/retainComplete.php",   
                        async: false,
						data: { 
								'TEAM_ID':obj,
								}
                      }).responseText;
/*if(checkRetains=='TRUE'){
	//document.getElementById('tabs-1').style.visibility='hidden';
	//document.getElementById('retainBut').style.visibility='hidden';
	document.getElementById('retainLink').innerHTML="Retaining Players Complete";
	
	var checkRetains =$.ajax({ type: "POST",   
                        url: "/closedBiddingPlayers.php",   
                        async: false,
						data: { 
								'TEAM_ID':obj,
								}
                      }).responseText;
	document.getElementById('retainLink').innerHTML=checkRetains;
	

}*/

document.getElementById('MyTeamName').innerHTML =$.ajax({ type: "POST",   
                        url: "/teamIndiv.php",   
                        async: false,
						data: { 
								'TEAM_ID':obj,
								}
                      }).responseText;
/*KARAN
var response =$.ajax({ type: "POST",   
                        url: "/listBowler.php",   
                        async: false,
                      }).responseText;
//document.getElementById('	').innerHTML=response;
var response =$.ajax({ type: "POST",   
                        url: "/listBatsMan.php",   
                        async: false,
                      }).responseText;
//document.getElementById('batsman').innerHTML=response;

KARAN*/
var maxId=parseInt($.ajax({ type: "GET",   
                        url: "/maxId.php",   
                        async: false
                      }).responseText);

//document.getElementById('score').innerHTML=maxId;
if(!maxId){
maxId=193864;}
for(i=maxId+1;;i++){
	document.getElementById('matchIdDisplay').innerHTML=(i-1);
if(queryForId(i)==-1){
break;
}
}

}

function PrevScores(){
	currentScores(parseInt(document.getElementById('matchIdDisplay').innerHTML));
}



function currentScores(matchId){
//console.log("looping in "+matchId);
//document.getElementById('colorCode').style.visibility='visible';
 
//alert(matchId);
var response ;
$.ajax({ type: "GET",   
         url: "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20cricket.scorecard%20where%20match_id%3D"+matchId+"&format=json&diagnostics=true&env=store%3A%2F%2F0TxIGQMQbObzvU4Apia0V0&callback=",   
         async: false,
         success : function(text)
         {
             response = text;
         }
});
//console.log(response)
//JSON.parse(response);
var FullQuery=response;

var matchDetails=FullQuery.query.results.Scorecard;

var matchDate= matchDetails.place.date;


var team1_Id=matchDetails.teams[0].i;
var team2_Id=matchDetails.teams[1].i;
console.log("matchdetails: "+matchDetails);
var keyVal=response.query.results.Scorecard.past_ings;


var firstInnings=keyVal[0];	
var secondInnings=keyVal[1];
var flag=0;	
var matchStatus="";
if(isArray(keyVal))	{matchStatus=keyVal[0].s.d;

}
else{
flag=1;
firstInnings=keyVal;
matchStatus=keyVal.s.d;
}

var bat =firstInnings.d.a.t;
var bowl =firstInnings.d.o.t;

var overallConsole = {};
for(var i in bat){
//console.log(bat[i]);
var playerId=bat[i].i;
var runs = bat[i].r;
var fours = bat[i].four;
var six = bat[i].six;
var batsmanBalls=bat[i].b;
//console.log(playerId);
var isOut="NO";
//console.log(playerId);
if(bat[i].fd!=0){isOut="YES";}
if(playerId in overallConsole){
var testPlayer=overallConsole[playerId];
testPlayer.runs=runs;
testPlayer.fours=fours;
testPlayer.six=six;
testPlayer.batsmanBalls=batsmanBalls;
testPlayer.isOut=isOut;
delete overallConsole[playerId];
overallConsole[playerId]=testPlayer;
}
else{
var PlayerInfo = {"PlayerId":playerId,"runs":runs,"fours":fours,"six":six,"batsmanBalls":batsmanBalls,"isOut":isOut};
overallConsole[playerId]=PlayerInfo;
}
var isOut="NO";
if(bat[i].fd!=0){
isOut="YES";
var wicketTakerid=bat[i].fd;
var detailOfWicket=bat[i].dt;
	if(detailOfWicket=='caught'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.catches==null){
		testPlayer.catches=0;
		}
		testPlayer.catches=testPlayer.catches+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"catches":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}
	if(detailOfWicket=='stumped'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.stumping==null){
		testPlayer.stumping=0;
		}
		testPlayer.stumping=testPlayer.stumping+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"stumping":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}
	if(detailOfWicket=='run out'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.runout==null){
		testPlayer.runout=0;
		}
		testPlayer.runout=testPlayer.runout+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"runout":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}


}



}
//console.log(overallConsole);
for(var i in bowl){

//console.log(bat[i]);
var playerId=bowl[i].i;




var wickets = bowl[i].w;
var overs = bowl[i].o;
var maiden = bowl[i].mo;
var bowlingRuns= bowl[i].r;
//console.log(playerId);

if(playerId in overallConsole){
var testPlayer=overallConsole[playerId];
testPlayer.wickets=wickets;
testPlayer.overs=overs;
testPlayer.maiden=maiden;
testPlayer.bowlingRuns=bowlingRuns;
delete overallConsole[playerId];
overallConsole[playerId]=testPlayer;
}
else{
var PlayerInfo = {"PlayerId":playerId,"wickets":wickets,"overs":overs,"maiden":maiden,"bowlingRuns":bowlingRuns};

overallConsole[playerId]=PlayerInfo;
}



}
//////////////////////////////////////////////////////

if(flag==0){
var bat =secondInnings.d.a.t;
var bowl =secondInnings.d.o.t;

for(var i in bat){
//console.log(bat[i]);
var playerId=bat[i].i;
var runs = bat[i].r;
var fours = bat[i].four;
var six = bat[i].six;
var batsmanBalls=bat[i].b;
var isOut="NO";
//console.log(playerId);
if(bat[i].fd!=0){isOut="YES";}
//console.log(playerId);



if(playerId in overallConsole){
var testPlayer=overallConsole[playerId];
testPlayer.runs=runs;
testPlayer.fours=fours;
testPlayer.six=six;
testPlayer.batsmanBalls=batsmanBalls;
testPlayer.isOut=isOut;
delete overallConsole[playerId];
overallConsole[playerId]=testPlayer;
//console.log(testPlayer);
}
else{
var PlayerInfo = {"PlayerId":playerId,"runs":runs,"fours":fours,"six":six,"batsmanBalls":batsmanBalls,"isOut":isOut};
overallConsole[playerId]=PlayerInfo;
}
var isOut="NO";
if(bat[i].fd!=0){
isOut="YES";
var wicketTakerid=bat[i].fd;
var detailOfWicket=bat[i].dt;
var catches =0,stumping=0;
	if(detailOfWicket=='caught'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.catches==null){
		testPlayer.catches=0;
		}
		testPlayer.catches=testPlayer.catches+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"catches":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}
	if(detailOfWicket=='stumped'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.stumping==null){
		testPlayer.stumping=0;
		}
		testPlayer.stumping=testPlayer.stumping+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"stumping":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}
	
	if(detailOfWicket=='run out'){
		if(wicketTakerid in overallConsole){
		var testPlayer=overallConsole[wicketTakerid];
		if(testPlayer.runout==null){
		testPlayer.runout=0;
		}
		testPlayer.runout=testPlayer.runout+1;
		delete overallConsole[wicketTakerid];
		overallConsole[wicketTakerid]=testPlayer;
		}
		else{
		var PlayerInfo = {"PlayerId":wicketTakerid,"runout":1};
		overallConsole[wicketTakerid]=PlayerInfo;
		}
	}


}



}

for(var i in bowl){


var playerId=bowl[i].i;

var wickets = bowl[i].w;
var overs = bowl[i].o;
var maiden = bowl[i].mo;
var bowlingRuns= bowl[i].r;
//console.log(playerId);

if(playerId in overallConsole){
var testPlayer=overallConsole[playerId];
testPlayer.wickets=wickets;
testPlayer.overs=overs;
testPlayer.maiden=maiden;
testPlayer.bowlingRuns=bowlingRuns;
delete overallConsole[playerId];
overallConsole[playerId]=testPlayer;
//console.log(testPlayer);
}
else{
var PlayerInfo = {"PlayerId":playerId,"wickets":wickets,"overs":overs,"maiden":maiden,"bowlingRuns":bowlingRuns};

overallConsole[playerId]=PlayerInfo;
}



}
}
document.getElementById('score').innerHTML=matchStatus+"</br></br>"; 

///////////////////////////////////////////////////////

var finalOp="<div id ='live-scores'>";
finalOp=finalOp+"<div id='thcc-zeo' class='cc-zero'> T </div>";
finalOp=finalOp+"<div id='thplayer-name' class='thplay-name'> Player </div>";
finalOp=finalOp+"<div id='thbat-points' class='thbat-pts'> Bt</div>";
finalOp=finalOp+"<div id='thbow-points' class='thbat-pts'> Bw </div>";
finalOp=finalOp+"<div id='thfield-points' class='thbat-pts'> Fd </div>";
finalOp=finalOp+"<div id='thtotal-points' class='thbat-pts'> Tot</div>";
/*

finalOp=finalOp+"<th>Name</th><th>Runs</th><th>Balls</th><th>Six</th><th>Four</th><th>isOut</th><th>Wickets</th><th>Overs</th><th>Maiden</th><th>Catches</th><th>Stumping</th><th>Run Out</th><th>BRuns</th><th>BtPoints</th><th>BoPoints</th><th>FiPoints</th>";

*/
//finalOp=finalOp+"<th>Name</th><th>BtPoints</th><th>BoPoints</th><th>FiPoints</th><th>Total</th>";

for(var player in overallConsole){


var response ;
$.ajax({ type: "GET",   
         url: "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20cricket.player.profile%20where%20player_id%3D"+overallConsole[player].PlayerId+"&format=json&diagnostics=true&env=store%3A%2F%2F0TxIGQMQbObzvU4Apia0V0&callback=",   
         async: false,
         success : function(text)
         {
             response = text;
         }
});


var batPoints=0,fieldPoints=0,bowlPoints=0;;
//console.log(response);
batPoints=batPoints+parseInt(overallConsole[player].runs==null?0:overallConsole[player].runs)+parseInt(overallConsole[player].fours==null?0:overallConsole[player].fours*2)+parseInt(overallConsole[player].six==null?0:overallConsole[player].six*3);

if((overallConsole[player].runs==null?0:overallConsole[player].runs)>=25){
	//batPoints=batPoints+(parseInt(overallConsole[player].runs==null?0:overallConsole[player].runs)/25)*10;
	batPoints=batPoints+parseInt((parseInt(overallConsole[player].runs==null?0:overallConsole[player].runs)/25)*10);
}

if((overallConsole[player].isOut==null?0:overallConsole[player].isOut)=="YES" && (overallConsole[player].runs==null?0:overallConsole[player].runs)==0){
	batPoints=batPoints-10;
}


var responseRes =$.ajax({ type: "POST",   
                        url: "/teamId.php",   
                        async: false,
						data: { 
								'PLAYER_ID':overallConsole[player].PlayerId,
								}
                      }).responseText;
//console.log(overallConsole[player].name+" -- "+ responseRes);

batPoints=batPoints+(parseInt(overallConsole[player].runs==null?0:overallConsole[player].runs)-parseInt(overallConsole[player].batsmanBalls==null?0:overallConsole[player].batsmanBalls));

fieldPoints=fieldPoints+parseInt(overallConsole[player].catches==null?0:overallConsole[player].catches)*10;
fieldPoints=fieldPoints+parseInt(overallConsole[player].stumping==null?0:overallConsole[player].stumping)*15;
fieldPoints=fieldPoints+parseInt(overallConsole[player].runout==null?0:overallConsole[player].runout)*10;

bowlPoints=bowlPoints+parseInt(overallConsole[player].wickets==null?0:overallConsole[player].wickets)*30;
bowlPoints=bowlPoints+parseInt(overallConsole[player].maiden==null?0:overallConsole[player].maiden)*25;
bowlPoints=bowlPoints+((parseFloat(overallConsole[player].overs==null?0:overallConsole[player].overs)*6*2.5)-parseInt(overallConsole[player].bowlingRuns==null?0:overallConsole[player].bowlingRuns));


finalOp=finalOp+"<div id='new-play'>";
bowlPoints=Math.round(bowlPoints * 100) / 100
if(responseRes=='2'){
finalOp=finalOp+"<div class='cc-two'>T</div>";
}
else if(responseRes=='1'){
finalOp=finalOp+"<div id='new-play' class='cc-one'>B</div>";
}
else if(responseRes=='4'){
finalOp=finalOp+"<div id='new-play' class='cc-four'>O</div>";
}
else if(responseRes=='5'){
finalOp=finalOp+"<div id='new-play' class='cc-five'>M</div>";
}
else{
	finalOp=finalOp+"<div id='new-play' class='cc-nope'>N</div>";
}
var playerFname = response.query.results.PlayerProfile.PersonalDetails.FirstName;
var playerSname = response.query.results.PlayerProfile.PersonalDetails.LastName;

var playersubstring = playerFname.charAt(0) + "  "+ playerSname.substring(0,9);
finalOp=finalOp+"<div class='play-name'>"+ playersubstring +"</div>"

/*finalOp=finalOp+"<td>"+(overallConsole[player].runs==null?0:overallConsole[player].runs)+"</td>"
finalOp=finalOp+"<td>"+(overallConsole[player].batsmanBalls==null?0:overallConsole[player].batsmanBalls)+"</td>"

finalOp=finalOp+"<td>"+(overallConsole[player].six==null?0:overallConsole[player].six)+"</td>"
finalOp=finalOp+"<td>"+(overallConsole[player].fours==null?0:overallConsole[player].fours)+"</td>"
finalOp=finalOp+"<td>"+(overallConsole[player].isOut==null?0:overallConsole[player].isOut)+"</td>"
finalOp=finalOp+"<td>"+(overallConsole[player].wickets==null?0:overallConsole[player].wickets)+"</td>"
finalOp=finalOp+"<td>"+(overallConsole[player].overs==null?0:overallConsole[player].overs)+"</td>"
finalOp=finalOp+"<td>"+(overallConsole[player].maiden==null?0:overallConsole[player].maiden)+"</td>"
finalOp=finalOp+"<td>"+(overallConsole[player].catches==null?0:overallConsole[player].catches)+"</td>"
finalOp=finalOp+"<td>"+(overallConsole[player].stumping==null?0:overallConsole[player].stumping)+"</td>"

finalOp=finalOp+"<td>"+(overallConsole[player].runout==null?0:overallConsole[player].runout)+"</td>"
finalOp=finalOp+"<td>"+(overallConsole[player].bowlingRuns==null?0:overallConsole[player].bowlingRuns)+"</td>"
*/finalOp=finalOp+"<div class='bat-pts'>"+(batPoints)+"</div>"
finalOp=finalOp+"<div class='bat-pts'>"+(bowlPoints)+"</div>"
finalOp=finalOp+"<div class='bat-pts'>"+(fieldPoints)+"</div>"
finalOp=finalOp+"<div class='bat-pts'>"+(batPoints+bowlPoints+fieldPoints)+"</div>"

		
		
		

finalOp=finalOp+"</div>";
//console.log(overallConsole[player]);	
}
finalOp=finalOp+"</div>";
//console.log(finalOp);
document.getElementById('score').innerHTML=document.getElementById('score').innerHTML+finalOp+"</br>";
document.getElementById('loading').style.visibility='hidden';

}

function overAll(){


var response =$.ajax({ type: "POST",   
                        url: "/teamScores.php",   
                        async: false,
                      }).responseText;
document.getElementById('overAllScore').innerHTML=response;

}


function query(){

var queryVal=document.getElementById('queryWindow').value;
var response =$.ajax({ type: "POST",   
                        url: "/Query.php",   
                        async: false,
						 data: { 
								'query': queryVal 
								}
                      }).responseText;
document.getElementById('result').innerHTML=response;

}



function teamLists(){

//var queryVal=document.getElementById('teams').value;
var response =$.ajax({ type: "POST",   
                        url: "/teamlists.php",   
                        async: false
                      }).responseText;

					  console.log(response);
					  console.log(JSON.parse(response).teams);
var teams = JSON.parse(response).teams;
var tables="";
for(var i in teams){
tables=tables+"<div class='team-name'>" + teams[i].name + "</div>";
var response =$.ajax({ type: "POST",   
                        url: "/team.php",   
                        async: false,
						data: { 
								'TEAM_ID': teams[i].id 
								}
                      }).responseText;
tables=tables+response;

tables=tables;
}
document.getElementById('teamScore').innerHTML=tables;

}


function playerList(){
	var obj='<?php echo $TEAM_ID?>';
	console.log(obj);
	giveTime();
	var response =$.ajax({ type: "POST",   
                        url: "/playersList.php",   
                        async: false,
						data: { 
								'TEAM_ID':obj,
								}
                      }).responseText;
					  console.log(JSON.parse(response).players);
var players=JSON.parse(response).players;
for(var i in players){
var x = document.getElementById("PlayersList");
var option = document.createElement("option");
option.text = players[i].name;
option.id=players[i].id;
x.add(option);
					  
}
document.getElementById("PlayersList").style.visibility='visible';
document.getElementById("editPower").innerHTML="Save";
document.getElementById("editcancel").style.visibility='visible';
document.getElementById("editPower").onclick=function() { 
var obj='<?php echo $TEAM_ID?>';
	//console.log(document.getElementById('PlayersList').selectedIndex);
	console.log(document.getElementById('PlayersList').options[document.getElementById('PlayersList').selectedIndex].id);
	var powerPlayId=document.getElementById('PlayersList').options[document.getElementById('PlayersList').selectedIndex].id;
	console.log(document.getElementById("powerId").innerHTML);
	var responseCheck="";
	if(powerPlayId==document.getElementById("powerId").innerHTML)
	{
		console.log("same");
	}
	else{


	responseCheck=$.ajax({ type: "POST",   
                        url: "/UpdatePowerPlayer.php",   
                        async: false,
						data: { 
								'TEAM_ID':obj,
								'PLAYER_ID':powerPlayId
								}
                      }).responseText;
	}	
if(responseCheck=="Already changed"){alert("you have already changed for today")}	
document.getElementById("editPower").innerHTML="Edit PowerPlayer";$('#PlayersList')
    .find('option')
    .remove();

	//
	document.getElementById("PlayersList").style.visibility='hidden';
	document.getElementById("editPower").onclick=playerList;
	location.reload();
	}
}
function cancelPowerPlay(){
	document.getElementById("editPower").innerHTML="Edit PowerPlayer";$('#PlayersList')
    .find('option')
    .remove();
	document.getElementById("PlayersList").style.visibility='hidden';
	document.getElementById("editcancel").style.visibility='hidden';
	document.getElementById("editPower").onclick=playerList;
}
function teamScores(){
	
	var obj='<?php echo $TEAM_ID?>';
	console.log(obj);
	var response =$.ajax({ type: "POST",   
                        url: "/team.php",   
                        async: false,
						data: { 
								'TEAM_ID':obj,
								}
                      }).responseText;
					  console.log(response);
var tables=response;


document.getElementById('PlayerScore').innerHTML=tables;
}

function giveTime(){
	var d = new Date();
	d.getHours();
	if(d.getHours()>16){
		document.getElementById('editPower').style.visibility='hidden';
	}

}



function scores(playerid){
      //Set a variable to contain the DOM element of the overly
      var overlay = document.getElementById("overlay");
      //Set a variable to contain the DOM element of the popup
      var popup = document.getElementById("popup");

      //Changing the display css style from none to block will make it visible
      overlay.style.display = "block";
	  
	  var obj='<?php echo $TEAM_ID?>';
	  
	  	 var response =$.ajax({ type: "POST",   
                        url: "/playerSplitScore.php",   
                        async: false,
						data: { 
								'PLAYER_ID':playerid,
								'TEAM_ID':obj
								}
                      }).responseText;
					  console.log(response);
var tables=response;
	 
	  popup.innerHTML="<button id=\"LearnMoreBtn\"   onClick=\"scoresClose()\">close</button>"+tables;
      //Same goes for the popup
      popup.style.display = "block";
   };
function scoresClose(){

      //Set a variable to contain the DOM element of the overly
      var overlay = document.getElementById("overlay");
      //Set a variable to contain the DOM element of the popup
      var popup = document.getElementById("popup");
     overlay.style.display='none';
	 
	 

	 
      //Same goes for the popup
      popup.style.display = "none";
      //Changing the display css style from none to block will make it visible

   };

</script>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="style.css">
  <script src="js/jquery-1.12.3.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <head>
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  
  $(document).ready(function() {
    $("#all-scores").click(function() {
        console.log("clicked mine");
    });
});
  </script>
  </head>
  <!--
<body onload="updateScores()">
!-->


<body onload="updateScores()">
<div id ="page-container">
<div id="page-header">
KOMARU FANTASY LEAGUE
</div>
<button id="query" type="button" onClick="query()">Query</button>
<div id ="teamscore-container">
<div id="MyTeamName" ></div>
<div id="overAllScore" ></div>
</div>
<label id="matchIdDisplay" style="visibility:hidden"> </label>
<!--
<label id="MyTeamName"></label>
!-->

<!--Mine Starts!-->
<div id="tabs">
  <ul>
    <li id="retainBut"><a href="#tabs-1">Retain</a></li>
	<li><a href="#tabs-2" onClick="playerList()">PP</a></li>
    <li><a href="#tabs-3" onClick="">Live</a></li>
    <li><a href="#tabs-4" onClick="teamLists()">All</a></li>
	<li><a href="#tabs-5" onClick="teamLists()">My</a></li>
	<li><a href="#tabs-6">ReAuc</a></li>
  </ul>
  <div id="tabs-3">
	<div id="container">
    <div id="batsman"></div>
    <div id="fielder"></div>
	<div id="score" ></div>
		<div id="loading">Loading Please wait!</div>
</div>
  </div>
  <div id="tabs-5">
		<div id="PlayerScore"></div>
		
  </div>
  
    <div id="tabs-2">
		<div id ="changepp-container">
		<div>
		<div id="choosepp"> Choose Power Player </div>
			<select id="PlayersList" style="visibility:hidden"></select>
		</div>
		<div id ="button-Container">
		<div>
			<button id="editPower" type="button" class="button" onClick="playerList()" >Edit PowerPlayer</button>
		</div>
		<div>
			<button id="editcancel" type="button" class="button" onClick="cancelPowerPlay()" style="visibility:hidden">Cancel</button>
		</div>
		</div>
		</div >
	</div>

  
  <div id="tabs-4">
	<div id="teamScore" ></div>
  </div>
  
  <div id="tabs-1">
  <div id = 'retainLink'>
	<p> Here You Go! </p>
	<br>
	<p> <a href = "pdf/KFL_Retains.pdf"> Click Here </a> to see Players Retained by all teams </p>
	<br>
	<br>
	<p> <a href = "pdf/KFL_Auction_Players.pdf"> Click Here </a> to see Players Available for various Auctions </p> 
  </div>
   <!--
  Mari, once a team submits the retain player list, hide the above div and populate the following div with retained players list.\
  <div id ='ret-players'>
  </div>
	!-->
  </div>
  
   <div id="tabs-6">
   <div id ="welcome-tab5">
		Hey Crazy Cricketers ! Welcome to the Re-Auction ! </br>
		I promise its gonna be much more fun and well balanced than last time !! </br>
		Here is the timeline for Re-Auction. Please Stay tuned for much more info !!! 
   </div>
	<table id="auc-timeline">
		<tr>
			<th> Action </th>
			<th> Timeline & Deadline </th>
		</tr>
		<tr>
			<td> Teams to Announce Retained Players </td>
			<td> Wed 8PM, 27th Apr</td>
		</tr>
		<tr>
			<td> Organizer: Info on List of Players avaialble for Auction </td>
			<td> Thu 10PM, 28th Apr</td>
		</tr>
		<tr>
			<td> Close Bidding I </td>
			<td> Fri 9PM, 29th Apr</td>
		</tr>
		<tr>
			<td> Results : Close Bidding I </td>
			<td> Fri 10PM, 29th Apr</td>
		</tr>
		<tr>
			<td> Close Bidding II </td>
			<td> Sat 2PM, 29th Apr</td>
		</tr>
		<tr>
			<td> Results : Close Bidding II </td>
			<td> Sat 3PM, 30th Apr</td>
		</tr>
		<tr>
			<td> Auction (Open Bid) </td>
			<td> Sat 6:30 PM - 9PM, 30th Apr</td>
		</tr>
	</table>
  </div>
  
  
</div>
<!--Mine Ends!-->
<label id="teams"></label>
<label id="result" ></label>
<input id="queryWindow"type="text" size="100" style="visibility:hidden">
<!--
<button id="start" type="button" onClick="teamLists()" >Display All Scores</button>
<button id="start" type="button" onClick="currentScores(193866)" style="visibility:visible">Display Live Scores</button>

<table id ="colorCode" width="200" border="1" style="visibility:hidden">
  <tr>
    <td width="74" bgcolor="#0BE83B">&nbsp;</td>
    <td width="110">IPL Blasters</td>
  </tr>
  <tr>
    <td width="74" bgcolor="#0B46E8">&nbsp;</td>
    <td>Okkali Guys<td>
  </tr>
  <tr>
    <td width="74" bgcolor="#E80BC7">&nbsp;</td>
    <td>Thaaru Maaru</td>
  </tr>
  <tr>
    <td width="74" bgcolor="#FF0000" >&nbsp;</td>
    <td>Theri Guys</td>
  </tr>
</table>
!-->
</div>
<div>

<div id="overlay"></div>
<div id="popup">

  
</div>
</body>
</head>
