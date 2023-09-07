// Import the 'qrcode.js' library if you're using it

// Payment data (example)
const paymentData = 'https://pay.google.com/gp/v/guided/v2?tp=buy&action=create&token=YOUR_TOKEN_HERE';

// Generate the QR code
const qrCodeElement = document.getElementById('qr-code');

// Create a QR code instance (using qrcode.js)
const qrCode = new QRCode(qrCodeElement, {
    text: paymentData,
    width: 200,
    height: 200,
});

qrCode.makeCode(paymentData);
