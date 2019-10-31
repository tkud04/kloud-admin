@extends('layout')

@section('title',"Orders")

@section('content')

            <!-- row -->
            <div class="row tm-content-row">
			
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title"> View orders, edit order details or remove orders</h2>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ORDER #</th>
                                    <th scope="col">USER</th>                                   
                                    <th scope="col">AMOUNT</th>                                   
                                    <th scope="col">DATE</th>                                   
                                    <th scope="col">STATUS</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							  @if($orders != null && count($orders) > 0)
                               @foreach($orders as $o)
				         <?php
                          $orderURL = url('order').'?on='.$o['number']; 
                         ?>
                                <tr>
                                    
                                    <td><b> {{$o['number']}}</b></td>
                                    <td><b> {{$o['email']}}</b></td>
                                    <td><b>&#8358;{{number_format($o['total'],2)}}</b></td>
                                    <td><b>{{$o['date']}}</b></td>
                                    <td><b>{{$o['status']}}</b></td>
                                    <td>
									<a href="{{$orderURL}}" class="tm-product-delete-link"><i class="far fa-eye tm-product-delete-icon"></i></a>								
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