@extends('admin_dashboard')
@section('admin')
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .card-badge {
            display: flex;
            justify-content: space-between;
            margin: 0.5rem;
        }

        .out-of-stock-badge,
        .quantity-badge {
            background-color: #00cc00;
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            font-weight: bold;
            font-size: 12px;
        }

        .out-of-stock-badge {
            background-color: #ff0000;
        }


        .card-image {
            width: 100%;
            height: 150px;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
            overflow: hidden;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-text {
            font-size: 16px;
            color: #555;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            column-gap: 10px;
            row-gap: 10px;
            cursor: pointer;
        }

        .hidden {
            display: none;
        }


        .left-side-menu,
        .footer {
            display: none;
        }

        .content-page {
            margin-left: 0px;
        }

        .navbar-custom
        {
            display: none;
        }
        .content-page{
            margin-top: 0px;
        }
    </style>


    <div class="row mt-2 g-2">
        <div class="col-md-7">
            <div class="list-unstyled d-flex w-100">
                <a class="btn btn-primary btn-block m-1 category-filter" data-category="all" href="#">All</a>
                @foreach ($categories as $category)
                    <a class="btn btn-secondary btn-block m-1 category-filter" data-category="{{ $category->id }}"
                        href="#">{{ $category->category_name }}</a>
                @endforeach
            </div>
        </div>
        <div class="col-md-5 d-flex" style="align-items: center; justify-content:space-around">
            <a class="btn btn-primary btn-block m-1" data-category="all" href="/">Back</a>
            <li class="dropdown d-none d-lg-inline-block">
                <a  class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>

        </div>
    </div>



    <div class="row mt-2 g-2">
        <div class="col-md-7">

            <div class="cards g-2">
                @foreach ($products as $product)
                    <div class="card text-center product-card" data-category="{{ $product->category_id }}"
                        data-product-id="{{ $product->id }}" data-product-name="{{ $product->product_name }}"
                        data-product-saleprice="{{ $product->sale_price }}">
                        <div class="card-badge" style="position: absolute;">
                            <span data-quantity="{{ $product->quantity }}"
                                class="quantity-badge {{ $product->quantity <= 0 ? 'out-of-stock-badge' : '' }}">{{ $product->quantity }}
                            </span>
                        </div>
                        <div class="card-image">
                            <img class="p-2 card-img-top" src="{{ asset('upload/product/' . $product->product_image) }}"
                                alt="Card image cap">
                        </div>
                        <div class="card-body p-2">
                            <h5 class="card-title">{{ $product->product_name }}</h5>
                            <p class="card-text text-primary font-weight-bold">${{ $product->sale_price }}</p>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-5" style="positon:fixed;">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <p class="card-title">Select Customers</p>
                            <select class="form-select" aria-label="Default select example" id="customer_id">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <p class="card-title">Select Date</p>
                            <input type="date" class="form-control" id="date">
                        </div>
                    </div>
                    <h5 class="mt-4 card-title">Cart List</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Quantity</th>
                                <th scope="col">Sale Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cart-list">
                            <!-- Cart items will be added here dynamically -->
                        </tbody>
                    </table>
                    <div class="text-end d-flex">
                        <button style="display:none;" class="btn btn-primary m-1 checkout-btn" href="#">Check
                            Out</button>
                        <button style="display:none;" class="btn btn-danger m-1 clear-cart-btn">Clear Cart</button>
                    </div>
                    <div class="text-end mt-3">
                        <p class="fw-bold">Total Quantity: <span id="total-quantity">0</span></p>
                        <p class="fw-bold">Total Amount: $<span id="total-amount">0.00</span></p>
                    </div>
                </div>
            </div>
        </div>
        


    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryButtons = document.querySelectorAll('.category-filter');
            const productCards = document.querySelectorAll('.product-card');
            const cartList = document.getElementById('cart-list');
            const clearCartButton = document.querySelector('.clear-cart-btn');
            const checkoutButton = document.querySelector('.checkout-btn');
            const totalQuantityDisplay = document.getElementById('total-quantity');
            const totalAmountDisplay = document.getElementById('total-amount');

            let totalQuantity = 0;
            let totalAmount = 0.00;

            // Function to update total quantity and total amount
            function updateTotals() {
                totalQuantity = 0;
                totalAmount = 0.00;
                const cartItems = cartList.querySelectorAll('tr');
                cartItems.forEach(item => {
                    const quantity = parseInt(item.querySelector('.qty_button').innerHTML);
                    const salePrice = parseFloat(item.querySelector('.sale-price-input').value);
                    totalQuantity += quantity;
                    totalAmount += quantity * salePrice;
                });
                totalQuantityDisplay.textContent = totalQuantity;
                totalAmountDisplay.textContent = totalAmount.toFixed(2);

            }

            // Function to toggle visibility of the checkout and clear cart buttons
            function toggleButtonsVisibility() {
                if (totalQuantity > 0) {

                    checkoutButton.style.display = 'block';
                    clearCartButton.style.display = 'block';
                } else {
                    checkoutButton.style.display = 'none';
                    clearCartButton.style.display = 'none';
                }
            }

            categoryButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const selectedCategory = button.getAttribute('data-category');
            
                    
                    const audio = new Audio("{{asset('soundeffects/click.mp3')}}")
                        audio.play();

                    categoryButtons.forEach(btn => {
                        btn.classList.remove('btn-primary')
                        btn.classList.add('btn-secondary')
                    });

                    button.classList.add('btn-primary')
                    button.classList.remove('btn-secondary')


                    productCards.forEach(card => {
                        const cardCategory = card.getAttribute('data-category');
                        card.style.display = (selectedCategory === 'all' ||
                            selectedCategory === cardCategory) ? 'block' : 'none';
                    });
                });
            });
            

            productCards.forEach(card => {
                card.addEventListener('click', () => {
                    const productId = card.getAttribute('data-product-id');
                    const productName = card.getAttribute('data-product-name');
                    const productSalePrice = card.getAttribute('data-product-saleprice');
                    const productQuantityElem = card.querySelector('.quantity-badge')
                    const productQuantity = parseInt(card.querySelector('.quantity-badge')
                        .textContent);

                  

                    if (productQuantity > 0) {
                        const existingCartItem = Array.from(cartList.querySelectorAll('tr')).find(
                            item => {
                                return item.querySelector('td').textContent === productId;
                            });
                             
                        const audio = new Audio("{{asset('soundeffects/beep.wav')}}")
                        audio.play();

                        const quantityElem = card.querySelector('.quantity-badge');
                        quantityElem.innerHTML = parseInt(quantityElem.innerHTML) - 1;
                        if (existingCartItem) {
                            const button = existingCartItem.querySelector('.qty_button');
                            button.innerHTML = parseInt(button.innerHTML) + 1;
                        
                        } else {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                        <td>${productId}</td>
                        <td>${productName}</td>
                        <td class="quantity-cell">
                            <button class="btn btn-sm btn-primary quantity-minus">-</button>
                            <button class="btn btn-sm btn-success qty_button">1</button>
                            <button class="btn btn-sm btn-primary quantity-plus">+</button>
                        </td>
                        <td class="quantity-cell">
                            <input type="number" id="sale_price" class="sale-price-input" value="${productSalePrice}" style="width:120px; text-align:center;" >
                        </td>
                        <td><button class="btn btn-danger remove-from-cart"><i class="bi bi-trash"></i></button></td>
                        `;
                            cartList.appendChild(row);

                            const removeButton = row.querySelector('.remove-from-cart');
                            removeButton.addEventListener('click', (e) => {
                     
                                const audio = new Audio("{{asset('soundeffects/beep.wav')}}")
                                audio.play();

                                productQuantityElem.innerHTML = productQuantityElem
                                    .getAttribute('data-quantity')
                                cartList.removeChild(row);
                                updateTotals();
                                toggleButtonsVisibility();
                            });

                            const plusButton = row.querySelector('.quantity-plus');
                            plusButton.addEventListener('click', () => {
                                const button = row.querySelector('.qty_button');
                                if (parseInt(productQuantityElem.innerHTML) > 0) {
                                    button.innerHTML = parseInt(button.innerHTML) + 1;
                                    productQuantityElem.innerHTML = parseInt(
                                        productQuantityElem.innerHTML) - 1

                                         const audio = new Audio("{{asset('soundeffects/click.mp3')}}")
                                         audio.play();

                                } else {
                                    
                                    Toastify({
                                        text: productName + " is out of Stock",
                                        duration: 3000,
                                        newWindow: true,
                                        close: true,
                                        gravity: "top",
                                        position: "right",
                                        stopOnFocus: true,
                                        style: {
                                            background: "#DC4C64",
                                            width: "300px",
                                            display: 'flex',
                                            justifyContent: "space-between",
                                        },
                                        onClick: function() {}
                                    }).showToast();

                                  
                                }
                                updateTotals();
                            });

                            const minusButton = row.querySelector('.quantity-minus');
                            minusButton.addEventListener('click', () => {
                                const button = row.querySelector('.qty_button');
                                productQuantityElem.innerHTML = parseInt(productQuantityElem
                                    .innerHTML) + 1
                                if (parseInt(button.innerHTML) > 1) {
                                    button.innerHTML = parseInt(button.innerHTML) - 1;

                                    const audio = new Audio("{{asset('soundeffects/click.mp3')}}")
                                     audio.play();

                                } else {
                                    cartList.removeChild(row);
                                }
                                updateTotals();
                                toggleButtonsVisibility();
                            });

                            const salePriceInput = row.querySelector('.sale-price-input');
                            salePriceInput.addEventListener('keyup', () => {
                
                                const audio = new Audio("{{asset('soundeffects/keypress.mp3')}}")
                                audio.play();
                                updateTotals();
                            });
                        }
                        updateTotals();
                        toggleButtonsVisibility();
                        
                        Toastify({
                            
                            text: productName + " is added to cart",
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: "right",
                            stopOnFocus: true,
                            style: {
                                background: "#14A44D",
                                width: "300px",
                                display: 'flex',
                                justifyContent: "space-between",
                            },
                            onClick: function() {}
                        }).showToast();
                    } else {
                        const audio = new Audio("{{asset('soundeffects/error.mp3')}}")
                        audio.play();

                        Toastify({
                            text: productName + " is out of Stock",
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top",
                            position: "right",
                            stopOnFocus: true,
                            style: {
                                background: "#DC4C64",
                                width: "300px",
                                display: 'flex',
                                justifyContent: "space-between",
                            },
                            onClick: function() {}
                        }).showToast();

                    }
                });
            });

            clearCartButton.addEventListener('click', () => {
                cartList.innerHTML = ''; // Clear the cart
                totalQuantity = 0;
                totalAmount = 0.00;
                totalQuantityDisplay.textContent = totalQuantity;
                totalAmountDisplay.textContent = totalAmount.toFixed(2);

                const audio = new Audio("{{asset('soundeffects/click.mp3')}}")
                audio.play();

                for (let card of productCards) {
                    const productQuantityElem = card.querySelector('.quantity-badge')
                    productQuantityElem.innerHTML = productQuantityElem.getAttribute('data-quantity')
                }
                toggleButtonsVisibility();
            });

            checkoutButton.addEventListener('click', function() {
                // Create an array to store the product data
                var productList = [];

                // Loop through the cart items and extract product information
                const cartItems = cartList.querySelectorAll('tr');
                cartItems.forEach(item => {
                    const productId = item.querySelector('td').textContent;
                    const productName = item.querySelector('td:nth-child(2)').textContent;
                    const quantity = parseInt(item.querySelector('.qty_button').textContent);
                    const salePrice = parseFloat(item.querySelector('.sale-price-input').value);

                    // Create an object for each product and add it to the productList array
                    productList.push({
                        productId: productId,
                        productName: productName,
                        quantity: quantity,
                        salePrice: salePrice,
                    });
                });

                const customerId = document.getElementById('customer_id');
                const date = document.getElementById('date');
                const totalQuantityDisplay = document.getElementById('total-quantity');
                const totalAmountDisplay = document.getElementById('total-amount');
                const data = {
                    date: date.value,
                    customer_id: customerId.value,
                    total_quantity: totalQuantityDisplay.innerText,
                    total_amount: totalAmountDisplay.innerText,
                    stocks: productList
                }
                if (date.value) {

                    addData(data).then(res => {
                        console.log(JSON.parse(res))
                        const productCards = document.querySelectorAll('.product-card');
                        for (let item of productCards) {
                            const productId = item.getAttribute('data-product-id');
                            const soldQuantity = productList.find((item) => item.productId ==
                                productId)
                            if (soldQuantity) {
                                const quantityElem = item.querySelector('.quantity-badge')
                                // quantityElem.innerHTML = parseInt(quantityElem.innerHTML) -
                                //     parseInt(soldQuantity.quantity)
                                // quantityElem.getAttribute('data-quantity') = parseInt(quantityElem.innerHTML)
                                quantityElem.setAttribute('data-quantity', parseInt(quantityElem
                                    .innerHTML))
                            }
                        }
                        clearCard()
                        const newProductCards = document.querySelectorAll('.product-card');
                        const allproducts = []
                        for (let item of newProductCards) {
                            let data = {
                                id: item.getAttribute('data-product-id'),
                                name: item.getAttribute('data-product-name')
                            }
                            allproducts.push(data)
                        }
                        let tableData = '';
                        for (let stock of JSON.parse(res)['stocks']) {
                            tableData += `
                                <tr>
                                    <td>${stock.id}</td>
                                    <td>${stock.product_id}</td>
                                    <td>${allproducts.find((item) => item.id == stock.product_id).name}</td>
                                    <td>${stock.quantity}</td>
                                    <td>${stock.price}</td>
                                </tr>`;
                        }
                        const table = `
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Id</th>    
                                        <th>Product Name</th>
                                        <th>Product Quantity</th>
                                        <th>Product Price</th>
                                    </tr>    
                                </thead>
                                <tbody>${tableData}</tbody>
                            </table>
                            
                        `;
                        const newWindow = window.open("", "", "width=500,height=1000")
                        const data = `
                        <link rel="shortcut icon" href="http://127.0.0.1:8000/assets/images/favicon.ico">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css">
                        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
                        <link href="http://127.0.0.1:8000/assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
                        <link href="http://127.0.0.1:8000/assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
                        <link href="http://127.0.0.1:8000/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
                        <link href="http://127.0.0.1:8000/assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css" />
                        <link href="http://127.0.0.1:8000/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
                        <link href="http://127.0.0.1:8000/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
                        <link href="http://127.0.0.1:8000/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
                        <link href="http://127.0.0.1:8000/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
                        <link href="http://127.0.0.1:8000/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                        <link href="http://127.0.0.1:8000/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style"/>
                        <link href="http://127.0.0.1:8000/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
                            <div style="display: flex; justify-content: center; align-items: center">
                                <div style="width: 95%">${table}</div>
                                
                            </div>
                        `;
                        newWindow.document.write(data)
                        // let tableData = '';
                        // for (let stock of JSON.parse(res)['stocks']) {
                        //     tableData += `
                        //         <tr>
                        //             <td>${stock.product_id}</td>
                        //             <td>${stock.quantity}</td>
                        //             <td>${stock.price}</td>
                        //         </tr>`;
                        // }
                        // const newWindow = window.open("", "", "width=500,height=1000")
                        // const data = `<div style="display: flex; justify-content: center; align-items: center">
                        //     <div style="width: 200px; background-color: red">${tableData}</div>
                        //     </div>`;
                        // newWindow.document.write(data)
                    })
                } else {
                    date.focus();
                    Toastify({
                        text: " please select date",
                        duration: 3000,
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "right",
                        stopOnFocus: true,
                        style: {
                            background: "#DC4C64",
                            width: "300px",
                            display: 'flex',
                            justifyContent: "space-between",
                        },
                        onClick: function() {}
                    }).showToast();
                }
            });
        });


        function clearCard() {
            const cartList = document.getElementById('cart-list');
            const totalQuantityDisplay = document.getElementById('total-quantity');
            const totalAmountDisplay = document.getElementById('total-amount');
            const clearCartButton = document.querySelector('.clear-cart-btn');
            const checkoutButton = document.querySelector('.checkout-btn');

            cartList.innerHTML = '';
            totalQuantity = 0;
            totalAmount = 0.00;
            totalQuantityDisplay.textContent = totalQuantity;
            totalAmountDisplay.textContent = totalAmount.toFixed(2);

            if (totalQuantity > 0) {
                checkoutButton.style.display = 'block';
                clearCartButton.style.display = 'block';
            } else {
                checkoutButton.style.display = 'none';
                clearCartButton.style.display = 'none';
            }
        }

         addData = async (something) => {
            let headersList = {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }

            let bodyContent = JSON.stringify(something);

            let response = await fetch("http://127.0.0.1:8000/sale/store", {
                method: "POST",
                body: bodyContent,
                headers: headersList
            });
            let data = await response.text();

            return data
        }



    </script>
    {{-- <button onclick="addData()">Click</button> --}}
@endsection
