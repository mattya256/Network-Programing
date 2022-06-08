@extends('common.layout')
@section('addTitle')
<title>Search Win Matches: Results</title>
@stop
@section('addMeta')
<meta name="csrf-token" content="{{csrf_token()}}">
@stop
@section('addCSS')
@stop
@section('addScript')
<!-- Google Map JavaScript Library -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCJJb1x_Vypsp3sZA-2uRNaYpj9VnLtyMU" type="text/javascript"></script>
@stop
@include('common.header')
@section('content')
<div id="hello_gmap">
<div class="container">
    <div class="title">Search Win Matches: Results</div>
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
        <?php $i=0; ?>
        <?php foreach ($data as $val) { ?>
            <tr>
                <td scope="row"><?php echo $val->tournament_name; ?></td>
                <td scope="row"><?php echo $val->round_name; ?></td>
                <td scope="row"><?php echo $val->group_name; ?></td>
                <td scope="row"><?php echo $val->DATE; ?></td>
                <td scope="row"><?php echo $val->team0_name; ?></td>
                <td scope="row"><?php echo $val->result_outcome; ?></td>
                <td scope="row"><?php echo $val->team1_name; ?></td>
                <td scope="row">
                <button type="submit" @click="selectaddMarker2(<?php echo $i; ?>)" :disabled="false" class="btn btn-primary">場所表示</button>
                </td>
                <td></td>
            </tr>
        <?php 
        $i++;} ?>
    </table>
</div>

<div class="container">
    
        <div id="gmap">
            <div id="mapinfo"></div>
            <div id="map" class="z-depth-1" style="height: 500px"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function getlocation() {
        location.data = <?php echo json_encode($data); ?>;
        return location;
    };
</script>

<script src="{{ mix('js/hello_gmap.js') }}">
</script>

@stop
@include('common.footer')