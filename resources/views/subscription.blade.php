@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Product List</div>

                    <div class="card-body">

                        <form id="payment-form" action="{{route("subscription.create")}}" method="post">
                            @csrf
                            <input type="hidden" name="product" id="product" value="{{$product->id}}">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>name</label>
                                        <input type="text" name="name" id="card-holder-name" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>card details</label>
                                        <div id="card-element"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr>
                                    <button type="submit" class="btn btn-primary" id="card-button" data-secret="">pay</button>
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
        const stripe = Stripe({{env('STRIPE_KEY')}});

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const form = document.getElementById('payment-form');
        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.disable = true;
        cardButton.addEventListener('submit', async (e) => {
            const { setupIntent, error } = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: { name: cardHolderName.value }
                    }
                }
            );

            if (error) {
                cardButton.disable = false;
            } else {
                let token = document.createElement('input');
                token.setAttribute('type', 'hidden')
                token.setAttribute('name', 'token')
                token.setAttribute('value', setupIntent.payment_method)
                form.appendChild(token)
                form.submit();
            }
        });
    </script>
@endsection
