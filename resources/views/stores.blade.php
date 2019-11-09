@extends('layout')

@section('title',"Stores")

@section('content')

            <!-- row -->
            <div class="row tm-content-row">
			
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title"> View all stores currently on the platform</h2>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">STORE</th>
                                    <th scope="col">TOTAL DEALS</th>                                   
                                    <th scope="col">REVENUE</th>                                   
                                    <th scope="col">DATE OPENED</th>                                   
                                    <th scope="col">STATUS</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							   @if(count($stores) > 0)
                   @foreach($stores as $s)
                      <?php
                         $ird = $s['img'];

                                      if($ird == null || $ird == "none") { $imgg = "img/no-image.png"; }
                                      else{                                      	
                                      	   $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$ird;                                        
										}
									  
                         $flink = $s['flink'];
                         $dn = $s['name'];
                         $deals = $s['deals'];
                         $revenue = $s['total-revenue'];
                         $status = $s['status'];
                         $uu = url("store")."?sn=".$flink;
                  ?>
                                <tr>
                                    
                                    <td>
									  <center><img src="{{$imgg}}" class="img img-fluid cli" style="width: 40% !important;" data-cli="{{$uu}}" alt=""></center><br>                           
									  <b> {{$dn}}</b>
									</td>
                                    <td><b> {{count($deals)}}</b></td>
                                    <td><b>&#8358;{{number_format($revenue, 2)}}</b></td>
                                    <td><b>{{$s['date']}}</b></td>
                                    <td><b>{{$s['status']}}</b></td>
                                    <td>
									<a href="{{$uu}}" class="tm-product-delete-link"><i class="far fa-eye tm-product-delete-icon"></i></a>								
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