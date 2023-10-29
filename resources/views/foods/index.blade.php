    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ"
        crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
        crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css"
        integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<link href="{{ url('css/homepage.css') }}" rel="stylesheet">


    <div class="row home-content">
            <div class="col-lg-2">
                <div class="menu-container">
                    <div class="food-order-header menu-header-container">
                        <img class="shop-logo" src="https://cdn-icons-png.flaticon.com/512/3787/3787263.png">
                        <h3 class="shop-name">Hang Nom</h3>
                    </div>
                    <div class="menu-content">
                        

                        <div class="menu-item">
                            <img class="category-image" src="https://w7.pngwing.com/pngs/848/762/png-transparent-computer-icons-home-house-home-angle-building-rectangle-thumbnail.png" alt="">
                            <a href="">Homepage</a>
                        </div>
                        <div class="menu-item">
                            <img class="category-image" src="https://static.thenounproject.com/png/3014257-200.png" alt="">
                            <a href="{{ url('item_management') }}">Item Management</a>
                        </div>

                        
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row food-category">
                    <div class="col-lg-12">
                        <div class="category-items-container">
                            <div class="category-item">
                                <img class="category-image" src="https://cdn-icons-png.flaticon.com/512/5787/5787100.png" alt="">
                                <a href="/">All item</a>
                            </div>
                            <div class="category-item">
                                <img class="category-image" src="https://img.freepik.com/premium-vector/delicious-burger-icon-food-beverages_22052-1.jpg?w=740" alt="">
                                <a href="/GetItem/Burger">Burger</a>
                            </div>
                            <div class="category-item">
                                <img class="category-image" src="https://w7.pngwing.com/pngs/712/706/png-transparent-pizza-food-icon.png" alt="">
                                <a href="/GetItem/Pizza">Pizza</a>
                            </div>
                            <div class="category-item">
                                <img class="category-image" src="https://img.lovepik.com/free_png/32/44/58/77758PICFabbK171g5406_PIC2018.png_300.png" alt="">
                                <a href="/GetItem/Drink">Drink</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row food-items">
                    @foreach($data as $item)
                    <div class="col-lg-3">
                    <form action="{{ url('add_tocart') }}" method="post">
                        @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <div class="food-card">
                                <div class="food-image-container">
                                    <img class="food-image" src="../images/{{ $item->image }}"
                                        alt="food-item">
                                </div>
                                <div class="food-info-container">
                                    <p class="foodname">{{ $item-> food_name}}</p>
                                    <p class="foodprice">{{ $item-> price}}$</p>
                                </div>
                                <div class="food-card-footer">
                                    <button class="btn btn-add-card" type="submit">Add</button>
                                </div>
                            </div>
                    </form>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 order-container">
                <div class="food-order-header">
                    <h3>New Order Item</h3>
                </div>
                <div class="food-order">
                    <!-- ===== -->

                    @php $total = 0; $vat = 0; $subtotal= 0; @endphp
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @php $subtotal += $details['price'] * $details['quantity'];
                            $vat = $subtotal/10;
                            $total = $subtotal + $vat;
                            @endphp

                            <div class="col-lg-12 order-item">
                        <div class="col-lg-3">
                            <img class="order-image" src="../images/{{ $details['image'] }}">
                        </div>
                        <div class="col-lg-6">
                            <p>${{ $details['product_name'] }}</p>
                            <p>${{ $details['price'] }} </p>

                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <div class="increment-container">
                                    <form action="{{ url('decrease_fromcart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $details['id'] }}">
                                    <button class="btn" type="submit">-</button>
                                    </form>
                                    <p class="order-unit">{{ $details['quantity'] }}</p>
                                    <form action="{{ url('add_tocart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $details['id'] }}">
                                    <button class="btn" type="submit">+</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="remove-item-container">
                                    <form action="{{ url('remove_fromcart') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $details['id'] }}">
                                        <input type="submit" class="remove-item" value="remove">

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                        @endforeach
                    @endif
        <!-- ========= -->



                </div>

                <div class="order-info">
                    <div class="price-container">
                        <p class="info-label">Sub Total</p>
                        <p class="price-label">$ {{$subtotal}}</p>
                    </div>
                    <div class="price-container">
                        <p class="info-label">Tax 10% (VAT included)</p>
                        <p class="price-label">$ {{$vat}}</p>
                    </div>
                    <div class="price-container total-container">
                        <p class="total-label">Total</p>
                        <p class="total-price-label">$ {{$total}}</p>
                    </div>
                </div>
                <div class="order-btn-container">
                    <form action="{{ url('placeorder') }}" method="post">
                        <input type="hidden" value="{{$subtotal}}" name="subtotal">
                        @csrf
                        <button type="submit" class="btn btn-order" id="btn_order">Place Order</button>
                    </form>
                </div>
            </div>
    </div>
    @if(session('purchase'))
    @php $total = session('purchase') + (session('purchase')/10); @endphp
    <div class="Receipt alert" id="Receipt">
        <div class="close-receipt-container">
            <button class="btn btn-danger" id="close-receipt">X</button>
        </div>
        <div class="order-info">
            <div class="price-container">
                <p class="info-label">Sub Total</p>
                <p class="price-label">$ {{session('purchase')}}</p>
            </div>
            <div class="price-container">
                <p class="info-label">Tax 10% (VAT included)</p>
                <p class="price-label">$ {{session('purchase') / 10}}</p>
            </div>
            <div class="price-container total-container">
                <p class="total-label">Total</p>
                <p class="total-price-label">$ {{$total}}</p>
            </div>
            <p>Thank you for your surpport</p>
        </div>
    </div>
    @endif
</body>
<script>
    $('#close-receipt').on('click', function(){
        $('#Receipt').css('display','none')
    })
</script>
</html>
