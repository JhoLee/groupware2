<?php
if ($this->session->userdata('category') == 'auth') {
    include 'head/auth_head.php';


} else if ($this->session->userdata('category') == 'topic') {
    include 'head/topic_head.php';


}
