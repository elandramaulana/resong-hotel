<!-- Invoice Detail  -->

<section  id="form-detail">
    <div class="container-fluid mt-4 mb-5 ">
        <div class="card">
            <div class="card-body text-dark">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Invoice Details</h2>
                </div>


            </div>
           
            <div class="container-fluid">
                <hr style="border-color: black; margin-left:-10px" class="col-12 mt-3 mb-2 border-bottom border-3">
            </div>


            <div class="container table-responsive">
                <table class="table" id="" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Product/Service</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody >
                        <tr>
                            <td style="margin-left: 20px;" >Room Standard Single</td>
                            <td>1/hari</td>
                            <td>Rp245.000</td>
                            <td>Rp245.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="container-fluid">
                <hr style="border-color: black; margin-left:-10px" class="col-12 mt-3 mb-2 border-bottom border-3">
            </div>
            

            <div class="container">
                    <form method="POST">
                        <div class="row">
                                <!-- Deposit -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Deposit:</label>
                                    <div class="col-sm-8">
                                        <input value="12" type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>
                                
                                <br>

                                <!-- Total -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Total:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>

                                <br>

                                <!-- Discount -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Discount:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName">
                                    </div>
                                </div>

                                <br>

                                <!-- Grand total -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Grand total:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>

                                <br>

                                <!-- Payment -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Payment:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName">
                                    </div>
                                </div>

                                <br>
                                
                                <!-- Change -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Change:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputName" disabled>
                                    </div>
                                </div>
                        </div>
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>