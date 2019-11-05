@extends('layout')

@section('title',"Ads")

@section('content')

            <!-- row -->
            <div class="row tm-content-row">
			
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">View, edit or remove ads on KloudTransact webasite</h2>
						<a href="{{url('ad-new')}}" class="btn btn-primary btn-block text-uppercase">Add new ad</a><br>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">BACKGROUND</th>
                                    <th scope="col">SUBTITLE</th>                                   
                                    <th scope="col">TITLE</th>                                    
                                    <th scope="col">TYPE</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							  @if($ads != null && count($ads) > 0)
                              @foreach($ads as $a)
				         <?php
                         $ird = $a['img'];

                                      if(count($ird) < 1 || $ird == "none") { $imgg = "img/no-image.png"; }
                                      else{                                      	
                                      	   $imgg = "https://res.cloudinary.com/kloudtransact/image/upload/v1563645033/".$ird;                                        
										}
									  
                          $viewURL = url('ad').'?&xf='.$c['id']; 
                          $deleteURL = url("delete-ad")."?xf=".$c['id'];
                         ?>
                                <tr>
                                    
                                    <td><b> {{$a['img']}}</b></td>
                                    <td><b> {{$a['subtitle']}}</b></td>
                                    <td><b>{{$a['title']}}</b></td>
                                    <td><b>{{$a['type']}}</b></td>
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