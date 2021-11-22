@extends('layouts.admin')
@section('css')
   <style>
fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 1em 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
      box-shadow:  0px 0px 0px 0px #000;
}

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
}
   </style> 
@endsection
@section('content')
    
      <mantenimientos-farmacias-admin></mantenimientos-farmacias-admin>
           
@endsection

