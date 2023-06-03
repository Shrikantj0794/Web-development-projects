document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault();
    
    // Show the loader animation
    document.querySelector(".loader").style.display = "block";
    
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    
    // Simulating a delay for demonstration purposes
    setTimeout(function() {
      // You can add your login logic here
      // For this example, we'll simply log the values
      console.log("Username: " + username);
      console.log("Password: " + password);
      
      // Hide the loader animation
      document.querySelector(".loader").style.display = "none";
    }, 2000);
  });
  