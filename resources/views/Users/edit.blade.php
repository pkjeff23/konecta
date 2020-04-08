@php
    $isIndex = false;

    $hasButtonBack = true;
    $hasButtonAdd = false;
    $hasButtonDel = true;
    $hasButtonSave = true;
@endphp

{{-- EXTEND --}}
    @extends('users.layout')

{{-- VARS --}}
    @section('title', 'Actualizar usuario')

{{-- FORM --}}
    @section('form_method', 'POST')
    @section('form_action', route('users.update', $user))
    @section('form_laravelCsrf', csrf_field())
    @section('form_laravelMethod', method_field('PUT'))

        @section('name_value', old('name', $user->name))
        @section('name_disabled', '')

        @section('email_value', old('email', $user->email))
        @section('email_disabled', '')
        
        @section('password_value', old('password', $user->password))
        @section('password_disabled', '')

        @section('role_value', old('role', ))
        @section('role_disabled', '')

{{-- BUTTONS --}}
    @section('buttonAdd_disabled', 'disabled')

    @section('buttonDel_disabled', '')

        @section('HTML-formDelete')
            <form id="formDelete"
                method="POST"
                action="{{ route('users.destroy', $user) }}"
                >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
            </form>
        @endsection

    @section('buttonSave_formType', 'submit')
    @section('buttonSave_formId', 'form')
    @section('buttonSave_disabled', '')