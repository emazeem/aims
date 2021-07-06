<?php
use Illuminate\Support\Facades\Route;
Route::get('optimize', function () {
    \Artisan::call('optimize');
    dd("Done");
});
Auth::routes();

Route::get('/home', function (){return redirect('/');})->middleware('auth');
Route::get('/', [App\Http\Controllers\DashboardControlller::class, 'index'])->middleware('auth')->name('home');
Route::post('/get-location', [App\Http\Controllers\DashboardControlller::class, 'get_location'])->middleware('auth')->name('dashboard.get.location');
Route::get('notifications', [App\Http\Controllers\DashboardControlller::class, 'notification'])->middleware('auth')->name('notification');
Route::get('notification/markasread/{id}', [App\Http\Controllers\DashboardControlller::class, 'markread'])->middleware('auth')->name('notification.markasread');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::get('/change_password', [App\Http\Controllers\UserController::class, 'changepw'])->middleware('auth')->name('change-pw');
Route::post('/change_password', [App\Http\Controllers\UserController::class, 'changepassword'])->middleware('auth')->name('change-password');
Route::post('/set_profile', [App\Http\Controllers\UserController::class, 'setprofile'])->middleware('auth')->name('setprofile');
Route::post('/get_attendance', [App\Http\Controllers\DashboardControlller::class, 'get_attendance'])->middleware('auth')->name('dashboard.get.attendance');

Route::get('/quote',function (){return view('docs.quotation');});
Route::get('/jobtag',function (){return view('docs.jobtag');});
Route::get('/certificate',function (){return view('worksheets.certificate');});
Route::get('/material_indent',function (){return view('docs.material_indent');});
Route::get('/jobform',function (){return view('docs.jobform');});
Route::get('/worksheet',function (){return view('worksheets.worksheets');});
Route::get('/invoice',function (){return view('docs.invoice');});
Route::get('/uncertainty',function (){return view('docs.uncertainty');});
Route::get('/review',function (){return view('docs.contractreview');});
Route::get('/gate-pass',function (){return view('docs.gatepass');});
Route::get('/calibration-sticker',function (){return view('docs.calibration_sticker');});
Route::get('/deliverynote',function (){return view('docs.deliverynote');});
Route::get('/pra',function (){ $entries=\App\Models\InvoicingLedger::all()->where('service_tax_type',2); return view('docs.pra',compact('entries'));})->name('pra');
Route::get('/masterlistofequipments',function (){ $assets=\App\Models\Asset::all(); return view('docs.masterlistofequipments',compact('assets'));});

Route::group(['prefix'=> 'customers'],function() {
    Route::get('',[App\Http\Controllers\CustomerController::class, 'index'])->middleware('auth')->name('customers');
    Route::get('/create',[App\Http\Controllers\CustomerController::class, 'create'])->middleware('auth')->name('customers.create');
    Route::post('show',[App\Http\Controllers\CustomerController::class, 'show'])->middleware('auth')->name('customers.show');
    Route::post('/edit',[App\Http\Controllers\CustomerController::class, 'edit'])->middleware('auth')->name('customers.edit');
    Route::post('/update/{id}',[App\Http\Controllers\CustomerController::class, 'update'])->middleware('auth')->name('customers.update');
    Route::post('',[App\Http\Controllers\CustomerController::class, 'fetch'])->middleware('auth')->name('customers.fetch');
    Route::post('/store',[App\Http\Controllers\CustomerController::class, 'store'])->middleware('auth')->name('customers.store');
    Route::delete('delete',[App\Http\Controllers\CustomerController::class, 'destroy'])->middleware('auth')->name('customers.destroy');
});
Route::group(['prefix'=> 'customers_contact'],function() {
    Route::post('store',[App\Http\Controllers\CustomerContactController::class, 'store'])->middleware('auth')->name('customers.contact.store');
    Route::delete('delete',[App\Http\Controllers\CustomerContactController::class, 'destroy'])->middleware('auth')->name('customers.contact.destroy');
});

Route::group(['prefix'=> 'purchase-order'],function() {
    Route::get('',[App\Http\Controllers\PoController::class, 'index'])->middleware('auth')->name('po');
    Route::get('/create/{id}',[App\Http\Controllers\PoController::class, 'create'])->middleware('auth')->name('po.create');
    Route::get('/print/{id}',[App\Http\Controllers\PoController::class, 'prints'])->middleware('auth')->name('po.prints');
    Route::get('/show/{id}',[App\Http\Controllers\PoController::class, 'show'])->middleware('auth')->name('po.show');
    Route::post('/edit',[App\Http\Controllers\PoController::class, 'edit'])->middleware('auth')->name('po.edit');
    Route::post('',[App\Http\Controllers\PoController::class, 'fetch'])->middleware('auth')->name('po.fetch');
    Route::post('/store',[App\Http\Controllers\PoController::class, 'store'])->middleware('auth')->name('po.store');
    Route::delete('delete',[App\Http\Controllers\PoController::class, 'destroy'])->middleware('auth')->name('po.destroy');
});
Route::group(['prefix'=> 'purchase-order-items'],function() {
    Route::post('/store',[App\Http\Controllers\PoDetailsController::class, 'store'])->middleware('auth')->name('po.items.store');

});

