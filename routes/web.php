<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    auth()->logout();
    return redirect('/login');
});



Route::get('login', function () {
    auth()->logout();
    return redirect('/login');
});



  

Auth::routes();

Route::get('register/{emailid}/{pass}', 'AdminController@adminRegister')->name('admin.register');

Route::post('employee/register/{id}/{slug}', 'RegisterController@employeeRegister')->name('employee.register');
Route::post('pre-employee/register/{id}/{slug}', 'RegisterController@preEmployeeRegister')->name('preemployee.register');


Route::post('/user/send-otp', 'AjaxController@send_otp')->name('user.login.otp.send');
Route::post('/emp-user/send-otp', 'AjaxController@emp_send_otp')->name('empuser.login.otp.send');
Route::get('/user/login-with-otp', 'EmployeeController@login_with_otp')->name('user.login.otp');

Route::post('/admin/logout', 'AdminController@logout')->name('admin.logout');

Route::get('/admin/login/disable', 'AdminController@disable')->name('admin.disable')->middleware('is_admin');
Route::get('/admin/login/enable', 'AdminController@enable')->name('admin.enable')->middleware('is_admin');
Route::get('/call-center/login/disable', 'CallCenterController@disable')->name('call_center.disable')->middleware('is_admin');
Route::get('/call-center/login/enable', 'CallCenterController@enable')->name('call_center.enable')->middleware('is_admin');



Route::get('/admin/export', 'AjaxController@export')->name('mis.export');
Route::get('/call-center/export/{status}', 'AjaxController@export')->name('export');

Route::get('/export-status/{status}', 'AjaxController@exportWithStatus')->name('exportstatus');
Route::get('/export-type/{type}', 'AjaxController@exportWithType')->name('exporttype');
Route::get('/admin/export-dc-data/{id}', 'AjaxController@exportDc')->name('exportDC');


Route::get('/user/login/otp/{email}', 'EmployeeController@otp_login')->name('user.otp.login');
Route::get('/vendor/login', 'VendorController@login')->name('vendor.login');
Route::post('/vendor/login', 'Auth\LoginController@vendor_login')->name('vendor.login.post');
Route::post('/vendor/logout', 'VendorController@logout')->name('vendor.logout');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::get('registration/{id}/{slug}', 'RegisterController@index')->name('register');

Route::get('employment-registration/{id}/{slug}', 'RegisterController@employmentIndex')->name('employmentregister');





Route::get('admin/dashboard', 'AdminController@index')->name('admin.home')->middleware('is_admin');
Route::get('admin/learning-module-list', 'AdminController@AllModuleList')->name('admin.AllModuleList')->middleware('is_admin');
Route::get('admin/vendors-list', 'AdminController@getVendorsList')->name('admin.getVendorsList')->middleware('is_admin');

Route::get('admin/learning-partners-list', 'AdminController@LearningPartnerList')->name('admin.getVendorsList')->middleware('is_admin');




Route::get('/learning-partner/login', 'CompanyController@login')->name('company.login');
Route::post('/learning-partner/login', 'Auth\LoginController@hr_login')->name('company.login.post');
Route::post('/learning-partner/logout', 'CompanyController@logout')->name('company.logout');

Route::get('learning-partner/home', 'CompanyController@index')->name('hr.home')->middleware('company');
Route::get('learning-partner/update-profile', 'CompanyController@updateProfile')->name('hr.updateProfile')->middleware('company');
Route::post('learning-partner/update-profile-save', 'CompanyController@updateProfileSave')->name('hr.update.profile')->middleware('company');
Route::post('learning-partner/update-password', 'CompanyController@updatePassword')->name('hr.update.password')->middleware('company');

Route::get('learning-partner/employee-list', 'CompanyController@listEmployee')->name('hr.list.employee')->middleware('company');
Route::get('learning-partner/product-list', 'CompanyController@listProduct')->name('hr.list.product')->middleware('company');
Route::get('learning-partner/view-product/{slug}', 'CompanyController@viewProduct')->name('hr.view.product')->middleware('company');

Route::get('learning-partner/new-vendor', 'CompanyController@addVendor')->name('hr.new.vendor')->middleware('company');
Route::get('learning-partner/vendor-list', 'CompanyController@listVendor')->name('hr.list.vendor')->middleware('company');
Route::post('learning-partner/save-vendor', 'CompanyController@saveVendor')->name('hr.save.vendor')->middleware('company');
Route::get('learning-partner/edit-vendor/{slug}', 'CompanyController@editVendor')->name('hr.edit.vendor')->middleware('company');
Route::get('learning-partner/show-vendor/{slug}', 'CompanyController@showVendorDetails')->name('hr.show.vendor')->middleware('company');
Route::get('learning-partner/delete-vendor/{slug}', 'CompanyController@deleteVendor')->name('hr.delete.vendor')->middleware('company');
Route::post('learning-partner/update-vendor/{slug}', 'CompanyController@updateVendor')->name('hr.update.vendor')->middleware('company');
Route::get('learning-partner/view-vendor/{slug}', 'CompanyController@viewVendor')->name('hr.view.vendor')->middleware('company');
Route::get('learning-partner/update-vendor-status/{id}/{status}', 'CompanyController@updateVendorStatus')->name('hr.status.vendor');



