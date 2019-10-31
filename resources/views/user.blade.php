@extends('layout')

@section('title',"View User")

@section('content')
                 <?php
                      $fund_url = url('fund-wallet').'?xf='.$account['email'];
                      $balance = $account['wallet']['balance'];
                    ?>
					
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">View information about this user</h2>
			  <a href="{{$fund_url}}" class="btn btn-primary btn-block text-uppercase">Fund user wallet</a><br>
              <form action="{{url('user')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}

					
                <div class="form-group col-lg-6">
                  <label for="phone">First Name</label>
                  <input
                    id="phone"
                    name="fname"
					value="{{$account['fname']}}"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Last Name</label>
                  <input
                    id="phone"
                    name="lname"
					value="{{$account['lname']}}"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Email address</label>
                  <input
                    id="phone"
                    name="email"
					value="{{$account['email']}}"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Phone #</label>
                  <input
                    id="phone"
                    name="phone"
					value="{{$account['phone']}}"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-4">
                  <label for="phone">Account balance</label>
                  <input
                    id="phone"
					value="&#8358;{{number_format($balance,2)}}"
                    type="text"
					readonly
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Role</label>
                  <select
                    id="phone"
                    name="role"
                    class="form-control validate"
					>
					<option value="none">Select role</option>
                              <?php 
                              $iss = ['user' => 'User','admin' => 'Admin','su' => 'Super Admin'];                           
                              foreach($iss as $key => $value){ 
                              	$ss = ($account['role'] == $key) ? 'selected="selected"' : ''; 
                              ?>
                               <option value="<?=$key?>" <?=$ss?>><?=$value?></option>
                              <?php } ?>   
                  </select>
                </div>
				
				<div class="form-group col-lg-6">
                  <label for="phone">Status</label>
                  <select
                    id="phone"
                    name="status"
                    class="form-control validate"
					>
					<option value="none">Select status</option>
                              <?php 
                              $iss = ['enabled' => 'Active','disabled' => 'Suspended'];                           
                              foreach($iss as $key => $value){ 
                              	$ss = ($account['status'] == $key) ? 'selected="selected"' : ''; 
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