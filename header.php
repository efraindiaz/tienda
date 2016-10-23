<nav class="navbar navbar-default nav-color">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php" style="color:white;">MI TIENDA</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a id="newSpendClick" href="#" data-toggle="modal" data-target="#addSpending" style="color:white;"><b>Gastos</b></a></li>
        <li><a id="newItemClick" href="#" data-toggle="modal" data-target="#addItem" style="color:white;"><b>Nuevo</b></a></li>
        <li><a href="items.php" style="color:white;"><b>Artículos</b></a></li>
        <li><a href="court.php" style="color:white;"><b>Corte</b></a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div id="myAlert" style=""></div>
<!--MODAL ADD-ITEM-->
  <div class="modal fade " id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="exampleModalLabel">Nuevo Artículo</h4>
        </div>
        <div class="modal-body">
          <form id="formAddItem" action="" method="POST">
            <div class="form-group">
              <label for="">Codígo</label>
              <div class="input-group">
                <div class="input-group-addon">#</div>
                <input class="form-control" type="text" id="code" name="code" required>
              </div>              
            </div>
             <div class="form-group">
              <label for="">Descripción</label>
              <input class="form-control" type="text" id="desc" name="desc" required>
            </div>
             <div class="form-group">
              <label for="">Cantidad</label>
              <div class="input-group">
                <div class="input-group-addon">#</div>
                <input class="form-control" type="number" id="cant" name="cant" min="0" required>
              </div>
            </div>
            <div class="form-group">
              <label for="">Precio Compra</label>
              <div class="input-group">
                <div class="input-group-addon">$</div>
                <input class="form-control" type="number" step="any" id="compra" name="compra" required>
              </div>
            </div>
            <div class="form-group">
              <label for="">Precio Venta</label>
              <div class="input-group">
                <div class="input-group-addon">$</div>
                <input class="form-control" type="number" step="any" id="venta" name="venta" required>
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--FIN MODAL ADD ITEM -->

  <!--MODAL ADD SPENDING -->
  <div class="modal fade " id="addSpending" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="exampleModalLabel">Agregar Gasto</h4>
        </div>
        <div class="modal-body">
          <p class="text-center"><a href="spendings.php"> Ver lista de Gastos </a></p>
          <form action="" method="POST" id="formSpending">
            <div class="form-group">
              <label for="">Fecha</label>
              <div class="input-group">
                <div class="input-group-addon">#</div>
                <input class="form-control" type="date" id="dateSpending" value="<?php print date("Y-m-d"); ?>" min="<?php print date("Y-m-d"); ?>" required>
              </div>              
            </div>
             <div class="form-group">
              <label for="">Descripción</label>
              <input class="form-control" type="text" id="descSpending"  required>
            </div>
             <div class="form-group">
              <label for="">Monto</label>
              <div class="input-group">
                <div class="input-group-addon">$</div>
                <input class="form-control" type="number" astep="any" id="spending" min="0" required>
              </div>
              </div>
              <div class="checkbox">
                <label>
                    <input type="checkbox" id="checkboxSpending" checked="on"> Agregar al corte
                </label>
              </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button id="buttonSendSpending" type="submit" class="btn btn-danger">Guardar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN MODAL ADD SPENDING -->

