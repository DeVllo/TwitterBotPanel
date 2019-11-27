<!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total de frases:</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($TOTAL_FRASES);?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-file-alt fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Frases tweeteadas:</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($fumoporro_tweets);?>
                <?php
                //echo(mostrarCuenta($nombreusuario,"username"));
                ?>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-broadcast-tower fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Frases en cola:</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($FRASES_EN_COLA);?>
                </div>
              </div>
              <div class="col-auto">
                <i class="fas fa-at fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Pending Requests Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Seguidores</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($fumoporro_followers);?></div>
              </div>
              <div class="col-auto">
                <i class="fas fa-rss fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>