<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
       <div class="navbar-header page-scroll">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar">
             <span class="sr-only">Toggle navigation</span>
             <i class="fa fa-bars"></i>
         </button>
         <a class="navbar-brand" href="<?= base_url() ?>">Dinas PU Pekanbaru</a>
        </div>
        <div class="navbar-collapse collapse" id="bs-navbar">
          <ul class="nav navbar-nav">
            <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Profil</a>
             <ul class="dropdown-menu">
              <?php
              $this->load->model('artikel/artikel_model');
              $profil = $this->artikel_model->find_all_by('kategori_artikel','Profil');
              foreach($profil as $atk){ ?>
              <li><a href="<?= base_url('home/profil/'.$atk->id_artikel) ?>"><?= $atk->judul_artikel ?></a></li>
              <?php } ?>
             </ul>
            </li>
            <li><a href="<?= base_url('home/gis') ?>" >Peta Sarana</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
           <?php if (empty($current_user)) : ?>
           <li><a href="<?php echo site_url(LOGIN_URL); ?>" class="navbar-link">Login</a></li>
           <?php else : ?>
           <li <?php echo check_method('profile'); ?>><a href="<?php echo site_url('users/profile'); ?>"><?php e(lang('bf_user_settings')); ?></a></li>
           <li><a href="<?php echo site_url('logout'); ?>"><?php e(lang('bf_action_logout')); ?></a></li>
           <?php endif; ?>
           </ul>
          </div>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>