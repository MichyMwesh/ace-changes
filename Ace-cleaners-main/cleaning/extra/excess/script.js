document.getElementById("notificationButton").addEventListener("click", function() {
    // Make an AJAX request to the PHP file to trigger the notification
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "notify.php", true);
    xhr.send();
  });
  