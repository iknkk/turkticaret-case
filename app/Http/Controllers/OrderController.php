<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('products')->get();
        if ($orders->count() > 0) {
            return response()->json($orders, 200);
        } else {
            return response()->json(['message' => 'No orders found'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [ //Post Validation 
            'product_id' => ['required'], //(integer doğrulaması çalışmıyor)
            'quantity' => ['required'], //(integer doğrulaması çalışmıyor)
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 400); //Validation hatası varsa 400 döndür
        }

        //
        $orderItems = $request->input(); //Get Verileri
        $campaigns = DB::table('campaigns')->get(); //Kampanyaları çekiyoruz
        //print_r($campaigns);die;
        $total = 0;
        $discountGrandTotal = 0;
        for ($i = 0; $i < count($orderItems['product_id']); $i++) { //Ürünlerin toplamını hesaplıyoruz
            $item[$i]['product_id'] = $orderItems['product_id'][$i];
            $item[$i]['author_id'] = db::table('products')->where('id', $orderItems['product_id'][$i])->value('author_id');
            $item[$i]['quantity'] = $orderItems['quantity'][$i];
            $item[$i]['stock'] = db::table('products')->where('id', $orderItems['product_id'][$i])->value('stock_quantity');
            if ($item[$i]['stock'] < $item[$i]['quantity']) { //Stok kontrolü
                return response()->json(['product' => db::table('products')->where('id', $orderItems['product_id'][$i])->get(), 'message' => 'Stock is not available'], 404);
                die;
            }
            $item[$i]['price'] = db::table('products')->where('id', $orderItems['product_id'][$i])->value('price'); //Ürün fiyatını çekiyoruz 
            if ($campaigns[0]->buyXpcsYpcsDiscountAuthorId == $item[$i]['author_id'] && $campaigns[0]->buyXpcsYpcsFree <= $item[$i]['quantity']) { //Kampanya 1 kontrolü
                $item[$i]['campaign_id'] = $campaigns[0]->id;
                $item[$i]['campaign_discount'] = $item[$i]['price'] * $campaigns[0]->buyXpcsYfreeLimit;
                $item[$i]['discoundedAmount'] = ($item[$i]['price'] * $item[$i]['quantity']) - ($item[$i]['price'] * $campaigns[0]->buyXpcsYfreeLimit);
                $item[$i]['withoutDiscountTotal'] = $item[$i]['price'] * $item[$i]['quantity'];
            } else { //Kampanya 1 yoksa
                $item[$i]['campaign_id'] = 0;
                $item[$i]['discoundedAmount'] = 0;
                $item[$i]['withoutDiscountTotal'] = $item[$i]['price'] * $item[$i]['quantity'];
            }
            $total += $item[$i]['withoutDiscountTotal']; //Toplam tutarı hesaplıyoruz
            $discountGrandTotal += $item[$i]['discoundedAmount']; //İndirimli toplam tutarı hesaplıyoruz
        }

        $grandTotal = $total - $discountGrandTotal;

        //$total = tüm ürünlerin kampanyasız fiyatı
        //$discountGrandTotal = tüm ürünlerin kampanya 1. kampanya indirimi
        //$grandTotal = tüm ürünlerin kampanya 1. kampanya indirimi ile toplam fiyatı

        if ($total >= $campaigns[1]->overXpriceDiscountAmount) { //Eğer toplam tutar kampanya 2. kampanya tutarından büyükse
            $discount = ($total * $campaigns[1]->overXpriceDiscountPercent) / 100; //Kampanya 2. kampanya indirimi
            $secondCampaignGrandTotal = $total - $discount; //Kampanya 2. kampanya indirimi ile toplam fiyat
            if ($secondCampaignGrandTotal < $grandTotal) { //Kampanya 2. kampanya indirimi ile toplam fiyat kampanya 1. kampanya indirimi ile toplam fiyatdan küçükse
                $campaignID = $campaigns[1]->id;
                $grandTotal = $secondCampaignGrandTotal;
            } else { //Kampanya 2. kampanya indirimi ile toplam fiyat kampanya 1. kampanya indirimi ile toplam fiyatdan büyükse
                $campaignID = $campaigns[0]->id;
                $grandTotal = $grandTotal;
            }
        } else { //Eğer toplam tutar kampanya 2. kampanya tutarından küçükse
            if ($discountGrandTotal > 0) {
                $campaignID = $campaigns[0]->id;
            } else {
                $campaignID = 0;
            }
            $grandTotal = $grandTotal;
        }

        $order = new Order; //Sipariş tablosuna kayıt
        $order->total_price = $total;
        $order->campaign_id = $campaignID;
        $order->paid_amount = $grandTotal;
        $order->save();
        $order_id = $order->id;

        foreach ($item as $key => $value) { //Sipariş ürünlerine kayıt
            DB::table('order_details')->insert([
                'order_id' => $order_id,
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'price' => $value['price'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
        $order = Order::with('order_details', 'campaign')->find($order_id); //Sipariş bilgilerini çekiyoruz
        if($order){
            return response()->json([$order,'message' => 'The order has been successfully created.'], 200); //Sipariş bilgilerini döndürüyoruz
        }else{
            return response()->json(['message' => 'The order could not be created.'], 404);
        }
        
    }




    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order = Order::with('order_details', 'campaign')->find($order->id);
        if ($order) {
            return response()->json($order, 200);
        } else {
            return response()->json(['message' => 'The order could not be found.'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
