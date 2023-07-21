

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-indigo w3-card" id="myNavbar">

	&nbsp;<a href="main.php" class="w3-bar-item1"><img src="images/logofyp.png" height="55"></a>

    <div class="w3-right w3-hide-small">
      <a href="main.php" class="w3-bar-item w3-button">HOME</a>
      <a href="booking_add.php" class="w3-bar-item w3-button">SERVICES</a>
      <a href="booking.php" class="w3-bar-item1 w3-button">BOOKING HISTORY</a>
      <div class="w3-dropdown-click">
        <!-- Update the button with an ID to be able to set the badge content -->
        <button id="notificationIcon" class="w3-bar-item w3-button" onclick="toggleNotificationsDropdown()">
          <i class="fas fa-bell"></i>
          <!-- Badge to show the notification count -->
          <span id="notificationBadge" class="w3-badge w3-red w3-small w3-hide">0</span>
        </button>
        <!-- Notifications container -->
        <div id="notificationsContainer" class="w3-hide w3-white w3-card-4 w3-bar-block" style="position: fixed; top: 60px; z-index: 1; width: 250px;">
          <!-- The content of the notifications container will be populated via JavaScript -->
        </div>
      </div>

      <a href="logout.php" class="w3-bar-item1 w3-button">LOGOUT</a>

    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->
    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-blue w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="main.php" onclick="w3_close()" class="w3-bar-item w3-button">HOME</a>
  <a href="booking.php" onclick="w3_close()" class="w3-bar-item w3-button">BOOKING HISTORY</a>
  <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button">LOGOUT</a>
</nav>

<script>
function toggleNotificationsDropdown() {
  var notificationsContainer = document.getElementById("notificationsContainer");
  notificationsContainer.classList.toggle("w3-show");
  // If the container is shown, update the notifications and hide the badge
  if (notificationsContainer.classList.contains("w3-show")) {
    updateNotificationsDropdown();
    hideNotificationBadge();
  }
}

function updateNotificationsDropdown() {
  // Make an AJAX request to fetch the notifications from the server
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var notifications = JSON.parse(this.responseText);
      var notificationsContent = "";

      // Generate the content for the dropdown menu
      notifications.forEach(function(notification) {
        // Add an event listener to each notification item
        notificationsContent += `<a href="${notification.link}" class="w3-bar-item w3-button" onclick="markNotificationAsRead(this, '${notification.id}')">${notification.message}</a>`;
      });

      document.getElementById("notificationsContainer").innerHTML = notificationsContent;

      // Update the badge with the notification count
      var notificationBadge = document.getElementById("notificationBadge");
      notificationBadge.textContent = notifications.length;
      // Show the badge if there are notifications
      if (notifications.length > 0) {
        showNotificationBadge();
      }
    }
  };
  xmlhttp.open("GET", "notification.php", true);
  xmlhttp.send();
}

function markNotificationAsRead(notificationItem, notificationId) {
  // Handle the notification item click event
  // Here, you can put any logic you want to handle the click event of a notification item.
  // For now, we will just remove the clicked notification from the list and update the dropdown.
  var notificationsContainer = document.getElementById("notificationsContainer");
  notificationsContainer.classList.remove("w3-show");
  hideNotificationBadge();

  // Remove the clicked notification from the list
  var notificationItems = notificationsContainer.getElementsByTagName("a");
  for (var i = 0; i < notificationItems.length; i++) {
    if (notificationItems[i].getAttribute("data-notification-id") === notificationId) {
      notificationItems[i].remove();
      break;
    }
  }

  // Update the badge with the new notification count
  var notificationBadge = document.getElementById("notificationBadge");
  notificationBadge.textContent = notificationItems.length - 1; // Subtract 1 to exclude the clicked notification
  // Show the badge if there are remaining notifications
  if (notificationItems.length > 1) {
    showNotificationBadge();
  }
}

function showNotificationBadge() {
  var notificationBadge = document.getElementById("notificationBadge");
  notificationBadge.classList.remove("w3-hide");
}

function hideNotificationBadge() {
  var notificationBadge = document.getElementById("notificationBadge");
  notificationBadge.classList.add("w3-hide");
}

// Call the function initially to populate the notifications dropdown
updateNotificationsDropdown();

// Set an interval to update the notifications dropdown every few seconds (optional)
setInterval(updateNotificationsDropdown, 20000); // Update every 20 seconds, adjust as needed
</script>