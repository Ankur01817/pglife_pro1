// window.addEventListener("load", function () {
    document.addEventListener("DOMContentLoaded", function () {
        // Edit Profile Link
        const editProfileLink = document.querySelector(".edit-profile");
        if (editProfileLink) {
          editProfileLink.addEventListener("click", function () {
            window.location.href = "edit_profile.php";
          });
        }
      
        // Interested Images
        const isInterestedImages = document.getElementsByClassName("is-interested-image");
        Array.from(isInterestedImages).forEach(element => {
          element.addEventListener("click", function (event) {
            const XHR = new XMLHttpRequest();
            const propertyId = event.target.getAttribute("property_id");
      
            // On success
            XHR.addEventListener("load", removeInterestedSuccess);
      
            // On error
            XHR.addEventListener("error", onError);
      
            // Set up request
            XHR.open("GET", "api/toggle_interested.php?property_id=" + propertyId);
      
            // Initiate the request
            XHR.send();
      
            document.getElementById("loading").style.display = 'block';
            event.preventDefault();
          });
        });
      
        // Remove Interested Success Function
        const removeInterestedSuccess = function (event) {
          document.getElementById("loading").style.display = 'none';
      
          const response = JSON.parse(event.target.responseText);
          if (response.success) {
            const propertyId = response.property_id;
            document.getElementsByClassName("property-id-" + propertyId)[0].style.display = 'none';
          }
        };
      
        // Error Function
        const onError = function (event) {
          document.getElementById("loading").style.display = 'none';
          console.error("An error occurred during the XHR request.");
        };
      });
      