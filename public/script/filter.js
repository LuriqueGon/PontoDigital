const applyFiltersButton = document.querySelector('#apply-filters');
applyFiltersButton.addEventListener('click', e => {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const selectedFilters = [];
    checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
            selectedFilters.push(checkbox.value);
        }
    });
    console.log('Selected filters:', selectedFilters);
});

