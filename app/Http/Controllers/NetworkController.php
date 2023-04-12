<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NetworkController extends Controller
{
    public function index()
    {
        return view('admin.network.index');
    }

    public function create()
    {
        return view('admin.network.create');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $validated = $this->validate($request, [
            'name'      => 'required|max:255',
            'is_active' => 'in:0,1'
        ]);

        Network::create([
            'name'      => $validated['name'],
            'is_active' => $validated['is_active']
        ]);

        return redirect(route('market.network.index'));
    }

    public function edit(Network $network)
    {
        return view('admin.network.edit', compact('network'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, Network $network)
    {
        $validated = $this->validate($request, [
            'name'      => 'required|max:255',
            'is_active' => 'in:0,1'
        ]);

        $network->update([
            'name'      => $validated['name'],
            'is_active' => $validated['is_active']
        ]);

        return redirect(route('market.network.index'));
    }

    public function destroy(Network $network): RedirectResponse
    {
        $network->delete();

        return redirect(route('market.network.index'));
    }
}
