<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Notification Button</title>
<style>
    #notification {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
</style>
</head>
<body>

<button id="notification">Show Notification</button>

<script>
document.getElementById("notification").addEventListener("click", function() {
    // Check if the browser supports notifications
    if (!("Notification" in window)) {
        alert("This browser does not support desktop notification");
    }
    
    // Check whether notification permissions have already been granted
    else if (Notification.permission === "granted") {
        // If they have, create a notification
        var notification = new Notification("Notification Title", {
            body: "Notification Body",
            icon: "path_to_icon/icon.png" // Replace "path_to_icon" with the actual path to your icon
        });
    }
    
    // If permission is not granted, ask the user for permission
    else if (Notification.permission !== 'denied') {
        Notification.requestPermission().then(function (permission) {
            // If the user accepts, create a notification
            if (permission === "granted") {
                var notification = new Notification("Notification Title", {
                    body: "Notification Body",
                    icon: "path_to_icon/icon.png" // Replace "path_to_icon" with the actual path to your icon
                });
            }
        });
    }
});
</script>

</body>
</html>
