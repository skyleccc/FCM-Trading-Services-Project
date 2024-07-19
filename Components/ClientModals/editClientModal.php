    <!-- The Modal -->
    <div class="modal fade" id="editClientModal">
        <div class="modal-dialog">

                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Client Details</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="modal-container">
                            <form id="editClientForm" onsubmit="return validateFormEdit()">
                                <div class="form-group">
                                    <label for="editClientName">Client Name:</label>
                                    <input type="text" class="form-control" name="clientName" id="editClientName" placeholder="Enter Name of Client Here" required>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="editClientContact">Contact Number:</label>
                                        <input type="text" class="form-control" name="clientContact" id="editClientContact" placeholder="Enter Contact Number Here">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="editClientEmail">Email Address:</label>
                                        <input type="text" class="form-control" name="clientEmail" id="editClientEmail" placeholder="Enter Email Address Here">
                                    </div>
                                </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-success btn-block">Edit Client</button>
                        </form>
                     </div>

                </div>


            </div>
        </div>