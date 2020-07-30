$('.btn-comment').on('click',function(e){
    e.preventDefault();
    var form = $(this).parents('form');
    swal.fire({
        title: "Deseja enviar o comentário?",
        text: "Seu comentário será enviado para moderação, ao ser aprovado após análise o mesmo será exibido aos demais alunos!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, enviar comentário!",
        closeOnConfirm: false
    }).then((result) => {
        if (result.value) {
            Swal.fire(
                'Enviado!',
                'Seu comentário foi enviado.',
                'success'
            );
            form.submit();
        }
    });
});

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

    swal.fire({
        title: "Deseja enviar a resposta?",
        text: "Sua resposta será enviada para moderação, ao ser aprovada após análise a mesma será exibida aos demais alunos!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sim, enviar resposta!",
        closeOnConfirm: false
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type : 'POST',
                url : url,
                data : data,
                success : function (response) {
                    if(response){
                        Swal.fire(
                            'Enviado!',
                            'Seu comentário foi enviado.',
                            'success'
                        );
                        window.location.reload();
                    }
                }
            });
        }
    });


}