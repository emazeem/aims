<?php
use Illuminate\Support\Facades\Route;
Route::get('optimize', function () {
    \Artisan::call('optimize');
    \Artisan::call('view:clear');
    dd("Done");
});
Route::get('/home', [App\Http\Controllers\DashboardControlller::class, 'index'])->middleware('auth');
Route::get('/', [App\Http\Controllers\DashboardControlller::class, 'index'])->middleware('auth')->name('home');
Route::get('notifications', [App\Http\Controllers\DashboardControlller::class, 'notification'])->middleware('auth')->name('notification');
Route::get('notification/markasread/{id}', [App\Http\Controllers\DashboardControlller::class, 'markread'])->middleware('auth')->name('notification.markasread');
Route::get('/profile', [App\Http\Controllers\UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::get('/change_password', [App\Http\Controllers\UserController::class, 'changepw'])->middleware('auth')->name('change-pw');
Route::post('/change_password', [App\Http\Controllers\UserController::class, 'changepassword'])->middleware('auth')->name('change-password');
Route::post('/set_profile', [App\Http\Controllers\UserController::class, 'setprofile'])->middleware('auth')->name('setprofile');

Auth::routes();
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
    Route::get('/view/{id}',[App\Http\Controllers\CustomerController::class, 'show'])->middleware('auth')->name('customers.show');
    Route::get('/edit/{id}',[App\Http\Controllers\CustomerController::class, 'edit'])->middleware('auth')->name('customers.edit');
    Route::post('/update/{id}',[App\Http\Controllers\CustomerController::class, 'update'])->middleware('auth')->name('customers.update');
    Route::post('',[App\Http\Controllers\CustomerController::class, 'fetch'])->middleware('auth')->name('customers.fetch');
    Route::post('/store',[App\Http\Controllers\CustomerController::class, 'store'])->middleware('auth')->name('customers.store');
    Route::delete('delete',[App\Http\Controllers\CustomerController::class, 'destroy'])->middleware('auth')->name('customers.destroy');
});
Route::group(['prefix'=> 'users'],function() {
    Route::get('',[App\Http\Controllers\UserController::class, 'index'])->middleware('auth')->name('users');
    Route::get('/attendances',[App\Http\Controllers\UserController::class, 'attendances'])->middleware('auth')->name('users.attendances');
    Route::get('/create',[App\Http\Controllers\UserController::class, 'create'])->middleware('auth')->name('users.create');
    Route::get('/view/{id}',[App\Http\Controllers\UserController::class, 'show'])->middleware('auth')->name('users.show');
    Route::get('/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->middleware('auth')->name('users.edit');
    Route::post('/update/{id}',[App\Http\Controllers\UserController::class, 'update'])->middleware('auth')->name('users.update');
    Route::post('',[App\Http\Controllers\UserController::class, 'fetch'])->middleware('auth')->name('users.fetch');
    Route::post('/store',[App\Http\Controllers\UserController::class, 'store'])->middleware('auth')->name('users.store');
    Route::get('/fetch/designation/{id}',[App\Http\Controllers\UserController::class, 'fetchDesignation'])->middleware('auth')->name('users.fetch.designation');
    Route::get('/list/of/employment',[App\Http\Controllers\UserController::class, 'list_of_employees'])->middleware('auth')->name('users.list.of.employees');
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
});
Route::group(['prefix'=> 'capabilities/group'],function() {
    Route::get('',[App\Http\Controllers\CapabilitiesgroupController::class, 'index'])->middleware('auth')->name('capabilities.groups');
    Route::get('/create',[App\Http\Controllers\CapabilitiesgroupController::class, 'create'])->middleware('auth')->name('capabilities.groups.create');
    Route::get('/edit/{id}',[App\Http\Controllers\CapabilitiesgroupController::class, 'edit'])->middleware('auth')->name('capabilities.groups.edit');
    Route::get('/show/{id}',[App\Http\Controllers\CapabilitiesgroupController::class, 'show'])->middleware('auth')->name('capabilities.groups.show');
    Route::post('/update',[App\Http\Controllers\CapabilitiesgroupController::class, 'update'])->middleware('auth')->name('capabilities.groups.update');
    Route::post('',[App\Http\Controllers\CapabilitiesgroupController::class, 'fetch'])->middleware('auth')->name('capabilities.groups.fetch');
    Route::post('store',[App\Http\Controllers\CapabilitiesgroupController::class, 'store'])->middleware('auth')->name('capabilities.groups.store');
});
Route::group(['prefix'=> 'assets'],function() {
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
Route::group(['prefix'=> 'designations'],function() {
    Route::get('',[App\Http\Controllers\DesignationController::class, 'index'])->middleware('auth')->name('designations');
    Route::post('',[App\Http\Controllers\DesignationController::class, 'fetch'])->middleware('auth')->name('designations.fetch');
    Route::post('/store',[App\Http\Controllers\DesignationController::class, 'store'])->middleware('auth')->name('designations.store');
    Route::post('/edit',[App\Http\Controllers\DesignationController::class, 'edit'])->middleware('auth')->name('designations.edit');
    Route::post('/update',[App\Http\Controllers\DesignationController::class, 'update'])->middleware('auth')->name('designations.update');
});
Route::group(['prefix'=> 'menus'],function() {
    Route::get('',[App\Http\Controllers\MenuController::class, 'index'])->middleware('auth')->name('menus');
    Route::post('',[App\Http\Controllers\MenuController::class, 'fetch'])->middleware('auth')->name('menus.fetch');
    Route::post('/store',[App\Http\Controllers\MenuController::class, 'store'])->middleware('auth')->name('menus.store');
    Route::post('/edit',[App\Http\Controllers\MenuController::class, 'edit'])->middleware('auth')->name('menus.edit');
    Route::delete('/delete',[App\Http\Controllers\MenuController::class, 'destroy'])->middleware('auth')->name('menus.destroy');
    Route::post('/update',[App\Http\Controllers\MenuController::class, 'update'])->middleware('auth')->name('menus.update');
    Route::post('/search',[App\Http\Controllers\MenuController::class, 'search'])->middleware('auth')->name('menus.search');

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

Route::group(['prefix'=> '/item/entries'],function() {
    Route::get('/{id}',[App\Http\Controllers\ItemEntriesController::class, 'index'])->name('checkin');
    Route::get('create/{type}/{id}',[App\Http\Controllers\ItemEntriesController::class, 'create'])->name('checkin.create');
    Route::post('store',[App\Http\Controllers\ItemEntriesController::class, 'store'])->name('checkin.store');
    Route::post('store/site',[App\Http\Controllers\ItemEntriesController::class, 'storesite'])->name('checkin.storesite');
    Route::post('edit/{id}',[App\Http\Controllers\ItemEntriesController::class, 'edit'])->name('checkin.edit');
});
Route::group(['prefix'=> 'scheduling'],function() {
    Route::group(['prefix'=> 'labs'],function() {
        Route::get('/{id}',[App\Http\Controllers\SchedulingController::class, 'show'])->middleware('auth')->name('lab');
    });
    Route::group(['prefix'=> 'tasks'],function() {
        Route::post('assign_site_job',[App\Http\Controllers\TaskController::class, 'siteassignjobs'])->middleware('auth')->name('tasks.siteassignjobs');
        Route::get('create/{id}',[App\Http\Controllers\TaskController::class, 'create'])->middleware('auth')->name('tasks.create');
        Route::get('edit/{id}',[App\Http\Controllers\TaskController::class, 'edit'])->middleware('auth')->name('tasks.edit');
        Route::get('/respective-assets/{id}',[App\Http\Controllers\TaskController::class, 'respectiveassets'])->middleware('auth')->name('tasks.respectiveassets');
        Route::post('store',[App\Http\Controllers\TaskController::class, 'store'])->middleware('auth')->name('tasks.store');
    });
    Route::get('',[App\Http\Controllers\SchedulingController::class, 'index'])->middleware('auth')->name('scheduling');
    Route::post('',[App\Http\Controllers\SchedulingController::class, 'fetch'])->middleware('auth')->name('scheduling.fetch');
});
Route::group(['prefix'=> 'items'],function() {
    Route::get('',[App\Http\Controllers\ItemController::class, 'index'])->middleware('auth')->name('items');
    Route::get('/select-capabilities/{id}',[App\Http\Controllers\ItemController::class, 'getCapabilities'])->middleware('auth')->name('items.getcapabilities');
    Route::get('/select-price/{id}',[App\Http\Controllers\ItemController::class, 'getPrice'])->middleware('auth')->name('items.getPrice');
    Route::post('',[App\Http\Controllers\ItemController::class, 'fetch'])->middleware('auth')->name('items.fetch');
    Route::get('/create/{id}',[App\Http\Controllers\ItemController::class, 'create'])->middleware('auth')->name('items.create');
    Route::post('/store',[App\Http\Controllers\ItemController::class, 'store'])->middleware('auth')->name('items.store');
    Route::post('/updateNA',[App\Http\Controllers\ItemController::class, 'updateNA'])->middleware('auth')->name('items.updateNA');
    Route::get('/edit/{session}/{id}',[App\Http\Controllers\ItemController::class, 'edit'])->middleware('auth')->name('items.edit');
    Route::post('/update/{id}',[App\Http\Controllers\ItemController::class, 'update'])->middleware('auth')->name('items.update');
    Route::delete('/delete/{id}',[App\Http\Controllers\ItemController::class, 'destroy'])->middleware('auth')->name('items.delete');
    Route::delete('/nofacility/{id}',[App\Http\Controllers\ItemController::class, 'nofacility'])->middleware('auth')->name('items.nofacility');
    Route::post('/editNA/',[App\Http\Controllers\ItemController::class, 'editNA'])->middleware('auth')->name('items.editNA');
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
Route::group(['prefix'=> 'mytasks'],function() {
    Route::get('',[App\Http\Controllers\MytaskController::class, 'index'])->middleware('auth')->name('mytasks');
    Route::post('/getcertificate',[App\Http\Controllers\MytaskController::class, 'getLabCertificate'])->middleware('auth')->name('getcertificate');
    Route::post('',[App\Http\Controllers\MytaskController::class, 'fetch'])->middleware('auth')->name('mytasks.fetch');
    Route::post('site',[App\Http\Controllers\MytaskController::class, 's_fetch'])->middleware('auth')->name('s_mytasks.fetch');
    Route::get('view/{id}',[App\Http\Controllers\MytaskController::class, 'show'])->middleware('auth')->name('mytasks.show');
    Route::get('s_view/{id}',[App\Http\Controllers\MytaskController::class, 's_show'])->middleware('auth')->name('mytasks.s_show');
    Route::get('print/woksheet/{loc}/{id}',[App\Http\Controllers\MytaskController::class, 'print_worksheet'])->middleware('auth')->name('mytasks.print_worksheet');
    Route::get('print/certificate/{loc}/{id}',[App\Http\Controllers\MytaskController::class, 'print_certificate'])->middleware('auth')->name('mytasks.print_certificate');
    Route::get('print/uncertainty/{loc}/{id}',[App\Http\Controllers\MytaskController::class, 'print_uncertainty'])->middleware('auth')->name('mytasks.print_uncertainty');
    Route::get('print/dataentrysheet/{loc}/{id}',[App\Http\Controllers\MytaskController::class, 'print_dataentrysheet'])->middleware('auth')->name('mytasks.print_dataentrysheet');
    Route::post('/start',[App\Http\Controllers\MytaskController::class, 'start'])->middleware('auth')->name('mytasks.start');
    Route::post('/end',[App\Http\Controllers\MytaskController::class, 'end'])->middleware('auth')->name('mytasks.end');
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
    Route::get('print/invoice/{id}',[App\Http\Controllers\JobController::class, 'print_invoice'])->middleware('auth')->name('jobs.print.invoice');
    Route::get('print/DN/{id}',[App\Http\Controllers\JobController::class, 'print_DN'])->middleware('auth')->name('jobs.print.DN');
    Route::get('print/GP/{id}',[App\Http\Controllers\JobController::class, 'print_gp'])->middleware('auth')->name('gatepass.print_gp');
    Route::get('print/jobtag/{loc}/{index}/{id}',[App\Http\Controllers\JobController::class, 'print_jt'])->middleware('auth')->name('gatepass.print_gt');
    Route::get('print/jobform/{id}',[App\Http\Controllers\JobController::class, 'print_job_form'])->middleware('auth')->name('jobs.print.job.form');
    Route::get('/view/{id}',[App\Http\Controllers\JobController::class, 'view'])->middleware('auth')->name('jobs.view');
    Route::post('',[App\Http\Controllers\JobController::class, 'fetch'])->middleware('auth')->name('jobs.fetch');
});
Route::group(['prefix'=> 'certificates'],function() {
    Route::get('',[App\Http\Controllers\CertificateController::class, 'index'])->middleware('auth')->name('certificates');
    Route::post('',[App\Http\Controllers\CertificateController::class, 'fetch'])->middleware('auth')->name('certificates.fetch');
});
Route::group(['prefix'=> 'suggestions'],function() {
    Route::post('create',[App\Http\Controllers\SuggestionController::class, 'create'])->middleware('auth')->name('suggestions.create');
    Route::post('delete',[App\Http\Controllers\SuggestionController::class, 'destroy'])->middleware('auth')->name('suggestions.delete');
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
Route::group(['prefix'=> 'expenses'],function(){
    Route::get('',[App\Http\Controllers\ExpenseController::class, 'index'])->middleware('auth')->name('expenses');
    Route::post('',[App\Http\Controllers\ExpenseController::class, 'fetch'])->middleware('auth')->name('expenses.fetch');
    Route::get('/create/',[App\Http\Controllers\ExpenseController::class, 'create'])->middleware('auth')->name('expenses.create');
    Route::get('/edit/{id}',[App\Http\Controllers\ExpenseController::class, 'edit'])->middleware('auth')->name('expenses.edit');
    Route::post('/store/',[App\Http\Controllers\ExpenseController::class, 'store'])->middleware('auth')->name('expenses.store');
    Route::post('/update/',[App\Http\Controllers\ExpenseController::class, 'update'])->middleware('auth')->name('expenses.update');
    Route::get('/get_subcategories/{id}',[App\Http\Controllers\ExpenseController::class, 'get_subcategories'])->middleware('auth')->name('expenses.get_subcategories');
});
Route::group(['prefix'=> 'expenses_categories'],function(){
    Route::get('',[App\Http\Controllers\ExpensecategoryController::class, 'index'])->middleware('auth')->name('expenses_categories');
    Route::post('',[App\Http\Controllers\ExpensecategoryController::class, 'fetch'])->middleware('auth')->name('expenses_categories.fetch');
    Route::get('/create/',[App\Http\Controllers\ExpensecategoryController::class, 'create'])->middleware('auth')->name('expenses_categories.create');
    Route::post('/store/',[App\Http\Controllers\ExpensecategoryController::class, 'store'])->middleware('auth')->name('expenses_categories.store');
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
    Route::post('/update/',[App\Http\Controllers\UnitController::class, 'update'])->middleware('auth')->name('units.update');
    Route::get('/units_of_assets/{id}',[App\Http\Controllers\UnitController::class, 'units_of_assets'])->middleware('auth')->name('units.units_of_assets');
    Route::get('/check_both_units/{unit}/{asset}',[App\Http\Controllers\UnitController::class, 'check_both_units'])->middleware('auth')->name('units.check_both_units');
    Route::get('/fetch/previous_units/{id}',[App\Http\Controllers\UnitController::class, 'previous_units'])->middleware('auth')->name('units.previous_units');
});

Route::group(['prefix'=> 'procedures'],function(){
    Route::get('',[App\Http\Controllers\ProcedureController::class, 'index'])->middleware('auth')->name('procedures');
    Route::post('',[App\Http\Controllers\ProcedureController::class, 'fetch'])->middleware('auth')->name('procedures.fetch');
    Route::get('/edit/{id}',[App\Http\Controllers\ProcedureController::class, 'edit'])->middleware('auth')->name('procedures.edit');
    Route::get('/show/{id}',[App\Http\Controllers\ProcedureController::class, 'show'])->middleware('auth')->name('procedures.show');
    Route::get('/create/',[App\Http\Controllers\ProcedureController::class, 'create'])->middleware('auth')->name('procedures.create');
    Route::post('/store/',[App\Http\Controllers\ProcedureController::class, 'store'])->middleware('auth')->name('procedures.store');
    Route::post('/update/',[App\Http\Controllers\ProcedureController::class, 'update'])->middleware('auth')->name('procedures.update');
    Route::get('/get_assets/{id}',[App\Http\Controllers\ProcedureController::class, 'get_assets'])->middleware('auth')->name('procedures.get_assets');
});
Route::group(['prefix'=> 'specifications'],function(){
    Route::get('',[App\Http\Controllers\AssetspecificationController::class, 'index'])->middleware('auth')->name('specifications');
    Route::post('',[App\Http\Controllers\AssetspecificationController::class, 'fetch'])->middleware('auth')->name('specifications.fetch');
    Route::post('/store/',[App\Http\Controllers\AssetspecificationController::class, 'store'])->middleware('auth')->name('specifications.store');
    Route::post('/update/',[App\Http\Controllers\AssetspecificationController::class, 'update'])->middleware('auth')->name('specifications.update');
    Route::post('/edit',[App\Http\Controllers\AssetspecificationController::class, 'edit'])->middleware('auth')->name('specifications.edit');
});
Route::group(['prefix'=> 'columns'],function(){
    Route::get('',[App\Http\Controllers\ColumnController::class, 'index'])->middleware('auth')->name('columns');
    Route::post('',[App\Http\Controllers\ColumnController::class, 'fetch'])->middleware('auth')->name('columns.fetch');
    Route::post('/store/',[App\Http\Controllers\ColumnController::class, 'store'])->middleware('auth')->name('columns.store');
    Route::post('/update/',[App\Http\Controllers\ColumnController::class, 'update'])->middleware('auth')->name('columns.update');
    Route::post('/edit',[App\Http\Controllers\ColumnController::class, 'edit'])->middleware('auth')->name('columns.edit');
});
Route::group(['prefix'=> 'uncertainties'],function() {
    Route::get('',[App\Http\Controllers\UncertaintyController::class, 'index'])->middleware('auth')->name('uncertainties');
    Route::post('',[App\Http\Controllers\UncertaintyController::class, 'fetch'])->middleware('auth')->name('uncertainties.fetch');
    Route::post('/store',[App\Http\Controllers\UncertaintyController::class, 'store'])->middleware('auth')->name('uncertainties.store');
    Route::post('/edit',[App\Http\Controllers\UncertaintyController::class, 'edit'])->middleware('auth')->name('uncertainties.edit');
    Route::post('/update',[App\Http\Controllers\UncertaintyController::class, 'update'])->middleware('auth')->name('uncertainties.update');
});
Route::group(['prefix'=> 'calculator'],function() {
    Route::get('{loc}/{id}',[App\Http\Controllers\CalculatorController::class, 'index'])->middleware('auth')->name('calculator');
});
Route::group(['prefix'=> 'data_entry'],function() {
    Route::post('store',[App\Http\Controllers\DataentryController::class, 'store'])->middleware('auth')->name('data_entry.create');
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
});
Route::get('/no-facility',[App\Http\Controllers\NofacilityController::class, 'index'])->middleware('auth')->name('nofacility.index');
Route::post('/no-facility',[App\Http\Controllers\NofacilityController::class, 'fetch'])->middleware('auth')->name('nofacility.fetch');
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


Route::group(['prefix'=> 'leave-application'],function() {
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
    Route::get('/edit/{id}',[App\Http\Controllers\AccLevelOneController::class, 'edit'])->middleware('auth')->name('acc_level_one.edit');
    Route::post('/store/',[App\Http\Controllers\AccLevelOneController::class, 'store'])->middleware('auth')->name('acc_level_one.store');
    Route::post('/update/',[App\Http\Controllers\AccLevelOneController::class, 'update'])->middleware('auth')->name('acc_level_one.update');
});
Route::group(['prefix'=> 'acc_level_two'],function(){
    Route::get('',[App\Http\Controllers\AccLevelTwoController::class, 'index'])->middleware('auth')->name('acc_level_two');
    Route::post('',[App\Http\Controllers\AccLevelTwoController::class, 'fetch'])->middleware('auth')->name('acc_level_two.fetch');
    Route::get('/create',[App\Http\Controllers\AccLevelTwoController::class, 'create'])->middleware('auth')->name('acc_level_two.create');
    Route::get('/edit/{id}',[App\Http\Controllers\AccLevelTwoController::class, 'edit'])->middleware('auth')->name('acc_level_two.edit');
    Route::post('/store/',[App\Http\Controllers\AccLevelTwoController::class, 'store'])->middleware('auth')->name('acc_level_two.store');
    Route::post('/update/',[App\Http\Controllers\AccLevelTwoController::class, 'update'])->middleware('auth')->name('acc_level_two.update');
});
Route::group(['prefix'=> 'acc_level_three'],function(){
    Route::get('',[App\Http\Controllers\AccLevelThreeController::class, 'index'])->middleware('auth')->name('acc_level_three');
    Route::post('',[App\Http\Controllers\AccLevelThreeController::class, 'fetch'])->middleware('auth')->name('acc_level_three.fetch');
    Route::get('/create',[App\Http\Controllers\AccLevelThreeController::class, 'create'])->middleware('auth')->name('acc_level_three.create');
    Route::get('/edit/{id}',[App\Http\Controllers\AccLevelThreeController::class, 'edit'])->middleware('auth')->name('acc_level_three.edit');
    Route::post('/store/',[App\Http\Controllers\AccLevelThreeController::class, 'store'])->middleware('auth')->name('acc_level_three.store');
    Route::post('/update/',[App\Http\Controllers\AccLevelThreeController::class, 'update'])->middleware('auth')->name('acc_level_three.update');
    Route::get('/get_level2/{id}',[App\Http\Controllers\AccLevelThreeController::class, 'get_level2'])->middleware('auth')->name('acc_level_three.get_level2');
    Route::get('/get_level3/{id}',[App\Http\Controllers\AccLevelThreeController::class, 'get_level3'])->middleware('auth')->name('acc_level_three.get_level3');
});
Route::group(['prefix'=> 'acc_level_four'],function(){
    Route::get('',[App\Http\Controllers\ChartofaccountController::class, 'index'])->middleware('auth')->name('acc_level_four');
    Route::post('',[App\Http\Controllers\ChartofaccountController::class, 'fetch'])->middleware('auth')->name('acc_level_four.fetch');
    Route::get('/create',[App\Http\Controllers\ChartofaccountController::class, 'create'])->middleware('auth')->name('acc_level_four.create');
    Route::get('/edit/{id}',[App\Http\Controllers\ChartofaccountController::class, 'edit'])->middleware('auth')->name('acc_level_four.edit');
    Route::post('/store/',[App\Http\Controllers\ChartofaccountController::class, 'store'])->middleware('auth')->name('acc_level_four.store');
    Route::post('/update/',[App\Http\Controllers\ChartofaccountController::class, 'update'])->middleware('auth')->name('acc_level_four.update');
});
Route::group(['prefix'=> 'vouchers'],function(){
    Route::get('',[App\Http\Controllers\VoucherController::class, 'index'])->middleware('auth')->name('vouchers');
    Route::post('',[App\Http\Controllers\VoucherController::class, 'fetch'])->middleware('auth')->name('vouchers.fetch');
    Route::get('/create',[App\Http\Controllers\VoucherController::class, 'create'])->middleware('auth')->name('vouchers.create');
    Route::get('/edit/{id}',[App\Http\Controllers\VoucherController::class, 'edit'])->middleware('auth')->name('vouchers.edit');
    Route::get('/show/{id}',[App\Http\Controllers\VoucherController::class, 'show'])->middleware('auth')->name('vouchers.show');
    Route::get('/print/{id}',[App\Http\Controllers\VoucherController::class, 'prints'])->middleware('auth')->name('vouchers.print');
    Route::post('/store/',[App\Http\Controllers\VoucherController::class, 'store'])->middleware('auth')->name('vouchers.store');
    Route::post('/update/',[App\Http\Controllers\VoucherController::class, 'update'])->middleware('auth')->name('vouchers.update');
});
Route::group(['prefix'=> 'activity-log'],function(){
    Route::get('/',[App\Http\Controllers\ActivityLogController::class, 'index'])->middleware('auth')->name('activitylog.index');
    Route::get('/show',[App\Http\Controllers\ActivityLogController::class, 'show'])->middleware('auth')->name('activitylog.show');
    Route::post('/',[App\Http\Controllers\ActivityLogController::class, 'fetch'])->middleware('auth')->name('activitylog.fetch');
});
Route::group(['prefix'=> 'journal'],function(){
    Route::get('/',[App\Http\Controllers\JournalController::class, 'index'])->middleware('auth')->name('journal.index');
    Route::post('/',[App\Http\Controllers\JournalController::class, 'fetch'])->middleware('auth')->name('journal.fetch');
    Route::post('/ledger',[App\Http\Controllers\JournalController::class, 'ledger'])->middleware('auth')->name('journal.ledger');
    Route::post('/trail_balance',[App\Http\Controllers\JournalController::class, 'trail_balance'])->middleware('auth')->name('trail.balance');
    Route::get('/income',[App\Http\Controllers\JournalController::class, 'income'])->middleware('auth')->name('journal.income');
});
