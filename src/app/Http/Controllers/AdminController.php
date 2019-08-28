<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $admins = User::all();

      return view('pages.admin.index', [
        'admins' => $admins,
      ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try {
        $verifiedData = $request->validate([
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required',
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        User::create($verifiedData);
      }

      return redirect()->route('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $admin = User::find($id);

      return view('pages.admin.edit', [
        'admin' => $admin,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $admin = User::find($id);
      try {
        $verifiedData = $request->validate([
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required',
        ]);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        $admin->update($verifiedData);
      }

      return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        User::where('id', $id)->delete();
      } catch (Exception $e) {
        return abort(404, $e);
      }

      return redirect()->route('admin');
    }
}
