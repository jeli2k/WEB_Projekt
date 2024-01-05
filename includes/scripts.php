<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    function calculateTotalPrice() {
        var currentRoomPrice = parseFloat(<?php echo $currentRoomPrice; ?>);
        var withBreakfast = document.querySelector('input[name="withBreakfast"]').checked;
        var withParking = document.querySelector('input[name="withParking"]').checked;
        var withPets = document.querySelector('input[name="withPets"]').checked;

        var additionalPriceBreakfast = withBreakfast ? parseFloat(document.querySelector('input[name="withBreakfast"]').getAttribute('data-price')) : 0;
        var additionalPriceParking = withParking ? parseFloat(document.querySelector('input[name="withParking"]').getAttribute('data-price')) : 0;
        var additionalPricePets = withPets ? parseFloat(document.querySelector('input[name="withPets"]').getAttribute('data-price')) : 0;

        var totalPrice = currentRoomPrice + additionalPriceBreakfast + additionalPriceParking + additionalPricePets;

        // check for NaN and return 0 if NaN
        return isNaN(totalPrice) ? 0 : totalPrice;
    }

    // update total price on checkbox change
    function updateTotalPrice() {
        var totalPriceInput = document.querySelector('input[name="currentPrice"]');
        var totalPrice = calculateTotalPrice();
        totalPriceInput.value = totalPrice.toFixed(2) + ' €'; // Add euro sign
    }

    document.querySelectorAll('input[type="checkbox"]').forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            updateTotalPrice();
        });
    });

    // add an event listener for form submission
    document.querySelector('form').addEventListener('submit', function () {
        updateTotalPrice();
    });

    // initial update on page load
    updateTotalPrice();
</script>




