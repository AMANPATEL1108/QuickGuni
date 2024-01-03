<footer>
  <div class="container">
    <?php $currentYear = date("Y"); ?>
    <p class="">QuickGuni  &copy;<?php echo "$currentYear"; ?>, All Right Reserved.</p>
  </div>
</footer>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
<script src="script.js"></script>


<script>
    $(document).ready(function () {
        // Attach an event listener to the email input field
        $('input[name="email"]').on('input', function () {
            // Get the entered email
            var email = $(this).val();

            // Validate the email using AJAX
            $.ajax({
                url: 'validate_email.php', // Replace with the actual URL to your validation script
                type: 'POST',
                data: { email: email },
                success: function (response) {
                    // Update the email validation result in the hidden input field
                    $('#email-validation-result').val(response);

                    // Display the validation message
                    $('#email-validation-message').html(response);
                }
            });
        });

        // Prevent form submission if email is not validated
        $('#registration-form').submit(function (e) {
            var validationResult = $('#email-validation-result').val();

            if (validationResult !== 'valid') {
                e.preventDefault();
                alert('Please fix the email validation error before submitting.');
            }
        });
    });
</script>


<script>
    $(window).on("load", function() {
        // When the page is fully loaded, hide the preloader
        $(".preloader").fadeOut("slow");

        // Your existing code here (e.g., the code for login, success message, etc.)
        $(document).ready(function() {
            // Your existing code goes here
        });
    });
</script>

<script>
function toggleTab(tabId) {
  // Hide all tab contents
  var tabContents = document.querySelectorAll('.tab-contents');
  tabContents.forEach(function (tabContent) {
    tabContent.style.display = 'none';
  });

  // Show the selected tab content
  var selectedTab = document.getElementById(tabId);
  if (selectedTab) {
    selectedTab.style.display = 'block';
  }
}

// Set the first tab as active by default
toggleTab('myprofile');

</script>

<script>
$(document).ready(function() {
  
 
  
  var table = $('#example').DataTable({ 
        select: false,
        "columnDefs": [{
            className: "Name", 
            "targets":[0],
            "visible": false,
            "searchable":false,    scrollX: true

        }]
    });//End of create main table

  
 
});

</script>


</body>

</html>
