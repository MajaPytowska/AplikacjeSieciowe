document.addEventListener('DOMContentLoaded', function() {
        var checkbox = document.getElementById('customVisitReasonEnable');
        var textboxarea = document.getElementById('customVisitReasonDiv');
        var combo = document.getElementById('visitReasonIdDiv');
        if (checkbox && textboxarea && combo) {
            checkbox.addEventListener('change', function() {
                textboxarea.style.display = this.checked ? 'block' : 'none';
                combo.style.display = !this.checked ? 'block' : 'none';
            });
        }
    });

