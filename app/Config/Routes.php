<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/', 'Home::index');
$routes->post('ForgotPasswordController/sendResetLink', 'ForgotPasswordController::sendResetLink');

// $routes->get('Home', 'Home::index', ['filter' => 'auth']);

$routes->get('logout', 'Home::logout');

$routes->match(['get', 'post'], 'ExcelController/importExcelToDb', 'ExcelController::importExcelToDb');
$routes->match(['get', 'post'], 'agentindividualadmin/uploadindividualexcel', 'agentindividualadmin::uploadindividualexcel');

// 

$routes->group('restricted', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('home', 'home::logout');
    // Add other restricted routes here
});

$routes->group("admin", function ($routes) {
    $routes->get('home', 'admin::home', ['as' => 'admin.home']);
    $routes->get('view/(:num)', 'admin::view/$1', ['as' => 'admin.view']);
    $routes->get('bank', 'admin::bank_details', ['as' => 'admin.bank']);
    $routes->get('agent', 'admin::agent', ['as' => 'admin.agent']);
    $routes->get('staff', 'admin::staff', ['as' => 'admin.staff']);
    $routes->get('uploadmaster', 'admin::uploadmastersheet', ['as' => 'admin.uploadmaster']);
    $routes->get('viewmaster', 'admin::viewmaster', ['as' => 'admin.viewmaster']);
    $routes->get('assignagents', 'admin::assignagents', ['as' => 'admin.assignagents']);
    $routes->get('subagents', 'admin::subagents', ['as' => 'admin.subagents']);
    $routes->get('mis', 'admin::mis', ['as' => 'admin.mis']);
    $routes->get('gipv', 'admin::gipv', ['as' => 'admin.gipv']);
    $routes->get('empty', 'admin::empty', ['as' => 'admin.empty']);
    $routes->get('agentlist', 'admin::agentlist', ['as' => 'admin.agentlist']);
    $routes->get('agentinvoicereport', 'admin::agentinvoicereport', ['as' => 'admin.agentinvoicereport']);
    $routes->get('Agentmasterreport', 'admin::Agentmasterreport', ['as' => 'admin.Agentmasterreport']);
    $routes->get('bankmasterreport', 'admin::bankmasterreport', ['as' => 'admin.bankmasterreport']);
    $routes->get('lossearch', 'admin::lossearch', ['as' => 'admin.lossearch']);
    $routes->get('customersearch', 'admin::customersearch', ['as' => 'admin.customersearch']);
    $routes->get('bankbranch', 'admin::bankbranch', ['as' => 'admin.bankbranch']);
    $routes->get('datatable', 'admin::datatable', ['as' => 'admin.datatable']);
    $routes->get('gstreport', 'admin::gstreport', ['as' => 'admin.gstreport']);
    $routes->post('savedata', 'admin::savedata', ['as' => 'admin.savedata']);
    $routes->get('edit/(:num)', 'admin::edit/$1', ['as' => 'admin.edit']);
    $routes->post('update', 'admin::update', ['as' => 'admin.update']);
    $routes->post('delete/(:num)', 'admin::delete/$1', ['as' => 'admin.delete']);
    $routes->group('admin', ['filter' => 'auth'], function ($routes) {
        // Define your protected routes here
        $routes->get('home', 'admin::home');
        // Add other protected routes
    });



});

