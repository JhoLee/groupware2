<?php if ($this->session->userdata('category') == 'auth') { ?>
    </div><!--/div.container-->
    <script src="/application/res/js/jquery-3.2.1.min.js"></script>
    <script src="/application/res/js/bootstrap.min.js"></script>
    </body>
    </html>
<?php } else if ($this->session->userdata('category') == 'topic') { ?>
    </div><!--/div.container-fluid-->
    </div><!--/div.row-fluid-->
    <script src="/application/res/js/jquery-3.2.1.min.js"></script>
    <script src="/application/res/js/bootstrap.min.js"></script>
    </body>
    </html>
<?php } ?>