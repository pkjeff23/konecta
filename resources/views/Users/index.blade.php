@php
    $isIndex = true;

    $hasButtonBack = false;
    $hasButtonAdd = true;
    $hasButtonDel = false;
    $hasButtonSave = false;
@endphp

{{-- EXTEND --}}
    @extends('users.layout')

{{-- VARS --}}
    @section('title', '')

{{-- BUTTONS --}}
    @section('buttonAdd_disabled', '')