$routes->group("applicationReportController", function ($routes) {
    $routes->get('applicationreport', 'applicationReportController::applicationreport', ['as' => 'applicationReportController.applicationreport']);
    $routes->get('getEmailByAgentId/(:num)', 'applicationReportController::getEmailByAgentId/$1', ['as' => 'applicationReportController.getEmailByAgentId']);
    $routes->get('getApplicationReport', 'applicationReportController::getApplicationReport', ['as' => 'applicationReportController.getApplicationReport']);
    $routes->get('getAgent', 'applicationReportController::getAgent', ['as' => 'applicationReportController.getAgent']);
    $routes->post('getDataByAgentId', 'applicationReportController::getDataByAgentId', ['as' => 'applicationReportController.getDataByAgentId']);
    $routes->post('getDataByBankName', 'applicationReportController::getDataByBankName', ['as' => 'applicationReportController.getDataByBankName']);
    $routes->post('getDataByLosNoLike', 'applicationReportController::getDataByLosNoLike', ['as' => 'applicationReportController.getDataByLosNoLike']);
    $routes->post('getDataBetweenDatesLos', 'applicationReportController::getDataBetweenDatesLos', ['as' => 'applicationReportController.getDataBetweenDatesLos']);
    $routes->post('getDataByAgentAndLos', 'applicationReportController::getDataByAgentAndLos', ['as' => 'applicationReportController.getDataByAgentAndLos']);
    $routes->post('getDataByBankAndLos', 'applicationReportController::getDataByBankAndLos', ['as' => 'applicationReportController.getDataByBankAndLos']);
    $routes->post('getDataByfromToDateAndLos', 'applicationReportController::getDataByfromToDateAndLos', ['as' => 'applicationReportController.getDataByfromToDateAndLos']);
    $routes->post('getDataByAgentAndBank', 'applicationReportController::getDataByAgentAndBank', ['as' => 'applicationReportController.getDataByAgentAndBank']);
    $routes->post('getDataByAgentAndFromToDate', 'applicationReportController::getDataByAgentAndFromToDate', ['as' => 'applicationReportController.getDataByAgentAndFromToDate']);
    $routes->post('getDataByBankAndFromToDate', 'applicationReportController::getDataByBankAndFromToDate', ['as' => 'applicationReportController.getDataByBankAndFromToDate']);
    $routes->post('getDataByFromToLosAgent', 'applicationReportController::getDataByFromToLosAgent', ['as' => 'applicationReportController.getDataByFromToLosAgent']);
    $routes->post('getDataByBankLosAgent', 'applicationReportController::getDataByBankLosAgent', ['as' => 'applicationReportController.getDataByBankLosAgent']);
    $routes->post('getDataByBankAgentFromToDate', 'applicationReportController::getDataByBankAgentFromToDate', ['as' => 'applicationReportController.getDataByBankAgentFromToDate']);
    $routes->post('getDataByBankLosFromToDate', 'applicationReportController::getDataByBankLosFromToDate', ['as' => 'applicationReportController.getDataByBankLosFromToDate']);
    $routes->post('getAllData', 'applicationReportController::getAllData', ['as' => 'applicationReportController.getAllData']);
    $routes->get('exportsToExcel', 'applicationReportController::exportsToExcel', ['as' => 'applicationReportController.exportsToExcel']);
    $routes->get('exportToExcel', 'applicationReportController::exportToExcel', ['as' => 'applicationReportController.exportToExcel']);
    $routes->get('export', 'applicationReportController::export', ['as' => 'applicationReportController.export']);
    $routes->get('getAgentEmail', 'applicationReportController::getAgentEmail', ['as' => 'applicationReportController.getAgentEmail']);
    $routes->post('sendEmailToAgents', 'applicationReportController::sendEmailToAgents', ['as' => 'applicationReportController.sendEmailToAgents']);

});


$routes->group("agentadmin", function ($routes) {
    $routes->post('view', 'agentadmin::view', ['as' => 'agentadmin.view']);
    $routes->post('checkEmail', 'agentadmin::checkEmail', ['as' => 'agentadmin.checkEmail']);
    $routes->get('display', 'agentadmin::display', ['as' => 'agentadmin.display']);
    $routes->get('agentlistdiplay', 'agentadmin::agentlistdisplay', ['as' => 'agentadmin.agentlistdisplay']);
    $routes->post('insert', 'agentadmin::insert', ['as' => 'agenadmin.insert']);
    $routes->post('insertsubagent', 'agentadmin::insertsubagent', ['as' => 'agenadmin.insertsubagent']);
    $routes->get('agent', 'agentadmin::agent', ['as' => 'agentadmin.agent']);
    $routes->get('edit/(:num)', 'agentadmin::edit/$1', ['as' => 'agentadmin.edit']);
    $routes->post('getsubagentdetails', 'agentadmin::getSubAgentDetails', ['as' => 'agentadmin/getsubagentdetails']);
    $routes->post('update', 'agentadmin::update', ['as' => 'agentadmin.update']);
    $routes->post('updatesubagent', 'agentadmin::updatesubagent', ['as' => 'agentadmin.updatesubagent']);
    $routes->post('delete/(:num)', 'agentadmin::delete/$1', ['as' => 'agentadmin.delete']);
    $routes->post('deletesubagent/(:num)', 'agentadmin::deletesubagent/$1', ['as' => 'agentadmin.deletesubagent']);
    $routes->get('subagent', 'agentadmin::subagent', ['as' => 'agentadmin.subagent']);
    $routes->post('getSubAgent', 'agentadmin::getSubAgents', ['as' => 'agentadmin.getSubAgent']);
    $routes->post('getsubagentedit/(:num)', 'agentadmin::getsubagentedit/$1', ['as' => 'agentadmin.getsubagentedit']);
    // $routes->get('getsubagentdetails', 'agentadmin::getsubagentdetails', ['as'=> 'agentadmin.getsubagentdetails']);
    $routes->post('getSubAgentDetails', 'agentadmin::getSubAgentDetails', ['as' => 'agentadmin/getSubAgentDetails']);
    $routes->get('exportToExcel', 'agentadmin::exportToExcel', ['as' => 'agentadmin.exportToExcel']);

});

