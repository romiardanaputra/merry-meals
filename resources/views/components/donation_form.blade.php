@extends('layout.main')
@section('component_content')
@include('components.navbar')
<main>
<div class="container border-4 px-6 py-6 mx-auto shadow-lg my-6">
        <h1>Donation</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading display-table">
                        <div class="row display-tr">
                            <h3 class="panel-title display-td">Payment Details</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success'))
                            <div class="alert alert-success text-center">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                <p>{{ Session::get('success') }}</p>
                            </div>
                        @endif
                        <form role="form" action="{{ route('donation.post') }}" method="post"
                            class="require-validation" data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                            @csrf
                            <label for="donatorName">Full Name</label><input type="text" name="donatorName" id="donatorName" required class="border-4"> <br>
                            {{-- <label for="address">Address</label><input type="text" name="address" id="address" required class="border-4"> <br> --}}
                            <label for="donatorPhone">Phone Number</label><input type="number" name="donatorPhone" id="donatorPhone" required class="border-4"> <br>
                            <label for="donatorEmail">Email</label><input type="email" name="donatorEmail" id="donatorEmail" required class="border-4">
                            <div class="form-row row">
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Donation Amount</label> <input class='form-control border-4' type='number' name="amount" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="card-element">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">Card details</div>
                                    </div>
                                    <div id="card-element" class=" w-7/12 my-6 ml-6 bg-slate-100 p-6">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>
                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" class="text-mow-red" role="alert"></div>
                            </div>
                            <label for="description"><div class="block">
                                    <div class="w-full text-lg font-semibold">Description</div>
                                </div>
                                <div>
                                    <textarea name="description" class="text-dark w-full bg-slate-50 border-slate-500 border-solid border-2 rounded-sm"
                                        id="description" cols="80" rows="6" required></textarea>
                                </div>
                            </label>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Donate</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    $('.custom-control-input').change(function() {
        $("div.custom-amount").toggle($(this).hasClass("custom-amount"))
        $(".custom-count").attr('value', '0');
    })

    $('.custom-count').change(function() {
        $('input.custom-amount:radio').val($(this).val())
    })

    var publishable_key = '{{ env('STRIPE_KEY') }}';
    // Create a Stripe client.
    var stripe = Stripe(publishable_key);

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '1.25rem',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {
        style: style
    });

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>
</div>
</main>
@include('components.footer')
@endsection
