// script.js
<script>
document.getElementById('password').addEventListener('input', function() {
    var password = this.value;
    var strength = 0;

    // Check password length
    if (password.length >= 8) strength++;

    // Check for uppercase letters
    if (/[A-Z]/.test(password)) strength++;

    // Check for lowercase letters
    if (/[a-z]/.test(password)) strength++;

    // Check for numbers
    if (/\d/.test(password)) strength++;

    // Check for special characters
    if (/[^a-zA-Z\d]/.test(password)) strength++;

    // Update the strength indicator
    var powerPoint = document.getElementById('power-point');
    powerPoint.style.width = (strength * 25) + '%';
});
</script>