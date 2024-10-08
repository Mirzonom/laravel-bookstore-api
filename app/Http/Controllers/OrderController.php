<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Enums\STATUS_STATE;

class OrderController extends Controller
{

    private $validationRules = [
        'user_id' => 'required|integer|exists:users,id',
        'total' => 'required|numeric|min:0',
        'status' => 'required|integer|in:' . STATUS_STATE::ACTIVE . ',' . STATUS_STATE::DEACTIVATED,
    ];

    public function index()
    {
        $order = Order::all();
        return response()->json($order);
    }

    public function show(Order $order)
    {
        return response()->json($order);
    }

    public function store(Request $request)
    {
        $request->validate($this->validationRules);

        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate($this->validationRules);

        $order->update($request->all());
        return response()->json($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }


    // Order Item

    private $orderItemValidationRules = [
        'order_id' => 'required|integer|exists:orders,id',
        'book_id' => 'required|integer|exists:books,id',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ];

    public function getItems(Order $order)
    {
        $items = $order->orderItems;
        return response()->json($items);
    }

    public function addItem(Request $request, Order $order)
    {
        $validatedData = $request->validate($this->orderItemValidationRules);

        unset($validatedData['order_id']);

        $orderItem = $order->orderItems()->create(array_merge($validatedData, ['order_id' => $order->id]));
        return response()->json($orderItem, 201);
    }

    public function updateItem(Request $request, Order $order, OrderItem $orderItem)
    {
        if ($orderItem->order_id !== $order->id) {
            return response()->json(['error' => 'Item does not belong to this order'], 403);
        }

        $validatedData = $request->validate([
            'book_id' => 'sometimes|required|integer|exists:books,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        unset($validatedData['order_id']);

        $orderItem->update($validatedData);
        return response()->json($orderItem);
    }

    public function removeItem(Order $order, OrderItem $orderItem)
    {
        $orderItem->delete();
        return response()->json(null, 204);
    }
}
