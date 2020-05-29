@extends('layout')

@section('title',"View Order")

@section('content')
					
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">View/edit information about this order</h2>
			  	<?php
                              $iu = url('invoice').'?on='.$order['number']; 
                          ?>
             
              <form action="{{url('order')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}
				 
				<div class="form-group col-lg-6">
                  <label for="phone">Order #</label>
                  <p class="form-control-plaintext text-white">{{$order['number']}}</p>
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">User</label>
                   <p class="form-control-plaintext text-white">{{$order['email']}}</p>
                </div>
				<div class="form-group col-lg-12">
                  <label for="phone">Items</label>
                  <ul class="form-control-plaintext text-white">
				   <?php
				    $subtotal = 0;
					
				    foreach($order['details'] as $od)
					{
					  $deal = $od['deal']; $store = $deal['store'];
					  $amount = $deal['data']['amount'];
					  $qty = $od['qty'];
					  $subtotal += ($amount * $qty);
				   ?>
				    <li>
					  <p>{{$deal['name']}} (<b>{{$deal['sku']}}</b>) x{{$qty}} | size: {{$od['size']}}, color: {{$od['color']}}</p>
					</li>
				   <?php
				    }
				   ?>
				   <li>SUB-TOTAL: <b>&#8358;{{number_format($subtotal,2)}}</b></li>
				  </ul>
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Status</label>
                  <p class="form-control-plaintext text-white">{{$order['status']}}</p>
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Type</label>
                   <p class="form-control-plaintext text-white">Sale</p>
                </div>
								

                <div class="form-group col-lg-12">
                   <a href="{{$iu}}" target="_blank" class="btn btn-primary btn-block text-uppercase">View Invoice</a><br>
                </div>
              </form>
            </div>
          </div>
        </div>
@stop