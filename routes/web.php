<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*---------------- Admin route start here ------------------*/
// admin login route start here 

Route::get('/admin/login', [AdminController::class, 'Index'])->name('login_form');
Route::post('/admin/login/owner', [AdminController::class, 'Login'])->name('admin.login');

// admin register route start here 
Route::get('/admin/register', [AdminController::class, 'AdminRegister'])->name('register_form');
Route::post('/admin/register/store', [AdminController::class, 'Store'])->name('admin.store');
// admin register route ends here 

// Customer Forgate password route start here 
Route::get('/admin/forgot-password', [AdminController::class, 'Forgot'])->name('admin.forgot-password');
Route::post('/admin/forgot-password/create', [AdminController::class, 'ForgotPassword'])->name('admin.forgot-password.create');
Route::get('/admin/reset/{token}', [AdminController::class, 'reset']);
Route::post('/admin/reset/{token}', [AdminController::class, 'PostReset']);
// Customer Forgate password route ends here 

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');

    // Customer show 
    Route::get('/customers', [AdminController::class, 'Customer'])->name('customers.all');
    Route::get('/customers/edit/{id}', [AdminController::class, 'CustomerEdit'])->name('customer.edit');
    Route::post('/customers/update', [AdminController::class, 'CustomerUpdate'])->name('customers.update');

    // admin login route start here 
    Route::post('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

});

