@extends('layouts.front')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row medium-padding120 bg-border-color">
            <div class="container">

                <div class="row">

                    <div class="col-lg-12">
                        <div class="order">
                            <h2 class="h1 order-title align-center">Your Order</h2>
                            <div class="cart-main">
                                <table class="shop_table cart">
                                    <thead class="cart-product-wrap-title-main">
                                    <tr>
                                        <th class="product-thumbnail">Product</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach(Cart::content() as $item)
                                    <tr class="cart_item">

                                        <td class="product-thumbnail">

                                            <div class="cart-product__item">
                                                <div class="cart-product-content">
                                                    <h5 class="cart-product-title">{{$item->name}}</h5>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="product-quantity">

                                            <div class="quantity">
                                                x {{$item->qty}}
                                            </div>

                                        </td>

                                        <td class="product-subtotal">
                                            <h5 class="total amount">${{$item->total()}}</h5>
                                        </td>

                                    </tr>
                                    @endforeach


                                    <tr class="cart_item total">

                                        <td class="product-thumbnail">


                                            <div class="cart-product-content">
                                                <h5 class="cart-product-title">Total:</h5>
                                            </div>


                                        </td>

                                        <td class="product-quantity">

                                        </td>

                                        <td class="product-subtotal">
                                            <h5 class="total amount">${{Cart::total()}}</h5>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                                <div class="cheque">

                                    <div class="logos">
                                        <a href="#" class="logos-item">
                                            <img src="{{asset('app/img/visa.png')}}" alt="Visa">
                                        </a>
                                        <a href="#" class="logos-item">
                                            <img src="{{asset('app/img/mastercard.png')}}" alt="MasterCard">
                                        </a>
                                        <a href="#" class="logos-item">
                                            <img src="{{asset('app/img/discover.png')}}" alt="DISCOVER">
                                        </a>
                                        <a href="#" class="logos-item">
                                            <img src="{{asset('app/img/amex.png')}}" alt="Amex">
                                        </a>
                                    </div>

                                    <span >
                                                <form id="payment-form" class="my-4" method="post" action="{{route('cart.pay')}}">

                                                                @csrf
                                                              <div id="card-element">
                                                              </div>
                                                              <div id="card-errors" role="alert"></div>
                                                                <button id="submit" class="btn btn-success" >Pay</button>

                                                </form>


							        </span>
                                </div>

                            </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')

    <script src="https://js.stripe.com/v3/"></script>
    <script>
        // Set your publishable key: remember to change this to your live publishable key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        var stripe = Stripe('pk_test_51HpiILKTVzKH3r8eo4Toylyqw56lwLCY0uWOY1lCfgAtBjtzFWts2Vdh1v7DS0OpaHWI5gXJ0rczGOvNFMG0hGeU00q9rtb8ag');
        var elements = stripe.elements();

        // Set up Stripe.js and Elements to use in checkout form
        var style = {
            base: {
                color: "#32325d",
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px",
                "::placeholder": {
                    color: "#aab7c4"
                }
            },
            invalid: {
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };

        var card = elements.create("card", { style: style });
        card.mount("#card-element");
        card.on('change', ({error}) => {
            let displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        //submitting the form
        var form = document.getElementById('payment-form');
        var submitButton = document.getElementById('submit');
        form.addEventListener('submit', function(ev) {
            submitButton.disabled = true;

            ev.preventDefault();


            stripe.confirmCardPayment("{{$clientSecret}}", {
                payment_method: {
                    card: card,
                    // billing_details: {
                    //     name: 'Jenny Rosen'
                    // }
                }
            }).then(function(result) {
                if (result.error) {
                    // Show error to your customer (e.g., insufficient funds)
                    submitButton.disabled = false;

                    console.log(result.error.message);
                } else {
                    // The payment has been processed!
                    if (result.paymentIntent.status === 'succeeded') {
                        // Show a success message to your customer
                        // There's a risk of the customer closing the window before callback
                        // execution. Set up a webhook or plugin to listen for the
                        // payment_intent.succeeded event that handles any business critical
                        // post-payment actions.
                        var paymentIntent = result.paymentIntent;
                        //ajax setup $ is only use with jquery there is no need for it here
                        var token =  document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        var url = form.action;
                        var redirect = "{{route('payment.successful')}}";
                        fetch(
                            url,
                        {
                            headers:{
                                "content-type":"application/json",
                                "Accept":"Application/json, text-plain",
                                "X-Requested-with":"XMLHttpRequest",
                                "X-CSRF-TOKEN": token
                            },
                            method: 'post',
                            body: JSON.stringify({
                                paymentIntent: paymentIntent
                            })
                        }
                        ).then((data) => {
                            console.log(data)
                              window.location.href = redirect;
                        }).catch((error)=>{
                            console.log(error)
                        })
                    }
                }
            });
        });





    </script>

@endsection
