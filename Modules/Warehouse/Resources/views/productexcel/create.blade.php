@extends('warehouse::layouts.master')

@section('content')
    <form method='POST' enctype="multipart/form-data">
        {{ csrf_field() }}
        <label>Seleccione archivo excel de productos simples</label>
        <br>
        <input type='file' name='file' accept='.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel'>
        <br><br>
        <input type='submit' value='Subir'>
    </form>
@stop
