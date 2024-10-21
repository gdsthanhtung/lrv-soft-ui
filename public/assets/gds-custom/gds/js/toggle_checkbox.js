
$(document).ready(function () {
    window.toggleCheckbox = function(buttonId, inputName) {
        const $toggleButton = $('#' + buttonId);
        const $checkboxes = $('input[name="' + inputName + '"]');

        $toggleButton.on('click', function () {
            const isCheckAll = $toggleButton.text() === 'Check all';

            $checkboxes.prop('checked', isCheckAll);

            $toggleButton.text(isCheckAll ? 'Uncheck all' : 'Check all');
        });
    };
});
