<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OwnerRequest;
use App\Models\Owner;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Throwable;

class OwnersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $owners = Owner::select('id', 'name', 'email', 'created_at')
            ->paginate(10);

        return view('admin.owners.index', compact('owners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.owners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OwnerRequest $request)
    {
        try {
            DB::transaction(function () use($request)
            {
                $owner = Owner::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                Shop::create([
                    'owner_id' => $owner->id,
                    'name' => '店名',
                    'information' => '',
                    'filename' => '',
                    'is_selling' => true,
                ], 2);
            });
        } catch (Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()
            ->route('admin.owners.index')
            ->with(['message' => 'Create Succesful!', 'status' => 'info']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $owner = Owner::findOrFail($id);

        return view('admin.owners.edit', compact('owner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OwnerRequest $request, $id)
    {
        $owner = Owner::findOrFail($id);
        $owner->name = $request->name;
        $owner->email = $request->email;
        if ($request->password_same === "0") {
            $owner->password = Hash::make($request->password);
        }
        $owner->save();

        return redirect()
            ->route('admin.owners.index')
            ->with(['message' => 'Update Succesful!', 'status' => 'info']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Owner::findOrFail($id)->delete();

        return redirect()
            ->route('admin.owners.index')
            ->with(['message' => 'Delete Succesful!', 'status' => 'alert']);
    }

    public function expiredOwnerIndex()
    {
        $expiredOwners = Owner::onlyTrashed()
            ->paginate(10);

        return view('admin.expired-owners', compact('expiredOwners'));
    }

    public function expiredOwnerRestore($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->restore();

        return redirect()
            ->route('admin.expired-owners.index')
            ->with(['message' => 'Restore Succesful!', 'status' => 'info']);
    }

    public function expiredOwnerDestroy($id)
    {
        Owner::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()
            ->route('admin.expired-owners.index')
            ->with(['message' => 'Delete Succesful!', 'status' => 'alert']);
    }

}
