<div class="modal fade" role="dialog" tabindex="-1" id="transaction">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Transaction</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3"><label class="form-label" for="first_name"><strong>Select Customer</strong></label><select class="form-select" name="id">
                                <optgroup label="Select Customer">
                                    <option value="12" selected="">Juanito</option>
                                </optgroup>
                            </select></div>                     
                    </form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-target="#transaction-1" data-bs-toggle="modal">New Customer</button><button class="btn btn-primary" type="button">Save</button></div>
            </div>
        </div>
    </div>
    
<div class="modal fade" role="dialog" tabindex="-1" id="transaction-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Transaction</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3"><label class="form-label" for="first_name"><strong>Firstname</strong></label><input class="form-control" type="text" name="firstname" placeholder="Fristname" required=""></div>
                        </div>
                        <div class="col">
                            <div class="mb-3"><label class="form-label" for="last_name"><strong>Type</strong></label><input class="form-control" type="text" name="lastname" placeholder="Lastname" required=""></div>
                        </div>
                    </div>
                    <div class="mb-3"><label class="form-label" for="first_name"><strong>Address</strong></label><input class="form-control" type="text" name="address" placeholder="Address" required=""></div>
                    <div class="mb-3"><label class="form-label" for="first_name"><strong>Contact No.</strong></label><input class="form-control" type="text" name="contact" placeholder="Contact" required="" minlength="11" maxlength="11"></div>
                </form>
            </div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-target="#transaction" data-bs-toggle="modal">Already Registered?</button><button class="btn btn-primary" type="button">Save</button></div>
        </div>
    </div>
</div>