<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 

class MainController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;                     
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getIndex()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('login');		
		}
		else
        {
        	return redirect()->intended('login');
        }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$transactions = $this->helpers->adminGetTransactions();
		$deals = $this->helpers->adminGetDeals();
		$auctions = $this->helpers->adminGetAuctions();
		$adminStats = $this->helpers->adminGetStats();
		$adminRecentOrders = $this->helpers->adminGetOrders();
		$adminRecentTransactions = $this->helpers->adminGetTransactions();
    	return view('index',compact(['user','c','signals','transactions','deals','auctions','adminStats','adminRecentOrders','adminRecentTransactions']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getUsers()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$users = $this->helpers->adminGetUsers();
    	return view('users',compact(['users','user','c','signals']));
    }	
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getUser(Request $request)
    {
       $user = null;
       $account = null; 
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
            $req = $request->all();
           //dd($req);
          $em = (isset($req['email'])) ? $req['email'] : null; 
           
         $c = $this->helpers->categories;
         $signals = $this->helpers->signals;
		$account = $this->helpers->getUser($em); 
    	return view('user',compact(['account','user','c','signals']));
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
    }	
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postUser(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'fname' => 'required',
                             'lname' => 'required',
                             'email' => 'required',
                             'phone' => 'required',
                             'role' => 'required|not_in:none',
                             'status' => 'required|not_in:none',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $this->helpers->updateUser($req);
	        session()->flash("cobra-user-status","ok");
			return redirect()->intended('users');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeals()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$deals = $this->helpers->adminGetDeals();
		#dd($deals);
    	return view('deals',compact(['user','c','signals','deals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeal(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$req = $request->all();
           //dd($req);
        $sku = (isset($req['sku'])) ? $req['sku'] : null; 
        
        if($sku == null) 
        {
        	session()->flash("cobra-deal-status","error");
            return redirect()->intended('cobra-deals');
        }
        else
        {
        	$deal = $this->helpers->adminGetDeal($sku);
    	    return view('deal',compact(['user','c','deal']));
        }
		
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddDeal()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		#$deals = $this->helpers->adminGetDeals();
    	return view('add-deal',compact(['user','c']));
    }
    
       /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postDeal(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'name' => 'required',
                             'sku' => 'required',
                            # 'type' => 'required',
                             'category' => 'required|not_in:none',
                             'description' => 'required',
                             'amount' => 'required|numeric',
                             'in_stock' => 'required|not_in:none',
                             'status' => 'required|not_in:none',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $this->helpers->updateDeal($req);
	        session()->flash("cobra-deal-status","ok");
			return redirect()->intended('deals');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddDeal(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'name' => 'required',
                             'type' => 'required',
                             'category' => 'required',
                             'description' => 'required',
                             'amount' => 'required|numeric',
                             'images' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $this->helpers->createDeal($req);
	        session()->flash("add-deal-status","ok");
			return redirect()->intended('deals');
         }        
    }
	
	   /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddBlogPost()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		#$deals = $this->helpers->adminGetDeals();
    	return view('admin.add-post',compact(['user','c']));
    }
	
	    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postAddBlogPost(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'category' => 'required',
                             'content' => 'required',
                             'flink' => 'required',
                             'title' => 'required',
                             'status' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req["user_id"] = $user->id; 
         	$req["likes"] = "0";  
             $this->helpers->createBlogPost($req);
	        session()->flash("add-post-status","ok");
			return redirect()->intended('cobra-posts');
         }        
    }
	
	    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBlogPosts()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$posts = $this->helpers->getBlogPosts("all");
    	return view('admin.posts',compact(['user','c','signals','posts']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getBlogPost(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$req = $request->all();
           //dd($req);
        $flink = (isset($req['u'])) ? $req['u'] : null; 
        
        if($flink == null) 
        {
        	session()->flash("cobra-post-status","error");
            return redirect()->intended('cobra-posts');
        }
        else
        {
        	$post = $this->helpers->getBlogPost($flink);
			
			if($post == []){
				session()->flash("cobra-post-status","error");
                return redirect()->intended('cobra-posts');
			}
			else{
    	      return view('admin.post',compact(['user','c','post']));
			}
        }
		
    }
	
		    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postBlogPost(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
                             'category' => 'required',
                             'type' => 'required',
                             'content' => 'required',
                             'flink' => 'required',
                             'title' => 'required',
                             'status' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req["id"] = $req["xf"]; 
             $this->helpers->updateBlogPost($req);
	        session()->flash("update-post-status","ok");
			return redirect()->intended('cobra-posts');
         }        
    }
    
     /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getFundWallet(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');	

            $req = $request->all();
            $em = (isset($req['xf'])) ? $req['xf'] : ""; 
		    $c = $this->helpers->categories;
		   
       	return view('fund-wallet',compact(['user','c','em']));	
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postFundWallet(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
                             'type' => 'required',
                             'amount' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req["email"] = $req["xf"]; 
             $this->helpers->fundWallet($req);
	        session()->flash("fund-wallet-status","ok");
			return redirect()->intended('users');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAuctions()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$auctions = $this->helpers->adminGetAuctions();
    	return view('auctions',compact(['user','c','signals','auctions']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAuction(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back();
             //dd($messages);
         }
         
         else
         {
             $auction = $this->helpers->adminGetAuction($req['xf']);
             if($auction == [])
             {
             	return redirect()->back();
             }
             else
             {
             	return view('admin.auction',compact(['user','auction']));
             }        
         }        
    }
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddAuction(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back();
             //dd($messages);
         }
         
         else
         {
             $deal = $this->helpers->getDeal($req['xf']);
             if($deal == [])
             {
             	return redirect()->back();
             }
             else
             {
             	return view('admin.add-auction',compact(['user','deal']));
             }        
         }           	
    }
    
        /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postAddAuction(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
                             'days' => 'required',
                             'hours' => 'required',
                             'minutes' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$req['deal_id'] = $req['xf'];
             $ret = $this->helpers->createAuction($req);
	        session()->flash("create-auction-status",$ret);
			return redirect()->intended('cobra-auctions');
         }        	
    }
    
     /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getEndAuction(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back();
             //dd($messages);
         }
         
         else
         {
             #$req["uid"] = $user->id; 
             $ret = $this->helpers->adminEndAuction($req['xf'], "bid");
	        session()->flash("cobra-end-auction-status",$ret);
			return redirect()->intended('auctions');
         }           	
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeleteAuction(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back();
             //dd($messages);
         }
         
         else
         {
             #$req["uid"] = $user->id; 
             $ret = $this->helpers->deleteAuction($user, $req['xf']);
	        session()->flash("delete-auction-status",$ret);
			return redirect()->intended('auctions');
         }           	
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getStores()
    {
		       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$stores = $this->helpers->getStores();
        #dd($stores);
		return view('stores',compact(['user','c','stores','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getStore(Request $request)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
			$validator = Validator::make($req, [
                             'sn' => 'required',
             ]);
         
            if($validator->fails())
             {
                #$messages = $validator->messages();
                return redirect()->intended('cobra-stores');
            }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$store = $this->helpers->getStore($req['sn']);
        #dd($stores);
		if(count($store) < 1){
			 session()->flash("cobra-get-store-status","error");
			return redirect()->intended('cobra-stores');
		}
		else{
		  return view('store',compact(['user','c','store','signals']));
		}
		
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postStore(Request $request)
    {
    	$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        $req = $request->all();
        #dd($req);
        
        $validator = Validator::make($req, [
                             'ird' => 'required',
                             'dri' => 'required',
                             'name' => 'required',
                             'pickup_address' => 'required',
                             'flink' => 'required',
                             'description' => 'required',
                             'status' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 $req['id'] = $req['dri'];
			$req['img'] = $req['ird'];
             $r = $this->helpers->updateStore($req);
	        session()->flash("cobra-store-status",$r);
			return redirect()->intended('stores');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeleteStore(Request $request)
    {
        $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
			$validator = Validator::make($req, [
                             'sn' => 'required',
             ]);
         
            if($validator->fails())
             {
                #$messages = $validator->messages();
                return redirect()->intended('cobra-stores');
            }
        
		$ret = $this->helpers->deleteUserStore($user, $req['sn']);
        session()->flash("delete-store-status",$ret);
        return redirect()->intended('cobra-stores');
    }

/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getTransactions()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$transactions = $this->helpers->adminGetTransactions();
    	return view('admin.transactions',compact(['user','c','transactions']));
    }

    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getInvoice(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$req = $request->all();
	    //dd($secure);
		$validator = Validator::make($req, [
                             'on' => 'required'
                   ]);
         
                 if($validator->fails())
                  {
					  return redirect()->intended('orders');     
                  }
                
                 else
                 {
					 $order = $this->helpers->adminGetOrder($req['on']);
					 $delivery = $this->helpers->getDeliveryFee();
					 $signals = $this->helpers->signals;
					 
					 if(is_null($order) || $order == [])
					 {
						return redirect()->intended('orders'); 
					 }
				     else
					 {
						// $totals = $this->helpers->getOrderTotals($order['items']);
						  #dd($order);
						 if(isset($req['print']) && $req['print'] == "1")
						 {
						   return view("print-receipt", compact(['user','c','order','delivery','signals'])); 
						 }
						 else
						 {
						    return view("receipt", compact(['user','c','order','delivery','signals'])); 
						 }
						  
					 }					 
                 }
    }


    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getOrders()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$orders = $this->helpers->adminGetOrders(); 
		#dd($orders);
    	return view('orders',compact(['user','c','signals','orders']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getOrder(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
			$validator = Validator::make($req, [
                             'on' => 'required',
             ]);
         
            if($validator->fails())
             {
                #$messages = $validator->messages();
                return redirect()->intended('cobra-orders');
            }
		$c = $this->helpers->categories;
		$order = $this->helpers->adminGetOrder($req['on']); 
		#dd($order);
    	return view('order',compact(['user','c','order']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postOrder(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'email' => 'required',
                             'type' => 'required',
                             'amount' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $this->helpers->fundWallet($req);
	        session()->flash("fund-wallet-status","ok");
			return redirect()->intended('cobra-users');
         }        
    }
    

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getRC()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$ratings = $this->helpers->adminGetRatings();
		$comments = $this->helpers->adminGetComments();
    	return view('rc',compact(['user','c','signals','ratings','comments']));
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAddCoupon()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
    	return view('add-coupon',compact(['user','c']));
    }
    
    public function postAddCoupon(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'code' => 'required',
                             'discount' => 'required|numeric',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $this->helpers->createCoupon($req);
	        session()->flash("add-coupon-status","ok");
			return redirect()->intended('coupons');
         }        
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCoupon(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
		$validator = Validator::make($req, [
                             'xf' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             #$messages = $validator->messages();
             return redirect()->intended('cobra-coupons');
         }
         
         else
         {             
			 $c = $this->helpers->categories;
		     $coupon = $this->helpers->adminGetCoupon($req['xf']);
         	return view('coupon',compact(['user','c','coupon']));
         }        
    }	
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postCoupon(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
                             'code' => 'required',
                             'discount' => 'required',
                             'status' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $ret = $this->helpers->updateCoupon($req);
	        session()->flash("cobra-coupon-status",$ret);
			return redirect()->intended('coupons');
         }        
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getDeleteCoupon(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $ret = $this->helpers->deleteCoupon($req);
	        session()->flash("delete-coupon-status",$ret);
			return redirect()->intended('coupons');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getCoupons()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$coupons = $this->helpers->adminGetCoupons();
    	return view('coupons',compact(['user','coupons','c','signals']));
    }

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getComments()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$comments = $this->helpers->adminGetComments();
    	return view('comments',compact(['user','c','comments','signals']));
    }
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getComment(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
		$validator = Validator::make($req, [
                             'id' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             #$messages = $validator->messages();
             return redirect()->intended('cobra-comments');
         }
         
         else
         {             
			 $c = $this->helpers->categories;
		     $comment = $this->helpers->adminGetComment($req['id']);
         	return view('comment',compact(['user','c','comment']));
         }      
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postComment(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'xf' => 'required',
                             'comment' => 'required',
                             'status' => 'required|not_in:none'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $ret = $this->helpers->updateComment($req);
	        session()->flash("cobra-comment-status",$ret);
			return redirect()->intended('rc');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getWithdrawals()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$withdrawals = $this->helpers->getWithdrawals();
		$signals = $this->helpers->signals;
    	return view('admin.withdrawals',compact(['user','c','withdrawals','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getApproveWithdrawal(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'ff' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $ret = $this->helpers->approveWithdrawal($req);
	        session()->flash("cobra-approve-withdrawal-status",$ret);
			return redirect()->intended('cobra-withdrawals');
         }        
    }

    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function getApproveRating(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'ax' => 'required',
							 'id' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $ret = $this->helpers->approveRating($req);
	        session()->flash("cobra-approve-rating-status",$ret);
			return redirect()->intended('rc');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSiteConfig()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$config = $this->helpers->getSiteConfig();
		$signals = $this->helpers->signals;
    	return view('be',compact(['user','c','config','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postSiteConfig(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'delivery' => 'required',
							'withdrawal' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	#$req["user_id"] = $user->id; 
             $ret = $this->helpers->updateSiteConfig($req);
	        session()->flash("cobra-settings-status",$ret);
			return redirect()->intended('be');
         }        
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSliders()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$sliders = $this->helpers->getSliders();
		$signals = $this->helpers->signals;
    	return view('ss',compact(['user','c','sliders','signals']));
    }
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getNewSlider()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
    	return view('slider-new',compact(['user','c']));
    }
    
    public function postNewSlider(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'img' => 'required|file',
                             'subtitle' => 'required',
                             'title' => 'required',
                             'cta-1-text' => 'required',
                             'cta-1-url' => 'required',
                             'type' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 //upload ad image
             $img = $request->file('img');       
             $ret = $this->helpers->uploadCloudImage($img->getRealPath());
			 $req["img"] = $ret['public_id'];
             $copy = "";
             if(isset($req["copy"])) $copy = $req["copy"]; 
			 $req["copy"] = $copy; 
			 $tag = "";
			 if(isset($req["tag"])) $tag = $req["tag"]; 
			else $req["tag"] = $tag;
			 $req["cta_1"] = $req["cta-1-text"].",".$req["cta-1-url"]; 
			 $req["cta_2"] = "None,#"; 
			if(isset($req["cta-2-text"]) && isset($req["cta-2-text"])) $req["cta_2"] = $req["cta-2-text"].",".$req["cta-2-url"]; 
             $this->helpers->createSlider($req);
	        session()->flash("add-slider-status","ok");
			return redirect()->intended('ss');
         }        
    }
    
    /* Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSlider(Request $request)
    {
       $user = null;
		$req = $request->all();
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $validator = Validator::make($req, [
                             'xf' => 'required'                           
         ]);
         
         if($validator->fails())
         {
             return redirect()->intended('ss');
             //dd($messages);
         }
         else
        {
        	$s = $this->helpers->getSlider($req['xf']);
            if(count($s) > 0)
            {
            	#dd($s);
            	$c = $this->helpers->categories;
            	return view('slider',compact(['user','c','s']));
            }
            else
            {
            	return redirect()->intended('ss');
            }
        }
    }
    
    
    public function postSlider(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        #dd($req);
        
        $validator = Validator::make($req, [
                             'img' => 'file',
                             'xf' => 'required',
                             'subtitle' => 'required',
                             'title' => 'required',
                             'cta-1-text' => 'required',
                             'cta-1-url' => 'required',
                             'type' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 //upload ad image
             $img = $request->file('img');
             $rimg = $img;
             #dd($img);
             if($img != null)
             {
             	$ret = $this->helpers->uploadCloudImage($img->getRealPath());
			     $rimg = $ret['public_id'];
             }       
             $req["img"] = $rimg;
             
             $copy = "";
             if(isset($req["copy"])) $copy = $req["copy"]; 
			 $req["copy"] = $copy; 
			 $tag = "";
			 if(isset($req["tag"])) $tag = $req["tag"]; 
			else $req["tag"] = $tag;
			 $req["cta_1"] = $req["cta-1-text"].",".$req["cta-1-url"]; 
			 $req["cta_2"] = "None,#"; 
			if(isset($req["cta-2-text"]) && isset($req["cta-2-text"])) $req["cta_2"] = $req["cta-2-text"].",".$req["cta-2-url"]; 
             $this->helpers->updateSlider($req);
	        session()->flash("update-slider-status","ok");
			return redirect()->intended('ss');
         }        
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeleteSlider(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
		$validator = Validator::make($req, [
                             'xf' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             #$messages = $validator->messages();
             return redirect()->intended('aa');
         }
         
         else
         {             
			 $this->helpers->deleteSlider($req['xf']);
	        session()->flash("delete-slider-status","ok");
			return redirect()->intended('ss');
         }      
    }
    
    
    

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getAds()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
		$ads = $this->helpers->getAds();
		$signals = $this->helpers->signals;
    	return view('aa',compact(['user','c','ads','signals']));
    }
    
    
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getNewAd()
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
		$c = $this->helpers->categories;
    	return view('ad-new',compact(['user','c']));
    }
    
    public function postNewAd(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'img' => 'required|file',
                             'subtitle' => 'required',
                             'title' => 'required',
                             'cta-text' => 'required',
                             'cta-url' => 'required',
                             'tag' => 'required',
                             'type' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
			 //upload ad image
             $img = $request->file('img');       
             $ret = $this->helpers->uploadCloudImage($img->getRealPath());
			 $req["img"] = $ret['public_id'];
             
			 $req["copy"] = ""; 
			 $req["cta"] = $req["cta-text"].",".$req["cta-url"]; 
             $this->helpers->createAd($req);
	        session()->flash("add-ad-status","ok");
			return redirect()->intended('aa');
         }        
    }
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeleteAd(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
		$validator = Validator::make($req, [
                             'xf' => 'required|numeric'
         ]);
         
         if($validator->fails())
         {
             #$messages = $validator->messages();
             return redirect()->intended('aa');
         }
         
         else
         {             
			 $this->helpers->deleteAd($req['xf']);
	        session()->flash("delete-ad-status","ok");
			return redirect()->intended('aa');
         }      
    }
    
	
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getMailer()
    {
        if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
	
    	$smtp = $this->helpers->getSmtpConfig();
		
		$server = $smtp['host'];
		
		/*
		$leads = [
		                ['id' => "264", 'email' => "aquarius4tkud@yahoo.com", 'status' => "sent"],
		                ['id' => "492", 'email' => "tkudayisi@yahoo.com", 'status' => "sent"],
		                ['id' => "80", 'email' => "dhfrwvjy@gmailcom", 'status' => "failed"],
		                ['id' => "96", 'email' => "tkud4real@yahoo.com", 'status' => "failed"],
                    ];
		*/
		$leads = $this->helpers->getLeads();
		$signals = $this->helpers->signals;
    	return view('admin.mailer',compact(['user','leads','server','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSmtp()
    {
        if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
	
    	$smtp = $this->helpers->getSmtpConfig();
		$signals = $this->helpers->signals;
    	return view('admin.smtp',compact(['user','smtp','signals']));
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postSmtp(Request $request)
    {
    	if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
        
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'ss' => 'required',
                             'sp' => 'required|numeric',
                             'su' => 'required',
                             'spp' => 'required',
                             'sa' => 'required|not_in:none',
                             'se' => 'required|not_in:no-enc',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
            $this->helpers->updateSmtpConfig($req);
	        session()->flash("update-smtp-status","ok");
			return redirect()->intended('smtp');
         }        
    }
    
   /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getLeads()
    {
        if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
	
    	// $signals = $this->helpers->signals;
		// $leads = $this->helpers->getLeads();
    	// return view('admin.leads',compact(['user','leads','signals']));
		
		return redirect()->intended('mailer');
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getDeleteLeads(Request $request)
    {
        if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
	
    	$req = $request->all();
        //dd($req); 
             $this->helpers->deleteLeads();
	        session()->flash("delete-leads-status","ok");
			return redirect()->intended('mailer');
             
    }
    
     /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postLeads(Request $request)
    {
        if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
	
    	$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'leads' => 'required',
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
            $leads = $req["leads"]; 
             $as = $this->helpers->selectLeads($leads);
	        session()->flash("add-leads-status",$as);
			
			return redirect()->intended('mailer');
         }        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postSend(Request $request)
    {
        if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
	
    	$req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'sn' => 'required',
                             'sa' => 'required',
                             'subject' => 'required',
                             'message' => 'required'
                             
         ]);
         
         if($validator->fails())
         {         	
             $ret = json_encode(["status" => "error", "message" => "Validation failed."]);
             //dd($messages);
         }
         
         else
         {         	
             $ret = $this->helpers->bombNext($req); 
         }
         return $ret;	   
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getSeeder()
    {
        if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
	
		$leads = $this->helpers->getLeads();
		$eye = "";
		foreach($leads as $l) $eye .= $l['email']."<br>";
    	return $eye;
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPractice()
    {
        if(Auth::check())
		{
			$user = Auth::user();
            if(!$this->helpers->isAdmin($user)) return redirect()->intended('dashboard');		
		}
		else
        {
        	return redirect()->intended('login?return=dashboard');
        }
	    $settings = [
	       ['item' => "delivery",'value' => "0",'type' => ""],
	       ['item' => "withdrawal",'value' => "0",'type' => ""]
       ];
        foreach($settings as $s) $this->helpers->addSettings($s);
		
    }
  

}