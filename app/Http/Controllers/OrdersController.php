<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Tag;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index')->withOrders(Order::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('orders.create', compact('customers'))->withOrder(new Order)->withTags(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $order = Order::create($data);
        if (array_key_exists('tags', $data)) {
            $order->tags()->sync($data['tags']);
        }
        $newContract = new Contract();
        $newContract->order_id = $order->id;
        $newContract->customer_id = $order->customer_id;
        $newContract->save();
        return redirect()->route('orders.edit', $order)->withMessage('Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $customers = Customer::all();
        return view('orders.edit', ['order' => $order, 'customers' => $customers])->withTags(Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = $request->all();
        $order->update($data);
        if (array_key_exists('tags', $data)) {
            $order->tags()->sync($data['tags']);
        }
        $customers = Customer::all();
        return redirect()->route('orders.edit', ['order' => $order, 'customers' => $customers])->withTags(Tag::all())->withMessage('Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->contract()->delete();
        $order->delete();
        return redirect()->route('orders.index')->withMessage('Order deleted successfully');
    }
}
