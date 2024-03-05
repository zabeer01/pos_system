@extends('master')
@section('content')
    <style>
        .sideBySide {
            display: inline-block;
            margin-right: 20px;
        }

        .imgSize {
            max-width: 100px;
            max-height: 100px;

        }

        .imgSize2 {
            max-width: 50px;
            max-height: 50px;

        }
    </style>

    {{--  @foreach ($collection as $item) --}}
    <div class="container">
        <div class="row ">
            <div class="col-7 ">
                @foreach ($products as $product)
                    <div class="sideBySide productContainer">
                        <h5 data-product-name="{{ $product->product_name }}">
                            {{ $product->product_name }}
                        </h5>



                        <img id="product_img" data-product-img="{{ $product->product_img }}"
                            src="{{ asset($product->product_img) }}" alt="Product Image" class="imgSize">


                        <br>
                        <p data-product-price="{{ $product->product_price }}" class="product_price">
                            {{ $product->product_price }} tk
                        </p>
                        <label class="form-check-label" for="flexCheckDefault">
                            <input type="checkbox" id="flexCheckDefault"> <!-- Checkbox added here -->
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="col-5">

                <div class="row table table-border" id="nextHtml">
                    <div class="col-2">
                        <p>#</p>
                    </div>
                    <div class="col-2">
                        <p>name</p>
                    </div>
                    <div class="col-2">
                        <p>price</p>
                    </div>
                    <div class="col-2">
                        <p>quantity</p>
                    </div>
                    <div class="col-2">
                        <p>subtotal</p>
                    </div>
                    <div class="col-2">
                        <p>actions</p>
                    </div>
                </div>

                <div>
                    <p>Total: <span id="total"></span></p>
                    <p>delivery charge: <span> 70 tk</span></p>
                    <p>vat: <span id="vat"></span></p>
                    <p>allTotal: <span id="allTotal"></span></p>
                </div> <br><br><br>
                <div>
                    <h3>shipping info</h3>
                    <div class="row">
                        <div class="col-75">
                            <div class="container">
                                <form action="/action_page.php">

                                    <div class="row">
                                        <div class="col-50">

                                            <label for="fname"><i class="fa fa-user"></i> Name</label>
                                            <input type="text" id="fname" name="firstname" placeholder="John M. Doe">
                                            <br>
                                            <label for="email"><i class="fa fa-envelope"></i> Email</label>
                                            <input type="text" id="email" name="email"
                                                placeholder="john@example.com"> <br>
                                            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                                            <input type="text" id="email" name="email" placeholder="">


                                </form>
                            </div>
                        </div>


                    </div>
                </div>
                <div>
                    <button class="btn btn-success  btn-sm">confirm order</button>
                </div>


            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var appendedProducts = []; // Array to track appended products

            function calculateSubtotal(productPrice, inputValue) {
                return productPrice * inputValue;
            }

            function updateTotal() {
                var total = 0;
                $(".subtotal").each(function() {
                    total += parseFloat($(this).text());
                });
                vat = total*(10/100) ; 
                allTotal = total + 70 +vat; 
               
                $("#total").text(total);
                $("#vat").text(vat);

                $("#allTotal").text(allTotal);
            }

            function generateRow(productImg, productName, productPrice, subtotal) {
                return `
            <div class="row">
                <div class="col-2">
                    <img src="${baseUrl}${productImg}" alt="Product Image" class="imgSize2">

                </div>
                <div class="col-2">
                    <p>${productName}</p>
                </div>
                <div class="col-2">
                    <p class="productPrice">${productPrice}</p>
                </div>
                <div class="col-2">
                    <input type="number" class="form-control productInputValue" name="product_quantity">
                </div>
                <div class="col-2">
                    <p class="subtotal">${subtotal}</p>
                </div>
                <div class="col-2">
                    <button class="btn btn-danger deleteRow btn-sm">Delete</button>
                </div>
            </div>`;
            }

            // Event listener for clicking on product container
            $(".productContainer").click(function() {
                var productName = $(this).find("h5").data("product-name");
                var productImg = $(this).find("#product_img").data("product-img");
                // Check if the product has already been appended
                if (appendedProducts.indexOf(productName) === -1) {
                    var productPrice = parseFloat($(this).find(".product_price").data("product-price"));

                    var html = generateRow(productImg, productName, productPrice,0); // Initial subtotal set to 0
                    $("#nextHtml").append(html);

                    // Add the product to the appendedProducts array
                    appendedProducts.push(productName);
                }
            });

            // Event listener for clicking on the delete button
            $(document).on("click", ".deleteRow", function() {
                // Get the product name from the row
                var productName = $(this).closest(".row").find("div:nth-child(2) p").text().trim();
   
                // Remove the row from the DOM
                $(this).closest(".row").remove();

                // Clear the entry from appendedProducts array
                var index = appendedProducts.indexOf(productName);
                if (index !== -1) {
                    appendedProducts.splice(index, 1);
                }

                // Update total after deleting a row
                updateTotal();
            });


            // Event listener for input field change
            $(document).on("input", ".productInputValue", function() {
                // Get the input value
                var inputValue = parseFloat($(this).val());

                // Get the product price from the same row
                var productPrice = parseFloat($(this).closest(".row").find(".productPrice").text());

                // Calculate subtotal
                var subtotal = calculateSubtotal(productPrice, inputValue);

                // Update the subtotal in the current row
                $(this).closest(".row").find(".subtotal").text(subtotal);

                // Update total
                updateTotal();
            });
        });
    </script>




    {{--   @endforeach --}}
@endsection
