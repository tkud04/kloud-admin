@extends('layout')

@section('title',"Add Deal")

@section('content')

        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Add a new deal to the system</h2>
              <form action="{{url('add-deal')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}

                <div class="form-group col-lg-6">
                  <label for="phone">Name</label>
                  <input
                    id="phone"
                    name="name"
					value="{{$deal['name']}}"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">SKU</label>
                  <input
                    id="phone"
                    name="sku"
					value="{{$deal['sku']}}"
                    type="text"
					readonly
                    class="form-control validate"
                  />
                </div>
                <div class="form-group col-lg-12">
                  <label for="phone">Description</label>
                 <textarea class="form-control validate" name='description' required>{{$deal['data']['description']}}</textarea>
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Amount (&#8358;)</label>
                  <input
                    id="phone"
                    name="amount"
					value="{{$deal['data']['amount']}}"
                    type="number"
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Category</label>
                  <select
                    id="phone"
                    name="category"
                    class="form-control validate"
					>
					<option value="none">Select category</option>
					   @foreach($c as $key => $value)
                              <?php $ss = ($deal['category'] == $key) ? 'selected="selected"' : ''; ?>
                              <option value="{{$key}}" {{$ss}}>{{$value}}</option>
                              @endforeach
                  </select>
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Rating</label>
                 <span class="form-control">
                          	<?php for($u = 0; $u < $deal['rating']; $u++){ ?>
                            	<i class="far fa-star text-primary"></i>
                              <?php } ?>
                          </span>
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Inventory status</label>
                  <select
                    id="phone"
                    name="in_stock"
                    class="form-control validate"
					>
					<option value="none">Select inventory status</option>
                              <?php 
                              $iss = ['yes' => 'In stock','new' => 'New!','no' => 'Out of Stock'];                           
                              foreach($iss as $key => $value){ 
                              	$ss = ($deal['data']['in_stock'] == $key) ? 'selected="selected"' : ''; 
                              ?>
                              <option value="<?=$key?>" <?=$ss?>><?=$value?></option>
                              <?php } ?>
                  </select>
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Status</label>
                  <select
                    id="phone"
                    name="status"
                    class="form-control validate"
					>
					<option value="none">Select status</option>
                              <?php 
                              $suss = ['approved' => 'Approved','pending'=> "Pending",'rejected' => 'Rejected'];                           
                              foreach($suss as $key => $value){ 
                              	$ss = ($deal['status'] == $key) ? 'selected="selected"' : ''; 
                              ?>
                              <option value="<?=$key?>" <?=$ss?>><?=$value?></option>
                              <?php } ?>
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