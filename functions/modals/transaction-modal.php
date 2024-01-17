<?php
include_once 'functions/views/get-data.php';
?>
<div class="modal fade" role="dialog" tabindex="-1" id="transaction">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Transaction</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="functions/transaction.php" method="post">
                    <div class="mb-3"><label class="form-label" for="first_name"><strong>Select Customer</strong></label><select class="selectpicker select" data-live-search="true" name="id">
                            <optgroup label="Select Customer">
                                <?php customer_list(); ?>
                            </optgroup>
                        </select>
                    </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="submit">Save</button></div>
            </form>
        </div>
    </div>
</div>