@extends('layout.main')
@section('component_content')
<main class="font-poppins">
    <div class="bg-donation-page min-h-screen max-h-fit bg-[#FFFCF0] py-[50px] px-[20px] sm:py-[138px] sm:px-[50px] lg:px-[147px] text-[#282222]">
        <div class="donation-section bg-[#FFFDF6] shadow-[0px_8px_50px_rgba(174,168,135,0.5)] h-fit w-full py-[30px] px-[20px] sm:py-[50px] sm:px-[50px] lg:px-[170px]">
            <h1 class="text-center text-[20px] sm:text-[25px] font-semibold">Donation</h1>

            <div class="payment-details mt-[2rem] sm:mt-[3rem] flex flex-col space-y-[15px] sm:space-y-[20px]">
                @if (Session::has('success'))
                <div class="alert alert-success text-center">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <p>{{ Session::get('success') }}</p>
                </div>
                @endif

                <div class="payment-form">
                    <form role="form" action="{{ route('donation.post') }}" method="post" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form" class="require-validation flex flex-col space-y-[10px] sm:space-y-[15px]">
                        @csrf

                        <h2 class="text-start text-[18px] sm:text-[20px] font-semibold pb-[.5rem] sm:pb-[.8rem]">Payment Details</h2>

                        <div class="input-style">
                            <label for="donatorName">Full Name</label>
                            <br>
                            <input type="text" name="donatorName" id="donatorName" required class="p-[8px] sm:p-[10px] rounded border-[#BABABA] w-full input input-bordered">
                        </div> <!-- input-style -->

                        <div class="input-style flex flex-col sm:flex-row w-full sm:space-x-[20px] lg:space-x-[35px] space-y-[10px] sm:space-y-0">
                            <div class="form-input-style w-full">
                                <label for="donatorPhone">Phone Number</label>
                                <br>
                                <input type="number" name="donatorPhone" id="donatorPhone" required class="input input-bordered p-[8px] sm:p-[10px] rounded border-[#BABABA] w-full">
                            </div> <!-- form-input-style -->

                            <div class="form-input-style w-full">
                                <label for="donatorEmail">Email</label>
                                <br>
                                <input type="email" name="donatorEmail" id="donatorEmail" required class="input input-bordered p-[8px] sm:p-[10px] rounded border-[#BABABA] w-full">
                            </div> <!-- form-input-style -->
                        </div> <!-- input-style -->

                        <div class="input-style required pb-[.5rem] sm:pb-[1rem]">
                            <label for="amount">Donation Amount ($)</label>
                            <br>
                            <input type="number" name="amount" id="amount" required class="input input-bordered p-[8px] sm:p-[10px] rounded border-[#BABABA] w-full">
                        </div> <!-- input-style -->

                        <h2 class="text-start text-[18px] sm:text-[20px] font-semibold">Card Detail</h2>

                        <div id="card-element" class="w-full border-[1px] bg-white border-[#BABABA] rounded p-4 sm:p-6">
                            <!-- A Stripe Element will be inserted here. -->
                        </div> <!-- card-element -->
                        <!-- Used to display form errors. -->
                        <div id="card-errors" class="text-mow-red" role="alert"></div>

                        <h2 class="text-start text-[18px] sm:text-[20px] font-semibold">Description</h2>

                        <div class="input-style pb-[1rem] sm:pb-[2rem]">                        
                            <textarea name="description" class="p-[.8rem] sm:p-[1rem] textarea textarea-bordered text-dark w-full border-[#BABABA] rounded" id="description" cols="80" rows="4" sm:rows="6" required></textarea>
                        </div> <!-- input-style -->


                        <button class="my-[1rem] h-[35px] w-full border-2 btn-lg border-[#A07C00] bg-[#FFFCF0] font-medium text-[14px] sm:text-[16px] text-[#A07C00] hover:bg-[#AB7C00] hover:duration-500 hover:text-white" type="submit">Donate</button>
                    </form>
                </div> <!-- payment-form -->
            </div> <!-- payment-details -->
        </div> <!-- donation-section -->
    </div> <!-- bg-donation-page -->

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
@endsection
