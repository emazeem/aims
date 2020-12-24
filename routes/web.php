<?php
use Illuminate\Support\Facades\Route;
Route::get('optimize', function () {
    \Artisan::call('optimize');
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
    Route::get('/create',[App\Http\Controllers\UserController::class, 'create'])->middleware('auth')->name('users.create');
    Route::get('/view/{id}',[App\Http\Controllers\UserController::class, 'show'])->middleware('auth')->name('users.show');
    Route::get('/edit/{id}',[App\Http\Controllers\UserController::class, 'edit'])->middleware('auth')->name('users.edit');
    Route::post('/update/{id}',[App\Http\Controllers\UserController::class, 'update'])->middleware('auth')->name('users.update');
    Route::post('',[App\Http\Controllers\UserController::class, 'fetch'])->middleware('auth')->name('users.fetch');
    Route::post('/store',[App\Http\Controllers\UserController::class, 'store'])->middleware('auth')->name('users.store');
    Route::get('/fetch/designation/{id}',[App\Http\Controllers\UserController::class, 'fetchDesignation'])->middleware('auth')->name('users.fetch.designation');

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
    Route::get('/manage',[App\Http\Controllers\MenuController::class, 'manage'])->middleware('auth')->name('menus.manage');
    Route::post('/manage',[App\Http\Controllers\MenuController::class, 'manage_store'])->middleware('auth')->name('menus.manage.store');
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
    Route::post('/approved/{id}',[App\Http\Controllers\QuotesController::class, 'approved'])->middleware('auth')->name('quotes.approved');
    Route::post('/revised/{id}',[App\Http\Controllers\QuotesController::class, 'revised'])->middleware('auth')->name('quotes.revised');
    Route::post('/approval_details',[App\Http\Controllers\QuotesController::class, 'approval_details'])->middleware('auth')->name('quotes.approval_details');
    Route::post('/discount',[App\Http\Controllers\QuotesController::class, 'discount'])->middleware('auth')->name('quotes.discount');
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
    Route::get('/create/{id}',[App\Http\Controllers\PendingRequestController::class, 'create'])->middleware('auth')->name('pendings.create');
    Route::post('/store',[App\Http\Controllers\PendingRequestController::class, 'store'])->middleware('auth')->name('pendings.store');
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
});
Route::group(['prefix'=> 'units'],function(){
    Route::get('',[App\Http\Controllers\UnitController::class, 'index'])->middleware('auth')->name('units');
    Route::post('',[App\Http\Controllers\UnitController::class, 'fetch'])->middleware('auth')->name('units.fetch');
    Route::get('/create',[App\Http\Controllers\UnitController::class, 'create'])->middleware('auth')->name('units.create');
    Route::get('/edit/{id}',[App\Http\Controllers\UnitController::class, 'edit'])->middleware('auth')->name('units.edit');
    Route::post('/store/',[App\Http\Controllers\UnitController::class, 'store'])->middleware('auth')->name('units.store');
    Route::post('/update/',[App\Http\Controllers\UnitController::class, 'update'])->middleware('auth')->name('units.update');
    Route::get('/units_of_assets/{id}',[App\Http\Controllers\UnitController::class, 'units_of_assets'])->middleware('auth')->name('units.units_of_assets');

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
    Route::get('/edit/{id}',[App\Http\Controllers\PreferenceController::class, 'edit'])->middleware('auth')->name('preferences.edit');
    Route::post('store',[App\Http\Controllers\PreferenceController::class, 'store'])->middleware('auth')->name('preferences.store');
    Route::post('store_category',[App\Http\Controllers\PreferenceController::class, 'store_category'])->middleware('auth')->name('preferences.store_category');
});
Route::group(['prefix'=> 'material_receiving'],function() {
    Route::get('/',[App\Http\Controllers\MaterialreceivingController::class, 'index'])->middleware('auth')->name('material.receiving.index');
    Route::get('create/{id}',[App\Http\Controllers\MaterialreceivingController::class, 'create'])->middleware('auth')->name('material.receiving.create');
    Route::get('edit/{id}',[App\Http\Controllers\MaterialreceivingController::class, 'edit'])->middleware('auth')->name('material.receiving.edit');
    Route::post('store',[App\Http\Controllers\MaterialreceivingController::class, 'store'])->middleware('auth')->name('material.receiving.store');
    Route::post('update',[App\Http\Controllers\MaterialreceivingController::class, 'update'])->middleware('auth')->name('material.receiving.update');
    Route::get('show/{id}',[App\Http\Controllers\MaterialreceivingController::class, 'show'])->middleware('auth')->name('material.receiving.show');
    Route::post('',[App\Http\Controllers\MaterialreceivingController::class, 'fetch'])->middleware('auth')->name('material.receiving.fetch');
});
