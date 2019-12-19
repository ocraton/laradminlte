@extends('layouts.master')

@section('head')
<meta http-equiv="refresh" content="300">
@endsection

@section('titlepage')
    Ups
@endsection

@section('content')
<h5 class="modal-title" id="exampleModalLabel">
  Ups ID: {{ $ups->id }}
  <br>
  Locazione: {{ $ups->locazione->id }}: {{ $ups->locazione->citta }}</h5>
<div class="card-body table-responsive p-0">
    <table class="table table-hover">
        {!! html_entity_decode($ups->info) !!}
    </table>
</div>
@endsection