/*---------------- Admin route ends here ------------------*/
/*---------------- Customer route start here ------------------*/
Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

      //    Category route 
      Route::get('/category', [CategoryController::class, 'Index'])->name('category.index');
      Route::get('/category/create', [CategoryController::class, 'Create'])->name('category.create');
      Route::post('/category/store', [CategoryController::class, 'Store'])->name('category.store');
      Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
      Route::post('/category/update', [CategoryController::class, 'Update'])->name('category.update');
      Route::get('/category/delete/{id}', [CategoryController::class, 'Destroy'])->name('category.delete');

    //    purchase route start here 
    Route::get('/purchases', [PurchaseController::class, 'Index'])->name('purchase.index');
    Route::get('/purchase/create', [PurchaseController::class, 'Create'])->name('purchase.create');
    Route::post('/purchase/product/store', [PurchaseController::class, 'Store'])->name('purchase.store');
    Route::get('/purchase/edit/{id}', [PurchaseController::class, 'Edit'])->name('purchase.edit');
    Route::post('/purchase/update', [PurchaseController::class, 'Update'])->name('purchase.update');
    Route::get('/purchase/delete/{id}', [PurchaseController::class, 'Destroy'])->name('purchase.delete');

    //    products route start here 
    Route::post('/product', [PurchaseController::class, 'GetProduct']); // get product using ajex 

    Route::get('/products', [ProductController::class, 'Index'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'Create'])->name('product.create');
    Route::post('/product/product/store', [ProductController::class, 'Store'])->name('product.store');
    Route::get('/product/edit/{product_id}', [ProductController::class, 'Edit'])->name('product.edit');
    Route::post('/product/update', [ProductController::class, 'Update'])->name('product.update');
    Route::get('/product/delete/{product_id}', [ProductController::class, 'Destroy'])->name('product.delete');

    //    products route start here 
    Route::get('/suppliers', [SupplierController::class, 'Index'])->name('supplier.index');
    Route::get('/suppliers/create', [SupplierController::class, 'Create'])->name('supplier.create');
    Route::post('/suppliers/store', [SupplierController::class, 'Store'])->name('supplier.store');
    Route::get('/suppliers/edit/{id}', [SupplierController::class, 'Edit']);
    Route::post('/suppliers/update', [SupplierController::class, 'Update'])->name('supplier.update');
    Route::get('/suppliers/delete/{id}', [SupplierController::class, 'Destroy'])->name('supplier.delete');
    //    products route start here 

    //    products route start here 
    Route::get('/payments', [PaymentController::class, 'Index'])->name('payment.index');
    Route::get('/payment/create', [PaymentController::class, 'Create'])->name('payment.create');
    Route::post('/payment/store', [PaymentController::class, 'Store'])->name('payment.store');
    Route::get('/payment/edit/{id}', [PaymentController::class, 'Edit']);
    Route::post('/payment/update', [PaymentController::class, 'Update'])->name('payment.update');
    Route::get('/payment/delete/{id}', [PaymentController::class, 'Destroy'])->name('payment.delete');
    //    products route start here 
    //    users route 
    Route::get('/users', [UserController::class, 'Index'])->name('users.index');
    Route::get('/user/create', [UserController::class, 'Create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'Store'])->name('user.store');
    Route::get('/user/edit/{user_id}', [UserController::class, 'Edit']);
    Route::post('/user/update', [UserController::class, 'Update'])->name('user.update');
    Route::post('/user/delete', [UserController::class, 'Destroy'])->name('user.delete');

    //    Sales route 
    Route::get('/sales', [SaleController::class, 'Index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'Create'])->name('sales.create');
    Route::post('/sales/store', [SaleController::class, 'Store'])->name('sales.store');
    Route::get('/sales/edit/{user_id}', [SaleController::class, 'Edit']);
    Route::post('/sales/update', [SaleController::class, 'Update'])->name('sales.update');
    Route::post('/sales/delete', [SaleController::class, 'Destroy'])->name('sales.delete');

    //    Sales route 
    Route::get('/due-collections', [CollectionController::class, 'Index'])->name('collections.index');
    Route::get('/collections/create', [CollectionController::class, 'Create'])->name('collections.create');
    Route::post('/collections/store', [CollectionController::class, 'Store'])->name('collections.store');
    // Route::get('/sales/edit/{user_id}', [SaleController::class, 'Edit']);
    Route::get('/generate-invoice/{invoice_id}', [CollectionController::class, 'GenerateInv'])->name('sales.update'); //generate voucher 
    // Route::post('/sales/delete', [SaleController::class, 'Destroy'])->name('sales.delete');

    // single users route
    // Route::get('/user/create', [UserController::class, 'SingleCreate'])->name('user.create');
    // Route::post('/user/store', [UserController::class, 'SingleStore'])->name('user.store');

    //    Expense-details route 
    // Route::get('/expense/create', [ExpDetailController::class, 'Create'])->name('expense.create');
    // Route::post('/expense/store', [ExpDetailController::class, 'Store'])->name('expense.store');
    // Route::get('/expense-details/edit/{id}', [ExpDetailController::class, 'Edit']);
    // Route::post('/expense-details/update', [ExpDetailController::class, 'Update'])->name('expense-details.update');
    // Route::get('/expense-details/delate/{id}', [ExpDetailController::class, 'Delate'])->name('expense-details.delate');

    // Route::get('/expense-summary', [ExpDetailController::class, 'Index'])->name('expense-summary.index');

    //    Expense route 
    // Route::get('/expenses', [ExpenseController::class, 'Index'])->name('expenses.index');
    // Route::get('/expense-summary/store', [ExpenseController::class, 'Store'])->name('expense-summary.store');

    //     report route start here 
    // Route::get('/expenses/all', [ExpProcessController::class, 'Index'])->name('expenses.process');
    // Route::get('/expenses/month', [ExpDetailController::class, 'MonthlyExpense'])->name('expenses.month');

    // account route start here 
    // Route::get('/ledger-posting', [ExpenseController::class, 'Index'])->name('ledgerPosting.index');
    // Route::get('/ledger-posting/store', [ExpProcessController::class, 'Store'])->name('ledger-posting.store');
    // Route::get('/expense-process/store', [ExpProcessController::class, 'Store'])->name('expense_process.store');
    // Route::get('/opening-balance/create', [BlanceController::class, 'OpeningBalance'])->name('opening.balance.create');
    // Route::post('/opening-balance/store', [BlanceController::class, 'OpeningBalanceStore'])->name('opening.balance.store');
    // account route ends here 

    //    Expense process route 
    // Route::get('/expense.process', [ExpProcessController::class, 'Index'])->name('expenses.index');
    // // Route::get('/expense-process/store', [ExpProcessController::class, 'Store'])->name('expense_process.store');

    //    income route  
    // Route::get('/income', [IncomeController::class, 'Create'])->name('income.create');
    // Route::post('/income/store', [IncomeController::class, 'Store'])->name('income.store');
    // Route::get('/income/collection', [IncomeController::class, 'Collection'])->name('income.collection');
    // Route::post('/income/collection/store/', [IncomeController::class, 'StoreCollection'])->name('income.collection.store');


    /*------------------------- Expense voucher route srtart here-------------------------*/
    // Expense Management 
    // Route::get('/expense/create-voucher/{id}', [PdfGeneratorController::class, 'CreateVoucher'])->name('expense.voucher.create');
    // Route::post('/expense/generate-voucher', [PdfGeneratorController::class, 'GenerateVoucher'])->name('expense.voucher.generate');
    // Route::get('/expense/generate-voucher-all', [PdfGeneratorController::class, 'GenerateVoucherAll'])->name('expense.voucher.generateall');
    // Expense Accounts 
    // Route::post('/account/expense-voucher-all', [PdfGeneratorController::class, 'GenerateExpenseVoucherAll'])->name('account.expense.voucher.generateall');
    /*------------------------- expense voucher route srtart here-------------------------*/

    /*------------------------- income voucher route start here-------------------------*/
    // Route::get('/income/generate-voucher/{id}', [PdfGeneratorController::class, 'GenerateIncomeVoucher'])->name('income.voucher.generate');
    // Route::post('/income/generate-voucher-all', [PdfGeneratorController::class, 'GenerateIncomeVoucherAll'])->name('income.voucher.generateall');
    /*------------------------- income voucher route ends here-------------------------*/

    /*--------------- Accounts voucher route start here ------------------*/
    // collection
    // Route::get('/income/collection-voucher', [VoucherController::class, 'Index'])->name('income.collection.index');
    // Route::post('/income/collection-all', [VoucherController::class, 'CollectionAll'])->name('income.collection.all');
    // //expense
    // Route::get('/account/expense-voucher', [VoucherController::class, 'ExpenseIndex'])->name('account.expense.index');
    // Route::post('/account/expense-all', [VoucherController::class, 'ExpenseAll'])->name('account.expense.all');
    // //Balance sheet
    // Route::get('/account/balance', [VoucherController::class, 'BalanceSheet'])->name('account.balancesheet');
    // Route::post('/account/balance-all', [VoucherController::class, 'AllBalanceSheet'])->name('account.allbalancesheet');
    // Route::get('/income-statement', [VoucherController::class, 'Incomes'])->name('income.statement');
    /*--------------- Accounts voucher route ends here ------------------*/

    /*--------------- Report route start here ------------------*/
    // Route::get('/expenses/month', [ReportController::class, 'MonthlyExpense'])->name('expenses.month');
    // Route::post('/expenses-all/month', [ReportController::class, 'MonthlyAllExpense'])->name('expensesall.month');
    // Route::get('/expenses/yearly', [ReportController::class, 'YearlyExpense'])->name('expenses.year');
    // Route::post('/expenses-all/year', [ReportController::class, 'YearlyAllExpense'])->name('expensesall.year');

    // Route::get('/incomes/month', [ReportController::class, 'MonthlyIncome'])->name('incomes.month');
    // Route::post('/incomes-all/month', [ReportController::class, 'MonthlyAllIncome'])->name('incomesall.month');
    // Route::get('/incomes/yearly', [ReportController::class, 'YearlyIncome'])->name('incomes.year');
    // Route::post('/incomes-all/yearly', [ReportController::class, 'YearlyAllIncome'])->name('incomesall.year');

    /*--------------- Report route ends here ------------------*/

    /*--------------- Others Income route start here ------------------*/
    // Route::get('/others-income/create', [OthersIncomeController::class, 'OthersIncomeCreate'])->name('others.income.create');
    // Route::post('/others-income/store', [OthersIncomeController::class, 'OthersIncomeStore'])->name('others.income.store');
    /*--------------- Others Income route ends here ------------------*/

    //    Balance route 
    // Route::get('/balance/month', [BlanceController::class, 'Monthly'])->name('monthly.blance.index');
    // Route::get('/balance/year', [BlanceController::class, 'Yearly'])->name('yearly.blance.index');


    //    Report route 
    // Route::get('/balance-sheet', [BlanceController::class, 'BalanceSheet'])->name('blance.index');
    // Route::get('/all-expenses', [BlanceController::class, 'Expenses'])->name('expense-all.index');
});

/*---------------- Customer route ends here ------------------*/

/*---------------- User route start here ------------------*/
// Route::get('/user-login', [UserController::class, 'LoginForm'])->name('user.login_form');
// Route::post('/user-login/owner', [UserController::class, 'Login'])->name('user.login');

// Route::middleware('auth')->group(function () {
//     Route::get('/user/profile', [UserController::class, 'Profile'])->name('user.Profile');
//     // admin login route start here 
//     Route::post('/user/logout', [AccountController::class, 'AdminLogout'])->name('manager.logout');
//     /*---------------- Manager route start here ------------------*/
//     // Route::get('/dashboard', [AdminController::class, 'Dashboard'])->name('admin.dashboard');

//     // flat route start here 
//     Route::get('/manage-flat', [UserFlatController::class, 'Index'])->name('manager.flat.index');
//     Route::get('/manage-flat/single-create', [UserFlatController::class, 'SingleCreate'])->name('manager.flat.singlecreate');
//     Route::post('/manage-flat/single-store', [UserFlatController::class, 'SingleStore'])->name('manager.flat.singlestore');
//     // flat route start here 

//     //    users route 
//     Route::get('/users', [UserFlatController::class, 'UserIndex'])->name('manager.users.index');
//     Route::get('/users/edit/{id}', [UserFlatController::class, 'Edit']);
//     Route::post('/users/update', [UserFlatController::class, 'Update'])->name('manager.users.update');

//     //    Expense-details route 
//     Route::get('/expense/create', [UserExpenseController::class, 'Create'])->name('manager.expense.create');
//     Route::post('/expense/store', [UserExpenseController::class, 'Store'])->name('manager.expense.store');
//     Route::get('/expense-details/edit/{id}', [UserExpenseController::class, 'Edit']);
//     Route::post('/expense-details/update', [UserExpenseController::class, 'Update'])->name('manager.expense-details.update');
//     Route::get('/expense-details/delate/{id}', [UserExpenseController::class, 'Delate'])->name('manager.expense-details.delate');

//     Route::get('/expense-summary', [UserExpenseController::class, 'Index'])->name('manager.expense-summary.index');
//     Route::get('/expenses/month', [UserExpenseController::class, 'MonthlyExpense'])->name('manager.expenses.month');

//     // Expense Management 
//     Route::get('/expense/create-/voucher/{id}', [UserExpenseController::class, 'CreateVoucher'])->name('manager.expense.voucher.create');
//     Route::post('/expense/generate/voucher', [UserExpenseController::class, 'GenerateVoucher'])->name('manager.expense.voucher.generate');
//     Route::get('/expense/generate-/voucher-all', [UserExpenseController::class, 'GenerateVoucherAll'])->name('manager.expense.voucher.generateall');

//     //    income route  
//     Route::get('/income', [UserIncomeController::class, 'Create'])->name('manager.income.create');
//     Route::post('/income/store', [UserIncomeController::class, 'Store'])->name('manager.income.store');
//     Route::get('/income/collection', [UserIncomeController::class, 'Collection'])->name('manager.income.collection');
//     Route::post('/income/collection/store/', [UserIncomeController::class, 'StoreCollection'])->name('manager.income.collection.store');

//     Route::get('/income/collection-voucher', [UserIncomeController::class, 'Index'])->name('manager.income.collection.index');
//     Route::post('/income/collection-all', [UserIncomeController::class, 'CollectionAll'])->name('manager.income.collection.all');

//     /*------------------------- income voucher route start here-------------------------*/
//     Route::get('/income/generate-voucher/{id}', [UserIncomeController::class, 'GenerateIncomeVoucher'])->name('manager.income.voucher.generate');
//     Route::post('/income/generate-voucher-all', [UserIncomeController::class, 'GenerateIncomeVoucherAll'])->name('manager.income.voucher.generateall');
//     /*------------------------- income voucher route ends here-------------------------*/

//     // account route start here 
//     Route::get('/ledger-posting', [AccountController::class, 'Index'])->name('manager.ledgerPosting.index');
//     Route::get('/ledger-posting/store', [AccountController::class, 'Store'])->name('manager.ledger-posting.store');

//     /*--------------- Accounts voucher route start here ------------------*/
//     // collection
//     Route::get('/income/collection-voucher', [AccountController::class, 'IndexCollection'])->name('manager.income.collection.index');
//     Route::post('/income/collection-all', [AccountController::class, 'CollectionAll'])->name('manager.income.collection.all');
//     //expense
//     Route::get('/account/expense-voucher', [AccountController::class, 'ExpenseIndex'])->name('manager.account.expense.index');
//     Route::post('/account/expense-all', [AccountController::class, 'ExpenseAll'])->name('manager.account.expense.all');
//     Route::post('/account/expense-voucher-all', [AccountController::class, 'GenerateExpenseVoucherAll'])->name('manager.account.expense.voucher.generateall');
//     //Balance sheet
//     Route::get('/account/balance', [AccountController::class, 'BalanceSheet'])->name('manager.account.balancesheet');
//     Route::post('/account/balance-all', [AccountController::class, 'AllBalanceSheet'])->name('manager.account.allbalancesheet');
//     Route::get('/income-statement', [AccountController::class, 'Incomes'])->name('manager.income.statement');

//     /*--------------- Accounts voucher route ends here ------------------*/

//     /*--------------- Report route start here ------------------*/
//     Route::get('/expenses/month', [UserReportController::class, 'MonthlyExpense'])->name('manager.expenses.month');
//     Route::post('/expenses-all/month', [UserReportController::class, 'MonthlyAllExpense'])->name('manager.expensesall.month');
//     Route::get('/expenses/yearly', [UserReportController::class, 'YearlyExpense'])->name('manager.expenses.year');
//     Route::post('/expenses-all/year', [UserReportController::class, 'YearlyAllExpense'])->name('manager.expensesall.year');

//     Route::get('/incomes/month', [UserReportController::class, 'MonthlyIncome'])->name('manager.incomes.month');
//     Route::post('/incomes-all/month', [UserReportController::class, 'MonthlyAllIncome'])->name('manager.incomesall.month');
//     Route::get('/incomes/yearly', [UserReportController::class, 'YearlyIncome'])->name('manager.incomes.year');
//     Route::post('/incomes-all/yearly', [UserReportController::class, 'YearlyAllIncome'])->name('manager.incomesall.year');

//     Route::get('/balance-sheet', [UserReportController::class, 'BalanceSheet'])->name('manager.blance.index');
//     /*--------------- Report route ends here ------------------*/

//     /*---------------- Manager route ends here ------------------*/

//     /*---------------- user route start here ------------------*/
//     Route::get('/single-user/paid', [UserIncomeController::class, 'SingleUserPaid'])->name('singleUser.paid');
//     Route::get('/single-user/due', [UserIncomeController::class, 'SingleUserDue'])->name('singleUser.due');
//     Route::get('/user/reset-password', [UserIncomeController::class, 'PasswordReset'])->name('user.password.reset');
//     Route::Post('/user/reset-password', [UserIncomeController::class, 'PasswordResetStore'])->name('user.password.reset.store');
//     /*---------------- user route ends here ------------------*/

//     /*---------------- User route ends here ------------------*/
// });



Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
