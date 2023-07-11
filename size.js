$(document).ready(function() {
  // Find all size select elements and add change event listeners
  $('select[name="Size"]').each(function(index, element) {
      $(element).on('change', function() {
          var selectedSize = $(this).val();
          // Perform any desired action based on the selected size
          console.log('Selected size for item ' + index + ': ' + selectedSize);
      });
  });

  // Find all quantity input elements and add increment/decrement event listeners
  $(document).on('click', '.increment-btn', function() {
      var quantityInput = $(this).closest('.card-body').find('input[name="Quantity"]');
      var currentValue = parseInt(quantityInput.val());
      quantityInput.val(currentValue + 1);
  });

  $(document).on('click', '.decrement-btn', function() {
      var quantityInput = $(this).closest('.card-body').find('input[name="Quantity"]');
      var currentValue = parseInt(quantityInput.val());
      if (currentValue > 1) {
          quantityInput.val(currentValue - 1);
      }
  });
});
