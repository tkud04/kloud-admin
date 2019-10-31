@extends('layout')

@section('title',"Ratings/Comments")

@section('content')

            <!-- row -->
            <div class="row tm-content-row">
			
			   <div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">  View and approve ratings on Kloud deals.</h2>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">DEAL</th>
                                    <th scope="col">COMMENT</th>                                   
                                    <th scope="col">STATUS</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							  @if($ratings != null && count($ratings) > 0)
                        @foreach($ratings as $r)
				         <?php
                          $approveURL = url('mr').'?ax=jl&id='.$r['id']; 
                          $rejectURL = url('mr').'?ax=lj&id='.$r['id']; 

                          $uu = $approveURL; 
                          $ss = "success";
                          $tt = "check";
                          
                          if($r['status'] == "approved"){
                           $uu = $rejectURL;
                           $ss = "warning";
                           $tt = "times";
                         }
                         ?>
                                <tr>
                                    
                                    <td>
									   {{$r['deal']}}
									</td>
                                    <td><b> 
									@for($u = 0; $u < $r['rating']; $u++)
                                 	<i class="fa fa-star"></i>
                                    @endfor
									</b></td>
                                    <td><b>{{$r['user']}}</b></td>
                                    <td><b> {{$r['status']}}</b></td>
                                    <td><b>{{$r['date']}}</b></td>
                                    <td>
									<a href="{{$uu}}" class="tm-product-delete-link"><i class="fa fa-{{$tt}} tm-product-delete-icon"></i></a>																								
									</td>
                                </tr>
                                @endforeach
								@endif
                            </tbody>
                        </table>
                    </div>
                </div>
				<div class="col-12 tm-block-col">
                    <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                        <h2 class="tm-block-title">  View, edit or remove comments on deals</h2>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">DEAL</th>
                                    <th scope="col">COMMENT</th>                                   
                                    <th scope="col">USER</th>                                   
                                    <th scope="col">STATUS</th>                                    
                                    <th scope="col">DATE CREATED</th>                                    
                                    <th scope="col">ACTIONS</th>                                    
                                </tr>
                            </thead>
                            <tbody>
							  @if($comments != null && count($comments) > 0)
                        @foreach($comments as $c)
				         <?php
                          $uu = url('comment').'?id='.$c['id'];
                         ?>
                                <tr>
                                    <td>{{$c['deal']}}</td>
                                    <td><b>{{$c['comment']}}</b></td>
                                    <td><b> {{$c['user']}}</b></td>
                                    <td><b> {{$c['status']}}</b></td>
                                    <td><b>{{$c['date']}}</b></td>
                                    <td>
									<a href="{{$uu}}" class="tm-product-delete-link"><i class="fa fa-eye tm-product-delete-icon"></i></a>																								
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