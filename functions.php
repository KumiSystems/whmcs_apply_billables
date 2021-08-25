<?php

use WHMCS\Database\Capsule;

function getBillables($userid, $invoiced=false) {
    $billables = Capsule::table('tblbillableitems')
        ->where("userid", $userid);

    if (!$invoiced) {
        $billables = $billables->where("invoicecount", 0);
    }

    $billables = $billables->get();

    return $billables;
}

function getBillable($billableid) {
    $billables = Capsule::table('tblbillableitems')
        ->where("id", $billableid)
        ->get();

    foreach ($billables as $billable) {
            return $billable;
    }
}

function incrementBillableInvoices($billableid) {
    Capsule::table('tblbillableitems')
        ->where("id", $billableid)
        ->increment("invoicecount");
}