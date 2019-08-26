<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = Customer::all();

      return view('pages.customer.index', [
        'customers' => $customer,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('pages.customer.create');
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
        $validatedData = $request->validate([
          'name' => 'required',
          'phone' => 'unique:customers|required',
          'email' => 'unique:customers|required',
          'gender' => 'required',
        ]);
        Customer::create($validatedData);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        return redirect()->route('customer');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $customer = Customer::with('purchase.item')->where('id', $id);

      return view('pages.customer.edit', [
        'customer' => $customer,
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try {
        $validatedData = $request->validate([
          'name' => 'required',
          'phone' => 'unique:customers|required',
          'email' => 'unique:customers|required',
          'gender' => 'required',
        ]);
        Customer::where('id', $id)->update($validatedData);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        return redirect()->route('customer');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        Customer::destroy($id);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        return redirect()->route('customer');
      }
    }
}
