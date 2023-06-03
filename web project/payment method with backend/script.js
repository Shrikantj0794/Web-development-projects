document.getElementById('paymentForm').addEventListener('submit', function(event) {
  event.preventDefault();

  // Simulating payment processing
  setTimeout(function() {
    document.getElementById('paymentResult').textContent = 'Payment Successful!';
  }, 2000);
});
