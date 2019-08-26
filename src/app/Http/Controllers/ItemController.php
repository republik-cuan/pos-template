<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $items = Item::all();

      return $items;
      /* return view('pages.item.index', [ */
      /*   'items' => $items, */
      /* ]); */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('pages.item.create');
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
          'name' => 'unique:items|required',
          'price' => 'required',
          'stock' => 'required',
        ]);

        Item::create($validatedData);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        return response()->json([
          'message' => 'success creating item',
        ]);
        /* return redirect()->route('item'); */
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $item = Item::find($id);

      return $item;
      /* return view('pages.item.edit', [ */
      /*   'item' => $item, */
      /* ]); */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      try {
        $validatedData = $request->validate([
          'name' => 'unique:items|required',
          'price' => 'required',
          'stock' => 'required',
          'sold' => 'required',
        ]);

        $user = Item::where('id', $id)->update($validatedData);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        return response()->json([
          'message' => 'success updating item',
          'user' => $user,
        ]);
        /* return redirect()->route('item'); */
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try {
        Item::destroy($id);
      } catch (Exception $e) {
        return abort(404, $e);
      } finally {
        return response()->json([
          'message' => 'success removing item',
        ]);
        /* return redirect()->route('item'); */
      }
    }
}
