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
                  <input
                    id="phone"
					value="{{$order['number']}}"
                    type="text"
					readonly
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">User</label>
                  <input
                    id="phone"
					value="{{$order['email']}}"
                    type="text"
					readonly
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Status</label>
                  <input
                    id="phone"
					value="{{$order['status']}}"
                    type="text"
					readonly
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Type</label>
                  <input
                    id="phone"
					value="Sale"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
								

                <div class="form-group col-lg-12">
                   <a href="{{$iu}}" target="_blank" class="btn btn-primary btn-block text-uppercase">View Invoice</a><br>
                </div>
              </form>
            </div>
          </div>
        </div>
@stop