$routes->group("phpmail", function ($routes) {
    $routes->get('index', 'phpmail::index', ['as' => 'phpmail.index']);
    $routes->post('submitForm', 'phpmail::submitForm', ['as' => 'phpmail.submitForm']);

});

$routes->group("gstController", function ($routes) {
    $routes->post('comparedates', 'gstController::comparedates', ['as' => 'gstController.comparedates']);
    $routes->get('exportToExcel', 'gstController::exportToExcel', ['as' => 'gstController.exportToExcel']);
    // $routes->get('downloadExcel','gstController::downloadExcel',['as=>'gstController.downloadExcel']);
});

$routes->group("staffadmin", function ($routes) {
    $routes->get('display', 'staffadmin::display', ['as' => 'staffadmin.display']);
    $routes->post('insert', 'staffadmin::insert', ['as' => 'staffadmin.insert']);
    $routes->get('edit/(:num)', 'staffadmin::edit/$1', ['as' => 'staffadmin.edit']);
    $routes->post('update', 'staffadmin::update', ['as' => 'staffadmin.update']);
    $routes->post('delete/(:num)', 'staffadmin::delete/$1', ['as' => 'staffadmin.delete']);
});

$routes->group('Miscontroller', function ($routes) {
    $routes->get('bankdisplay', 'Miscontroller::bankdisplay', ['as' => 'Miscontroller.bankdisplay']);
    $routes->get('getAgentBank', 'Miscontroller::getAgentBank', ['as' => 'Miscontroller.getAgentBank']);
    $routes->get('getAgentName/(:segment)', 'Miscontroller::getAgentName/$1', ['as' => 'Miscontroller.getAgentName']);
    $routes->get('editmis/(:segment)', 'Miscontroller::editmis/$1', ['as' => 'Miscontroller.editmis']);
    $routes->post('getAgentData', 'Miscontroller::getAgentData', ['as' => 'Miscontroller.getAgentData']);
    $routes->post('comparedate', 'Miscontroller::comparedate', ['as' => 'Miscontroller.comparedate']);
    $routes->post('getPayoutPercentage', 'Miscontroller::getPayoutPercentage', ['as' => 'Miscontroller.getPayoutPercentage']);
    $routes->post('updateMis', 'Miscontroller::updateMis', ['as' => 'Miscontroller.updateMis']);
    $routes->post('getDataByAgentFromToDate', 'Miscontroller::getDataByAgentFromToDate', ['as' => 'Miscontroller.getDataByAgentFromToDate']);
    $routes->post('updateAgentGrossPayout', 'Miscontroller::updateAgentGrossPayout', ['as' => 'Miscontroller.updateAgentGrossPayout']);
    $routes->get('exportToExcel', 'Miscontroller::exportToExcel', ['as' => 'Miscontroller.exportToExcel']);
});

$routes->group("agentindividualadmin", function ($routes) {
    $routes->get('displayagent', 'agentindividualadmin::displayagent', ['as' => 'agentindividualadmin.displayagent']);
    $routes->get('getagent/(:segment)', 'agentindividualadmin::getagent/$1', ['as' => 'agentindividualadmin.getagent']);
    $routes->get('download_excel', 'agentindividualadmin::download_excel', ['as' => 'agentindividualadmin.download_excel']);
});
$routes->group("ExcelController", function ($routes) {
    $routes->post('comparedates', 'ExcelController::comparedates', ['as' => 'ExcelController.comparedates']);
    $routes->get('viewmaster', 'ExcelController::viewmastersheet', ['as' => 'ExcelController.viewmaster']);
    $routes->get('agentname', 'ExcelController::agentname', ['as' => 'ExcelController.agentname']);
    $routes->post('getAgentData', 'ExcelController::getAgentData', ['as' => 'ExcelController.getAgentData']);
    $routes->post('assignagent', 'ExcelController::assignagent', ['as' => 'ExcelController.assignagent']);
    $routes->post('getBankData', 'ExcelController::getBankData', ['as' => 'ExcelController.getBankData']);
    $routes->get('getdatabyid/(:num)', 'ExcelController::getdatabyid/$1', ['as' => 'ExcelController.getdatabyid']);
    // $routes->get('getdatabyid/(:num)', 'ExcelController::getdatabyid/$1',['as' =>'ExcelController.getdatabyid']);
    $routes->post('updateExecutive', 'ExcelController::updateExecutive', ['as' => 'ExcelController.updateExecutive']);
    $routes->post('sendEmailToAgents', 'ExcelController::sendEmailToAgents', ['as' => 'ExcelController.sendEmailToAgents']);
    $routes->get('getUpdatedData', 'ExcelController::getUpdatedData', ['as' => 'ExcelController.getUpdatedData']);
    $routes->get('index', 'ExcelController::index', ['as' => 'ExcelController.index']);
    $routes->get('fetchtabledata', 'ExcelController::fetchtabledata', ['as' => 'ExcelController.fetchtabledata']);
    $routes->get('download_excel', 'ExcelController::download_excel', ['as' => 'ExcelController.download_excel']);
});
// $routes->get('/', 'admin::home');

