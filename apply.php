<?php

require_once('../../../init.php');
require_once('functions.php');

$currentUser = localAPI("GetAdminDetails");

if ($currentUser["result"] == "success") {

    $billables = array();
    $prices = array();
    $taxed = array();

    foreach ($_POST["billable"] as $billableid) {
        $billable = getBillable($billableid);
        $billables[] = $billable->description;
        $prices[] = $billable->amount;
        $taxed[] = true;
    }

    print_r($billables);
    print_r($prices);
    print_r($taxed);

    $result = localAPI("UpdateInvoice", array(
        'invoiceid' => $_POST["invoiceid"],
        'newitemdescription' => $billables,
        'newitemamount' => $prices,
        'newitemtaxed' => $taxed
    ));

    if (!$result["result"] == "success") {
        die("Could not apply billables to invoice.");
    }

    foreach ($_POST["billable"] as $billableid) {
        incrementBillableInvoices($billableid);
    }

    header("Location: /admin/invoices.php?action=edit&id=" . $_POST["invoiceid"]);

} else {
    die();
}
