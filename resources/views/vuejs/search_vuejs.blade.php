@extends('common.layout')
@section('addTitle')
<title>Search World Cup Database</title>
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
<div id="wc_vuejs">
<div class="container">
    <div class="title">Search World Cup Database</div>

    <form action="./search_results" method="POST">
        {{ csrf_field() }}
   

        <div id="search_form_area">
            <div class="title">Search Form</div>
            <div class="form-group">
                <label for="Tournament">Tournament</label>
                <select class="form-control" id="tournament" name="tournament">
                    <option value="" selected></option>
                    <?php foreach ($tournaments as $v) { ?>
                        <option value=<?php echo $v->id; ?>><?php echo $v->name; ?></option>
                    <?php } ?>
                </select>
                <label for="Round">Round</label>
                <select class="form-control" id="Round" name="Round">
                    <option value="" selected></option>
                    <?php foreach ($rounds as $v) { ?>
                        <option value=<?php echo $v->knockout; ?>><?php echo $v->knockout; ?></option>
                    <?php } ?>
                </select>
                <label for="Group">Group</label>
                <select class="form-control" id="Group" name="Group">
                    <option value="" selected></option>
                    <?php foreach ($groups as $v) { ?>
                        <option value=<?php echo $v->name; ?>><?php echo $v->name; ?></option>
                    <?php } ?>
                </select>
                <label for="Team">Team</label>
                <select class="form-control" id="Team" name="Team">
                    <option value="" selected></option>
                    <?php foreach ($teams as $v) { ?>
                        <option value=<?php echo $v->id; ?>><?php echo $v->name; ?></option>
                    <?php } ?>
                </select>
                <label for="Outcome">Outcome</label>
                <select class="form-control" id="Outcome" name="Outcome">
                    <option value="" selected></option>
                    <?php foreach ($outcomes as $v) { ?>
                        <option value=<?php echo $v->outcome; ?>><?php echo $v->outcome; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@stop
@include('common.footer')
