<form action="<?php echo site_url('admin/sections/'.$param2.'/add'); ?>" method="post">
    <div class="form-group">
        <label for="title"><?php echo get_phrase('title'); ?></label>
        <input class="form-control" type="text" name="title" id="title" required>
        <small class="text-muted"><?php echo get_phrase('provide_a_section_name'); ?></small>
    </div>
    <div class="form-group">
        <label for="title">Data para ativação da seção:</label>
        <input class="form-control" type="date" name="date_to_activate" id="date_to_activate">
<!--        <small class="text-muted">Se este campo não estiver preenchido, a seção será ativada automaticamente.</small>-->
    </div>
    <div class="form-group">
        <label for="title">Dias para ativação após registro:</label>
        <input class="form-control" type="date" name="days_to_activate" id="days_to_activate">
        <small class="text-muted">Se este campo não estiver preenchido, a seção será ativada automaticamente.</small>
    </div>
    <div class="text-right">
        <button class = "btn btn-success" type="submit" name="button"><?php echo get_phrase('submit'); ?></button>
    </div>
</form>
