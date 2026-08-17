<button type="button" id="back-button" class="inline-flex items-center justify-center rounded border border-blue-600 bg-blue-600 px-4 py-2 text-white shadow-sm transition hover:bg-blue-700" style="display:none; margin:0 0 1rem 0;" onclick="history.back()">
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