$routes->group("paymentcontroller", function ($routes) {
    $routes->get('editLoan/(:segment)', 'paymentcontroller::editLoan/$1', ['as' => 'paymentcontroller.editLoan']);
    $routes->get('issueCapital', 'paymentcontroller::issueCapital', ['as' => 'paymentcontroller.issueCapital']);
    $routes->post('loanupdate', 'paymentcontroller::loanupdate', ['as' => 'paymentcontroller.loanupdate']);
    $routes->post('delete/(:num)', 'paymentcontroller::delete/$1', ['as' => 'paymentcontroller.delete']);
    $routes->get('payment_display', 'paymentcontroller::payment_display', ['as' => 'paymentcontroller.payment_display']);
    $routes->post('insertPayment', 'paymentcontroller::insertPayment', ['as' => 'paymentcontroller.insertPayment']);
    $routes->post('insertLoan', 'paymentcontroller::insertLoan', ['as' => 'paymentcontroller.insertLoan']);
    $routes->get('getAgentName/(:segment)', 'paymentcontroller::getAgentName/$1', ['as' => 'paymentcontroller.getAgentName']);
    $routes->post('getAgentData', 'paymentcontroller::getAgentData', ['as' => 'paymentcontroller.getAgentData']);
    $routes->post('getData', 'paymentcontroller::getData', ['as' => 'paymentcontroller.getData']);
    $routes->get('exportToExcel', 'paymentcontroller::exportToExcel', ['as' => 'paymentcontroller.exportToExcel']);
    $routes->post('insertEmi', 'paymentcontroller::insertEmi', ['as' => 'paymentcontroller.insertEmi']);
    $routes->post('getpayableAmount', 'paymentcontroller::getpayableAmount', ['as' => 'paymentcontroller.getpayableAmount']);
    $routes->get('payment', 'paymentcontroller::paymentdetails', ['as' => 'paymentcontroller.payment']);
    $routes->get('edit/(:num)', 'paymentcontroller::edit/$1', ['as' => 'paymentcontroller.edit']);
    $routes->post('update', 'paymentcontroller::update', ['as' => 'paymentcontroller.update']);
    $routes->post('deletepayment/(:num)', 'paymentcontroller::deletepayment/$1', ['as' => 'paymentcontroller.deletepayment']);
});

$routes->group("generateinvoicecontroller", function ($routes) {
    $routes->get('agentdetails', 'generateinvoicecontroller::AgentDetails', ['as' => 'generateinvoicecontroller.agentdetails']);
    $routes->get('getAgentData/(:segment)', 'generateinvoicecontroller::getAgentData/$1', ['as' => 'generateinvoicecontroller.getAgentData']);
    $routes->get('getCommissionAmount/(:segment)/(:any)', 'generateinvoicecontroller::getCommissionAmount/$1/$2', ['as' => 'generateinvoicecontroller.getCommissionAmount']);
});