Route::group(['prefix'=> 'vendor'],function() {
    Route::get('',[App\Http\Controllers\VendorsController::class, 'index'])->middleware('auth')->name('vendors');
    Route::get('/create',[App\Http\Controllers\VendorsController::class, 'create'])->middleware('auth')->name('vendors.create');
    Route::get('/show/{id}',[App\Http\Controllers\VendorsController::class, 'show'])->middleware('auth')->name('vendors.show');
    Route::get('/edit/{id}',[App\Http\Controllers\VendorsController::class, 'edit'])->middleware('auth')->name('vendors.edit');
    Route::post('/update',[App\Http\Controllers\VendorsController::class, 'update'])->middleware('auth')->name('vendors.update');
    Route::post('',[App\Http\Controllers\VendorsController::class, 'fetch'])->middleware('auth')->name('vendors.fetch');
    Route::post('/store',[App\Http\Controllers\VendorsController::class, 'store'])->middleware('auth')->name('vendors.store');
    Route::delete('delete',[App\Http\Controllers\VendorsController::class, 'destroy'])->middleware('auth')->name('vendors.destroy');
});
Route::group(['prefix'=> 'scopeofsupply'],function() {
    Route::post('/store',[App\Http\Controllers\ScopeOfSupplyController::class, 'store'])->middleware('auth')->name('scope.of.supply.store');
});
Route::group(['prefix'=> 'purchase/vendor'],function() {
    Route::post('/send-to-tm',[App\Http\Controllers\PurchaseVendorController::class, 'send_to_tm'])->middleware('auth')->name('purchase.vendor.send.to.tm');
    Route::post('/prioritized',[App\Http\Controllers\PurchaseVendorController::class, 'prioritized'])->middleware('auth')->name('purchase.vendor.prioritized');
    Route::post('/selected_vendor',[App\Http\Controllers\PurchaseVendorController::class, 'selected_vendor'])->middleware('auth')->name('purchase.vendor.selected.vendor');
    Route::post('/set_priority',[App\Http\Controllers\PurchaseVendorController::class, 'set_priority'])->middleware('auth')->name('purchase.vendor.set.priority');
    Route::post('/store',[App\Http\Controllers\PurchaseVendorController::class, 'store'])->middleware('auth')->name('purchase.vendor.store');
});
Route::group(['prefix'=> 'users'],function() {
    Route::get('',[App\Http\Controllers\UserController::class, 'index'])->middleware('auth')->name('users');
    Route::get('/attendances',[App\Http\Controllers\UserController::class, 'attendances'])->middleware('auth')->name('users.attendances');
    Route::get('/create',[App\Http\Controllers\UserController::class, 'create'])->middleware('auth')->name('users.create');
    Route::get('/view/{id}',[App\Http\Controllers\UserController::class, 'show'])->middleware('auth')->name('users.show');
    Route::get('/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->middleware('auth')->name('users.edit');
    Route::post('/update',[App\Http\Controllers\UserController::class, 'update'])->middleware('auth')->name('users.update');
    Route::post('',[App\Http\Controllers\UserController::class, 'fetch'])->middleware('auth')->name('users.fetch');
    Route::post('/store',[App\Http\Controllers\UserController::class, 'store'])->middleware('auth')->name('users.store');
    Route::get('/fetch/designation/{id}',[App\Http\Controllers\UserController::class, 'fetchDesignation'])->middleware('auth')->name('users.fetch.designation');
    Route::get('/list/of/employment',[App\Http\Controllers\UserController::class, 'list_of_employees'])->middleware('auth')->name('users.list.of.employees');
});
Route::group(['prefix'=> 'user_vs_parameter'],function() {
    Route::post('store',[App\Http\Controllers\ParameterAuthorizationController::class, 'store'])->middleware('auth')->name('authorization.store');
    Route::delete('delete',[App\Http\Controllers\ParameterAuthorizationController::class, 'delete'])->middleware('auth')->name('authorization.destroy');
});
Route::group(['prefix'=> 'quote-attachments'],function() {
    Route::post('store',[App\Http\Controllers\QuotesAttachmentsController::class, 'store'])->middleware('auth')->name('quotes.attachments.store');
    Route::delete('delete',[App\Http\Controllers\QuotesAttachmentsController::class, 'delete'])->middleware('auth')->name('quotes.attachments.destroy');
});


Route::group(['prefix'=> 'capabilities'],function() {

    Route::get('',[App\Http\Controllers\CapabilitiesController::class, 'index'])->middleware('auth')->name('capabilities');
    Route::post('',[App\Http\Controllers\CapabilitiesController::class, 'fetch'])->middleware('auth')->name('capabilities.fetch');
    Route::get('/create',[App\Http\Controllers\CapabilitiesController::class, 'create'])->middleware('auth')->name('capabilities.create');
    Route::post('/store',[App\Http\Controllers\CapabilitiesController::class, 'store'])->middleware('auth')->name('capabilities.store');
    Route::post('/edit',[App\Http\Controllers\CapabilitiesController::class, 'edit'])->middleware('auth')->name('capabilities.edit');
    Route::post('/update/',[App\Http\Controllers\CapabilitiesController::class, 'update'])->middleware('auth')->name('capabilities.update');
    Route::delete('/delete',[App\Http\Controllers\CapabilitiesController::class, 'delete'])->middleware('auth')->name('capabilities.delete');
    Route::get('/view/{id}',[App\Http\Controllers\CapabilitiesController::class, 'show'])->middleware('auth')->name('capabilities.show');
    Route::get('/print',[App\Http\Controllers\CapabilitiesController::class, 'prints'])->middleware('auth')->name('capabilities.print');
    Route::get('/respective-assets/{id}',[App\Http\Controllers\CapabilitiesController::class, 'respectiveassets'])->middleware('auth')->name('capabilities.respectiveassets');

});
Route::group(['prefix'=> 'grouped-capabilities'],function() {
    Route::get('',[App\Http\Controllers\GroupedCapabilitiesController::class, 'index'])->middleware('auth')->name('grouped.capabilities');
    Route::get('create/{id?}',[App\Http\Controllers\GroupedCapabilitiesController::class, 'create'])->middleware('auth')->name('grouped.capabilities.create');
    Route::get('edit/{id}',[App\Http\Controllers\GroupedCapabilitiesController::class, 'edit'])->middleware('auth')->name('grouped.capabilities.edit');
    Route::post('store',[App\Http\Controllers\GroupedCapabilitiesController::class, 'store'])->middleware('auth')->name('grouped.capabilities.store');
    Route::post('update',[App\Http\Controllers\GroupedCapabilitiesController::class, 'update'])->middleware('auth')->name('grouped.capabilities.update');
    Route::post('',[App\Http\Controllers\GroupedCapabilitiesController::class, 'fetch'])->middleware('auth')->name('grouped.capabilities.fetch');
    Route::delete('/delete',[App\Http\Controllers\GroupedCapabilitiesController::class, 'delete'])->middleware('auth')->name('grouped.capabilities.delete');
});

Route::group(['prefix'=> 'asset'],function() {
    Route::group(['prefix'=> 'intermediate-checks'],function() {
        Route::get('/create/{asset}',[App\Http\Controllers\IntermediatechecksofassetController::class, 'create'])->middleware('auth')->name('intermediate-checks.create');
        Route::get('/edit/{asset}',[App\Http\Controllers\IntermediatechecksofassetController::class, 'edit'])->middleware('auth')->name('intermediate-checks.edit');
        Route::post('/store',[App\Http\Controllers\IntermediatechecksofassetController::class, 'store'])->middleware('auth')->name('intermediate-checks.store');
        Route::post('/update',[App\Http\Controllers\IntermediatechecksofassetController::class, 'update'])->middleware('auth')->name('intermediate-checks.update');
    });
    Route::get('',[App\Http\Controllers\AssetController::class, 'index'])->middleware('auth')->name('assets');
    Route::post('',[App\Http\Controllers\AssetController::class, 'fetch'])->middleware('auth')->name('assets.fetch');
    Route::get('/create',[App\Http\Controllers\AssetController::class, 'create'])->middleware('auth')->name('assets.create');
    Route::post('/store',[App\Http\Controllers\AssetController::class, 'store'])->middleware('auth')->name('assets.store');
    Route::get('/edit/{id}',[App\Http\Controllers\AssetController::class, 'edit'])->middleware('auth')->name('assets.edit');
    Route::post('/update/{id}',[App\Http\Controllers\AssetController::class, 'update'])->middleware('auth')->name('assets.update');
    Route::get('/show/{id}',[App\Http\Controllers\AssetController::class, 'show'])->middleware('auth')->name('assets.show');
    Route::delete('delete',[App\Http\Controllers\AssetController::class, 'destroy'])->middleware('auth')->name('assets.destroy');
});
Route::group(['prefix'=> 'asset/groups'],function() {
    Route::get('',[App\Http\Controllers\AssetgroupController::class, 'index'])->middleware('auth')->name('assets.groups');
    Route::get('/create',[App\Http\Controllers\AssetgroupController::class, 'create'])->middleware('auth')->name('assets.groups.create');
    Route::get('/edit/{id}',[App\Http\Controllers\AssetgroupController::class, 'edit'])->middleware('auth')->name('assets.groups.edit');
    Route::get('/show/{id}',[App\Http\Controllers\AssetgroupController::class, 'show'])->middleware('auth')->name('assets.groups.show');
    Route::post('/update',[App\Http\Controllers\AssetgroupController::class, 'update'])->middleware('auth')->name('assets.groups.update');
    Route::post('',[App\Http\Controllers\AssetgroupController::class, 'fetch'])->middleware('auth')->name('assets.groups.fetch');
    Route::post('store',[App\Http\Controllers\AssetgroupController::class, 'store'])->middleware('auth')->name('assets.groups.store');
});
Route::group(['prefix'=> 'preventive/checklist'],function() {
    Route::post('store',[App\Http\Controllers\PreventivechecklistController::class, 'store'])->middleware('auth')->name('preventive.checklist.store');
    Route::post('update',[App\Http\Controllers\PreventivechecklistController::class, 'update'])->middleware('auth')->name('preventive.checklist.update');
    Route::post('edit',[App\Http\Controllers\PreventivechecklistController::class, 'edit'])->middleware('auth')->name('preventive.checklist.edit');
});
Route::group(['prefix'=> 'preventive/maintenance'],function() {
    Route::get('create/{id}',[App\Http\Controllers\PreventivemaintenancerecordsController::class, 'create'])->middleware('auth')->name('preventive.maintenance.create');
    Route::get('edit/{id}',[App\Http\Controllers\PreventivemaintenancerecordsController::class, 'edit'])->middleware('auth')->name('preventive.maintenance.edit');
    Route::post('store',[App\Http\Controllers\PreventivemaintenancerecordsController::class, 'store'])->middleware('auth')->name('preventive.maintenance.store');
    Route::post('update',[App\Http\Controllers\PreventivemaintenancerecordsController::class, 'update'])->middleware('auth')->name('preventive.maintenance.update');
});


Route::group(['prefix'=> 'parameters'],function() {
    Route::get('',[App\Http\Controllers\ParameterControlller::class, 'index'])->middleware('auth')->name('parameters');
    Route::post('',[App\Http\Controllers\ParameterControlller::class, 'fetch'])->middleware('auth')->name('parameters.fetch');
    Route::post('/store',[App\Http\Controllers\ParameterControlller::class, 'store'])->middleware('auth')->name('parameters.store');
    Route::post('/edit',[App\Http\Controllers\ParameterControlller::class, 'edit'])->middleware('auth')->name('parameters.edit');
    Route::post('/update',[App\Http\Controllers\ParameterControlller::class, 'update'])->middleware('auth')->name('parameters.update');
    Route::delete('/delete',[App\Http\Controllers\ParameterControlller::class, 'destroy'])->middleware('auth')->name('parameters.destroy');
    Route::post('/view_assets',[App\Http\Controllers\ParameterControlller::class, 'view_assets'])->middleware('auth')->name('parameters.view_assets');
    Route::post('/view_units',[App\Http\Controllers\ParameterControlller::class, 'view_units'])->middleware('auth')->name('parameters.view_units');
    Route::post('/view_capabilities',[App\Http\Controllers\ParameterControlller::class, 'view_capabilities'])->middleware('auth')->name('parameters.view_capabilities');
});
Route::group(['prefix'=> 'departments'],function() {
    Route::get('',[App\Http\Controllers\DepartmentController::class, 'index'])->middleware('auth')->name('departments');
    Route::post('',[App\Http\Controllers\DepartmentController::class, 'fetch'])->middleware('auth')->name('departments.fetch');
    Route::post('/store',[App\Http\Controllers\DepartmentController::class, 'store'])->middleware('auth')->name('departments.store');
    Route::post('/edit',[App\Http\Controllers\DepartmentController::class, 'edit'])->middleware('auth')->name('departments.edit');
    Route::post('/update',[App\Http\Controllers\DepartmentController::class, 'update'])->middleware('auth')->name('departments.update');
});
Route::group(['prefix'=> 'business-lines'],function() {
    Route::get('',[App\Http\Controllers\BusinessLineController::class, 'index'])->middleware('auth')->name('business.line');
    Route::post('',[App\Http\Controllers\BusinessLineController::class, 'fetch'])->middleware('auth')->name('business.line.fetch');
    Route::post('/store',[App\Http\Controllers\BusinessLineController::class, 'store'])->middleware('auth')->name('business.line.store');
    Route::post('/edit',[App\Http\Controllers\BusinessLineController::class, 'edit'])->middleware('auth')->name('business.line.edit');
    Route::post('/update',[App\Http\Controllers\BusinessLineController::class, 'update'])->middleware('auth')->name('business.line.update');
});

Route::group(['prefix'=> 'designations'],function() {
    Route::get('',[App\Http\Controllers\DesignationController::class, 'index'])->middleware('auth')->name('designations');
    Route::post('',[App\Http\Controllers\DesignationController::class, 'fetch'])->middleware('auth')->name('designations.fetch');
    Route::post('/store',[App\Http\Controllers\DesignationController::class, 'store'])->middleware('auth')->name('designations.store');
    Route::post('/edit',[App\Http\Controllers\DesignationController::class, 'edit'])->middleware('auth')->name('designations.edit');
    Route::post('/update',[App\Http\Controllers\DesignationController::class, 'update'])->middleware('auth')->name('designations.update');
});
Route::group(['prefix'=> 'log-reviews'],function() {
    Route::get('',[App\Http\Controllers\LogReviewController::class, 'index'])->middleware('auth')->name('log_reviews');
    Route::post('',[App\Http\Controllers\LogReviewController::class, 'fetch'])->middleware('auth')->name('log_reviews.fetch');
    Route::post('/store',[App\Http\Controllers\LogReviewController::class, 'store'])->middleware('auth')->name('log_reviews.store');
    Route::post('/edit',[App\Http\Controllers\LogReviewController::class, 'edit'])->middleware('auth')->name('log_reviews.edit');
    Route::post('/update',[App\Http\Controllers\LogReviewController::class, 'update'])->middleware('auth')->name('log_reviews.update');
    Route::get('/show/{id}',[App\Http\Controllers\LogReviewController::class, 'show'])->middleware('auth')->name('log_reviews.show');
    Route::delete('/delete',[App\Http\Controllers\LogReviewController::class, 'destroy'])->middleware('auth')->name('log_reviews.delete');
    Route::post('start',[App\Http\Controllers\LogReviewController::class, 'start'])->middleware('auth')->name('log_reviews.start');
    Route::post('end',[App\Http\Controllers\LogReviewController::class, 'end'])->middleware('auth')->name('log_reviews.end');
});

Route::group(['prefix'=> 'menus'],function() {
    Route::get('',[App\Http\Controllers\MenuController::class, 'index'])->middleware('auth')->name('menus');
    Route::post('',[App\Http\Controllers\MenuController::class, 'fetch'])->middleware('auth')->name('menus.fetch');
    Route::post('/store',[App\Http\Controllers\MenuController::class, 'store'])->middleware('auth')->name('menus.store');
    Route::post('/edit',[App\Http\Controllers\MenuController::class, 'edit'])->middleware('auth')->name('menus.edit');
    Route::delete('/delete',[App\Http\Controllers\MenuController::class, 'destroy'])->middleware('auth')->name('menus.destroy');
    Route::post('/update',[App\Http\Controllers\MenuController::class, 'update'])->middleware('auth')->name('menus.update');

    Route::get('/manage',[App\Http\Controllers\MenuController::class, 'manage'])->middleware('auth')->name('menus.manage');
    Route::post('/store_position',[App\Http\Controllers\MenuController::class, 'store_position'])->middleware('auth')->name('menus.store_position');
    Route::post('/remove_position',[App\Http\Controllers\MenuController::class, 'remove_position'])->middleware('auth')->name('menus.remove_position');
});
Route::group(['prefix'=> 'roles'],function() {
    Route::get('',[App\Http\Controllers\RoleController::class, 'index'])->middleware('auth')->name('roles');
    Route::get('/create',[App\Http\Controllers\RoleController::class, 'create'])->middleware('auth')->name('roles.create');
    Route::get('/edit/{id}',[App\Http\Controllers\RoleController::class, 'edit'])->middleware('auth')->name('roles.edit');
    Route::post('',[App\Http\Controllers\RoleController::class, 'fetch'])->middleware('auth')->name('roles.fetch');
    Route::delete('/delete',[App\Http\Controllers\RoleController::class, 'destroy'])->middleware('auth')->name('roles.delete');
    Route::post('/store',[App\Http\Controllers\RoleController::class, 'store'])->middleware('auth')->name('roles.store');
    Route::post('/update',[App\Http\Controllers\RoleController::class, 'update'])->middleware('auth')->name('roles.update');
});
Route::get('/print_rf/{id}',[App\Http\Controllers\QuotesController::class, 'print_rf'])->middleware('auth')->name('quotes.print_rf');
Route::group(['prefix'=> 'quotes'],function() {
    Route::get('',[App\Http\Controllers\QuotesController::class, 'index'])->middleware('auth')->name('quotes');
    Route::post('',[App\Http\Controllers\QuotesController::class, 'fetch'])->middleware('auth')->name('quotes.fetch');
    Route::post('/store',[App\Http\Controllers\QuotesController::class, 'store'])->middleware('auth')->name('quotes.store');
    Route::post('/edit',[App\Http\Controllers\QuotesController::class, 'edit'])->middleware('auth')->name('quotes.edit');
    Route::post('/update',[App\Http\Controllers\QuotesController::class, 'update'])->middleware('auth')->name('quotes.update');
    Route::get('/view/{id}',[App\Http\Controllers\QuotesController::class, 'show'])->middleware('auth')->name('quotes.show');
    //Route::post('/sendtocustomer/{id}',[App\Http\Controllers\QuotesController::class, 'sendtocustomer'])->middleware('auth')->name('quotes.sendtocustomer');
    //Route::post('/sendtocustomer/{id}',[App\Http\Controllers\QuotesController::class, 'sendtocustomer'])->name('sessions.sendtocustomer');
    //Route::post('/addprintdetails',[App\Http\Controllers\QuotesController::class, 'addprintdetails'])->middleware('auth')->name('quotes.addprintdetails');
    //Route::post('/getprintdetails',[App\Http\Controllers\QuotesController::class, 'getprintdetails'])->middleware('auth')->name('quotes.getprintdetails');
    //Route::get('/sendmail/{id}',[App\Http\Controllers\QuotesController::class, 'sendmail'])->middleware('auth')->name('quotes.sendmail');
    Route::get('/print/{id}',[App\Http\Controllers\QuotesController::class, 'prints'])->middleware('auth')->name('quotes.print');
    Route::get('/print_rf/{id}',[App\Http\Controllers\QuotesController::class, 'print_review_form'])->middleware('auth')->name('quotes.print_review_form');
    Route::get('get_principal/{id}',[App\Http\Controllers\QuotesController::class, 'get_principal'])->middleware('auth')->name('quotes.get_principal');
    Route::post('/complete/',[App\Http\Controllers\QuotesController::class, 'complete'])->middleware('auth')->name('quotes.complete');
    Route::post('/sendtocustomer/',[App\Http\Controllers\QuotesController::class, 'sendtocustomer'])->middleware('auth')->name('quotes.sendtocustomer');
    Route::post('/approved/{id}',[App\Http\Controllers\QuotesController::class, 'approved'])->middleware('auth')->name('quotes.approved');
    Route::post('/revised/{id}',[App\Http\Controllers\QuotesController::class, 'revised'])->middleware('auth')->name('quotes.revised');
    Route::post('/purchase_details',[App\Http\Controllers\QuotesController::class, 'purchase_details'])->middleware('auth')->name('quotes.purchase_details');
    Route::post('/approval_details',[App\Http\Controllers\QuotesController::class, 'approval_details'])->middleware('auth')->name('quotes.approval_details');
    Route::post('/remarks',[App\Http\Controllers\QuotesController::class, 'remarks'])->middleware('auth')->name('quotes.remarks');
    Route::post('/discount',[App\Http\Controllers\QuotesController::class, 'discount'])->middleware('auth')->name('quotes.discount');
    Route::delete('/destroy',[App\Http\Controllers\QuotesController::class, 'destroy'])->middleware('auth')->name('quotes.destroy');
});
Route::group(['prefix'=> 'generate-requests'],function() {
    Route::get('',[App\Http\Controllers\GenerateRequestsController::class, 'index'])->middleware('auth')->name('generaterequests');
    Route::post('',[App\Http\Controllers\GenerateRequestsController::class, 'fetch'])->middleware('auth')->name('generaterequests.fetch');
    Route::post('/store',[App\Http\Controllers\GenerateRequestsController::class, 'store'])->middleware('auth')->name('generaterequests.store');
    Route::post('/edit',[App\Http\Controllers\GenerateRequestsController::class, 'edit'])->middleware('auth')->name('generaterequests.edit');
    Route::post('/update',[App\Http\Controllers\GenerateRequestsController::class, 'update'])->middleware('auth')->name('generaterequests.update');
    Route::get('/view/{id}',[App\Http\Controllers\GenerateRequestsController::class, 'show'])->middleware('auth')->name('generaterequests.show');
    Route::post('/complete/',[App\Http\Controllers\GenerateRequestsController::class, 'complete'])->middleware('auth')->name('generaterequests.complete');
});

Route::group(['prefix'=> '/item_entries'],function() {
    Route::get('create/{type}/{id}',[App\Http\Controllers\ItemEntriesController::class, 'create'])->name('checkin.create');
    Route::post('store',[App\Http\Controllers\ItemEntriesController::class, 'store'])->name('checkin.store');
    Route::post('store/site',[App\Http\Controllers\ItemEntriesController::class, 'storesite'])->name('checkin.storesite');
    Route::post('edit/{id}',[App\Http\Controllers\ItemEntriesController::class, 'edit'])->name('checkin.edit');
    Route::post('update',[App\Http\Controllers\ItemEntriesController::class, 'update'])->name('checkin.update');
});
Route::group(['prefix'=> 'gate_pass'],function() {
    Route::group(['prefix'=> 'items'],function() {
        Route::post('out',[App\Http\Controllers\GatePassItemController::class, 'out'])->name('gp.items.out');
        Route::post('in',[App\Http\Controllers\GatePassItemController::class, 'in'])->name('gp.items.in');
    });
    Route::get('',[App\Http\Controllers\GatePassController::class, 'index'])->name('gp.index');
    Route::post('/',[App\Http\Controllers\GatePassController::class, 'fetch'])->name('gp.fetch');
    Route::post('get_items',[App\Http\Controllers\GatePassController::class, 'get_items'])->name('gp.get.items');
    Route::post('store_out',[App\Http\Controllers\GatePassController::class, 'store_out'])->name('gp.store.out');
    Route::post('store_in',[App\Http\Controllers\GatePassController::class, 'store_in'])->name('gp.store.in');
    Route::get('print/{id}',[App\Http\Controllers\GatePassController::class, 'prints'])->middleware('auth')->name('gp.print');
    Route::get('check-in-out/{id}',[App\Http\Controllers\GatePassController::class, 'check_in_out'])->middleware('auth')->name('gp.check.in.out');
});

Route::group(['prefix'=> 'tasks'],function() {
    Route::get('assign_site/{job_id}/{items}',[App\Http\Controllers\TaskController::class, 'site_assign'])->middleware('auth')->name('tasks.site_assign');
    Route::post('assign_site_job',[App\Http\Controllers\TaskController::class, 'siteassignjobs'])->middleware('auth')->name('tasks.siteassignjobs');
    Route::get('create/{id}',[App\Http\Controllers\TaskController::class, 'create'])->middleware('auth')->name('tasks.create');
    Route::get('edit/{id}',[App\Http\Controllers\TaskController::class, 'edit'])->middleware('auth')->name('tasks.edit');
    Route::get('/respective-assets/{id}',[App\Http\Controllers\TaskController::class, 'respectiveassets'])->middleware('auth')->name('tasks.respectiveassets');
    Route::post('store',[App\Http\Controllers\TaskController::class, 'store'])->middleware('auth')->name('tasks.store');
});


Route::group(['prefix'=> 'items'],function() {
    Route::get('show/{id}',[App\Http\Controllers\QuoteItemController::class, 'show'])->middleware('auth')->name('items.show');
    Route::get('',[App\Http\Controllers\QuoteItemController::class, 'index'])->middleware('auth')->name('items');
    Route::get('/select-capabilities/{id}',[App\Http\Controllers\QuoteItemController::class, 'getCapabilities'])->middleware('auth')->name('items.getcapabilities');
    Route::get('/select-price/{id}',[App\Http\Controllers\QuoteItemController::class, 'getPrice'])->middleware('auth')->name('items.getPrice');
    Route::get('/select-multi-detail/{id}',[App\Http\Controllers\QuoteItemController::class, 'get_multi_detail'])->middleware('auth')->name('items.get_multi_detail');
    Route::get('/compare-ranges/{min}/{max}/{capability}',[App\Http\Controllers\QuoteItemController::class, 'compare_ranges'])->middleware('auth')->name('items.compare_ranges');
    Route::post('',[App\Http\Controllers\QuoteItemController::class, 'fetch'])->middleware('auth')->name('items.fetch');
    Route::post('/store',[App\Http\Controllers\QuoteItemController::class, 'store'])->middleware('auth')->name('items.store');
    Route::post('/edit',[App\Http\Controllers\QuoteItemController::class, 'edit'])->middleware('auth')->name('items.edit');
    Route::post('/editNA',[App\Http\Controllers\QuoteItemController::class, 'editNA'])->middleware('auth')->name('items.editNA');
    Route::post('/updateNA',[App\Http\Controllers\QuoteItemController::class, 'updateNA'])->middleware('auth')->name('items.updateNA');
/*    Route::get('/edit/{session}/{id}',[App\Http\Controllers\QuoteItemController::class, 'edit'])->middleware('auth')->name('items.edit');*/
    Route::post('/update',[App\Http\Controllers\QuoteItemController::class, 'update'])->middleware('auth')->name('items.update');
    Route::delete('/delete/{id}',[App\Http\Controllers\QuoteItemController::class, 'destroy'])->middleware('auth')->name('items.delete');
    Route::post('/nofacility',[App\Http\Controllers\QuoteItemController::class, 'nofacility'])->middleware('auth')->name('items.nofacility');
    Route::post('/store_multi',[App\Http\Controllers\QuoteItemController::class, 'store_multi'])->middleware('auth')->name('items.store_multi');
    Route::post('/update_multi',[App\Http\Controllers\QuoteItemController::class, 'update_multi'])->middleware('auth')->name('items.update_multi');

});
Route::group(['prefix'=> 'pendings'],function() {
    Route::get('',[App\Http\Controllers\PendingRequestController::class, 'index'])->middleware('auth')->name('pendings');
    Route::get('print_review/{id}',[App\Http\Controllers\PendingRequestController::class, 'print_review'])->middleware('auth')->name('pendings.print_review');
    Route::post('',[App\Http\Controllers\PendingRequestController::class, 'fetch'])->middleware('auth')->name('pendings.fetch');
    Route::post('/checks',[App\Http\Controllers\PendingRequestController::class, 'checks'])->middleware('auth')->name('pendings.checks');
    Route::get('/create/{id}',[App\Http\Controllers\PendingRequestController::class, 'create'])->middleware('auth')->name('pendings.create');
    Route::post('/store',[App\Http\Controllers\PendingRequestController::class, 'store'])->middleware('auth')->name('pendings.store');
    Route::get('/view/{id}',[App\Http\Controllers\PendingRequestController::class, 'show'])->middleware('auth')->name('pendings.show');
});
Route::group(['prefix'=> 'lab_task'],function() {
    Route::get('',[App\Http\Controllers\MytaskController::class, 'index_lab'])->middleware('auth')->name('lab.task');
    Route::post('lab',[App\Http\Controllers\MytaskController::class, 'fetch_lab'])->middleware('auth')->name('lab.task.fetch');
    Route::get('view/{id}',[App\Http\Controllers\MytaskController::class, 'show'])->middleware('auth')->name('mytasks.show');
    Route::post('start',[App\Http\Controllers\MytaskController::class, 'start'])->middleware('auth')->name('mytasks.start');
    Route::post('/end',[App\Http\Controllers\MytaskController::class, 'end'])->middleware('auth')->name('mytasks.end');
});

Route::group(['prefix'=> 'site_task'],function() {
    Route::get('',[App\Http\Controllers\MytaskController::class, 'index_site'])->middleware('auth')->name('site.task');
    Route::post('site',[App\Http\Controllers\MytaskController::class, 'fetch_site'])->middleware('auth')->name('site.task.fetch');
    Route::post('/getcertificate',[App\Http\Controllers\MytaskController::class, 'getLabCertificate'])->middleware('auth')->name('getcertificate');
    Route::get('view/{id}',[App\Http\Controllers\MytaskController::class, 'show'])->middleware('auth')->name('mytasks.s_show');
});
Route::group(['prefix'=> 'site_receiving'],function() {
    Route::get('',[App\Http\Controllers\SitePlanController::class, 'index'])->middleware('auth')->name('site.receiving');
    Route::get('show/{id}',[App\Http\Controllers\SitePlanController::class, 'show'])->middleware('auth')->name('site.receiving.show');
    Route::post('fetch',[App\Http\Controllers\SitePlanController::class, 'fetch'])->middleware('auth')->name('site.receiving.fetch');
});


Route::group(['prefix'=> 'delivery_note'],function() {
    Route::post('/store',[App\Http\Controllers\DeliveryNoteController::class, 'store'])->middleware('auth')->name('delivery_note.store');
    Route::post('/delete',[App\Http\Controllers\DeliveryNoteController::class, 'destroy'])->middleware('auth')->name('delivery_note.delete');
    Route::get('print/DN/{id}',[App\Http\Controllers\DeliveryNoteController::class, 'print_DN'])->middleware('auth')->name('delivery_note.print.DN');

});
Route::group(['prefix'=> 'jobs'],function() {
    Route::group(['prefix'=> 'manage'],function() {
        Route::get('',[App\Http\Controllers\ManageJobsController::class, 'index'])->middleware('auth')->name('jobs.manage');
        Route::get('create/{id}',[App\Http\Controllers\ManageJobsController::class, 'create'])->middleware('auth')->name('jobs.manage.create');
        Route::post('',[App\Http\Controllers\ManageJobsController::class, 'fetch'])->middleware('auth')->name('jobs.manage.fetch');
        Route::post('/store',[App\Http\Controllers\ManageJobsController::class, 'store'])->middleware('auth')->name('jobs.manage.store');
        Route::post('get_items',[App\Http\Controllers\ManageJobsController::class, 'get_items'])->middleware('auth')->name('jobs.manage.get_items');
        Route::get('/view/{id}',[App\Http\Controllers\ManageJobsController::class, 'show'])->middleware('auth')->name('jobs.manage.show');
        Route::post('/delete',[App\Http\Controllers\ManageJobsController::class, 'destroy'])->middleware('auth')->name('jobs.manage.delete');
    });
    Route::get('',[App\Http\Controllers\JobController::class, 'index'])->middleware('auth')->name('jobs');
    Route::get('print/DN/{id}',[App\Http\Controllers\JobController::class, 'print_DN'])->middleware('auth')->name('jobs.print.DN');
    Route::get('print/invoice/{id}',[App\Http\Controllers\JobController::class, 'print_invoice'])->middleware('auth')->name('jobs.print.invoice');
    Route::get('print/sales_invoice/{id}',[App\Http\Controllers\JobController::class, 'print_st_invoice'])->middleware('auth')->name('jobs.print.st.invoice');
    Route::get('print/jobtag/{id}',[App\Http\Controllers\JobController::class, 'print_jt'])->middleware('auth')->name('gatepass.print_gt');
    Route::get('print/jobform/{id}',[App\Http\Controllers\JobController::class, 'print_job_form'])->middleware('auth')->name('jobs.print.job.form');
    Route::get('/view/{id}',[App\Http\Controllers\JobController::class, 'view'])->middleware('auth')->name('jobs.view');
    Route::post('',[App\Http\Controllers\JobController::class, 'fetch'])->middleware('auth')->name('jobs.fetch');
    Route::post('store',[App\Http\Controllers\JobController::class, 'store'])->middleware('auth')->name('jobs.store');
    Route::post('complete',[App\Http\Controllers\JobController::class, 'complete'])->middleware('auth')->name('jobs.complete');
});
Route::group(['prefix'=> 'certificates'],function() {
    Route::get('',[App\Http\Controllers\CertificateController::class, 'index'])->middleware('auth')->name('certificates');
    Route::post('',[App\Http\Controllers\CertificateController::class, 'fetch'])->middleware('auth')->name('certificates.fetch');
});
Route::group(['prefix'=> 'suggestions'],function() {
    Route::post('create',[App\Http\Controllers\SuggestionController::class, 'create'])->middleware('auth')->name('suggestions.create');
    Route::get('for_lab_job/{task_id}',[App\Http\Controllers\SuggestionController::class, 'for_lab_job'])->middleware('auth')->name('suggestions.for.lab.job');
    Route::delete('delete',[App\Http\Controllers\SuggestionController::class, 'destroy'])->middleware('auth')->name('suggestions.delete');
});
Route::group(['prefix'=> 'invoicing-ledger'],function() {
    Route::get('',[App\Http\Controllers\InvoicingLedgerController::class, 'index'])->middleware('auth')->name('invoicing_ledger');
    Route::post('',[App\Http\Controllers\InvoicingLedgerController::class, 'fetch'])->middleware('auth')->name('invoicing_ledger.fetch');
    Route::get('/create/{id}',[App\Http\Controllers\InvoicingLedgerController::class, 'create'])->middleware('auth')->name('invoicing_ledger.create');
    Route::get('/edit/{id}',[App\Http\Controllers\InvoicingLedgerController::class, 'edit'])->middleware('auth')->name('invoicing_ledger.edit');
    Route::post('/store',[App\Http\Controllers\InvoicingLedgerController::class, 'store'])->middleware('auth')->name('invoicing_ledger.store');
    Route::post('/update',[App\Http\Controllers\InvoicingLedgerController::class, 'update'])->middleware('auth')->name('invoicing_ledger.update');
    Route::get('/show/{invoice}',[App\Http\Controllers\InvoicingLedgerController::class, 'show'])->middleware('auth')->name('invoicing_ledger.show');
});
Route::group(['prefix'=> 'receivable-ledger'],function() {
    Route::get('',[App\Http\Controllers\ReceivingLedgerController::class, 'index'])->middleware('auth')->name('receivable_ledger');
    Route::post('',[App\Http\Controllers\ReceivingLedgerController::class, 'fetch'])->middleware('auth')->name('receivable_ledger.fetch');
    Route::get('/create/{id}',[App\Http\Controllers\ReceivingLedgerController::class, 'create'])->middleware('auth')->name('receivable_ledger.create');
    Route::get('/edit/{id}',[App\Http\Controllers\ReceivingLedgerController::class, 'edit'])->middleware('auth')->name('receivable_ledger.edit');
    Route::post('/store',[App\Http\Controllers\ReceivingLedgerController::class, 'store'])->middleware('auth')->name('receivable_ledger.store');
    Route::post('/update/{invoice}',[App\Http\Controllers\ReceivingLedgerController::class, 'update'])->middleware('auth')->name('receivable_ledger.update');
    Route::get('/show/{invoice}',[App\Http\Controllers\ReceivingLedgerController::class, 'show'])->middleware('auth')->name('receivable_ledger.show');
});

Route::group(['prefix'=> 'manage-reference'],function(){
    Route::get('',[App\Http\Controllers\ManagereferenceController::class, 'index'])->middleware('auth')->name('manageref');
    Route::post('',[App\Http\Controllers\ManagereferenceController::class, 'fetch'])->middleware('auth')->name('manageref.fetch');
    Route::get('/create',[App\Http\Controllers\ManagereferenceController::class, 'create'])->middleware('auth')->name('manageref.create');
    Route::get('/edit/{id}',[App\Http\Controllers\ManagereferenceController::class, 'edit'])->middleware('auth')->name('manageref.edit');
    Route::post('/store/',[App\Http\Controllers\ManagereferenceController::class, 'store'])->middleware('auth')->name('manageref.store');
    Route::post('/update/',[App\Http\Controllers\ManagereferenceController::class, 'update'])->middleware('auth')->name('manageref.update');
    Route::get('/show/{id}',[App\Http\Controllers\ManagereferenceController::class, 'show'])->middleware('auth')->name('manageref.show');
});
Route::group(['prefix'=> 'units'],function(){
    Route::get('',[App\Http\Controllers\UnitController::class, 'index'])->middleware('auth')->name('units');
    Route::post('',[App\Http\Controllers\UnitController::class, 'fetch'])->middleware('auth')->name('units.fetch');
    Route::get('/create',[App\Http\Controllers\UnitController::class, 'create'])->middleware('auth')->name('units.create');
    Route::get('/edit/{id}',[App\Http\Controllers\UnitController::class, 'edit'])->middleware('auth')->name('units.edit');
    Route::post('/store/',[App\Http\Controllers\UnitController::class, 'store'])->middleware('auth')->name('units.store');
    Route::delete('/delete',[App\Http\Controllers\UnitController::class, 'destroy'])->middleware('auth')->name('units.destroy');
    Route::post('/update/',[App\Http\Controllers\UnitController::class, 'update'])->middleware('auth')->name('units.update');
    Route::get('/units_of_assets/{id}',[App\Http\Controllers\UnitController::class, 'units_of_assets'])->middleware('auth')->name('units.units_of_assets');
    Route::get('/check_both_units/{unit}/{asset}',[App\Http\Controllers\UnitController::class, 'check_both_units'])->middleware('auth')->name('units.check_both_units');
    Route::get('/fetch/previous_units/{parameter}',[App\Http\Controllers\UnitController::class, 'previous_units'])->middleware('auth')->name('units.previous_units');
});

Route::group(['prefix'=> 'procedures'],function(){
    Route::get('',[App\Http\Controllers\ProcedureController::class, 'index'])->middleware('auth')->name('procedures');
    Route::post('',[App\Http\Controllers\ProcedureController::class, 'fetch'])->middleware('auth')->name('procedures.fetch');
    Route::get('/edit/{id}',[App\Http\Controllers\ProcedureController::class, 'edit'])->middleware('auth')->name('procedures.edit');
    Route::get('/show/{id}',[App\Http\Controllers\ProcedureController::class, 'show'])->middleware('auth')->name('procedures.show');
    Route::get('/create/{selections?}',[App\Http\Controllers\ProcedureController::class, 'create'])->middleware('auth')->name('procedures.create');
    Route::post('/store/',[App\Http\Controllers\ProcedureController::class, 'store'])->middleware('auth')->name('procedures.store');
    Route::post('/update/',[App\Http\Controllers\ProcedureController::class, 'update'])->middleware('auth')->name('procedures.update');
    Route::delete('destroy',[App\Http\Controllers\ProcedureController::class, 'destroy'])->middleware('auth')->name('procedures.destroy');
    Route::get('/get_assets/{id}',[App\Http\Controllers\ProcedureController::class, 'get_assets'])->middleware('auth')->name('procedures.get_assets');
});
Route::group(['prefix'=> 'specifications'],function(){
    Route::get('',[App\Http\Controllers\AssetspecificationController::class, 'index'])->middleware('auth')->name('specifications');
    Route::post('',[App\Http\Controllers\AssetspecificationController::class, 'fetch'])->middleware('auth')->name('specifications.fetch');
    Route::post('/store/',[App\Http\Controllers\AssetspecificationController::class, 'store'])->middleware('auth')->name('specifications.store');
    Route::post('/update/',[App\Http\Controllers\AssetspecificationController::class, 'update'])->middleware('auth')->name('specifications.update');
    Route::post('/edit',[App\Http\Controllers\AssetspecificationController::class, 'edit'])->middleware('auth')->name('specifications.edit');
});
/*Route::group(['prefix'=> 'columns'],function(){
    Route::get('',[App\Http\Controllers\ColumnController::class, 'index'])->middleware('auth')->name('columns');
    Route::post('',[App\Http\Controllers\ColumnController::class, 'fetch'])->middleware('auth')->name('columns.fetch');
    Route::post('/store/',[App\Http\Controllers\ColumnController::class, 'store'])->middleware('auth')->name('columns.store');
    Route::post('/update/',[App\Http\Controllers\ColumnController::class, 'update'])->middleware('auth')->name('columns.update');
    Route::post('/edit',[App\Http\Controllers\ColumnController::class, 'edit'])->middleware('auth')->name('columns.edit');
});*/

Route::group(['prefix'=> 'uncertainties'],function() {
    Route::get('',[App\Http\Controllers\UncertaintyController::class, 'index'])->middleware('auth')->name('uncertainties');
    Route::post('',[App\Http\Controllers\UncertaintyController::class, 'fetch'])->middleware('auth')->name('uncertainties.fetch');
    Route::post('/store',[App\Http\Controllers\UncertaintyController::class, 'store'])->middleware('auth')->name('uncertainties.store');
    Route::post('/edit',[App\Http\Controllers\UncertaintyController::class, 'edit'])->middleware('auth')->name('uncertainties.edit');
    Route::post('/update',[App\Http\Controllers\UncertaintyController::class, 'update'])->middleware('auth')->name('uncertainties.update');
});
Route::get('/taxes',[App\Http\Controllers\TaxesController::class, 'index'])->middleware('auth')->name('taxes');
Route::post('/search',[App\Http\Controllers\InvoicingLedgerController::class, 'search'])->middleware('auth')->name('search');
Route::post('/clear/filter',[App\Http\Controllers\InvoicingLedgerController::class, 'clearfilter'])->middleware('auth')->name('clear.filter');
Route::post('/calculate',[App\Http\Controllers\MytaskController::class, 'calculate'])->middleware('auth')->name('calculate');
Route::group(['prefix'=> 'sop'],function() {
    Route::get('',[App\Http\Controllers\SopsController::class, 'index'])->middleware('auth')->name('sops');
    Route::get('master_list_of_documents',[App\Http\Controllers\SopsController::class, 'master_list_of_documents'])->middleware('auth')->name('sops.master_list_of_documents');
    Route::post('',[App\Http\Controllers\SopsController::class, 'fetch'])->middleware('auth')->name('sops.fetch');
    Route::post('/store',[App\Http\Controllers\SopsController::class, 'store'])->middleware('auth')->name('sops.store');
    Route::get('/view/{id}',[App\Http\Controllers\SopsController::class, 'show'])->middleware('auth')->name('sops.show');
    Route::post('/edit',[App\Http\Controllers\SopsController::class, 'edit'])->middleware('auth')->name('sops.edit');
    Route::post('/update',[App\Http\Controllers\SopsController::class, 'update'])->middleware('auth')->name('sops.update');
    Route::delete('/delete',[App\Http\Controllers\SopsController::class, 'destroy'])->middleware('auth')->name('sops.delete');

});
Route::group(['prefix'=> 'forms'],function() {
    Route::get('',[App\Http\Controllers\FormsandformatsController::class, 'index'])->middleware('auth')->name('forms.index');
    Route::post('',[App\Http\Controllers\FormsandformatsController::class, 'fetch'])->middleware('auth')->name('forms.fetch');
    Route::get('create/{id}',[App\Http\Controllers\FormsandformatsController::class, 'create'])->middleware('auth')->name('forms.create');
    Route::post('edit',[App\Http\Controllers\FormsandformatsController::class, 'edit'])->middleware('auth')->name('forms.edit');
    Route::get('edit/details/{id}',[App\Http\Controllers\FormsandformatsController::class, 'edit_details'])->middleware('auth')->name('forms.edit_details');
    Route::get('view/{id}',[App\Http\Controllers\FormsandformatsController::class, 'show'])->middleware('auth')->name('forms.show');
    Route::post('store',[App\Http\Controllers\FormsandformatsController::class, 'store'])->middleware('auth')->name('forms.store');
    Route::post('update',[App\Http\Controllers\FormsandformatsController::class, 'update'])->middleware('auth')->name('forms.update');
    Route::delete('destroy',[App\Http\Controllers\FormsandformatsController::class, 'destroy'])->middleware('auth')->name('forms.destroy');
});
Route::group(['prefix'=> 'purchase_indent'],function() {
    Route::group(['prefix'=> 'item'],function() {
        Route::get('/create/{indent}',[App\Http\Controllers\PurchaseindentitemController::class, 'create'])->middleware('auth')->name('purchase.indent.items.create');
        Route::get('/revision/approve/{id}',[App\Http\Controllers\PurchaseindentitemController::class, 'revision_accept'])->middleware('auth')->name('purchase.indent.items.revision_accept');
        Route::get('/revision/reject/{id}',[App\Http\Controllers\PurchaseindentitemController::class, 'revision_reject'])->middleware('auth')->name('purchase.indent.items.revision_reject');
        Route::get('/approval/approve/{id}',[App\Http\Controllers\PurchaseindentitemController::class, 'approval_accept'])->middleware('auth')->name('purchase.indent.items.approval_accept');
        Route::get('/approval/reject/{id}',[App\Http\Controllers\PurchaseindentitemController::class, 'approval_reject'])->middleware('auth')->name('purchase.indent.items.approval_reject');
        Route::get('/edit/{id}',[App\Http\Controllers\PurchaseindentitemController::class, 'edit'])->middleware('auth')->name('purchase.indent.items.edit');
        Route::post('/store',[App\Http\Controllers\PurchaseindentitemController::class, 'store'])->middleware('auth')->name('purchase.indent.items.store');
        Route::post('/update',[App\Http\Controllers\PurchaseindentitemController::class, 'update'])->middleware('auth')->name('purchase.indent.items.update');
    });
    Route::get('',[App\Http\Controllers\PurchaseindentController::class, 'index'])->middleware('auth')->name('purchase.indent.index');
    Route::post('',[App\Http\Controllers\PurchaseindentController::class, 'fetch'])->middleware('auth')->name('purchase.indent.fetch');
    Route::get('/create',[App\Http\Controllers\PurchaseindentController::class, 'create'])->middleware('auth')->name('purchase.indent.create');
    Route::post('store',[App\Http\Controllers\PurchaseindentController::class, 'store'])->middleware('auth')->name('purchase.indent.store');
    Route::post('update',[App\Http\Controllers\PurchaseindentController::class, 'update'])->middleware('auth')->name('purchase.indent.update');
    Route::get('/edit/{id}',[App\Http\Controllers\PurchaseindentController::class, 'edit'])->middleware('auth')->name('purchase.indent.edit');
    Route::get('/print/{id}',[App\Http\Controllers\PurchaseindentController::class, 'print_indent'])->middleware('auth')->name('purchase.indent.print_indent');
    Route::get('/show/{id}',[App\Http\Controllers\PurchaseindentController::class, 'show'])->middleware('auth')->name('purchase.indent.show');
});
Route::group(['prefix'=> 'preferences'],function() {
    Route::get('',[App\Http\Controllers\PreferenceController::class, 'index'])->middleware('auth')->name('preferences.index');
    Route::post('',[App\Http\Controllers\PreferenceController::class, 'fetch'])->middleware('auth')->name('preferences.fetch');
    Route::get('/create',[App\Http\Controllers\PreferenceController::class, 'create'])->middleware('auth')->name('preferences.create');
    Route::post('/update',[App\Http\Controllers\PreferenceController::class, 'update'])->middleware('auth')->name('preferences.update');
    Route::get('/edit/{id}',[App\Http\Controllers\PreferenceController::class, 'edit'])->middleware('auth')->name('preferences.edit');
    Route::post('store',[App\Http\Controllers\PreferenceController::class, 'store'])->middleware('auth')->name('preferences.store');
    Route::post('store_category',[App\Http\Controllers\PreferenceController::class, 'store_category'])->middleware('auth')->name('preferences.store_category');
});
Route::group(['prefix'=> 'material_receiving'],function() {
    Route::get('/',[App\Http\Controllers\MaterialreceivingController::class, 'index'])->middleware('auth')->name('material.receiving.index');
    Route::post('',[App\Http\Controllers\MaterialreceivingController::class, 'fetch'])->middleware('auth')->name('material.receiving.fetch');
    Route::get('create/{id}',[App\Http\Controllers\MaterialreceivingController::class, 'create'])->middleware('auth')->name('material.receiving.create');
    Route::get('edit/{id}',[App\Http\Controllers\MaterialreceivingController::class, 'edit'])->middleware('auth')->name('material.receiving.edit');
    Route::post('store',[App\Http\Controllers\MaterialreceivingController::class, 'store'])->middleware('auth')->name('material.receiving.store');
    Route::post('update',[App\Http\Controllers\MaterialreceivingController::class, 'update'])->middleware('auth')->name('material.receiving.update');
    Route::get('show/{id}',[App\Http\Controllers\MaterialreceivingController::class, 'show'])->middleware('auth')->name('material.receiving.show');
    Route::post('grn/create',[App\Http\Controllers\MaterialreceivingController::class, 'create_grn'])->middleware('auth')->name('material.receiving.grn.create');
});
Route::group(['prefix'=> 'no-facility'],function() {
    Route::get('',[App\Http\Controllers\NofacilityController::class, 'index'])->middleware('auth')->name('no.facility.index');
    Route::post('fetch',[App\Http\Controllers\NofacilityController::class, 'fetch'])->middleware('auth')->name('no.facility.fetch');
    Route::post('store',[App\Http\Controllers\NofacilityController::class, 'store'])->middleware('auth')->name('no.facility.store');
    Route::delete('destroy',[App\Http\Controllers\NofacilityController::class, 'destroy'])->middleware('auth')->name('no.facility.destroy');
});

Route::group(['prefix'=> 'requisition'],function() {
    Route::get('/',[App\Http\Controllers\RequisitionController::class, 'index'])->middleware('auth')->name('requisition.index');
    Route::post('',[App\Http\Controllers\RequisitionController::class, 'fetch'])->middleware('auth')->name('requisition.fetch');
    Route::get('create',[App\Http\Controllers\RequisitionController::class, 'create'])->middleware('auth')->name('requisition.create');
    Route::post('store',[App\Http\Controllers\RequisitionController::class, 'store'])->middleware('auth')->name('requisition.store');
    Route::get('edit/{id}',[App\Http\Controllers\RequisitionController::class, 'edit'])->middleware('auth')->name('requisition.edit');
    Route::post('update',[App\Http\Controllers\RequisitionController::class, 'update'])->middleware('auth')->name('requisition.update');
    Route::get('show/{id}',[App\Http\Controllers\RequisitionController::class, 'show'])->middleware('auth')->name('requisition.show');
    Route::get('print/{id}',[App\Http\Controllers\RequisitionController::class, 'prints'])->middleware('auth')->name('requisition.print');
});
Route::group(['prefix'=> 'interview-appraisal'],function() {
    Route::get('/',[App\Http\Controllers\InterviewappraisalController::class, 'index'])->middleware('auth')->name('interview_appraisal.index');
    Route::post('',[App\Http\Controllers\InterviewappraisalController::class, 'fetch'])->middleware('auth')->name('interview_appraisal.fetch');
    Route::get('create',[App\Http\Controllers\InterviewappraisalController::class, 'create'])->middleware('auth')->name('interview_appraisal.create');
    Route::post('store',[App\Http\Controllers\InterviewappraisalController::class, 'store'])->middleware('auth')->name('interview_appraisal.store');
    Route::get('edit/{id}',[App\Http\Controllers\InterviewappraisalController::class, 'edit'])->middleware('auth')->name('interview_appraisal.edit');
    Route::post('update',[App\Http\Controllers\InterviewappraisalController::class, 'update'])->middleware('auth')->name('interview_appraisal.update');
    Route::get('show/{id}',[App\Http\Controllers\InterviewappraisalController::class, 'show'])->middleware('auth')->name('interview_appraisal.show');
    Route::get('print/{id}',[App\Http\Controllers\InterviewappraisalController::class, 'prints'])->middleware('auth')->name('interview_appraisal.print');

});

Route::group(['prefix'=> 'emp_contract'],function() {
    Route::get('/',[App\Http\Controllers\EmpcontractController::class, 'index'])->middleware('auth')->name('emp_contract.index');
    Route::post('',[App\Http\Controllers\EmpcontractController::class, 'fetch'])->middleware('auth')->name('emp_contract.fetch');
    Route::get('create',[App\Http\Controllers\EmpcontractController::class, 'create'])->middleware('auth')->name('emp_contract.create');
    Route::post('store',[App\Http\Controllers\EmpcontractController::class, 'store'])->middleware('auth')->name('emp_contract.store');
    Route::get('edit/{id}',[App\Http\Controllers\EmpcontractController::class, 'edit'])->middleware('auth')->name('emp_contract.edit');
    Route::post('update',[App\Http\Controllers\EmpcontractController::class, 'update'])->middleware('auth')->name('emp_contract.update');
    Route::get('show/{id}',[App\Http\Controllers\EmpcontractController::class, 'show'])->middleware('auth')->name('emp_contract.show');
    Route::get('print/{id}',[App\Http\Controllers\EmpcontractController::class, 'prints'])->middleware('auth')->name('emp_contract.print');
});

Route::group(['prefix'=> 'emp_joining'],function() {
    Route::get('/',[App\Http\Controllers\EmpjoiningController::class, 'index'])->middleware('auth')->name('emp_joining.index');
    Route::post('',[App\Http\Controllers\EmpjoiningController::class, 'fetch'])->middleware('auth')->name('emp_joining.fetch');
    Route::get('create',[App\Http\Controllers\EmpjoiningController::class, 'create'])->middleware('auth')->name('emp_joining.create');
    Route::post('store',[App\Http\Controllers\EmpjoiningController::class, 'store'])->middleware('auth')->name('emp_joining.store');
    Route::get('edit/{id}',[App\Http\Controllers\EmpjoiningController::class, 'edit'])->middleware('auth')->name('emp_joining.edit');
    Route::post('update',[App\Http\Controllers\EmpjoiningController::class, 'update'])->middleware('auth')->name('emp_joining.update');
    Route::get('show/{id}',[App\Http\Controllers\EmpjoiningController::class, 'show'])->middleware('auth')->name('emp_joining.show');
    Route::get('print/{id}',[App\Http\Controllers\EmpjoiningController::class, 'prints'])->middleware('auth')->name('emp_joining.print');
});
Route::group(['prefix'=> 'emp_orientation'],function() {
    Route::get('/',[App\Http\Controllers\EmpOrientationController::class, 'index'])->middleware('auth')->name('emp_orientation.index');
    Route::post('',[App\Http\Controllers\EmpOrientationController::class, 'fetch'])->middleware('auth')->name('emp_orientation.fetch');
    Route::get('create',[App\Http\Controllers\EmpOrientationController::class, 'create'])->middleware('auth')->name('emp_orientation.create');
    Route::post('store',[App\Http\Controllers\EmpOrientationController::class, 'store'])->middleware('auth')->name('emp_orientation.store');
    Route::get('edit/{id}',[App\Http\Controllers\EmpOrientationController::class, 'edit'])->middleware('auth')->name('emp_orientation.edit');
    Route::post('update',[App\Http\Controllers\EmpOrientationController::class, 'update'])->middleware('auth')->name('emp_orientation.update');
    Route::get('show/{id}',[App\Http\Controllers\EmpOrientationController::class, 'show'])->middleware('auth')->name('emp_orientation.show');
    Route::get('print/{id}',[App\Http\Controllers\EmpOrientationController::class, 'prints'])->middleware('auth')->name('emp_orientation.print');
});


Route::group(['prefix'=> 'leave-applications'],function() {
    Route::get('/',[App\Http\Controllers\LeaveApplicationController::class, 'index'])->middleware('auth')->name('leave_application.index');
    Route::post('',[App\Http\Controllers\LeaveApplicationController::class, 'fetch'])->middleware('auth')->name('leave_application.fetch');
    Route::get('create',[App\Http\Controllers\LeaveApplicationController::class, 'create'])->middleware('auth')->name('leave_application.create');
    Route::post('store',[App\Http\Controllers\LeaveApplicationController::class, 'store'])->middleware('auth')->name('leave_application.store');
    Route::get('edit/{id}',[App\Http\Controllers\LeaveApplicationController::class, 'edit'])->middleware('auth')->name('leave_application.edit');
    Route::post('update',[App\Http\Controllers\LeaveApplicationController::class, 'update'])->middleware('auth')->name('leave_application.update');
    Route::get('show/{id}',[App\Http\Controllers\LeaveApplicationController::class, 'show'])->middleware('auth')->name('leave_application.show');
    Route::get('print/{id}',[App\Http\Controllers\LeaveApplicationController::class, 'prints'])->middleware('auth')->name('leave_application.print');

    Route::get('/head/reject/{id}',[App\Http\Controllers\LeaveApplicationController::class, 'head_reject'])->middleware('auth')->name('leave_application.head_reject');
    Route::get('/head/approve/{id}',[App\Http\Controllers\LeaveApplicationController::class, 'head_approve'])->middleware('auth')->name('leave_application.head_approve');

});
Route::group(['prefix'=> 'attendance'],function() {
    Route::post('checkin',[App\Http\Controllers\AttendanceController::class, 'checkin'])->middleware('auth')->name('attendance.checkin');
    Route::post('checkout',[App\Http\Controllers\AttendanceController::class, 'checkout'])->middleware('auth')->name('attendance.checkout');
});
Route::group(['prefix'=> 'acc_level_one'],function(){
    Route::get('',[App\Http\Controllers\AccLevelOneController::class, 'index'])->middleware('auth')->name('acc_level_one');
    Route::post('',[App\Http\Controllers\AccLevelOneController::class, 'fetch'])->middleware('auth')->name('acc_level_one.fetch');
    Route::get('/create',[App\Http\Controllers\AccLevelOneController::class, 'create'])->middleware('auth')->name('acc_level_one.create');
    Route::post('/edit/{id}',[App\Http\Controllers\AccLevelOneController::class, 'edit'])->middleware('auth')->name('acc_level_one.edit');
    Route::post('/store/',[App\Http\Controllers\AccLevelOneController::class, 'store'])->middleware('auth')->name('acc_level_one.store');
    Route::post('/update/',[App\Http\Controllers\AccLevelOneController::class, 'update'])->middleware('auth')->name('acc_level_one.update');
    Route::delete('delete',[App\Http\Controllers\AccLevelOneController::class, 'destroy'])->middleware('auth')->name('acc_level_one.destroy');

});
Route::group(['prefix'=> 'acc_level_two'],function(){
    Route::get('',[App\Http\Controllers\AccLevelTwoController::class, 'index'])->middleware('auth')->name('acc_level_two');
    Route::post('',[App\Http\Controllers\AccLevelTwoController::class, 'fetch'])->middleware('auth')->name('acc_level_two.fetch');
    Route::get('/create',[App\Http\Controllers\AccLevelTwoController::class, 'create'])->middleware('auth')->name('acc_level_two.create');
    Route::post('/edit/{id}',[App\Http\Controllers\AccLevelTwoController::class, 'edit'])->middleware('auth')->name('acc_level_two.edit');
    Route::post('/store/',[App\Http\Controllers\AccLevelTwoController::class, 'store'])->middleware('auth')->name('acc_level_two.store');
    Route::post('/update/',[App\Http\Controllers\AccLevelTwoController::class, 'update'])->middleware('auth')->name('acc_level_two.update');
    Route::delete('delete',[App\Http\Controllers\AccLevelTwoController::class, 'destroy'])->middleware('auth')->name('acc_level_two.destroy');

});
Route::group(['prefix'=> 'acc_level_three'],function(){
    Route::get('',[App\Http\Controllers\AccLevelThreeController::class, 'index'])->middleware('auth')->name('acc_level_three');
    Route::post('',[App\Http\Controllers\AccLevelThreeController::class, 'fetch'])->middleware('auth')->name('acc_level_three.fetch');
    Route::get('/create',[App\Http\Controllers\AccLevelThreeController::class, 'create'])->middleware('auth')->name('acc_level_three.create');
    Route::post('/edit/{id}',[App\Http\Controllers\AccLevelThreeController::class, 'edit'])->middleware('auth')->name('acc_level_three.edit');
    Route::post('/store/',[App\Http\Controllers\AccLevelThreeController::class, 'store'])->middleware('auth')->name('acc_level_three.store');
    Route::post('/update/',[App\Http\Controllers\AccLevelThreeController::class, 'update'])->middleware('auth')->name('acc_level_three.update');
    Route::get('/get_level2/{id}',[App\Http\Controllers\AccLevelThreeController::class, 'get_level2'])->middleware('auth')->name('acc_level_three.get_level2');
    Route::get('/get_level3/{id}',[App\Http\Controllers\AccLevelThreeController::class, 'get_level3'])->middleware('auth')->name('acc_level_three.get_level3');
    Route::delete('delete',[App\Http\Controllers\AccLevelThreeController::class, 'destroy'])->middleware('auth')->name('acc_level_three.destroy');

});
Route::group(['prefix'=> 'chartofaccount'],function(){
    Route::get('',[App\Http\Controllers\ChartofaccountController::class, 'index'])->middleware('auth')->name('acc_level_four');
    Route::post('',[App\Http\Controllers\ChartofaccountController::class, 'fetch'])->middleware('auth')->name('acc_level_four.fetch');
    Route::get('/create',[App\Http\Controllers\ChartofaccountController::class, 'create'])->middleware('auth')->name('acc_level_four.create');
    Route::get('/show',[App\Http\Controllers\ChartofaccountController::class, 'show'])->middleware('auth')->name('acc_level_four.show');
    Route::get('/print',[App\Http\Controllers\ChartofaccountController::class, 'prints'])->middleware('auth')->name('acc_level_four.print');
    Route::get('/edit/{id}',[App\Http\Controllers\ChartofaccountController::class, 'edit'])->middleware('auth')->name('acc_level_four.edit');
    Route::post('/store/',[App\Http\Controllers\ChartofaccountController::class, 'store'])->middleware('auth')->name('acc_level_four.store');
    Route::post('/update/',[App\Http\Controllers\ChartofaccountController::class, 'update'])->middleware('auth')->name('acc_level_four.update');
    Route::delete('delete',[App\Http\Controllers\ChartofaccountController::class, 'destroy'])->middleware('auth')->name('acc_level_four.destroy');
    Route::get('/my-cc/{id}',[App\Http\Controllers\ChartofaccountController::class, 'mycc'])->middleware('auth')->name('acc_level_four.my-cc');
    Route::get('/my-coa/{id}',[App\Http\Controllers\ChartofaccountController::class, 'mycoa'])->middleware('auth')->name('acc_level_four.my-coa');
});

Route::group(['prefix'=> 'cost-center'],function(){
    Route::post('/store',[App\Http\Controllers\CostCenterController::class, 'store'])->middleware('auth')->name('cost.center.store');
    Route::get('/show/{id}',[App\Http\Controllers\CostCenterController::class, 'show'])->middleware('auth')->name('cost.center.show');
    Route::post('destroy',[App\Http\Controllers\CostCenterController::class, 'destroy'])->middleware('auth')->name('cost.center.destroy');
});


Route::group(['prefix'=> 'vouchers'],function(){
    Route::get('',[App\Http\Controllers\VoucherController::class, 'index'])->middleware('auth')->name('vouchers');
    Route::get('all-vouchers',[App\Http\Controllers\VoucherController::class, 'all'])->middleware('auth')->name('vouchers.all');
    Route::post('',[App\Http\Controllers\VoucherController::class, 'fetch'])->middleware('auth')->name('vouchers.fetch');
    Route::post('/fetch-all',[App\Http\Controllers\VoucherController::class, 'all_fetch'])->middleware('auth')->name('vouchers.fetch.all');
    Route::get('/create',[App\Http\Controllers\VoucherController::class, 'create'])->middleware('auth')->name('vouchers.create');
    Route::get('/edit/{id}',[App\Http\Controllers\VoucherController::class, 'edit'])->middleware('auth')->name('vouchers.edit');
    Route::get('/show/{id}',[App\Http\Controllers\VoucherController::class, 'show'])->middleware('auth')->name('vouchers.show');
    Route::get('/print/{id}',[App\Http\Controllers\VoucherController::class, 'prints'])->middleware('auth')->name('vouchers.print');
    Route::post('/store/',[App\Http\Controllers\VoucherController::class, 'store'])->middleware('auth')->name('vouchers.store');
    Route::post('/update/',[App\Http\Controllers\VoucherController::class, 'update'])->middleware('auth')->name('vouchers.update');
    Route::get('get-po-details/{id}',[App\Http\Controllers\VoucherController::class, 'get_po_details'])->middleware('auth')->name('vouchers.get.po.details');
    Route::get('get-inv-details/{inv}',[App\Http\Controllers\VoucherController::class, 'get_inv_details'])->middleware('auth')->name('vouchers.get.inv.details');
});
Route::group(['prefix'=> 'journal-vouchers'],function(){
    Route::get('',[App\Http\Controllers\JournalVouhcerController::class, 'index'])->middleware('auth')->name('journal.vouchers');
    Route::post('',[App\Http\Controllers\JournalVouhcerController::class, 'fetch'])->middleware('auth')->name('journal.vouchers.fetch');
    Route::get('/create',[App\Http\Controllers\JournalVouhcerController::class, 'create'])->middleware('auth')->name('journal.vouchers.create');
    Route::get('/edit/{id}',[App\Http\Controllers\JournalVouhcerController::class, 'edit'])->middleware('auth')->name('journal.vouchers.edit');
    Route::get('/show/{id}',[App\Http\Controllers\JournalVouhcerController::class, 'show'])->middleware('auth')->name('journal.vouchers.show');
    Route::get('/print/{id}',[App\Http\Controllers\JournalVouhcerController::class, 'prints'])->middleware('auth')->name('journal.vouchers.print');
    Route::post('/store/',[App\Http\Controllers\JournalVouhcerController::class, 'store'])->middleware('auth')->name('journal.vouchers.store');
    Route::post('/update/',[App\Http\Controllers\JournalVouhcerController::class, 'update'])->middleware('auth')->name('journal.vouchers.update');

});

Route::group(['prefix'=> 'sales-invoice'],function(){
    Route::get('',[App\Http\Controllers\SalesInvoiceController::class, 'index'])->middleware('auth')->name('sales.invoice');
    Route::get('/create',[App\Http\Controllers\SalesInvoiceController::class, 'create'])->middleware('auth')->name('sales.invoice.create');
    Route::post('/create/fetch',[App\Http\Controllers\SalesInvoiceController::class, 'create_fetch'])->middleware('auth')->name('sales.invoice.create.fetch');
    Route::post('',[App\Http\Controllers\SalesInvoiceController::class, 'fetch'])->middleware('auth')->name('sales.invoice.fetch');
});
Route::group(['prefix'=> 'purchase-invoice'],function(){
    Route::get('',[App\Http\Controllers\PurchaseInvoiceController::class, 'index'])->middleware('auth')->name('purchase.invoice');
    Route::get('/create',[App\Http\Controllers\PurchaseInvoiceController::class, 'create'])->middleware('auth')->name('purchase.invoice.create');
    Route::post('',[App\Http\Controllers\PurchaseInvoiceController::class, 'fetch'])->middleware('auth')->name('purchase.invoice.fetch');
    Route::post('/create/fetch',[App\Http\Controllers\PurchaseInvoiceController::class, 'create_fetch'])->middleware('auth')->name('purchase.invoice.create.fetch');
    Route::post('store',[App\Http\Controllers\PurchaseInvoiceController::class, 'store'])->middleware('auth')->name('purchase.invoice.store');
});

Route::group(['prefix'=> 'invoice'],function(){
    Route::post('store',[App\Http\Controllers\InvoiceController::class, 'store'])->middleware('auth')->name('invoice.store');
});

Route::group(['prefix'=> 'receipt-voucher'],function(){
    Route::get('',[App\Http\Controllers\ReceiptVoucherController::class, 'index'])->middleware('auth')->name('sales.receipt.vouchers');
    Route::post('',[App\Http\Controllers\ReceiptVoucherController::class, 'fetch'])->middleware('auth')->name('sales.receipt.vouchers.fetch');
    Route::get('/create',[App\Http\Controllers\ReceiptVoucherController::class, 'create'])->middleware('auth')->name('sales.receipt.vouchers.create');
    Route::get('/edit/{id}',[App\Http\Controllers\ReceiptVoucherController::class, 'edit'])->middleware('auth')->name('sales.receipt.vouchers.edit');
    Route::get('/show/{id}',[App\Http\Controllers\ReceiptVoucherController::class, 'show'])->middleware('auth')->name('sales.receipt.vouchers.show');
    Route::get('/print/{id}',[App\Http\Controllers\ReceiptVoucherController::class, 'prints'])->middleware('auth')->name('sales.receipt.vouchers.print');
    Route::post('/store/',[App\Http\Controllers\ReceiptVoucherController::class, 'store'])->middleware('auth')->name('sales.receipt.vouchers.store');
    Route::post('/update/',[App\Http\Controllers\ReceiptVoucherController::class, 'update'])->middleware('auth')->name('sales.receipt.vouchers.update');
    Route::get('get-inv/{customer}',[App\Http\Controllers\ReceiptVoucherController::class, 'get_inv'])->middleware('auth')->name('sales.receipt.vouchers.get_inv');
    Route::get('get-inv-details/{inv}',[App\Http\Controllers\ReceiptVoucherController::class, 'get_inv_details'])->middleware('auth')->name('sales.receipt.vouchers.get.inv.details');
    Route::get('get-payments-acc/{type}',[App\Http\Controllers\ReceiptVoucherController::class, 'get_payment_acc'])->middleware('auth')->name('sales.receipt.vouchers.get_payments_acc');
});


Route::group(['prefix'=> 'activity-log'],function(){
    Route::get('/',[App\Http\Controllers\ActivityLogController::class, 'index'])->middleware('auth')->name('activitylog.index');
    Route::post('/show-page/{page?}',[App\Http\Controllers\ActivityLogController::class, 'fetch'])->middleware('auth')->name('activitylog.fetch');
//    Route::post('/',[App\Http\Controllers\ActivityLogController::class, 'fetch'])->middleware('auth')->name('activitylog.fetch');
});
Route::group(['prefix'=> 'journal'],function(){
    Route::get('/',[App\Http\Controllers\JournalController::class, 'index'])->middleware('auth')->name('journal.index');
    Route::post('/',[App\Http\Controllers\JournalController::class, 'fetch'])->middleware('auth')->name('journal.fetch');
    Route::post('/ledger',[App\Http\Controllers\JournalController::class, 'ledger'])->middleware('auth')->name('journal.ledger');
    Route::post('/trail_balance',[App\Http\Controllers\JournalController::class, 'trail_balance'])->middleware('auth')->name('trail.balance');
    Route::post('/income',[App\Http\Controllers\JournalController::class, 'income'])->middleware('auth')->name('journal.income');
    Route::post('/balance-sheet',[App\Http\Controllers\JournalController::class, 'balance_sheet'])->middleware('auth')->name('journal.balance_sheet');
    Route::get('/receivable-aging',[App\Http\Controllers\JournalController::class, 'receivable_aging'])->middleware('auth')->name('journal.receivable_aging');
    Route::post('/pra',[App\Http\Controllers\JournalController::class, 'pra'])->middleware('auth')->name('journal.pra');
});
Route::group(['prefix'=> 'general-calculator'],function() {
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\Calculator\GeneralCalculatorController::class, 'print_worksheet'])->middleware('auth')->name('general.calculator.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\Calculator\GeneralCalculatorController::class, 'print_certificate'])->middleware('auth')->name('general.calculator.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\Calculator\GeneralCalculatorController::class, 'print_uncertainty'])->middleware('auth')->name('general.calculator.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\Calculator\GeneralCalculatorController::class, 'print_dataentrysheet'])->middleware('auth')->name('general.calculator.print_dataentrysheet');
    Route::get('{id}',[App\Http\Controllers\Calculator\GeneralCalculatorController::class, 'create'])->middleware('auth')->name('general.calculator');
    Route::post('store',[App\Http\Controllers\Calculator\GeneralCalculatorController::class, 'store'])->middleware('auth')->name('general.calculator.data.entry.store');

});
Route::group(['prefix'=> 'balance-calculator'],function() {
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\Calculator\BalanceCalculatorController::class, 'print_worksheet'])->middleware('auth')->name('balance.calculator.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\Calculator\BalanceCalculatorController::class, 'print_certificate'])->middleware('auth')->name('balance.calculator.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\Calculator\BalanceCalculatorController::class, 'print_uncertainty'])->middleware('auth')->name('balance.calculator.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\Calculator\BalanceCalculatorController::class, 'print_dataentrysheet'])->middleware('auth')->name('balance.calculator.print_dataentrysheet');
    Route::get('{id}',[App\Http\Controllers\Calculator\BalanceCalculatorController::class, 'create'])->middleware('auth')->name('balance.calculator');
    Route::post('store',[App\Http\Controllers\Calculator\BalanceCalculatorController::class, 'store'])->middleware('auth')->name('balance.calculator.data.entry.store');
});
Route::group(['prefix'=> 'incubator-calculator'],function() {
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\Calculator\IncubatorController::class, 'print_worksheet'])->middleware('auth')->name('incubator.calculator.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\Calculator\IncubatorController::class, 'print_certificate'])->middleware('auth')->name('incubator.calculator.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\Calculator\IncubatorController::class, 'print_uncertainty'])->middleware('auth')->name('incubator.calculator.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\Calculator\IncubatorController::class, 'print_dataentrysheet'])->middleware('auth')->name('incubator.calculator.print_dataentrysheet');
    Route::get('{id}',[App\Http\Controllers\Calculator\IncubatorController::class, 'create'])->middleware('auth')->name('incubator.calculator');
    Route::post('store',[App\Http\Controllers\Calculator\IncubatorController::class, 'store'])->middleware('auth')->name('incubator.calculator.data.entry.store');
});
Route::group(['prefix'=> 'volume-calculator'],function() {
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\Calculator\VolumeController::class, 'print_worksheet'])->middleware('auth')->name('volume.calculator.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\Calculator\VolumeController::class, 'print_certificate'])->middleware('auth')->name('volume.calculator.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\Calculator\VolumeController::class, 'print_uncertainty'])->middleware('auth')->name('volume.calculator.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\Calculator\VolumeController::class, 'print_dataentrysheet'])->middleware('auth')->name('volume.calculator.print_dataentrysheet');
    Route::get('{id}',[App\Http\Controllers\Calculator\VolumeController::class, 'create'])->middleware('auth')->name('volume.calculator');
    Route::post('store',[App\Http\Controllers\Calculator\VolumeController::class, 'store'])->middleware('auth')->name('volume.calculator.data.entry.store');
});