Route::get('admin/update-profile', 'AdminController@updateProfile')->name('admin.updateProfile')->middleware('is_admin');
Route::post('admin/update-profile-save', 'AdminController@updateProfileSave')->name('admin.update.profile')->middleware('is_admin');
Route::post('admin/update-password', 'AdminController@updatePassword')->name('admin.update.password')->middleware('is_admin');
Route::post('feedback', 'AdminController@saveFeedback')->name('admin.save.feedback')->middleware('is_admin');

Route::get('admin/new-learning-partner', 'AdminController@addCompany')->name('admin.new.company')->middleware('is_admin');
Route::get('admin/learning-partner-list', 'AdminController@listCompany')->name('admin.list.company')->middleware('is_admin');
Route::post('admin/save-learning-partner', 'AdminController@saveCompany')->name('admin.save.company')->middleware('is_admin');
Route::get('admin/edit-learning-partner/{slug}', 'AdminController@editCompany')->name('admin.edit.company')->middleware('is_admin');
Route::get('admin/delete-learning-partner/{slug}', 'AdminController@deleteCompany')->name('admin.delete.company')->middleware('is_admin');
Route::post('admin/update-learning-partner/{slug}', 'AdminController@updateCompany')->name('admin.update.company')->middleware('is_admin');
Route::get('admin/view-learning-partner/{slug}', 'AdminController@viewCompany')->name('admin.view.company')->middleware('is_admin');


Route::get('admin/new-learning-module', 'AdminController@addLearningModule')->name('admin.new.learning')->middleware('is_admin');
Route::get('admin/learning-module', 'AdminController@listLearningModule')->name('admin.list.learning')->middleware('is_admin');
Route::post('admin/learning-module', 'AdminController@saveLearningModule')->name('admin.save.learning')->middleware('is_admin');
Route::get('admin/edit-learning-module/{slug}', 'AdminController@editLearningModule')->name('admin.edit.learning')->middleware('is_admin');
Route::get('admin/delete-learning-module/{slug}', 'AdminController@deleteLearningModule')->name('admin.delete.learning')->middleware('is_admin');
Route::post('admin/update-learning-module/{slug}', 'AdminController@updateLearningModule')->name('admin.update.learning')->middleware('is_admin');
Route::get('admin/view-learning-module/{slug}', 'AdminController@viewLearningModule')->name('admin.view.learning')->middleware('is_admin');

Route::post('ajaxRequest/pdf', 'AdminController@addMorePdfSection')->name('ajaxRequest.addMorePdfSection');
Route::post('ajaxRequest/pdt', 'AdminController@addMorePptSection')->name('ajaxRequest.addMorePptSection');
Route::post('ajaxRequest/doc', 'AdminController@addMoreDocSection')->name('ajaxRequest.addMoreDocSection');
Route::post('ajaxRequest/video', 'AdminController@addMoreVideoSection')->name('ajaxRequest.addMoreVideoSection');
Route::post('ajaxRequest/question', 'AdminController@addMoreQuestionSection')->name('ajaxRequest.addMoreQuestionSection');



Route::get('admin/new-coupon', 'AdminController@addCoupon')->name('admin.new.coupon')->middleware('is_admin');
Route::post('admin/save-coupon', 'AdminController@saveCoupon')->name('admin.save.coupon')->middleware('is_admin');
Route::get('admin/edit-coupon/{slug}', 'AdminController@editCoupon')->name('admin.edit.coupon')->middleware('is_admin');
Route::get('admin/delete-coupon/{slug}', 'AdminController@deleteCoupon')->name('admin.delete.coupon')->middleware('is_admin');
Route::post('admin/update-coupon/{slug}', 'AdminController@updateCoupon')->name('admin.update.coupon')->middleware('is_admin');
Route::get('admin/update-coupon-status/{id}/{status}', 'AdminController@updateCouponStatus')->name('admin.status.coupon');

Route::get('admin/update-company-status/{id}/{status}', 'AdminController@updateCompanyStatus')->name('admin.status.company');

Route::get('admin/new-employee', 'AdminController@addEmployee')->name('admin.new.employee')->middleware('is_admin');
Route::post('admin/save-employee', 'AdminController@saveEmployee')->name('admin.save.employee')->middleware('is_admin');
Route::get('admin/edit-employee/{slug}', 'AdminController@editEmployee')->name('admin.edit.employee')->middleware('is_admin');
Route::get('admin/delete-employee/{slug}', 'AdminController@deleteEmployee')->name('admin.delete.employee')->middleware('is_admin');
Route::post('admin/update-employee/{slug}', 'AdminController@updateEmployee')->name('admin.update.employee');
Route::post('admin/update-user/{id}', 'AdminController@deleteUser')->name('admin.delete.user');
Route::get('admin/update-employee-status/{id}/{status}', 'AdminController@updateEmployeeStatus')->name('admin.status.employee');
Route::get('admin/view-employee-sheet/{slug}', 'AdminController@viewEmployee')->name('admin.view.employee')->middleware('is_admin');


