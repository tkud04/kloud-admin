@extends('layout')

@section('title',"Deals")

@section('content')

            <!-- row -->
            <div class="row tm-content-row">
			
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">Deals List - View, Edit or Remove Deals</h2>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">SKU</th>
                                    <th scope="col">DATE CREATED</th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">RATING</th>
                                    <th scope="col">STATUS</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							  @foreach($deals as $d)
							  <?php
							  $store = $d['store'];
							  ?>
                                <tr>
                                    <th scope="row"><b>{{$d['sku']}}</b><br><b>({{$store['name']}})</b></th>
                                    
                                    <td><b>{{$d['date']}}</b></td>
                                    <td><b>{{$d['name']}}</b></td>
                                    <td><b>
									@for($u = 0; $u < $d['rating']; $u++)
                            	     <i class="far fa-star text-primary"></i>
                                    @endfor
									</b></td>
                                    <td><b>{{$d['status']}} </b></td>
                                    <td>
									<a href="{{url('deal').'?sku='.$d['sku']}}" class="tm-product-delete-link"><i class="far fa-eye tm-product-delete-icon"></i></a>
									<a href="#" class="tm-product-delete-link"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>
									</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
@stop