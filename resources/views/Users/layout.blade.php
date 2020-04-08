{{-- EXTEND --}}
@extends('layout')

{{-- VARS --}}
    @section('title', 'users')

{{-- CSS --}}
    @section('HTML-cssVendors')

    @endsection

    @section('HTML-css')
        <link rel="stylesheet" href="{{ asset('css/user.css') }}">
    @endsection

{{-- JS --}}
    @section('HTML-jsVendors')
    @endsection

    @section('HTML-js')
        <script type="text/javascript" language="javascript" src="{{ asset('js/users.js') }}"></script>
    @endsection

{{-- HTML --}}
@section('HTML-main')
    <div class="row">
        @if ($isIndex == true)
            <div class="col-md-7">
                <table class="table">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-right">
                                <button class="separate btn btn-outline-dark btn-sm"
                                    title="Editar"
                                    onclick="window.location='{{ route('users.edit', $user) }}'"
                                    >
                                    edit
                                </button>

                                <form class="formDelete" 
                                    method="POST"
                                    action="{{ route('users.destroy', $user) }}"
                                    >
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="separate btn btn-outline-danger btn-sm"
                                        type="button"
                                        data-toggle="modal"
                                        data-target="#myModal{{$user->id}}"
                                        >
                                        delete
                                    </button>

                                    <div class="modal fade"
                                        id="myModal{{$user->id}}"
                                        tabindex="-1"
                                        role="dialog"
                                        aria-labelledby="myModalLabel">

                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button"
                                                        class="close"
                                                        data-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    ¿Está seguro de eliminar éste usuario?
                                                </div>

                                                <div class="modal-footer">
                                                    <button id="buttonDel"
                                                        class="btn btn-danger"
                                                        type="submit"
                                                        alt="Eliminar"
                                                    >Si</button>

                                                    <button type="button"
                                                        class="btn btn-primary"
                                                        data-dismiss="modal"
                                                    >No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

            <div class="col-md-5">
                <h3 class="text-center rb-4">Crear usuario</h3>

                <form method="post" action="{{ route('users.store') }}">
                    @csrf

                    <div class="form-group">
                        <input type="text" 
                            name="name" 
                            id="name" 
                            class="form-control" 
                            placeholder="Nombre usuario" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <input type="email" 
                            name="email" 
                            id="email" 
                            class="form-control" 
                            placeholder="Email" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <input id="password" 
                            type="password" 
                            class="form-control" 
                            name="password" 
                            required 
                            autocomplete="new-password"
                            placeholder="Contraseña"
                        >
                    </div>

                    <div class="form-group">
                        <input id="password-confirm" 
                            type="password" 
                            class="form-control" 
                            name="password_confirmation" 
                            required 
                            autocomplete="new-password"
                            placeholder="Confirme contraseña"
                            >
                    </div>

                    <div class="form-group">
                        <select name="role" id="role" class="form-control">
                            @foreach ($roles as $rol)
                                <option value="{{$rol->description}}">{{ $rol->description}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Crear usuario</button>
                </form>

                @if (session('agregar'))
                    <div class="alert alert-success mt-3">
                        {{session('agregar')}}
                    </div>
                @endif
            </div>
        @else
            <div id="formsFrm" class="col-12">
                <form id="form"
                    method="@yield("form_method")"
                    action="@yield("form_action")"
                    >
                    @yield("form_laravelCsrf")
                    @yield("form_laravelMethod")

                    @if ($errors->any())
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger" role="alert">
                                    <strong>Novedades</strong>

                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div id="nameFrm" class="form-row form-group">
                        <div class="col-12 col-lg-2 text-right">
                            <label for="users_id" class="col-form-label">Nombre</label>
                        </div>

                        <div class="col-12 col-lg-3">
                            <input type="text" 
                                name="name" 
                                id="name" 
                                class="form-control" 
                                placeholder="Nombre usere"
                                value="@yield('name_value')" 
                                required
                            >
                        </div>
                    </div>

                    <div id="emailFrm" class="form-row form-group">
                        <div class="col-12 col-lg-2 text-right">
                            <label for="email" class="col-form-label">Email</label>
                        </div>

                        <div class="col-12 col-lg-3">
                            <input type="text" 
                                name="email" 
                                id="email" 
                                class="form-control" 
                                placeholder="Nombre usere"
                                value="@yield('email_value')" 
                                required
                            >
                        </div>
                    </div>

                    <div id="passwordFrm" class="form-row form-group">
                        <div class="col-12 col-lg-2 text-right">
                            <label for="password" class="col-form-label">Contraseña</label>
                        </div>

                        <div class="col-12 col-lg-3">
                            <input type="password" 
                                name="password" 
                                id="password" 
                                class="form-control" 
                                placeholder="contraseña"
                                value="@yield('password_value')" 
                                required
                            >
                        </div>

                        <input type="hidden" name="hiddenpassword" value="@yield('password_value')">
                    </div>

                    <div id="roleFrm" class="form-row form-group">
                        <div class="col-12 col-lg-2 text-right">
                            <label for="role" class="col-form-label">Rol</label>
                        </div>
                        
                        <div class="col-12 col-lg-3">
                            <select name="role" id="role" class="form-control">
                                @foreach ($roles as $rol)
                                    <option value="{{$rol->description}}">{{ $rol->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>

                @yield('HTML-formDelete')
            </div>

            <div id="buttonsFrm" class="form-row form-group">
                <div class="col-1">
                    @if ($hasButtonBack == true)
                        <button id="buttonBack" class="btn btn-light btn-link"
                            onclick="window.location='{{ route('users.index') }}';"
                        >Regresar</button>
                    @endif
                </div>

                <div class="offset-2 offset-lg-1 col-1">
                    @if ($hasButtonSave == true)
                        <button class="btn btn-dark"
                            type="@yield('buttonSave_formType')"
                            form="@yield('buttonSave_formId')"
                            @yield('buttonSave_disabled')
                        >Guardar</button>
                    @endif
                </div>

                <div class="offset-5 col-1 offset-lg-8 col-lg-1">
                    @if ($hasButtonDel == true)
                        <button class="btn btn-danger"
                            type="button"
                            data-toggle="modal"
                            data-target="#myModal"
                            @yield('buttonDel_disabled')
                        >Eliminar</button>

                        <div class="modal fade"
                            id="myModal"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="myModalLabel">

                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button"
                                            class="close"
                                            data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                        Esta seguro de eliminar ?
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-danger"
                                            type="submit"
                                            form="formDelete"
                                        >Si</button>

                                        <button type="button"
                                            class="btn btn-primary"
                                            data-dismiss="modal"
                                        >No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
        @endif
    </div>
@endsection