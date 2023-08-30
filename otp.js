const generatedOTP = "123456"; // Replace this with your actual OTP

const otpInput = document.getElementById("otpInput");
const submitBtn = document.getElementById("submitBtn");
const message = document.getElementById("message");

submitBtn.addEventListener("click", () => {
  const enteredOTP = otpInput.value.trim();

  if (enteredOTP === generatedOTP) {
    message.textContent = "OTP is valid!";
    message.style.color = "green";
  } else {
    message.textContent = "Invalid OTP. Please try again.";
    message.style.color = "red";
  }
});
