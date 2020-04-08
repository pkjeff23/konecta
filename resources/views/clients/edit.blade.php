@php
    $isIndex = false;

    $hasButtonBack = true;
    $hasButtonAdd = false;
    $hasButtonDel = true;
    $hasButtonSave = true;
@endphp

{{-- EXTEND --}}
    @extends('clients.layout')

{{-- VARS --}}
    @section('title', 'Actualizar cliente')

{{-- FORM --}}
    @section('form_method', 'POST')
    @section('form_action', route('clients.update', $client->id))
    @section('form_laravelCsrf', csrf_field())
    @section('form_laravelMethod', method_field('PUT'))

        @section('name_value', old('name', $client->name))
        @section('name_disabled', '')

        @section('dni_value', old('dni', $client->dni))
        @section('dni_disabled', '')

        @section('email_value', old('email', $client->email))
        @section('email_disabled', '')

        @section('address_value', old('address', $client->address))
        @section('address_disabled', '')

{{-- BUTTONS --}}
    @section('buttonAdd_disabled', 'disabled')

    @section('buttonDel_disabled', '')

        @section('HTML-formDelete')
            <form id="formDelete"
                method="POST"
                action="{{ route('clients.destroy', $client) }}"
                >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
            </form>
        @endsection

    @section('buttonSave_formType', 'submit')
    @section('buttonSave_formId', 'form')
    @section('buttonSave_disabled', '')