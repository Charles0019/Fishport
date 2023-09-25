    <?= $this->session->flashdata('register_customer'); ?>
    <?= $this->session->flashdata('register_customer_error'); ?>

    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h2>Product List</h2>
                        </div>
                        <div class="card-body" id="product-list" style="max-height: 400px; overflow-y: auto;">
                            <div class="row">
                                <?php foreach ($result as $product) { ?>
                                    <div class="col-md-6 mb-2">
                                        <div class="card product-card" data-product-name="<?php echo $product->product_name; ?>"
                                            data-product-image="<?php echo base_url('assets/images/' . $product->product_image); ?>">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php echo $product->product_name; ?>
                                                </h5>
                                                <img src="<?php echo base_url('assets/images/' . $product->product_image); ?>"
                                                    alt="<?php echo $product->product_name; ?>" class="img-fluid mb-3"
                                                    style="max-height: 100px;">
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--code for Selected products table-->
                <div class="col-md-6">
                    <div class="card shadow">
                        <div class="card-header">
                            <h2>Selected Products</h2> 
                        </div>
                        <div class="card-body">
                            <ul class="list-group" id="cart-items">
                                <!-- Cart items will be added here -->
                            </ul>
                            <div class="d-flex justify-content-between align-items-center">
                                <p>Total: ₱<span id="total">0.00</span></p>
                                <button type="button" class="btn btn-success" id="placeOrderButton" data-bs-toggle="modal"
                                    data-bs-target="#checkoutModal">Checkout</button>


                            </div>

                        </div>
                    </div>
                </div><!--end of code for Selected products table-->

            </div>
        </div>

        <!-- place /checkout for existing customer order Modal -->

        <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <!--toggle button for walking-->
                            <div class="form-check form-switch ms-auto">
                                <input class="form-check-input" type="checkbox" id="walkInToggle">
                                <label class="form-check-label" for="walkInToggle">Walk-In</label>
                            </div>
                            <!--end toggle button for walking-->
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customerName">
                        </div>
                        <div class="mb-3">
                            <label for="paymentMethod" class="form-label">Payment Method</label>
                            <select class="form-select" id="paymentMethod">
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Account Number">Account Number</option>
                            </select>
                        </div>
                        <p>Total Amount: ₱<span id="modalTotal">0.00</span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Place Order</button>
                    </div>
                </div>
            </div>
        </div><!-- end of place order Modal -->




        <!-- checkout for Walk-In Modal -->
        <div class="modal fade" id="walkInModal" tabindex="-1" aria-labelledby="walkInModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="walkInModalLabel">Walk-In Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="First Name" name="customer_fname"
                                value="<?php echo set_value('customer_fname'); ?>"
                                class="form-control <?php echo form_error('customer_fname') ? 'is-invalid' : ''; ?>">
                            <span style="color: red;">
                                <?php echo form_error('customer_fname'); ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" placeholder="Last Name" name="customer_lname"
                                value="<?php echo set_value('customer_lname'); ?>"
                                class="form-control <?php echo form_error('customer_lname') ? 'is-invalid' : ''; ?>">
                            <span style="color: red;">
                                <?php echo form_error('customer_lname'); ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" placeholder="Enter Contact NUmber" name="contact_no"
                                value="<?php echo set_value('contact_no'); ?>"
                                class="form-control <?php echo form_error('contact_no') ? 'is-invalid' : ''; ?>">
                            <span style="color: red;">
                                <?php echo form_error('contact_no'); ?>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="form-select" name="role" id="role" aria-label="Default select example">
                                <option selected hidden>Select Payment Methodological</option>
                                <option value="encoder">Cash</option>
                                <option value="cashier">Cash Account</option>
                                <option value="auditor">Cheque</option>
                            </select>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Place
                            Order</button>
                    </div>
                </div>
            </div>
        </div><!-- end of code for checkout for Walk-In Modal -->





        <!-- Modal for entering weight and price -->
        <div class="modal fade" id="itemModal" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemModalLabel">Enter Weight and Price for Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="itemForm">
                            <div class="mb-3">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="weight">Weight:</label>
                                <input type="text" class="form-control" id="weight" name="weight" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="addToCart">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of Modal for entering weight and price -->


        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                // Handle clicking on a product card
                $('.product-card').on('click', function () {
                    const productCard = $(this);
                    const productName = productCard.data('product-name');
                    const productImage = productCard.data('product-image');

                    // Reset the form fields and error message
                    $('#itemForm')[0].reset();
                    $('#validationError').text('');

                    // Set modal title and image
                    $('#itemModalLabel').text(`Enter Weight and Price for ${productName}`);
                    $('#itemModal img').attr('src', productImage);

                    // Store the selected product name in a data attribute
                    $('#addToCart').data('product-name', productName);

                    // Show the modal
                    $('#itemModal').modal('show');
                });

                // Handle adding to cart
                $('#addToCart').on('click', function () {
                    const weight = $('#weight').val();
                    const price = $('#price').val();
                    const productName = $('#addToCart').data('product-name');

                    // Validate the form fields
                    if (weight === '' || price === '') {
                        $('#validationError').text('Please fill in all fields.');
                        return; // Don't proceed if validation fails
                    }

                    // Calculate the total
                    const total = (parseFloat(weight) * parseFloat(price)).toFixed(2);

                    // Create a new list item for the cart
                    const listItem = `<li class="list-group-item">${productName} - Weight: ${weight}, Price: ${price}, Total: ₱${total}</li>`;

                    // Append the list item to the cart
                    $('#cart-items').append(listItem);

                    // Update the total in the cart
                    updateTotal();

                    // Close the modal and reset the form
                    $('#itemModal').modal('hide');
                    $('#itemForm')[0].reset();
                    $('#validationError').text('');
                });

                // Function to update the total in the cart
                function updateTotal() {
                    let total = 0.00;
                    $('#cart-items li').each(function () {
                        const itemText = $(this).text();
                        const itemTotal = parseFloat(itemText.split('Total: ₱')[1]);
                        total += itemTotal;
                    });

                    $('#total').text(total.toFixed(2));
                }
            });     

            // JavaScript code to update the modal's total amount
            document.getElementById('placeOrderButton').addEventListener('click', function () {
                // Get the total amount from the cart and update the modal
                var totalAmount = document.getElementById('total').textContent;
                document.getElementById('modalTotal').textContent = totalAmount;
            });

            // JavaScript code for toggling between Walk-In and Checkout Modals
            document.getElementById('walkInToggle').addEventListener('change', function () {
                if (this.checked) {
                    // If Walk-In is checked, show the Walk-In Modal
                    $('#walkInModal').modal('show');
                } else {
                    // If Walk-In is unchecked, show the Checkout Modal
                    $('#checkoutModal').modal('show');
                }
            });


            // JavaScript code for submitting the walk-in customer form
$('#customerForm').submit(function (event) {
    event.preventDefault(); // Prevent the default form submission

    $.ajax({
        type: 'POST',
        url: '<?= base_url('OrderController/placeOrder'); ?>', // Update the URL to point to your controller method
        data: $(this).serialize(),
        success: function (response) {
            // Handle the response from the server (e.g., show a success message)
            console.log(response);

            // Close the modal after successful submission
            $('#walkInModal').modal('hide');
        },
        error: function (xhr, status, error) {
            // Handle the error response, if needed
            console.error(xhr.responseText);
        }
    });
});

    
        </script>
    </body>