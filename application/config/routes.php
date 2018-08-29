<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/


/*********** Admin section start *********/
 
$route['admin'] 			= 'admin/Auth/login';
//$route['admin/auth/login']= 'admin/Auth/login';
$route['admin/logout']		= 'admin/Auth/Logout';
$route['admin/dashboard']	= 'admin/AdminDashboard';
$route['admin/profile/(:num)']		= 'admin/Profile/index/$1';

$route['admin/user-listing']		= 'admin/AdminUsers';
$route['admin/create-user']			= 'admin/AdminUsers/CreateNewUser';
$route['admin/update-user/(:any)']	= 'admin/AdminUsers/UpdateUser/$1';
$route['admin/delete-user/(:any)']	= 'admin/AdminUsers/DeleteUser/$1';



/****************Delivery boys*************/
$route['admin/deliveryboys-listing']		= 'admin/AdminUsers/FetchAllDeliveryBoys';
$route['admin/delete-deliveryboy/(:any)']	= 'admin/AdminUsers/DeleteDeliveryBoys/$1';


/*************************Staff***************************/
$route['admin/staff-listing']		= 'admin/AdminUsers/FetchAllStaff';
$route['admin/delete-staff/(:any)']	= 'admin/AdminUsers/DeleteStaff/$1';


$route['admin/product-listing']			= 'admin/AdminProducts';
$route['admin/product-listing/(:num)']	= 'admin/AdminProducts/index/$1';
$route['admin/create-product']			= 'admin/AdminProducts/CreateNewProduct';
$route['admin/product-update/(:any)']	= 'admin/AdminProducts/UpdateProduct/$1';
$route['admin/product-delete/(:any)']	= 'admin/AdminProducts/DeleteProduct/$1';
$route['delete/gallery/image/(:num)'] 	= "admin/AdminProducts/DeleteGalleryImage/$1";

$route['admin/category-listing']		= 'admin/AdminCategory';
$route['admin/category-listing/(:num)']		= 'admin/AdminCategory/index/$1';
$route['admin/sub-category-listing/(:any)']	= 'admin/AdminCategory/GetSubCategoryListing/$1';
$route['admin/create-category']			= 'admin/AdminCategory/CreateNewCategory';
$route['admin/update-category/(:any)']	= 'admin/AdminCategory/UpdateCategory/$1';
$route['admin/delete-category/(:any)']	= 'admin/AdminCategory/DeleteCategory/$1';


$route['admin/brand-listing']			= 'admin/AdminBrand';
$route['admin/brand-listing/(:num)']	= 'admin/AdminBrand/index/$1';
$route['admin/sub-brand-listing/(:any)']= 'admin/AdminBrand/GetSubBrandListing/$1';
$route['admin/create-brand']			= 'admin/AdminBrand/CreateNewBrand';
$route['admin/update-brand/(:any)']		= 'admin/AdminBrand/UpdateBrand/$1';
$route['admin/delete-brand/(:any)']		= 'admin/AdminBrand/DeleteBrand/$1';

/* $route['admin/create-subcategory']			= 'admin/AdminCategory/CreateNewSubCategory'; */


$route['admin/revslider'] = 'admin/Revslider';
$route['admin/create-revslide'] = 'admin/Revslider/AddSlide';
$route['admin/update-slide/(:num)'] = 'admin/Revslider/UpdateRevSlide/$1';
$route['admin/slide-delete/(:num)'] = 'admin/Revslider/DeleteRevSlide/$1';

$route['admin/pages'] = 'admin/AdminPage';
$route['admin/create-page'] = 'admin/AdminPage/AddNewpage';
$route['admin/update-page/(:num)'] = 'admin/AdminPage/UpdatePage/$1';
$route['admin/page-delete/(:num)'] = 'admin/AdminPage/DeletePage/$1';

$route['admin/social-connect'] = 'admin/SiteSettings/UpdateSocialLinkSetting';

$route['admin/site-option'] = 'admin/SiteSettings/Siteoption';

$route['admin/grid-option'] = 'admin/SiteSettings/Gridoption';

