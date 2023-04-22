<!DOCTYPE html>
<html>
    <head>
        <title>DatPayment example</title>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ url('/assets/payment/css/DatPayment.css') }}">
        <style>
            * {
                padding:0;
                margin:0;
            }

            body {
                background:#ffffff;
                font-family: 'Source Sans Pro', sans-serif;
                padding-top:60px;
            }

            .datpayment-form {
                width:360px;
            }
            pre {
                width:360px;
                margin:auto;
            }
        </style>
    </head>
    <body>
        <form action="/" method="POST" id="payment-form"s>
            <div class="dpf-title">
                
                <div class="accepted-cards-logo"></div>
            </div>
            <div class="dpf-card-placeholder"></div>
            <div class="dpf-input-container">
                <div class="dpf-input-row">
                    <label class="dpf-input-label">Credit Card Number</label>
                    <div class="dpf-input-container with-icon">
                        <span class="dpf-input-icon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                        <input type="text" class="dpf-input" size="20" data-type="number" required>
                    </div>
                </div>

                <div class="dpf-input-row">
                    <div class="dpf-input-column">
                        <input type="hidden" size="2" data-type="exp_month" placeholder="MM">
                        <input type="hidden" size="2" data-type="exp_year" placeholder="YY">

                        <label class="dpf-input-label">Expiry Date</label>
                        <div class="dpf-input-container">
                            <input type="text" class="dpf-input" data-type="expiry" required>
                        </div>
                    </div>
                    <div class="dpf-input-column">
                        <label class="dpf-input-label">CVV</label>
                        <div class="dpf-input-container">
                            <input type="text" class="dpf-input" size="4" data-type="cvc" required>
                        </div>
                    </div>
                </div>

                <div class="dpf-input-row">
                    <label class="dpf-input-label">Card Holder Name</label>
                    <div class="dpf-input-container">
                        <input type="text" size="4" class="dpf-input" data-type="name" required>
                    </div>
                </div>

                <button type="submit" class="dpf-submit" id="payment">
                        <span class="btn-active-state">
                            Continue Payment
                        </span>
                        <span class="btn-loading-state">
                            <i class="fa fa-refresh "></i>
                        </span>
                </button>
            </div>
        </form>

        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script type="text/javascript" src="{{ url('/assets/payment/js/DatPayment.js')}}"></script>

        <script type="text/javascript">
            var payment_form = new DatPayment({
                form_selector: '#payment-form',
                card_container_selector: '.dpf-card-placeholder',

                number_selector: '.dpf-input[data-type="number"]',
                date_selector: '.dpf-input[data-type="expiry"]',
                cvc_selector: '.dpf-input[data-type="cvc"]',
                name_selector: '.dpf-input[data-type="name"]',

                submit_button_selector: '.dpf-submit',

                placeholders: {
                    number: '•••• •••• •••• ••••',
                    expiry: '••/••',
                    cvc: '•••',
                    name: '•••'
                },

                validators: {
                    number: function(number){
                        return Stripe.card.validateCardNumber(number);
                    },
                    expiry: function(expiry){
                        var expiry = expiry.split(' / ');
                        return Stripe.card.validateExpiry(expiry[0]||0,expiry[1]||0);
                    },
                    cvc: function(cvc){
                        return Stripe.card.validateCVC(cvc);
                    },
                    name: function(value){
                        return value.length > 0;
                    }
                }
            });

        </script>
        <script type="text/javascript">
            document.getElementById("payment").onclick = function () {
                location.href = "/guest/payment/cc/success";
            };
        </script>
    </body>
</html>