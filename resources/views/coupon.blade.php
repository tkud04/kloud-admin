@extends('layout')

@section('title',"View Coupon")

@section('content')
					
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">View, edit or remove this coupon</h2>

              <form action="{{url('coupon')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}
                 <input type="hidden" name="xf" value="{{$coupon['id']}}">
				 
				<div class="form-group col-lg-4">
                  <label for="phone">Code</label>
                  <input
                    id="phone"
                    name="code"
					value="{{$coupon['code']}}"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Discount (%)</label>
                  <input
                    id="phone"
					name="discount"
					value="{{$coupon['discount']}}"
                    type="number"
					required
                    class="form-control validate"
                  />
                </div>
								
				<div class="form-group col-lg-4">
                  <label for="phone">Status</label>
                 <select
                    id="phone"
                    name="status"
                    class="form-control validate"
					>
					<?php
                                $ar = ['active' => "Active", 'pending' => "Pending", 'disabled' => "Disabled"];
                              ?>
                          	<option value="none">Select status</option>
                              <?php
                                foreach($ar as $key => $value){ 
                                	$snm = ($coupon['status'] == $key) ? "selected='selected'" : "";
                               ?>
                              <option value="{{$key}}" {{$snm}}>{{$value}}</option>
                              <?php
                                }
                               ?>
                  </select>
                </div>

                <div class="form-group col-lg-12">
                  <button
                    type="submit"
                    class="btn btn-primary btn-block text-uppercase"
                  >
                   Submit
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
@stop