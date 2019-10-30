<?php
namespace App\Helpers\Contracts;

Interface HelperContract
{
        public function sendEmail($to,$subject,$data,$view,$type);
        public function createUser($data);
        public function createShippingDetails($data);
        public function createBankAccount($data);
        public function addToCart($data);
        public function inCart($user_id, $sku);
        public function createDeal($data);
        public function createDealData($data);
        public function createDealImage($data);
        public function createAuction($data);
        public function createBid($data);
        public function createWallet($data);
        public function createTransaction($data);
        public function createOrder($data);
        public function createOrderDetails($data);
        public function createRating($data);
        public function createComment($data);
        public function createBlogPost($data);
        public function createCoupon($data);
        public function createStore($data);
        public function addSettings($data);
        public function getSetting($i);
        public function createWithdrawal($data);
        public function generateSKU();
        public function generateOrderNumber($type);
        public function getDeals($category,$q="");
        public function refineDeals($deals,$p="");
        public function getUserDeals($user);
        public function getDeadline($baseTimeStamp,$offset);
        public function getDealData($sku);
        public function getDealImages($sku);
        public function getCart($user);
        public function clearCart($user);
        public function getCartTotals($cart);
        public function updateCart($cart, $quantities);
        public function removeFromCart($user, $asf);
        public function getDeal($sku);
        public function updateDeal($data);
        public function updateBlogPost($data);
        public function updateComment($data);
        public function updateCoupon($data);
        public function getUser($email);
        public function updateUser($data);
        public function updateProfile($user, $data);
        public function getUserDeal($user, $sku);
        public function updateUserDeal($user, $data);
        public function getShippingDetails($user);
        public function getSingleShippingDetails($user,$id);
        public function getBankAccount($user);
        public function updateShippingDetails($user,$data);
        public function getWallet($user);
        public function getDashboard($user);
        public function getTransactions($user);
        public function getAuctions($category="");
        public function getUserAuctions($user);
        public function getAuction($dealID);        
        public function getBid($id);     
        public function getBids($id);    
        public function getHighestBidder($id);    
        public function getTotalBids($id); 
        public function getUserBids($user); 
        public function bid($data);     
        public function getBlogPosts($category,$q="");		
        public function getBlogPost($id);		
        public function adminGetTransactions();
        public function adminGetUsers();
        public function adminGetDeals();
        public function adminGetDeal($sku);
        public function adminGetOrders();
        public function adminGetOrder($number);
        public function adminGetAuctions();
        public function adminGetAuction($id);
        public function adminEndAuction($id,$mode);
        public function adminGetRatings();
        public function adminGetCoupons();
        public function adminGetCoupon($id);
        public function adminGetComments();
        public function adminGetComment($id);
        public function getStoreSales();
        public function getLiveAuctions();
        public function adminGetStats();
        public function getBidAmount();
        public function getHottestDeals();
        public function getNewArrivals();
        public function getBestSellers();
        public function getHotCategories();
        public function getRating($deal);
        public function getUserRating($deal,$user);
        public function getComments($deal);
        public function getOrders($user);
        public function getOrder($on);
        public function getOrderDetails($user_id,$id);
        public function addOrder($user,$data);
        public function getInvoice($on);
        public function getUserInvoice($user,$on);
        public function fundWallet($data);
        public function transferFunds($user, $data);
        public function withdrawFunds($user, $data);
        public function checkout($user, $data, $type);
        public function payWithKloudPay($user, $data);
        public function payWithPayStack($user, $payStackResponse);
        public function getPasswordResetCode($user);
        public function verifyPasswordResetCode($code);
        public function getWithdrawalFee();
        public function getWithdrawals();
        public function getPendingWithdrawals($user);
        public function approveWithdrawal($data);
        public function approveRating($data);
        public function isAdmin($user);
        public function isSuperAdmin($user);
        public function rateDeal($user, $data);
        public function commentDeal($user, $data);
		public function approveDeal($data);
		public function getStore($flink);
		public function getStores();
		public function getUserStore($user);
		public function updateUserStore($user,$req);
		public function deleteCloudImage($id);
		public function getED($a);
		public function deleteDeal($user, $id);
		public function deleteAuction($user, $id);
		public function deleteStore($user);
		public function deleteUserStore($user,$id);
		public function getSiteConfig();
		public function updateSiteConfig($data);
		public function getDeliveryFee();
		public function addLeads($data);
		public function deleteLeads();
		public function selectLeads($type);
        public function addSmtpConfig($data);
        public function getSmtpConfig();
        public function getLeads();
        public function hasKey($arr,$key);
        public function updateSmtpConfig($data);
        public function bombNext($data);
        public function setNextLead();
        public function getNextLead();
        public function bomb($data);
        public function notifyAdmin($type, $data);
        public function getSliders();
        public function getCategories();
		
}
 ?>