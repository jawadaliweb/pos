@extends('admin_dashboard')
@section('admin')
    <div class="content">
        <style>
          button.btn.btn-danger.remove-product {
                width: 32px;
                padding: 0px;
                margin-left: 98.5%;
                margin-top: 35px;
                position: absolute;

            }
        </style>
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row mt-4">

                <div class="col-12">

                    <form method="POST" action="{{route('product.purchase')}}">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="modal-body p-2">
                                    <div class="row pb-2 ">

                                        <div class="col-md-6  ">
                                            <div class="mb-3">
                                                <label for="field-1" class="form-label">Select Suppliers</label>
                                                <select name="supplier_id" class="form-select"
                                                    aria-label="Default select example">
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">
                                                            {{ $supplier->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6  ">
                                            <div class="mb-3">
                                                <label for="field-1" class="form-label">Select Date</label>
                                                <input type="date" id="date" name="date" class="form-control"
                                                    placeholder="Select your birthdate" required>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row pt-3 pb-3 product-section" style="border-top: 1px solid black;" id="">

                                        <div class="col-md-3">
                                            <div>
                                                <label for="product" class="form-label">Product Name</label>
                                                <select name="product_id[]" class="form-select product_names"
                                                    aria-label="Default select example">
                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">
                                                            {{ $product->product_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div>
                                                <label for="total_quantity[]" class="form-label">Quantity</label>
                                                <input type="number" name="total_quantity[]" class="form-control">
                                            </div>
                                        </div>

                                      
                                        <div class="col-md-3    ">
                                            <div>
                                                <label for="price" class="form-label">Price</label>
                                                <input type="text" name="price[]" class="form-control">
                                            </div>
                                        </div>

                                       

                                        <div style="width: 23%;" class="col-md-3">
                                            <div>
                                                <label for="discount" class="form-label">Discount</label>
                                                <input type="text" name="discount[]" class="form-control">
                                            </div>
                                        </div>
                                        <!-- Add a "Remove" button to remove this field group -->
                                    </div>



                                    <a class="btn btn-primary" id="add-product"
                                        style="border-radius: 50%; margin-left:50%; margin-right:50%;">+</a>


                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-info waves-effect waves-light" id="save-changes">Save changes</button>
                                </div>


                                <script>
                                    const productData = []; // Array to store product data
                                
                                    document.getElementById('add-product').addEventListener('click', function() {
                                        // const productSection = document.getElementById('product-section');
                                        const productSections = document.querySelectorAll('.product-section');
                                        const productSection = productSections[productSections.length - 1]
                                        const product_select_element = productSection.querySelector('.product_names')

                                        if (product_select_element.value) {
                                            
                                            
                                            const productClone = productSection.cloneNode(true);
                                                const inputFields = productClone.querySelectorAll('input, select');
                                                inputFields.forEach(function(input) {
                                                    input.value = '';
                                            });
                                            const selected_product_values = productClone.querySelector('.product_names')
                                            selected_product_values.readonly = ""

                                            for (let item of selected_product_values.children) {
                                                if (item.value == product_select_element.value) {
                                                    item.remove()
                                                }
                                            }
                                            
                                            if (selected_product_values.children.length) {
                                                product_select_element.readonly = 'readonly'
                                                const removeButton = document.createElement('button');
                                                removeButton.className = 'btn btn-danger remove-product';
                                                removeButton.innerHTML = '&#128465'; // HTML entity for trash icon
                                                
                                                productClone.appendChild(removeButton);
                                                productSection.parentNode.insertBefore(productClone, document.getElementById('add-product'));
                                            }
                                        }
                                    });
                                
                                    // Add event listener to remove a product field group
                                    document.addEventListener('click', function(event) {
                                        if (event.target.classList.contains('remove-product')) {
                                            event.target.parentNode.previousElementSibling.querySelector('.product_names').readonly = ""
                                            event.target.parentNode.remove();
                                        }
                                    });
                                
                                    document.getElementById('save-changes').addEventListener('click', function() {
                                        // Reset productData array to store the new data
                                        productData.length = 0;
                                
                                        // Collect and store data from all product sections
                                        const productSections = document.querySelectorAll('.row#product-section');
                                
                                        productSections.forEach(function(section, index) {
                                            const inputFields = section.querySelectorAll('input, select');
                                            const product = { form: index + 1 };
                                
                                            inputFields.forEach(function(input) {
                                                product[input.name] = input.value;
                                            });
                                
                                            productData.push(product);
                                        });
                                
                                        // Display the data in the console
                                        console.log(productData);
                                    });
                                </script>

                    </form>
                </div>
            </div> <!-- end card -->
        </div><!-- end col-->
    </div> <!-- container -->
    </div> <!-- content -->
@endsection
