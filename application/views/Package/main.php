<?php $this->load->view('template/sidenav'); ?>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#30_4week" aria-controls="30_4week" role="tab" data-toggle="tab">30% / 4 Week</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="30_4week"><?php $this->load->view('package/main_30%_4week'); ?></div>
  </div>

</div>