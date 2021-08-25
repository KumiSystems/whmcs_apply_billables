<?php

require_once("functions.php");

add_hook('AdminInvoicesControlsOutput', 99, function($vars) {
    $billables = getBillables($vars["userid"]);
    print('<br><input type="button" value="Apply Billable Items" onclick="jQuery(\'#applyBillables\').modal(\'show\');" class="button btn btn-default">');
    print('<div class="modal fade" id="applyBillables" tabindex="-1" role="dialog" aria-labelledby="applyBillablesLabel" aria-hidden="true" style="display: none;">
    <form method="post" action="../modules/addons/whmcs_apply_billables/apply.php">
        <input type="hidden" name="invoiceid" value="' . $vars["invoiceid"] . '" class="id-target">
        <div class="modal-dialog">
            <div class="modal-content panel panel-primary">
                <div class="modal-header panel-heading">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Select Billable Items</h4>
                </div>
                <div class="modal-body panel-body">
                <table>
                <tr>
                    <th></th>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Hours</th>
                    <th>Amount</th>
                </tr>
');

foreach ($billables as $billable) {
    print('
                    <tr>
                        <td><input type="checkbox" name="billable[]" value="' . $billable->id . '"></td>
                        <td>' . $billable->id . '</td>
                        <td>' . $billable->description . '</td>
                        <td>' . $billable->hours . '</td>
                        <td>' . $billable->amount . '</td>
                    </tr>
    ');
};

print('
            </table>

                </div>
                <div class="modal-footer panel-footer">
                    <button type="button" id="doDeleteClient-cancel" class="btn btn-default" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" id="doDeleteClient-ok" class="btn btn-primary">
                        OK
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>');
});
