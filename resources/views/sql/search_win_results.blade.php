@extends('common.layout')
@section('addTitle')
<title>Search Win Matches: Results</title>
@stop
@include('common.header')
@section('content')
<div class="container">
    <div class="title">Search Win Matches: Results</div>
    <div class="title">Search: <?php echo $team; ?></div>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">TOURNAMENT</th>
                <th scope="col">ROUND</th>
                <th scope="col">GROUP</th>
                <th scope="col">DATE</th>
                <th scope="col">TEAM</th>
                <th scope="col">RESULT</th>
                <th scope="col">TEAM</th>
            </tr>
        </thead>
        <?php foreach ($data as $val) { ?>
            <tr>
                <td scope="row"><?php echo $val->tournament_name; ?></td>
                <td scope="row"><?php echo $val->round_name; ?></td>
                <td scope="row"><?php echo $val->group_name; ?></td>
                <td scope="row"><?php echo $val->DATE; ?></td>
                <td scope="row"><?php echo $val->team0_name; ?></td>
                <td scope="row"><?php echo $val->result_outcome; ?></td>
                <td scope="row"><?php echo $val->team1_name; ?></td>
                <td></td>
            </tr>
        <?php } ?>
    </table>
</div>
@stop
@include('common.footer')