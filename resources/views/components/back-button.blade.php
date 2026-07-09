<button type="button" id="back-button" class="btn btn-outline-secondary position-absolute" style="left:16px;top:16px;display:none;z-index:9999;" onclick="history.back()">
    &larr; Retour
</button>

<script>
document.addEventListener('DOMContentLoaded', function () {
    try {
        // Show button only if there's a previous history entry
        if (history.length > 1) {
            document.getElementById('back-button').style.display = 'inline-block';
        }
    } catch (e) {
        // ignore
    }
});
</script>
