$('.remove_attachment').click(function(evt) {
            var _this = $(this);
            console.log(_this);
            var formDiscard = _this.data('formdiscard');
            if (confirm("Are you sure you want to delete: \n" + $(this).parent().text() + " ?")) {
                $.ajax({
                    url: "<?= base_url() . 'jobs/removefile' ?>",
                    type: "POST",
                    data: "formDiscard="+formDiscard,
                    async: false
                });
            }
        });