@extends('layout')

@section('title',"Coupons")

@section('content')

            <!-- row -->
            <div class="row tm-content-row">
			
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">View, edit or remove coupons</h2>
						<a href="{{url('add-coupon')}}" class="btn btn-primary btn-block text-uppercase">Add new coupon</a><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">COUPON</th>
                                    <th scope="col">DISCOUNT</th>                                   
                                    <th scope="col">STATUS</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							  @if($coupons != null && count($coupons) > 0)
                              @foreach($coupons as $c)
				         <?php
                          $viewURL = url('coupon').'?&xf='.$c['id']; 
                          $deleteURL = url("delete-coupon")."?xf=".$c['id'];
                         ?>
                                <tr>
                                    
                                    <td><b> {{$c['code']}}</b></td>
                                    <td><b> {{$c['discount']}}%</b></td>
                                    <td><b>{{$c['status']}}</b></td>
                                    <td>
									<a href="{{$viewURL}}" class="tm-product-delete-link"><i class="far fa-eye tm-product-delete-icon"></i></a>
									<a href="{{$deleteURL}}" class="tm-product-delete-link"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>
									</td>
                                </tr>
                                @endforeach
								@endif
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
@stop