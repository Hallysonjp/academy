<div class="col-lg-9  order-md-1 course_col" id = "video_player_area">
    <!-- <div class="" style="background-color: #333;"> -->
    <div class="" style="text-align: center;">
        <?php
        $lesson_details = $this->crud_model->get_lessons('lesson', $lesson_id)->row_array();
        $lesson_thumbnail_url = $this->crud_model->get_lesson_thumbnail_url($lesson_id);
        $opened_section_id = $lesson_details['section_id'];
        // If the lesson type is video
        // i am checking the null and empty values because of the existing users does not have video in all video lesson as type
        if($lesson_details['lesson_type'] == 'video' || $lesson_details['lesson_type'] == '' || $lesson_details['lesson_type'] == NULL):
            $video_url = $lesson_details['video_url'];
            $provider = $lesson_details['video_type'];
            ?>

            <!-- If the video is youtube video -->
            <?php if (strtolower($provider) == 'youtube'): ?>
                <!------------- PLYR.IO ------------>
                <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">

                <div class="plyr__video-embed" id="player">
                    <iframe height="500" src="<?php echo $video_url;?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1" allowfullscreen allowtransparency allow="autoplay"></iframe>
                </div>

                <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                <script>const player = new Plyr('#player');</script>
                <!------------- PLYR.IO ------------>

                <!-- If the video is vimeo video -->
            <?php elseif (strtolower($provider) == 'vimeo'):
                $video_details = $this->video_model->getVideoDetails($video_url);
                $video_id = $video_details['video_id'];?>
                <!------------- PLYR.IO ------------>
                <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
                <div class="plyr__video-embed" id="player">
                    <iframe height="500" src="https://player.vimeo.com/video/<?php echo $video_id; ?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media" allowfullscreen allowtransparency allow="autoplay"></iframe>
                </div>

                <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                <script>const player = new Plyr('#player');</script>
                <!------------- PLYR.IO ------------>

                <!-- If the video is Amazon S3 video -->
            <?php elseif (strtolower($provider) == 'amazon'):?>
                <!------------- PLYR.IO ------------>
                <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
                <video poster="<?php echo $lesson_thumbnail_url;?>" id="player" playsinline controls>
                    <?php if (get_video_extension($video_url) == 'mp4'): ?>
                        <source src="<?php echo $video_url; ?>" type="video/mp4">
                    <?php elseif (get_video_extension($video_url) == 'webm'): ?>
                        <source src="<?php echo $video_url; ?>" type="video/webm">
                    <?php else: ?>
                        <h4><?php get_phrase('video_url_is_not_supported'); ?></h4>
                    <?php endif; ?>
                </video>

                <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                <script>const player = new Plyr('#player');</script>
                <!------------- PLYR.IO ------------>
                <!-- If the video is Amazon S3 video -->

                <!-- If the video is self uploaded video -->
            <?php elseif (strtolower($provider) == 'system'):?>
                <!------------- PLYR.IO ------------>
                <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
                <video poster="<?php echo $lesson_thumbnail_url;?>" id="player" playsinline controls>
                    <?php if (get_video_extension($video_url) == 'mp4'): ?>
                        <source src="<?php echo $video_url; ?>" type="video/mp4">
                    <?php elseif (get_video_extension($video_url) == 'webm'): ?>
                        <source src="<?php echo $video_url; ?>" type="video/webm">
                    <?php else: ?>
                        <h4><?php get_phrase('video_url_is_not_supported'); ?></h4>
                    <?php endif; ?>
                </video>

                <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                <script>const player = new Plyr('#player');</script>
                <!------------- PLYR.IO ------------>
                <!-- If the video is self uploaded video -->

                <?php else :?>
                    <!------------- PLYR.IO ------------>
                    <link rel="stylesheet" href="<?php echo base_url();?>assets/global/plyr/plyr.css">
                    <video poster="<?php echo $lesson_thumbnail_url;?>" id="player" playsinline controls>
                        <?php if (get_video_extension($video_url) == 'mp4'): ?>
                            <source src="<?php echo $video_url; ?>" type="video/mp4">
                        <?php elseif (get_video_extension($video_url) == 'webm'): ?>
                            <source src="<?php echo $video_url; ?>" type="video/webm">
                        <?php else: ?>
                            <h4><?php get_phrase('video_url_is_not_supported'); ?></h4>
                        <?php endif; ?>
                    </video>

                    <script src="<?php echo base_url();?>assets/global/plyr/plyr.js"></script>
                    <script>const player = new Plyr('#player');</script>
                    <!------------- PLYR.IO ------------>
                <?php endif; ?>
            <?php elseif ($lesson_details['lesson_type'] == 'quiz'): ?>
                <div class="mt-5">
                    <?php include 'quiz_view.php'; ?>
                </div>
            <?php else: ?>
                <?php if ($lesson_details['attachment_type'] == 'iframe'): ?>
                    <div class="mt-5">
                        <div class="embed-responsive embed-responsive-16by9">
                          <iframe class="embed-responsive-item" src="<?php echo $lesson_details['attachment']; ?>" allowfullscreen></iframe>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="mt-5">
                        <a href="<?php echo base_url().'uploads/lesson_files/'.$lesson_details['attachment']; ?>" class="btn btn-sign-up" download style="color: #fff;">
                            <i class="fa fa-download" style="font-size: 20px;"></i> <?php echo get_phrase('download').' '.$lesson_details['title']; ?>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="" style="margin: 20px 0;" id = "lesson-summary">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $lesson_details['lesson_type'] == 'quiz' ? get_phrase('instruction') : get_phrase("note"); ?>:</h5>
                    <?php if ($lesson_details['summary'] == ""): ?>
                        <p class="card-text"><?php echo $lesson_details['lesson_type'] == 'quiz' ? get_phrase('no_instruction_found') : get_phrase("no_summary_found"); ?></p>
                    <?php else: ?>
                        <p class="card-text"><?php echo $lesson_details['summary']; ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
        $lesson_comments = $this->crud_model->get_lesson_comments($lesson_id, $lesson_details['course_id'])->result_array();
        if(!empty($lesson_comments)):
    ?>
    <div class="" style="margin: 20px 0;" id="comments">
        <div class="card">
            <div class="card-body">
                <?php

                    foreach ($lesson_comments as $comment):
                        if (empty($comment['parent_lesson_id']) && $comment['status'] == 1):
                            $user_comment = $this->user_model->get_user($comment['user_id'])->row_array();
                ?>
                <div class="row border row-comment">
                    <div class="col-sm-12 col-lg-2 mx-auto text-center">
                        <img src="<?php echo $this->user_model->get_user_image_url($comment['user_id']); ?>" width="50" alt="user-image" class="rounded-circle">
                        <p class="text-secondary text-center minutes"><?php echo $this->crud_model->tempo_corrido($comment['added_at']); ?></p>
                    </div>
                    <div class="col-sm-12 col-lg-10 mx-auto">
                        <p>
                            <a class="float-left" href="#">
                                <strong>
                                    <?= $user_comment['first_name'] . " " . $user_comment['last_name'] ?>
                                </strong>
                            </a>
                        </p>
                        <div class="clearfix"></div>
                        <p><?= $comment['comment'] ?></p>
                        <p>
                            <!--<a class="float-right btn text-white btn-outline-primary ml-2" onclick="replyComment(<?php echo $comment['id']; ?>)"> <i class="fa fa-reply"></i> Responder</a>-->
                        <div class="reply-box" id="reply-box-<?php echo $comment['id']; ?>"></div>
                        <!--<a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>-->
                        </p>
                    </div>
                </div>
                <?php
                    $lesson_comments_reply = $this->crud_model->get_lesson_comments_reply($lesson_id, $lesson_details['course_id'], $comment['id'])->result_array();
                    foreach ($lesson_comments_reply as $reply):
                    $user_comment_reply = $this->user_model->get_all_user($reply['user_id'])->row_array();
                    if($reply['status'] == 1):
                ?>
                <div class="card card-inner">
                    <div class="card-body bg-white">
                        <div class="row border row-comment">
                            <div class="col-sm-12 col-lg-2 mx-auto text-center">
                                <img src="<?php echo $this->user_model->get_user_image_url($reply['user_id']); ?>" alt="user-image" class="rounded-circle card-img-top smallimg">
                                <p class="text-secondary text-center minutes"><?php echo $this->crud_model->tempo_corrido($reply['added_at']); ?></p>
                            </div>
                            <div class="col-sm-12 col-lg-10">
                                <p><a href="#"><strong><?= $user_comment_reply['first_name'] . " " . $user_comment_reply['last_name'] ?></strong></a></p>
                                <p><?= $reply['comment'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; endforeach; ?>

                <?php elseif (empty($comment['parent_lesson_id']) && $comment['status'] == 0 && $comment['user_id'] == $this->session->userdata('user_id')): ?>
                <div class="row border row-comment">
                    <div class="col-sm-12 col-lg-2 mx-auto text-center">
                        <img src="<?php echo $this->user_model->get_user_image_url($comment['user_id']); ?>" width="50" alt="user-image" class="rounded-circle">
                        <p class="text-secondary text-center minutes"><?php echo $this->crud_model->tempo_corrido($comment['added_at']); ?></p>
                    </div>
                    <div class="col-sm-12 col-lg-10 mx-auto">
                        <p>
                            <a class="float-left" href="#">
                                <strong>
                                    <?= $user_comment['first_name'] . " " . $user_comment['last_name'] ?>
                                </strong>
                            </a>
                        </p>
                        <div class="clearfix"></div>
                        <p><?= $comment['comment'] ?></p>
                        <p>
                            <!--<a class="float-right btn text-white btn-outline-primary ml-2" onclick="replyComment(<?php echo $comment['id']; ?>)"> <i class="fa fa-reply"></i> Responder</a>-->
                        <div class="reply-box" id="reply-box-<?php echo $comment['id']; ?>"></div>

                            <p class="float-right btn text-white">
                            <i class="fa fa-exclamation-triangle"></i>
                                <small>Este comentário estará disponível apenas para você até ser aprovado.</small>
                            </p>

                        </p>
                    </div>
                </div>


                <?php endif; endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="" style="margin: 20px 0;" id="comments">
        <div class="card">
            <div class="card-body">
                <?php
                echo form_open(site_url('home/add_lesson_comment') , ['class' => 'form-inline form-groups-bordered validate','target'=>'_top']);
                echo form_input([
                    'type'  => 'hidden',
                    'name'  => 'lesson_id',
                    'id'    => 'hidden-lesson-id',
                    'value' => $lesson_id
                ]);
                echo form_input([
                    'type'  => 'hidden',
                    'name'  => 'course_id',
                    'id'    => 'hidden-course-id',
                    'value' => $lesson_details['course_id']
                ]);
                echo form_input([
                    'type'  => 'hidden',
                    'name'  => 'user_id',
                    'id'    => 'hidden-user-id',
                    'value' => $this->session->userdata('user_id')
                ]);
                echo form_input([
                    'type'  => 'hidden',
                    'name'  => 'url-reply',
                    'id'    => 'url-reply',
                    'value' =>  site_url('home/add_lesson_reply')
                ]);
                ?>
                <textarea placeholder="Escreva um comentário!" name="comment" class="pb-cmnt-textarea"></textarea>
                <button class="btn btn-primary pull-right btn-comment" type="submit">Comentar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<style>
    .pb-cmnt-container {
        font-family: Lato;
        margin-top: 100px;
    }

    .pb-cmnt-textarea {
        resize: none;
        padding: 20px;
        height: 130px;
        width: 100%;
        border: 1px solid #F2F2F2;
    }

    .smallimg {
        width: 50px;
        height: 50px;
    }

    .minutes {
        font-size: 12px;
        margin-top: 5px;
    }

    .btn-comment {
        margin-top: 15px;
    }

    .row-comment {
        padding: 5px;
        margin: 10px;
    }

    .card-inner {
        background-color: #f1f1f1;
    }

    .reply-box {
        margin-top: 10px;
    }
</style>
</div>