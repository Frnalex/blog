<?php

echo $this->session->show('need_token');
$this->session->set('token', md5(time() * rand(175, 658)));