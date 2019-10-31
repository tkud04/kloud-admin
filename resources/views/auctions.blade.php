@extends('layout')

@section('title',"Auctions")

@section('content')

            <!-- row -->
            <div class="row tm-content-row">
			
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">  View all Kloud Auctions</h2>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">AUCTION</th>
                                    <th scope="col">AMOUNT</th>                                   
                                    <th scope="col">TOTAL BIDS</th>                                   
                                    <th scope="col">HIGHEST BIDDER</th>                                   
                                    <th scope="col">TIME LEFT</th>                                   
                                    <th scope="col">STATUS</th>                                    
                                    <th scope="col">DATE CREATED</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							    @if($auctions != null && count($auctions) > 0)
                                              @foreach($auctions as $a)
                      <?php
                         $deal = $a['deal'];
                    $images = $deal['images'];
                         shuffle($images);
                         $ird = $images[0]['url'];

                                      if(count($ird) < 1 || $ird == "none") { $imgg = "img/no-image.png"; }
                                      else{                                      	
                                      	   $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/uploads/".$ird;                                        
										}
									  
                         $du = url('deal')."?sku=".$deal['sku'];
                    $bp = "&#8358;".number_format($a['buy_price'],2);
                    $hb = "Unknown";
                    $hbb = (isset($a['hb'])) ? $a['hb'] : "no";
                    if($hbb != "no") $hb = $hbb->fname." ".$hbb->lname;
                    $eu = url('end-auction')."?xf=".$a['id'];
                    $deu = url('delete-auction')."?xf=".$a['id'];
                  ?>
                                <tr>
                                    
                                    <td>
									  <center><img src="{{$imgg}}" class="img img-fluid cli" style="width: 40% !important;" data-cli="{{$du}}" alt="{{$deal['name']}}"></center><br>                           
									  <b> {{$deal['name']}}</b>
									</td>
                                    <td><b> {!! $bp !!}</b></td>
                                    <td><b>{{$a['total-bids']}}</b></td>
                                    <td><b>{{$hb}}</b></td>
                                    <td>
									  <b>
									    <div id="cdc-{{$a['id']}}"></div>
                                                    <script>
	                                                    nq = new Date("{{$a['ed']}}");
                                                        getcd(nq,"cdc-{{$a['id']}}");
                                                    </script>
									  </b>
									</td>
                                    <td>
									<b>
									@if($a['status'] == "live")
                                                  	<span class="text-primary text-bold">Live</span>
                                                      @elseif($a['status'] == "ended")
                                                      <span class="text-danger text-bold">Ended</span>
                                                      @endif
									</b>
									</td>
                                    <td><b>{{$a['date']}}</b></td>
                                    <td>
									<a href="{{$eu}}" class="tm-product-delete-link"><i class="fa fa-stopwatch tm-product-delete-icon"></i></a>								
									<a href="{{$deu}}" class="tm-product-delete-link"><i class="far fa-trash-alt tm-product-delete-icon"></i></a>								
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