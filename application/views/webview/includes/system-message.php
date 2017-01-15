    <?php
     if(validation_errors())
        {
            echo '<div class="alert alert-danger">'.validation_errors('<p>','</p>').'</div>';
        }
      if($this->session->flashdata(WARNING_MESSAGE)!="")
        {
            echo '<div class="alert alert-info"><p>'.$this->session->flashdata('warningMessage').'</p></div>';	
        }else if($this->session->flashdata(ERROR_MESSAGE)!=""){
            echo '<div class="alert alert-danger"><p>'.$this->session->flashdata(ERROR_MESSAGE).'</p></div>';
        }else if($this->session->flashdata(SUCCESS_MESSAGE)!=""){
            echo '<div class="alert alert-success"><p>'.$this->session->flashdata(SUCCESS_MESSAGE).'</p></div>';
        }
        $this->session->set_flashdata(WARNING_MESSAGE,'');
        $this->session->set_flashdata(ERROR_MESSAGE,'');
        $this->session->set_flashdata(SUCCESS_MESSAGE,'');
     ?>