Route::group(['prefix'=> 'thermal-mapping'],function() {
    Route::post('store',[App\Http\Controllers\Calculator\IncubatormappingController::class, 'store'])->middleware('auth')->name('incubator.mapping.data.entry.store');
});
Route::group(['prefix'=> 'calculator-entry'],function() {
    Route::get('create/{loc}/{id}',[App\Http\Controllers\CalclulatorentriesController::class, 'create'])->middleware('auth')->name('calculator.data.entry.create');
    Route::post('store',[App\Http\Controllers\CalclulatorentriesController::class, 'store'])->middleware('auth')->name('calculator.data.entry.store');
});
Route::group(['prefix'=> 'mass-reference'],function() {
    Route::post('edit/{id}',[App\Http\Controllers\MassreferenceController::class, 'edit'])->middleware('auth')->name('mass.reference.edit');
    Route::post('store',[App\Http\Controllers\MassreferenceController::class, 'store'])->middleware('auth')->name('mass.reference.store');
});
Route::group(['prefix'=> 'ir-thermometer'],function() {
    Route::get('{id}',[App\Http\Controllers\Calculator\IRController::class, 'create'])->middleware('auth')->name('ir.calculator');
    Route::post('store',[App\Http\Controllers\Calculator\IRController::class, 'store'])->middleware('auth')->name('ir.calculator.data.entry.store');
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\Calculator\IRController::class, 'print_worksheet'])->middleware('auth')->name('ir.calculator.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\Calculator\IRController::class, 'print_certificate'])->middleware('auth')->name('ir.calculator.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\Calculator\IRController::class, 'print_uncertainty'])->middleware('auth')->name('ir.calculator.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\Calculator\IRController::class, 'print_dataentrysheet'])->middleware('auth')->name('ir.calculator.print_dataentrysheet');
});
Route::group(['prefix'=> 'lig-thermometer'],function() {
    Route::get('{id}',[App\Http\Controllers\Calculator\LIGController::class, 'create'])->middleware('auth')->name('lig.calculator');
    Route::post('store',[App\Http\Controllers\Calculator\LIGController::class, 'store'])->middleware('auth')->name('lig.calculator.data.entry.store');
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\Calculator\LIGController::class, 'print_worksheet'])->middleware('auth')->name('lig.calculator.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\Calculator\LIGController::class, 'print_certificate'])->middleware('auth')->name('lig.calculator.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\Calculator\LIGController::class, 'print_uncertainty'])->middleware('auth')->name('lig.calculator.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\Calculator\LIGController::class, 'print_dataentrysheet'])->middleware('auth')->name('lig.calculator.print_dataentrysheet');
});

