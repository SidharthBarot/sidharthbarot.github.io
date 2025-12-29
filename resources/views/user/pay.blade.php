<h2>Pay ₹500</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<button id="payBtn">Pay Now</button>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
document.getElementById('payBtn').onclick = function () {

    fetch("{{ route('order.create') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Content-Type": "application/json"
        }
    })
    .then(res => res.json())
    .then(data => {

        var options = {
            key: data.key,
            amount: 500 * 100,
            currency: "INR",
            order_id: data.order_id,
            handler: function (response) {

                fetch("{{ route('payment.success') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(response)
                }).then(() => location.reload());

            }
        };

        new Razorpay(options).open();
    });
}
</script>
