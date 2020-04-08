<?php

namespace App\Http\Controllers;

use App\Clients;
use Illuminate\Http\Request;
use App;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $clients = Clients::all();

        return View('clients.index')
            ->with('clients', $clients);
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $client = new Clients;
        $client->name = $request->name;
        $client->dni = $request->dni;
        $client->email = $request->email;
        $client->address = $request->address;
        $client->save();

        return back()->with('agregar', 'Cliente creado correctamente');
    }

    public function show(Clients $clients)
    {
        //
    }

    public function edit(Clients $client)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        return view('clients.edit')
            ->with('client', $client);
    }

    public function update(Request $request, Clients $client)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $client->name = $request->name;
        $client->dni = $request->dni;
        $client->email = $request->email;
        $client->address = $request->address;
        $client->save();

        return redirect()->route('clients.index');
    }

    public function destroy(Clients $client)
    {
        $request->user()->authorizeRoles(['user', 'admin']);

        $client->delete();

        return redirect()->route('clients.index');
    }
}