$routes->group("agentwisecontroller", function ($routes) {
    $routes->get('agentLoanReports', 'agentwisecontroller::agentLoanReports', ['as' => 'agentwisecontroller.agentLoanReports']);
    $routes->post('getAgentName', 'agentwisecontroller::getAgentName', ['as' => 'agentwisecontroller.getAgentName']);
    $routes->post('getAgentLoanData', 'agentwisecontroller::getAgentLoanData', ['as' => 'agentwisecontroller.getAgentLoanData']);
    $routes->get('agentname', 'agentwisecontroller::agentname', ['as' => 'agentwisecontroller.agentname']);
    $routes->get('bankname', 'agentwisecontroller::bankname', ['as' => 'agentwisecontroller.bankname']);
    $routes->get('lossheet', 'agentwisecontroller::lossheet', ['as' => 'agentwisecontroller.lossheet']);
    $routes->get('customersheet', 'agentwisecontroller::customersheet', ['as' => 'agentwisecontroller.customersheet']);
    $routes->get('branchsheet', 'agentwisecontroller::branchsheet', ['as' => 'agentwisecontroller.branchsheet']);
    $routes->post('comparedate', 'agentwisecontroller::comparedate', ['as' => 'agentwisecontroller.comparedate']);
    $routes->get('exportToExcel', 'agentwisecontroller::exportToExcel', ['as' => 'agentwisecontroller.exportToExcel']);

});

$routes->group("agentinvoice", function ($routes) {
    // app/Config/Routes.php

    $routes->get('agentinvoice/generateAndSaveInvoice', 'agentinvoice::generateAndSaveInvoice');
    $routes->get('generateAndSaveInvoice', 'agentinvoice::generateAndSaveInvoice', ['as' => 'agentinvoice.generateAndSaveInvoice']);
    $routes->get('display', 'agentinvoice::display', ['as' => 'agentinvoice.display']);
    $routes->get('agentInvoice', 'agentinvoice::agentInvoice', ['as' => 'agentinvoice.agentInvoice']);
    $routes->post('agentInvoice', 'agentinvoice::agentInvoice', ['as' => 'agentinvoice.agentInvoice']);
    $routes->post('comparedates', 'agentinvoice::comparedates', ['as' => 'agentinvoice.comparedates']);
    $routes->post('getInvoiceData', 'agentinvoice::getInvoiceData', ['as' => 'agentinvoice.getInvoiceData']);
    $routes->post('getSubAgentName', 'agentinvoice::getSubAgentName', ['as' => 'agentinvoice.getSubAgentName']);
    $routes->post('getGstNo', 'agentinvoice::getGstNo', ['as' => 'agentinvoice.getGstNo']);
    $routes->post('insertInvoice', 'agentinvoice::insertInvoice', ['as' => 'agentinvoice.insertInvoice']);
    $routes->post('checkDuplicateData', 'agentinvoice::checkDuplicateData', ['as' => 'agentinvoice.checkDuplicateData']);
    $routes->post('comparedate', 'agentinvoice::comparedate', ['as' => 'agentinvoice.comparedate']);
    $routes->post('getRowData/(:num)', 'agentinvoice::getRowData/$1', ['as' => 'agentinvoice.getRowData']);
    $routes->post('insertdata', 'agentinvoice::insertdata', ['as' => 'agentinvoice.insertdata']);
    $routes->post('checkDataExist', 'agentinvoice::checkDataExist', ['as' => 'agentinvoice.checkDataExist']);
    $routes->post('checkDataExists', 'agentinvoice::checkDataExists', ['as' => 'agentinvoice.checkDataExists']);
    $routes->get('exportToExcel', 'agentinvoice::exportToExcel', ['as' => 'agentinvoice.exportToExcel']);
    $routes->get('taxinvoice', 'agentinvoice::taxinvoice', ['as' => 'agentinvoice.taxinvoice']);
    $routes->post('sendEmail', 'agentinvoice::sendEmail', ['as' => 'agentinvoice.sendEmail']);
    $routes->post('savePdf', 'agentinvoice::savePdf', ['as' => 'agentinvoice.savePdf']);
    $routes->post('savePdfAndSendEmail', 'agentinvoice::savePdfAndSendEmail', ['as' => 'agentinvoice.savePdfAndSendEmail']);
    $routes->post('downloadPdf', 'agentinvoice::downloadPdf', ['as' => 'agentinvoice.downloadPdf']);
    $routes->post('generateAndSavePdf', 'agentinvoice::generateAndSavePdf', ['as' => 'agentinvoice.generateAndSavePdf']);
    $routes->post('savePdfAndSendEmail', 'agentinvoice::savePdfAndSendEmail', ['as' => 'agentinvoice.savePdfAndSendEmail']);







});

$routes->group("bankInvoice", function ($routes) {
    $routes->get('display', 'bankInvoice::display', ['as' => 'bankInvoice.display']);
    $routes->post('getagent', 'bankInvoice::getagent', ['as' => 'bankInvoice.getagent']);
});
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */