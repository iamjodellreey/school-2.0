<script>
    $(document).ready(function() {
        let counter = 0;
        $(document).on("click", ".addeventmore", function() {
            let whole_extra_item_add = $('#whole_extra_item_add').html();

            console.log($(this).closest(".add_item"));

            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click", '.removeeventmore', function(event) {
            $(this).closest(".delete_whole_extra_item_add").remove();
            counter -= 1
        });
    });
</script>
