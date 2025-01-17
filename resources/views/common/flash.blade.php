<script>
    @if (!empty($flash['message']))
        const flashMessageData = @json($flash);
        if (flashMessageData.message) {
            flashMessage(flashMessageData.message, flashMessageData.type);
        }
    @endif
</script>