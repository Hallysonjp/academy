<form action="<?php echo site_url('home/add_lesson_reply/'); ?>" method="post">
    <?php
        echo form_input([
        'type'  => 'hidden',
        'name'  => 'lesson_id',
        'id'    => 'hidden-lesson-id',
        'value' => $param3
        ]);
        echo form_input([
        'type'  => 'hidden',
        'name'  => 'course_id',
        'id'    => 'hidden-course-id',
        'value' => $param4
        ]);
        echo form_input([
        'type'  => 'hidden',
        'name'  => 'user_id',
        'id'    => 'hidden-user-id',
        'value' => $this->session->userdata('user_id')
        ]);
        echo form_input([
            'type'  => 'hidden',
            'name'  => 'parent_lesson_id',
            'id'    => 'hidden-parent-lesson-id',
            'value' => $param2
        ]);
        echo form_input([
        'type'  => 'hidden',
        'name'  => 'url-reply',
        'id'    => 'url-reply',
        'value' =>  site_url('home/add_lesson_reply')
        ]);
    ?>
    <div class="form-group">
        <label>Responder comentário</label>
        <textarea name="comment" class="form-control"></textarea>
    </div>
    <div class="text-center">
        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('submit'); ?></button>
    </div>
</form>