Route::get('admin/new-product', 'AdminController@addProduct')->name('admin.new.product')->middleware('is_admin');
Route::get('admin/product-list', 'AdminController@listProduct')->name('admin.list.product')->middleware('is_admin');
Route::post('admin/save-product', 'AdminController@saveProduct')->name('admin.save.product')->middleware('is_admin');
Route::get('admin/edit-product/{slug}', 'AdminController@editProduct')->name('admin.edit.product')->middleware('is_admin');
Route::get('admin/delete-product/{slug}', 'AdminController@deleteProduct')->name('admin.delete.product')->middleware('is_admin');
Route::post('admin/update-product/{slug}', 'AdminController@updateProduct')->name('admin.update.product')->middleware('is_admin');
Route::get('admin/view-product', 'AdminController@viewProduct')->name('admin.view.product')->middleware('is_admin');
Route::post('admin/save-product-data', 'AdminController@saveProductBlukdata')->name('admin.save.blukproduct')->middleware('is_admin');

Route::post('admin/update-product-status', 'AdminController@updateProductStatus')->name('admin.status.product')->middleware('is_admin');






Route::get('admin/employee-list', 'AdminController@listEmployee')->name('admin.list.employee')->middleware('is_admin');
Route::get('admin/analytics', 'AdminController@listAnalytics')->name('admin.list.analytics')->middleware('is_admin');
Route::get('admin/mis', 'AdminController@listMis')->name('admin.list.mis')->middleware('is_admin');


Route::get('admin/new-assign-product', 'AdminController@addAssignProduct')->name('admin.new.assignproduct')->middleware('is_admin');
Route::get('admin/assign-product-list', 'AdminController@listAssignProduct')->name('admin.list.assignproduct')->middleware('is_admin');
Route::post('admin/save-assign-product', 'AdminController@saveAssignProduct')->name('admin.save.assignproduct')->middleware('is_admin');
Route::get('admin/edit-assign-product/{id}', 'AdminController@editAssignProduct')->name('admin.edit.assignproduct')->middleware('is_admin');
Route::get('admin/delete-assign-product/{id}', 'AdminController@deleteAssignProduct')->name('admin.delete.assignproduct')->middleware('is_admin');
Route::post('admin/update-assign-product/{id}', 'AdminController@updateAssignProduct')->name('admin.update.assignproduct')->middleware('is_admin');

Route::get('admin/daily-status', 'AdminController@addDailyStatus')->name('admin.new.status')->middleware('is_admin');

Route::post('admin/save-daily-status', 'AdminController@saveDailyStatus')->name('admin.save.status')->middleware('is_admin');
Route::get('admin/daily-sheet', 'AdminController@dailySheet')->name('admin.new.sheet')->middleware('is_admin');


Route::get('vendor/dashboard', 'VendorController@index')->name('vendor.home')->middleware('Vendor');

Route::get('vendor/employee-list', 'VendorController@listEmployee')->name('vendor.list.employee')->middleware('Vendor');
Route::get('vendor/product-list', 'VendorController@listProduct')->name('vendor.list.product')->middleware('Vendor');

Route::get('vendor/user-details/{slug}', 'VendorController@viewUserDetails')->name('vendor.user.details')->middleware('Vendor');

Route::get('vendor/update-profile', 'VendorController@updateProfile')->name('vendor.update.profile')->middleware('Vendor');

Route::post('vendor/update-profile-save', 'VendorController@updateProfileSave')->name('vendor.save.profile')->middleware('Vendor');

Route::post('vendor/update-password', 'VendorController@updatePassword')->name('vendor.update.password')->middleware('Vendor');





Route::get('vendor/view-product/{slug}', 'VendorController@viewProduct')->name('vendor.view.product')->middleware('Vendor');


Route::get('user/update-profile', 'EmployeeController@updateProfile')->name('employee.updateProfile')->middleware('employees');
Route::post('user/update-profile-save', 'EmployeeController@updateProfileSave')->name('employee.update.profile')->middleware('employees');
Route::post('user/update-password', 'EmployeeController@updatePassword')->name('employee.update.password')->middleware('employees');


Route::get('user/daily-status', 'EmployeeController@addDailyStatus')->name('user.new.status')->middleware('employees');
Route::post('user/save-daily-status', 'EmployeeController@saveDailyStatus')->name('employee.save.status')->middleware('employees');

Route::post('view-project-detail', 'EmployeeController@projectDetail')->name('ajaxRequest.details.project');
Route::post('get-product-price', 'AdminController@getProductPrice')->name('ajaxRequest.getProductPrice');
