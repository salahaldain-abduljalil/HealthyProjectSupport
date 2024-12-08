    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script href="{{ asset('frontend') }}/lib/easing/easing.min.js"></script>
    <script href="{{ asset('frontend') }}/lib/waypoints/waypoints.min.js"></script>
    <script href="{{ asset('frontend') }}/lib/owlcarousel/owl.carousel.min.js"></script>
    <script href="{{ asset('frontend') }}/lib/tempusdominus/js/moment.min.js"></script>
    <script href="{{ asset('frontend') }}/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script href="{{ asset('frontend') }}/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script href="{{ asset('frontend') }}/js/main.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script type="text/javascript">
        var temporaryMsgId = 0;
        const commentsSection = document.getElementById('comments-section');
        const commentInput = $(".comment-input");
        const CommentContainer = $(".general-comments"),
            messageForm = $(".comment-form"),
            messageInput = $(".comment-input"),
            messageBoxContainer = $(".general-comments");

        function sendMessage() {
            temporaryMsgId += 1;
            let tempID = `temp_${temporaryMsgId}`;
            const inputValue = commentInput.val();
            const post_id = $('#post_id').val();
            const user_id = $('#user_id').val();

            if (inputValue.length > 0) {
                const formData = new FormData($(".comment-form")[0]);
                formData.append("temporaryMsgId", tempID);
                formData.append("post_id", post_id);
                formData.append("user_id", user_id);

                $.ajax({
                    method: "POST",
                    url: "/comment/send-comments",
                    data: formData,
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    beforeSend: function() {
                        // add temp message on dom
                        messageBoxContainer.append(
                            sendTempMessageCard(inputValue, tempID, user_id, post_id)
                        );
                        messageForm.trigger("reset");
                        playNotificationSound();
                    },
                    success: function(data) {
                        // update contact item
                        const tempMsgCardElement = messageBoxContainer.find(
                            `.comment-card[data-id=${data.tempID}]`
                        );
                        tempMsgCardElement.before(data.comment);
                        tempMsgCardElement.remove();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                });
            }
        }


        function sendTempMessageCard(comment, tempId, user_id, post_id) {
            return `
    <div class="d-flex mb-4 comment-card" data-id="${tempId}">
       <img src="{{ !empty(Auth::user()->photo) ? url('upload/instructor_images/' . Auth::user()->photo) : url('upload/no_image.jpg') }}" class="img-fluid rounded-circle" style="width: 45px; height: 45px;">
       <div class="ps-3">
             <div class="pre_loader">
                <div class="spinner-border text-light" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <input type="hidden" name="post_id" value="${post_id}">
            <input type="hidden" name="user_id" value="${user_id}">

    ${
    comment.length > 0 ? `<p>${comment}</p>
                                                                                                                                ` : ""
    }
      <h6><small><i>{{ \Carbon\Carbon::now() }}</i></small></h6>
    <button class="btn btn-sm btn-light" onclick="toggleElement();">رد</button>
  </div>
  </div>
    `;
        }

        function playNotificationSound() {
            const sound = new Audio(`/default/message-sound.mp3`);
            sound.play();
        }

        $(document).ready(function() {
            //Send comment
            $(".comment-form").on("submit", function(e) {
                e.preventDefault();
                sendMessage();
            });
        });
    </script>
