function replyComment(elementId){
    console.log(elementId);
    if (!$("#reply-text-" + elementId).length) {
        var html = '<textarea placeholder="Escreva uma resposta!" name="comment" id="reply-text-' + elementId + '" class="pb-cmnt-textarea"></textarea><button class="btn btn-primary pull-right btn-comment" onclick="sendReply(' + elementId + ')" type="button">Responder</button>';
        $("#reply-box-" + elementId).html(html);
    }
}

function sendReply(elementId){
    var comment     = $("#reply-text-" + elementId).val();
    var lesson_id   = $("#hidden-lesson-id").val();
    var user_id     = $("#hidden-user-id").val();
    var course_id   = $("#hidden-course-id").val();
    var url         = $("#url-reply").val();


    var data = {
        parent_lesson_id: elementId,
        comment: comment,
        lesson_id: lesson_id,
        user_id: user_id,
        course_id: course_id
    };

    $.ajax({
        type : 'POST',
        url : url,
        data : data,
        success : function (response) {
            if(response){
                window.location.reload();
            }
        }
});
}