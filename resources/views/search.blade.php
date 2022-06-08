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
        
        
    <div class="title">Search World Cup Database</div>

    <form action="./search_results" method="POST">
        {{ csrf_field() }}
   
        <div id="search_form_area">
            <div class="title">Seaarch Form</div>
            <div class="form-group">
            

                <label for="Tournament">Tournament</label>
                <select class="Tournament" id="tournament" name="tournament" >
                    <option value="" selected ></option>
                    <?php foreach ($tournaments as $v) { ?>
                        <option value=<?php echo $v->id; ?>><?php echo $v->name; ?></option>
                    <?php } ?>
                </select>
                <label for="Round">Round</label>
                <select class="Round" id="Round" name="Round">
                    <option value="" selected></option>
                    <?php foreach ($rounds as $v) { ?>
                        <option value=<?php echo $v->knockout; ?>><?php 
                        if($v->knockout==1){echo "決勝リーグ";}
                        else {echo "予選リーグ";} 
                        ?></option>
                    <?php } ?>
                </select>
                <label for="Group" id ="Group2">Group</label>
                <select class="Group" id="Group" name="Group">
                    <option value="" selected></option>
                    <?php foreach ($groups as $v) { ?>
                        <option value=<?php echo $v->name; ?>><?php echo $v->name; ?></option>
                    <?php } ?>
                </select>
                <label for="Team">Team</label>
                <select class="Team" id="Team" name="Team">
                    <option value="" selected></option>
                    <?php foreach ($teams as $v) { ?>
                        <option value=<?php echo $v->id; ?>><?php echo $v->name; ?></option>
                    <?php } ?>
                </select>
                <label for="Outcome" id ="Outcome2">Outcome</label>
                <select class="Outcome" id="Outcome" name="Outcome">
                    <option value="" selected></option>
                    <?php foreach ($outcomes as $v) { ?>
                        <option value=<?php echo $v->outcome; ?>><?php echo $v->outcome; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    


<script src="{{ mix('js/hello_ajax.js') }}">
</script>

@stop
@include('common.footer')