Route::group(['prefix'=> 'inventory-categories'],function() {
    Route::get('',[App\Http\Controllers\InventoryCategoryController::class, 'index'])->middleware('auth')->name('inventory.category.index');
    Route::post('',[App\Http\Controllers\InventoryCategoryController::class, 'fetch'])->middleware('auth')->name('inventory.category.fetch');
    Route::post('/store',[App\Http\Controllers\InventoryCategoryController::class, 'store'])->middleware('auth')->name('inventory.category.store');
    Route::post('/edit',[App\Http\Controllers\InventoryCategoryController::class, 'edit'])->middleware('auth')->name('inventory.category.edit');
});
Route::group(['prefix'=> 'inventories'],function() {
    Route::get('',[App\Http\Controllers\InventoriesController::class, 'index'])->middleware('auth')->name('inventory.index');
    Route::get('view/{id}',[App\Http\Controllers\InventoriesController::class, 'view'])->middleware('auth')->name('inventory.view');
    Route::get('get-sub-categories/{id}',[App\Http\Controllers\InventoriesController::class, 'get_subcategories'])->middleware('auth')->name('inventory.get_subcategories');
    Route::post('',[App\Http\Controllers\InventoriesController::class, 'fetch'])->middleware('auth')->name('inventory.fetch');
    Route::post('/store',[App\Http\Controllers\InventoriesController::class, 'store'])->middleware('auth')->name('inventory.store');
    Route::post('/edit',[App\Http\Controllers\InventoriesController::class, 'edit'])->middleware('auth')->name('inventory.edit');
});

