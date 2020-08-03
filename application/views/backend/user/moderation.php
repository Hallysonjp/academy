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
                <table id="basic-datatable" class="table table-light table-centered mb-0">
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
                       foreach ($moderation->result_array() as $key => $moderation):
                       if(empty($moderation['parent_lesson_id'])):
                       ?>
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
                                  <p><small><?= $moderation['first_name'].' '.$moderation['last_name']; ?></small></p>
                              </td>
                              <td>
                                  <?php
                                    $descricao = [
                                        0 => 'Aguardando',
                                        1 => 'Aprovado',
                                        2 => 'Reprovado',
                                        3 => 'Arquivado'
                                    ];

                                    $status = [
                                        0 => 'warning',
                                        1 => 'success',
                                        2 => 'danger',
                                        3 => 'info'
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
                                        <li><a class="dropdown-item" href="<?php echo site_url('user/moderation/approve/'.$moderation['id']) ?>">Aprovar</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('user/moderation/unapprove/'.$moderation['id']); ?>');">Reprovar</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('user/moderation/archive/'.$moderation['id']); ?>');">Arquivar</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="showAjaxModal('<?php echo site_url('modal/popup/reply_comment/'.$moderation['id'].'/'.$moderation['lesson_id'].'/'.$moderation['course_id']); ?>');">Responder</a></li>
                                        <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('user/moderation/delete/'.$moderation['id']); ?>');">Deletar</a></li>
                                    </ul>
                                </div>
                              </td>
                          </tr>
                      <?php
                       endif;
                        $replies = $this->crud_model->get_moderations(true, $moderation['id'])->result_array();
                        if(!empty($replies)):

                      ?>
                        <tr>
                            <td><p>Resposta</p></td>

                            <td colspan="6">
                               <table class="table table-info">
                                   <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Comentário</th>
                                       <th></th>
                                       <th></th>
                                       <th>Usuário</th>
                                       <th>Status</th>
                                       <th><?php echo get_phrase('actions'); ?></th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                        <?php foreach ($replies as $reply): ?>
                                            <tr>
                                                <td><?= $reply['id']; ?></td>
                                                <td colspan="3">
                                                    <?= $reply['comment'] ?>
                                                </td>
                                                <td width="100">
                                                    <?= $reply['email']; ?>
                                                    <p><small><?= $reply['first_name'].' '.$reply['last_name']; ?></small></p>
                                                </td>
                                                <td width="100">
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
                                                    <small><p><span class="badge badge-<?= $status[$reply['status']] ?>-lighten"><?= $descricao[$reply['status']] ?></span></p></small>
                                                </td>
                                                <td width="50">
                                                    <div class="dropright dropright">
                                                        <button type="button" class="btn btn-sm btn-outline-primary btn-rounded btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="mdi mdi-dots-vertical"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="<?php echo site_url('user/moderation/approve/'.$reply['id']) ?>">Aprovar</a></li>
                                                            <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('user/moderation/unapprove/'.$reply['id']); ?>');">Reprovar</a></li>
                                                            <li><a class="dropdown-item" href="#" onclick="confirm_modal('<?php echo site_url('user/moderation/delete/'.$reply['id']); ?>');">Deletar</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                   </tbody>
                               </table>
                            </td>


                        </tr>
                       <?php endif; endforeach; ?>
                  </tbody>
              </table>
              </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
