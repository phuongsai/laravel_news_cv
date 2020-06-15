<div class="card__header ml-8 py-5 pr-6 flex items-center justify-between border-b border-semi-white">
    <h2 class="text-white mb-0 text-4xl leading-tight">Newsletter</h2>
    <img class="header__icon block" src="{{ asset('assets/frontend/images/icon-newsletter.png') }}">
</div>
<div class="card__content py-5 px-6">
    <p class="mb-4">Join with others and never miss out on new tips, tutorials, and more.</p>
    <form method="POST" action="{{ route('subscriber.store') }}" class="newsletter-form" data-area="home">
        @csrf
        <div class="flex w-full">
            <input class="w-full flex-1 input w-full flex-1 border-r-0 rounded-r-none" type="email"
                placeholder="Email Address" name="email" id="newsletter_form" required>
            <button type="submit" id="submit_subscriber"
                class="btn border-red-darker p-4 bg-red-darker rounded-r hover:bg-black transition newsletter-subscribe">Subscribe
            </button>
        </div>
    </form>
</div>

<script>
    var SITEURL = window.location.origin;
    $(document).ready(function(){
        $('body').on('click', '#submit_subscriber', function(event){
            event.preventDefault();
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                data: $('#newsletter_form').serialize(),
                url: SITEURL + '/subscriber' + '?_token=' + '{{ csrf_token() }}',
                type: 'POST',
                dataType: "json",
                success: function(data){
                    if (data.errors) {
                        $.msgNotification("error", data);
                    }else{
                        $("#newsletter_form").val('');
                        $.msgNotification("success", data);
                    }
                },
                error: function(data){
                    var validateErrors = data.responseJSON.errors;
                    $.msgNotification("error", validateErrors.email);
                }
            });
        });
    });

/* Capitalize first letter for Toast Nofitication*/
$(function() {
    $.jsUcFirst = function(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    };
});

/* Toast Nofitication*/
$(function() {
    $.msgNotification = function(msgType, msgText) {
        switch (msgType) {
            case "error":
                return iziToast.error({
                    title: $.jsUcFirst(msgType),
                    message: msgText,
                    position: 'topRight'
                });
                break;
            case "success":
                return iziToast.success({
                    title: $.jsUcFirst(msgType),
                    message: msgText,
                    position: 'topRight'
                });
                break;
            case "warning":
                return iziToast.warning({
                    title: $.jsUcFirst(msgType),
                    message: msgText,
                    position: 'topRight'
                });
                break;

            default:
                return iziToast.info({
                    title: $.jsUcFirst(msgType),
                    message: msgText,
                    position: 'topRight'
                });
                break;
        }
    };
});

</script>