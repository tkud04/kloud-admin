@extends('layout')

@section('title',"Configuration")

@section('content')
        <!-- row -->
        <div class="row tm-content-row">
          <div class="tm-block-col tm-col-account-settings">
            <div class="tm-bg-primary-dark tm-block tm-block-settings">
              <h2 class="tm-block-title">Manage your website configuration options</h2>
              <form action="{{url('be')}}" method="post" class="tm-signup-form row">
			     {{csrf_field()}}
				 
                 <?php
                  $cc = [];
                   if(count($config) > 0)
                   {
                   	foreach($config as $c)
                       {
                       	$key = $c['item'];
                           $value = $c['value'];
                       	$cc[$key] = $value; 
                       }
                   }
                  ?>
					
                <div class="form-group col-lg-6">
                  <label for="phone">Delivery fee (&#8358;</label>
                  <input
                    id="phone"
                    name="delivery"
					value="{{$cc['delivery']}}"
                    type="text"
					required
                    class="form-control validate"
                  />
                </div>
				<div class="form-group col-lg-6">
                  <label for="phone">Withdrawal fee (&#8358;)</label>
                  <input
                    id="phone"
                    name="withdrawal"
					value="{{$cc['withdrawal']}}"
                    type="text"
					required
                    class="form-control validate"
                  />
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