Route::group(['prefix'=> 'spectro'],function() {
    Route::get('{id}',[App\Http\Controllers\Calculator\SpectrophotometerentriesController::class, 'create'])->middleware('auth')->name('spectro.calculator');
    Route::post('store',[App\Http\Controllers\Calculator\SpectrophotometerentriesController::class, 'store'])->middleware('auth')->name('spectro.calculator.data.entry.store');
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\Calculator\SpectrophotometerentriesController::class, 'print_worksheet'])->middleware('auth')->name('spectro.calculator.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\Calculator\SpectrophotometerentriesController::class, 'print_certificate'])->middleware('auth')->name('spectro.calculator.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\Calculator\SpectrophotometerentriesController::class, 'print_uncertainty'])->middleware('auth')->name('spectro.calculator.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\Calculator\SpectrophotometerentriesController::class, 'print_dataentrysheet'])->middleware('auth')->name('spectro.calculator.print_dataentrysheet');
});
Route::group(['prefix'=> 'vernier'],function() {
    Route::get('{id}',[App\Http\Controllers\Calculator\VernierentriesController::class, 'create'])->middleware('auth')->name('vernier.calculator');
    Route::post('store',[App\Http\Controllers\Calculator\VernierentriesController::class, 'store'])->middleware('auth')->name('vernier.calculator.data.entry.store');
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\Calculator\VernierentriesController::class, 'print_worksheet'])->middleware('auth')->name('vernier.calculator.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\Calculator\VernierentriesController::class, 'print_certificate'])->middleware('auth')->name('vernier.calculator.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\Calculator\VernierentriesController::class, 'print_uncertainty'])->middleware('auth')->name('vernier.calculator.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\Calculator\VernierentriesController::class, 'print_dataentrysheet'])->middleware('auth')->name('vernier.calculator.print_dataentrysheet');
});
Route::group(['prefix'=> 'micrometer'],function() {
    Route::get('{id}',[App\Http\Controllers\Calculator\MicrometerCalculator::class, 'create'])->middleware('auth')->name('micrometer.calculator');
    Route::post('store',[App\Http\Controllers\Calculator\MicrometerCalculator::class, 'store'])->middleware('auth')->name('micrometer.calculator.data.entry.store');
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\Calculator\MicrometerCalculator::class, 'print_worksheet'])->middleware('auth')->name('micrometer.calculator.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\Calculator\MicrometerCalculator::class, 'print_certificate'])->middleware('auth')->name('micrometer.calculator.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\Calculator\MicrometerCalculator::class, 'print_uncertainty'])->middleware('auth')->name('micrometer.calculator.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\Calculator\MicrometerCalculator::class, 'print_dataentrysheet'])->middleware('auth')->name('micrometer.calculator.print_dataentrysheet');
});
Route::group(['prefix'=> 'dialgauge'],function() {
    Route::get('{id}',[App\Http\Controllers\Calculator\DialguageController::class, 'create'])->middleware('auth')->name('dialgauge.calculator');
    Route::post('store',[App\Http\Controllers\Calculator\DialguageController::class, 'store'])->middleware('auth')->name('dialgauge.calculator.data.entry.store');
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\Calculator\DialguageController::class, 'print_worksheet'])->middleware('auth')->name('dialgauge.calculator.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\Calculator\DialguageController::class, 'print_certificate'])->middleware('auth')->name('dialgauge.calculator.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\Calculator\DialguageController::class, 'print_uncertainty'])->middleware('auth')->name('dialgauge.calculator.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\Calculator\DialguageController::class, 'print_dataentrysheet'])->middleware('auth')->name('dialgauge.calculator.print_dataentrysheet');
});