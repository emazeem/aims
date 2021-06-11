<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Passport::routes();
        //View::share('notifications',Notification::all());
        View::share('menus',Menu::where('parent_id',null)->where('status',1)->orderBy('position','ASC')->get());
        $this->registerPolicies();
        $this->vendors();
        $this->customers();
        $this->interview_appraisal();
        $this->staff();
        $this->expenses();
        $this->empcontract();
        $this->requisition();
        $this->units();
        $this->hr();
        $this->department();
        $this->preferences();
        $this->designation();
        $this->asset();
        $this->capabilities();
        $this->uncertainties();
        $this->quotes();
        $this->columns();
        $this->material_receiving();
        $this->items();
        $this->mytasks();
        $this->roles();
        $this->pendings();
        $this->awaitings();
        $this->document_control();
        $this->staf();
        $this->menus();
        $this->manage_reference();
        $this->parameters();
        $this->procedures();
        $this->manage_jobs();
        $this->tasks();
        $this->scheduling();
        $this->sop();
        $this->jobs();
        $this->certificates();
        $this->invoicing_ledger();
        $this->settings();
        $this->purchase();
        $this->acclevelone();
        $this->accleveltwo();
        $this->acclevelthree();
        $this->acclevelfour();
        $this->purchase_invoice();
        $this->vouchers();
        $this->activitylog();
        $this->journal();
        $this->inventory();
        $this->businessLine();
        $this->vendor_evaluation();
        $this->po();
        $this->cir();
        $this->asset_requisition();
        $this->logreview();
        $this->payment_vouchers();
        //
    }
    public function logreview()
    {
        Gate::define('log-reviews', function ($user) {
            if (in_array('log-reviews',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('add-log-reviews', function ($user) {
            if (in_array('add-log-reviews',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('update-log-reviews', function ($user) {
            if (in_array('update-log-reviews',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('view-log-reviews', function ($user) {
            if (in_array('view-log-reviews',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('delete-log-reviews', function ($user) {
            if (in_array('delete-log-reviews',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }
    public function asset_requisition()
    {
        Gate::define('asset-requisition', function ($user) {
            if (in_array('asset-requisition',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function purchase_invoice()
    {
        Gate::define('purchase-invoice', function ($user) {
            if (in_array('purchase-invoice',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('add-purchase-invoice', function ($user) {
            if (in_array('add-purchase-invoice',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('edit-purchase-invoice', function ($user) {
            if (in_array('edit-purchase-invoice',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('view-purchase-invoice', function ($user) {
            if (in_array('view-purchase-invoice',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('print-purchase-invoice', function ($user) {
            if (in_array('print-purchase-invoice',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });



    }

    public function cir()
    {
        Gate::define('cir', function ($user) {
            if (in_array('cir',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function po()
    {
        Gate::define('purchase-order', function ($user) {
            if (in_array('purchase-order',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function vendor_evaluation()
    {
        Gate::define('vendor-evaluation', function ($user) {
            if (in_array('vendor-evaluation',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function expenses()
    {
        Gate::define('finance-accounts', function ($user) {
            if (in_array('finance-accounts',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }

    public function businessLine()
    {
        Gate::define('business-lines', function ($user) {
            if (in_array('business-lines',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function journal()
    {
        Gate::define('journal-index', function ($user) {
            if (in_array('journal-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }

    public function inventory()
    {
        Gate::define('inventory-index', function ($user) {
            if (in_array('inventory-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('inventory-categories-index', function ($user) {
            if (in_array('inventory-categories-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('inventories-index', function ($user) {
            if (in_array('inventories-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });


    }
    public function payment_vouchers()
    {
        Gate::define('vouchers-index', function ($user) {
            if (in_array('vouchers-index', explode(',', $user->roles->permissions))) {
                return true;
            }
            return false;
        });
        Gate::define('create-payment-voucher', function ($user) {
            if (in_array('create-payment-voucher', explode(',', $user->roles->permissions))) {
                return true;
            }
            return false;
        });
        Gate::define('update-payment-voucher', function ($user) {
            if (in_array('update-payment-voucher', explode(',', $user->roles->permissions))) {
                return true;
            }
            return false;
        });
        Gate::define('view-payment-voucher', function ($user) {
            if (in_array('view-payment-voucher', explode(',', $user->roles->permissions))) {
                return true;
            }
            return false;
        });
        Gate::define('print-payment-voucher', function ($user) {
            if (in_array('print-payment-voucher', explode(',', $user->roles->permissions))) {
                return true;
            }
            return false;
        });


    }
    public function vouchers()
    {
        Gate::define('journal-vouchers', function ($user) {
            if (in_array('journal-vouchers',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('add-journal-vouchers', function ($user) {
            if (in_array('add-journal-vouchers',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('edit-journal-vouchers', function ($user) {
            if (in_array('edit-journal-vouchers',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('print-journal-vouchers', function ($user) {
            if (in_array('print-journal-vouchers',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });


        Gate::define('sales-invoice', function ($user) {
            if (in_array('sales-invoice',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('add-sales-invoice', function ($user) {
            if (in_array('add-sales-invoice',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('view-sales-invoice', function ($user) {
            if (in_array('view-sales-invoice',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });




        Gate::define('receipt-voucher', function ($user) {
            if (in_array('receipt-voucher',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('add-receipt-voucher', function ($user) {
            if (in_array('add-receipt-voucher',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('edit-receipt-voucher', function ($user) {
            if (in_array('edit-receipt-voucher',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('view-receipt-voucher', function ($user) {
            if (in_array('view-receipt-voucher',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('print-receipt-voucher', function ($user) {
            if (in_array('print-receipt-voucher',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });




    }
    public function activitylog()
    {
        Gate::define('activity-log-index', function ($user) {
            if (in_array('activity-log-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function acclevelone()
    {
        Gate::define('acc-level-one-index', function ($user) {
            if (in_array('acc-level-one-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function accleveltwo()
    {
        Gate::define('acc-level-two-index', function ($user) {
            if (in_array('acc-level-two-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function acclevelthree()
    {
        Gate::define('acc-level-three-index', function ($user) {
            if (in_array('acc-level-three-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }
    public function acclevelfour()
    {
        Gate::define('index-coa', function ($user) {
            if (in_array('index-coa',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('create-coa', function ($user) {
            if (in_array('create-coa',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('update-coa', function ($user) {
            if (in_array('update-coa',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('delete-coa', function ($user) {
            if (in_array('delete-coa',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('view-coa', function ($user) {
            if (in_array('view-coa',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });





    }


    public function customers()
    {
        Gate::define('customer-index', function ($user) {
            if (in_array('customer-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('customer-create', function ($user) {
            if (in_array('customer-create',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('customer-edit', function ($user) {
            if (in_array('customer-edit',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('customer-delete', function ($user) {
            if (in_array('customer-delete',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('customer-view', function ($user) {
            if (in_array('customer-view',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });


    }

    public function pendings()
    {
        Gate::define('pending-index', function ($user) {
            if (in_array('pending-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('pendings-no-facility', function ($user) {
            if (in_array('pendings-no-facility',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }

    public function purchase()
    {
        Gate::define('purchase', function ($user) {
            if (in_array('purchase',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('indent-index', function ($user) {
            if (in_array('indent-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }

    public function procedures()
    {
        Gate::define('procedure-index', function ($user) {
            if (in_array('procedure-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }
    public function vendors()
    {
        Gate::define('vendors-index', function ($user) {
            if (in_array('vendors-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }

    public function preferences()
    {
        Gate::define('preferences-index', function ($user) {
            if (in_array('preferences-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }
    public function material_receiving()
    {
        Gate::define('material-receiving-index', function ($user) {
            if (in_array('material-receiving-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }
    public function interview_appraisal()
    {
        Gate::define('interview-appraisal-index', function ($user) {
            if (in_array('interview-appraisal-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }



    public function document_control()
    {
        Gate::define('document-control', function ($user) {
            if (in_array('document-control',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('forms-index', function ($user) {
            if (in_array('forms-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }

    public function columns()
    {
        Gate::define('column-index', function ($user) {
            if (in_array('column-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }
    public function empcontract()
    {
        Gate::define('emp-contract-index', function ($user) {
            if (in_array('emp-contract-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('emp-joining-index', function ($user) {
            if (in_array('emp-joining-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('employee-orientation-index', function ($user) {
            if (in_array('employee-orientation-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('leave-application-index', function ($user) {
            if (in_array('leave-application-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });



    }

    public function sop()
    {
        Gate::define('sop-index', function ($user) {
            if (in_array('sop-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function staf()
    {
        Gate::define('staff-details', function ($user) {
            if (in_array('staff-details',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }


    public function units()
    {
        Gate::define('units-index', function ($user) {
            if (in_array('units-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('create-units', function ($user) {
            if (in_array('create-units',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('update-units', function ($user) {
            if (in_array('update-units',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('delete-units', function ($user) {
            if (in_array('delete-units',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });



    }
    public function uncertainties()
    {
        Gate::define('uncertainties-index', function ($user) {
            if (in_array('uncertainties-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }



    public function manage_jobs()
    {
        Gate::define('manage-jobs-index', function ($user) {
            if (in_array('manage-jobs-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function jobs()
    {
        Gate::define('jobs-index', function ($user) {
            if (in_array('jobs-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }


    public function parameters()
    {
        Gate::define('parameter-index', function ($user) {
            if (in_array('parameter-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('parameter-create', function ($user) {
            if (in_array('parameter-create',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('parameter-edit', function ($user) {
            if (in_array('parameter-edit',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('parameter-delete', function ($user) {
            if (in_array('parameter-delete',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });




    }
    public function invoicing_ledger()
    {
        Gate::define('invoicing-ledger-index', function ($user) {
            if (in_array('invoicing-ledger-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }


    public function awaitings()
    {
        Gate::define('awaiting-index', function ($user) {
            if (in_array('awaiting-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }
    public function manage_reference()
    {
        Gate::define('manage-reference-index', function ($user) {
            if (in_array('manage-reference-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }


    public function staff()
    {
        Gate::define('staff-index', function ($user) {
            if (in_array('staff-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('staff-create', function ($user) {
            if (in_array('staff-create',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('staff-edit', function ($user) {
            if (in_array('staff-edit',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('staff-view', function ($user) {
            if (in_array('staff-view',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });


    }
    public function department()
    {
        Gate::define('department-index', function ($user) {
            if (in_array('department-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('department-create', function ($user) {
            if (in_array('department-create',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('department-edit', function ($user) {
            if (in_array('department-edit',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }
    public function scheduling()
    {
        Gate::define('scheduling-index', function ($user) {
            if (in_array('scheduling-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('scheduling-show', function ($user) {
            if (in_array('scheduling-show',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('create-task', function ($user) {
            if (in_array('create-task',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('edit-task', function ($user) {
            if (in_array('edit-task',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }

    public function tasks()
    {
        Gate::define('task-index', function ($user) {
            if (in_array('task-index', explode(',', $user->roles->permissions))) {
                return true;
            }
            return false;
        });
    }
    public function hr()
    {
        Gate::define('hr-index', function ($user) {
            if (in_array('hr-index', explode(',', $user->roles->permissions))) {
                return true;
            }
            return false;
        });
    }
    public function requisition()
    {
        Gate::define('requisition-index', function ($user) {
            if (in_array('requisition-index', explode(',', $user->roles->permissions))) {
                return true;
            }
            return false;
        });
    }


    public function designation()
    {
        Gate::define('designation-index', function ($user) {
            if (in_array('designation-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('designation-create', function ($user) {
            if (in_array('designation-create',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('designation-edit', function ($user) {
            if (in_array('designation-edit',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }
    public function asset()
    {
        Gate::define('asset-index', function ($user) {
            if (in_array('asset-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('asset-create', function ($user) {
            if (in_array('asset-create',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('asset-edit', function ($user) {
            if (in_array('asset-edit',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('asset-groups', function ($user) {
            if (in_array('asset-groups',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }
    public function capabilities()
    {
        Gate::define('calibration-management', function ($user) {
            if (in_array('calibration-management',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('capabilities-index', function ($user) {
            if (in_array('capabilities-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

        Gate::define('capabilities-create', function ($user) {
            if (in_array('capabilities-create',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('capabilities-edit', function ($user) {
            if (in_array('capabilities-edit',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('capabilities-view', function ($user) {
            if (in_array('capabilities-view',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('capabilities-delete', function ($user) {
            if (in_array('capabilities-delete',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('grouped-capabilities', function ($user) {
            if (in_array('grouped-capabilities',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('add-grouped-capabilities', function ($user) {
            if (in_array('add-grouped-capabilities',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('edit-grouped-capabilities', function ($user) {
            if (in_array('edit-grouped-capabilities',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('delete-grouped-capabilities', function ($user) {
            if (in_array('delete-grouped-capabilities',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }
    public function roles()
    {
        Gate::define('roles-index', function ($user) {
            if (in_array('roles-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('roles-create', function ($user) {
            if (in_array('roles-create',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('roles-edit', function ($user) {
            if (in_array('roles-edit',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('roles-delete', function ($user) {
            if (in_array('roles-delete',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }public function menus()
{
    Gate::define('menu-index', function ($user) {
        if (in_array('menu-index',explode(',',$user->roles->permissions))){
            return true;
        }
        return false;
    });
    Gate::define('menu-create', function ($user) {
        if (in_array('menu-create',explode(',',$user->roles->permissions))){
            return true;
        }
        return false;
    });
    Gate::define('menu-edit', function ($user) {
        if (in_array('menu-edit',explode(',',$user->roles->permissions))){
            return true;
        }
        return false;
    });
    Gate::define('menu-delete', function ($user) {
        if (in_array('menu-delete',explode(',',$user->roles->permissions))){
            return true;
        }
        return false;
    });

}

    public function quotes()
    {
        Gate::define('rfq', function ($user) {
            if (in_array('rfq',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('quote-index', function ($user) {
            if (in_array('quote-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('generate-requests-index', function ($user) {
            if (in_array('generate-requests-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });


        Gate::define('quote-create', function ($user) {
            if (in_array('quote-create',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('quote-edit', function ($user) {
            if (in_array('quote-edit',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('quote-view', function ($user) {
            if (in_array('quote-view',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('quote-send-to-customer', function ($user) {
            if (in_array('quote-send-to-customer',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('quote-print-details', function ($user) {
            if (in_array('quote-print-details',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('quote-accept', function ($user) {
            if (in_array('quote-accept',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('quote-revised', function ($user) {
            if (in_array('quote-revised',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });





    }
    public function items()
    {
        Gate::define('uuc-items-index', function ($user) {
            if (in_array('uuc-items-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('items-create', function ($user) {
            if (in_array('items-create',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

        Gate::define('items-edit', function ($user) {
            if (in_array('items-edit',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('items-delete', function ($user) {
            if (in_array('items-delete',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });


    }
    public function certificates()
    {
        Gate::define('certificates-index', function ($user) {
            if (in_array('certificates-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

    }
    public function settings()
    {
        Gate::define('settings-index', function ($user) {
            if (in_array('settings-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });

        Gate::define('dashboard-index', function ($user) {
            if (in_array('dashboard-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('manage-jobs', function ($user) {
            if (in_array('manage-jobs',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });



    }

    public function mytasks()
    {
        Gate::define('mytask-index', function ($user) {
            if (in_array('mytask-index',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('mytask-view', function ($user) {
            if (in_array('mytask-view',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('start-mytask', function ($user) {
            if (in_array('start-mytask',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('end-mytask', function ($user) {
            if (in_array('end-mytask',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
        Gate::define('get-certificate', function ($user) {
            if (in_array('get-certificate',explode(',',$user->roles->permissions))){
                return true;
            }
            return false;
        });
    }
}
