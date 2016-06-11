<?php
    include('debate_fns.php');
    session_start();
    $postid = $_GET['postid'];
    $post = get_post($postid);
    do_view_post_header($post['poster']);
    display_post($post);
    if($post['children']){
        display_tree2($_SESSION['expanded'], 0, $postid);
    }
    display_bottom_bar($post);
    do_main_page_footer();
?>