$route['admin/contact-info'] = 'admin/SiteSettings/ContactInfoOption';

$route['admin/outofstock-option'] = 'admin/SiteSettings/OutofStockProducts';


$route['admin/delivery'] = 'admin/Delivery';
$route['admin/assign/delivery'] = 'admin/Delivery/AssignDeliveryBoy';

$route['admin/order-listing'] = 'admin/AdminOrders';

$route['admin/request-cancel'] = 'admin/AdminOrders/AdminCancelOrders';

$route['admin/request-cancel-order-view/(:num)'] = 'admin/AdminOrders/GetSingleCancelOrder/$1';
$route['admin/paymentrefund-view/(:num)'] = 'admin/AdminPaymentRefund/PaypalRefund/$1';
$route['admin/paymentrefundforApp-view/(:num)'] = 'admin/AdminPaymentRefund/PaypalRefundForApp/$1';




$route['admin/order-view/(:num)'] = 'admin/AdminOrders/GetSingleOrder/$1';

$route['admin/app-slider'] = 'admin/AndroidAppSlider';
$route['admin/update-app-slide/(:num)'] = 'admin/AndroidAppSlider/UpdateAppSlide/$1';
/*Admin Section End */




$route['404_override'] = 'Pagenotfound/index';
$route['404'] = 'Pagenotfound/index';

$route['translate_uri_dashes'] 	= FALSE;

/***************** Frontend Start *******************/

$route['default_controller'] 	= 'Home';

$route['welcome']		= 'Welcome';
$route['fbAuth1']		= 'common/User_Authentication/index';
$route['fbAuth']		= 'common/FB_Authentication/index';
$route['fbAuth/logout']	= 'common/User_Authentication/logout';
$route['facebook-error/(:any)']	= 'Home';



$route['search/(:any)']		= 'frontend/Search/index/$1';

$route['facebooklogin'] 	= 'frontend/Auth/FacebookAuthentication';

$route['contact'] 	= 'frontend/Contactus/index';


$route['products'] 			= 'frontend/Products/index';
$route['product/(:any)'] 	= 'frontend/Products/SingleProduct/$1';

$route['account/profile']	= 'frontend/Userprofile';
$route['account/profile/edit']	= 'frontend/Userprofile/UpdateUserProfile';

$route['account/wishlist'] = 'frontend/WishlistProducts/index';
$route['account/my-orders'] = 'frontend/MyOrders/index';
$route['account/order-detail/(:any)'] = 'frontend/MyOrders/SingleOrderDetail/$1';


$route['delete/wishlist/product/(:num)'] = 'frontend/WishlistProducts/DeleteWishlistProduct/$1';

$route['reset-password/(:any)'] = 'frontend/Auth/ResetPassword/$1';


$route['cart'] 					= 'frontend/MainCart/index';
$route['cart/add'] 				= 'frontend/MainCart/addToCart';
$route['cart/update-cart'] 		= 'frontend/MainCart/updateCartVal';
$route['cart/remove/(:any)']	= 'frontend/MainCart/EmptyCurrentCart/$1';
$route['cart/error-outofstock']	= 'frontend/MainCart/index';
$route['checkout'] 				= 'frontend/Checkout/index';
$route['conformation/success'] 	= 'frontend/Checkout/Thanks';
$route['conformation/cancel']  = 'frontend/Checkout/Thanks';

$route['account/my-address/edit'] = 'frontend/Userprofile/UpdateUserAddress';

/*********************** Front end Ajax requests ***********************/
$route['request/addWishlist'] 		= 'common/Allajax/Wishlist';
$route['request/productfillter'] 	= 'common/Allajax/AjaxFilterProducts';

$route['request/ordercancel-request'] 	= 'common/Allajax/CancelOrderRequest';

$route['request/loadmore-products'] = 'common/Allajax/AjaxLoadMoreProducts';
$route['request/addtobuket'] 		= 'frontend/MainCart/addToCartByAjax';



/** For dyanmic pages only **/
$route['(:any)'] = 'frontend/FrontendInternalPages/index/$1';
/***************** Frontend End *******************/
