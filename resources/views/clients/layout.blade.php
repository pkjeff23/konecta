{{-- EXTEND --}}
@extends('layout')

{{-- VARS --}}
    @section('title', 'Clients')

{{-- CSS --}}
    @section('HTML-cssVendors')

    @endsection

    @section('HTML-css')
        <link rel="stylesheet" href="{{ asset('css/Clients.css') }}">
    @endsection

{{-- JS --}}
    @section('HTML-jsVendors')
    @endsection

    @section('HTML-js')
        <script type="text/javascript" language="javascript" src="{{ asset('js/clients.js') }}"></script>
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
                        <th>Dni</th>
                        <th>Email</th>
                        <th>Direccion</th>
                        <th></th>
                    </tr>
                    @foreach ($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->dni }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->address }}</td>
                            <td class="text-right">
                                <button class="btn btn-outline-dark btn-sm"
                                    title="Editar"
                                    onclick="window.location='{{ route('clients.edit', $client) }}'"
                                    >
                                    <i class="fas fa-pencil-alt"></i>
                                </button>

                                <form class="formDelete"
                                    method="POST"
                                    action="{{ route('clients.destroy', $client) }}"
                                    >
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-outline-danger btn-sm"
                                        type="button"
                                        data-toggle="modal"
                                        data-target="#myModal{{ $client->id }}"
                                        >
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <div class="modal fade"
                                        id="myModal{{ $client->id }}"
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
                                                    ¿Está seguro de eliminar éste cliente?
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
                <h3 class="text-center rb-4">Crear Cliente</h3>

                <form method="post" action="{{ route('clients.store') }}">
                    @csrf

                    <div class="form-group">
                        <input type="text" 
                            name="name" 
                            id="name" 
                            class="form-control" 
                            placeholder="Nombre cliente" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <input type="number" 
                            name="dni" 
                            id="dni" 
                            class="form-control" 
                            placeholder="Documento de identidad" 
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
                        <input type="text" 
                            name="address" 
                            id="address" 
                            class="form-control" 
                            placeholder="Direccion" 
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-success btn-block">Crear cliente</button>
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
                            <label for="clients_id" class="col-form-label">Nombre</label>
                        </div>

                        <div class="col-12 col-lg-3">
                            <input type="text" 
                                name="name" 
                                id="name" 
                                class="form-control" 
                                placeholder="Nombre cliente"
                                value="@yield('name_value')" 
                                required
                            >
                        </div>
                    </div>

                    <div id="dniFrm" class="form-row form-group">
                        <div class="col-12 col-lg-2 text-right">
                            <label for="dni" class="col-form-label">Dni</label>
                        </div>

                        <div class="col-12 col-lg-3">
                            <input type="text" 
                                name="dni" 
                                id="dni" 
                                class="form-control" 
                                placeholder="Nombre cliente"
                                value="@yield('dni_value')" 
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
                                placeholder="Nombre cliente"
                                value="@yield('email_value')" 
                                required
                            >
                        </div>
                    </div>

                    <div id="addressFrm" class="form-row form-group">
                        <div class="col-12 col-lg-2 text-right">
                            <label for="address" class="col-form-label">Direccion</label>
                        </div>

                        <div class="col-12 col-lg-3">
                            <input type="text" 
                                name="address" 
                                id="address" 
                                class="form-control" 
                                placeholder="Nombre cliente"
                                value="@yield('address_value')" 
                                required
                            >
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
                            onclick="window.location='{{ route('clients.index') }}';"
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