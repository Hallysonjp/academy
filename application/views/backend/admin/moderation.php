<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo $page_title; ?>
            </h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
              <h4 class="mb-3 header-title">Moderação</h4>
              <div class="table-responsive-sm mt-4">
                <table id="basic-datatable" class="table table-striped table-centered mb-0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Curso</th>
                      <th>Lição</th>
                      <th>Comentário</th>
                      <th>Aluno</th>
                      <th>Status</th>
                      <th><?php echo get_phrase('actions'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                       foreach ($moderation->result_array() as $key => $moderation): ?>
                          <tr>
                              <td><?php echo $key+1; ?></td>
                              <td>
                                  <?= $moderation['course'] ?>
                              </td>
                              <td>
                                  <?= $moderation['lesson'] ?>
                              </td>
                              <td>
                                  <?= $moderation['comment'] ?>
                              </td>
                              <td>
                                  <?= $moderation['email']; ?>
                                  <small><p><?= $moderation['first_name'].' '.$moderation['last_name']; ?></p></small>
                              </td>
                              <td>
                                  <?php
                                    $descricao = [
                                        0 => 'Aguardando',
                                        1 => 'Aprovado',
                                        2 => 'Reprovado'
                                    ];

                                    $status = [
                                        0 => 'warning',
                                        1 => 'success',
                                        2 => 'danger'
                                    ]
                                  ?>
                                  <small><p><span class="badge badge-<?= $status[$moderation['status']] ?>-lighten"><?= $descricao[$moderation['status']] ?></span></p></small>
                              </td>
                              <td>
                                  <div class="dropright dropright">
                                    <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="<?php echo site_url('admin/moderation/approve/'.$moderation['id']) ?>">Aprovar</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('admin/moderation/unapprove/'.$moderation['id']); ?>');">Reprovar</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/reply_comment/'.$moderation['id'].'/'.$moderation['lesson_id'].'/'.$moderation['course_id']); ?>');">Responder</a></li>
                                    </ul>
                                </div>
                              </td>
                          </tr>
                      <?php endforeach; ?>
                  </tbody>
              </table>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
