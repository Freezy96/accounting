<?php $this->load->view('template/sidenav'); ?>

<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#30_4week" aria-controls="30_4week" role="tab" data-toggle="tab">30% / 4 Week</a></li>
    <li role="presentation"><a href="#20_week" aria-controls="20_week" role="tab" data-toggle="tab">20% / 1 Week</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="30_4week"><?php $this->load->view('package/insert_30%_4week'); ?></div>
    <div role="tabpanel" class="tab-pane" id="20_week"><?php $this->load->view('package/insert_1000_1200_week'); ?></div>
  </div>

</div>