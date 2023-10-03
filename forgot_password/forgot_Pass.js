
document.getElementById("forgot-password-form").addEventListener("submit", function (e) {
    e.preventDefault();

    // Get the user's email
    const email = document.getElementById("email").value;

    // In a real application, you would send a request to a server to handle the password reset request.
    // For this example, we'll just display a success message.
    const message = document.getElementById("message");
    message.innerHTML = "Password reset link sent to " + email;
});
