<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="Content-Type" charset="utf-8" content="text/html; utf-8 " />

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="<#ROOT#>/bootstrap/docs/examples/navbar-fixed-top/favicon.ico">

        <title>Fixed Top Navbar Example for Bootstrap</title>

        <!-- Bootstrap core CSS -->
        <link href="<#ROOT#>/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Custom styles for this template -->
        <link href="<#ROOT#>/bootstrap/docs/examples/navbar-fixed-top/navbar-fixed-top.css" rel="stylesheet">
        <link href="<#ROOT#>/bootstrap/docs/examples/navbar-fixed-top/additional-slider.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="/bootstrap/docs/examples/navbar-fixed-top/assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!--script src="./bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
        <!--script src="./bootstrap/assets/js/slider.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
        <script>tinymce.init({selector:'textarea'});</script>        
        <script type="text/javascript" src="<#ROOT#>/script.js"></script>
    </head>

    <body>
        <!--var link = "./xulytest.php?loai=" + loai + "&loaiid=" + loaiid + "&request=" + request;    -->
        <!-- Fixed navbar -->
    
        <#NAVBAR#>
        <#HEADER#>
	
        <div class="container" style="margin-top:20px;">
            <!-- Main component for a primary marketing message or call to action -->
            <div id='content' class='row-fluid'>
                <#LEFT_SIDEBAR#>
                <#MAIN#>
                <#RIGHT_SIDEBAR#>
            </div>	
        </div> <!-- /container -->

        <div id="footer" style="margin-top:30px;">
            <div class="container">
              <div class="row">
                
                  <div class="col-sm-3">
                    <div class="foot-header">
                      Acerca de Nosotros <img src="http://200.27.156.170/ean_default/img/cocha/icon-cocha.png">
                    </div>
                    <div class="foot-links">
                      <a href="http://internet.cocha.com/nuestra-empresa/nuestra-empresa.html">Nuestra Empresa</a>
                      <a href="http://cms.cocha.com/sucursales.html">Sucursales</a>
                      <a href="http://internet.cocha.com/_DisenoWeb/minisitios/sitio/por-que-comprar-en-cocha.html?cid=por-que-comprar-en-cocha">Por qué comprar en Cocha</a>
                      <a href="http://internet.cocha.com/virgin_galactic/virgin_galactic.html">Virgin Galactic</a>
                      <a href="http://internet.cocha.com/_DisenoWeb/minisitios/sitio/trabaja-con-nosotros.html?cid=trabaja_en_cocha">Trabaja con nosotros</a>
                      <a href="http://www.cochainbound.com/" target="_blank">¿Vienes a Chile?</a>
                    </div>
                  </div><!--/col-sm-3-->
                <div class="col-sm-3">
                  <div class="foot-header"> Servicio al cliente <img src="http://200.27.156.170/ean_default/img/cocha/servicio-al-cliente-icon.png"></div>
                  <div class="foot-links">
                    <a href="javascript:Contacto()">Contáctanos</a>
                    <a href="http://internet.cocha.com/_DisenoWeb/minisitios/sitio/servicio-al-pasajero.html?cid=atencion-al-pasajero">Atención al pasajero</a>
                    <a href="http://internet.cocha.com/_DisenoWeb/minisitios/sitio/faq.html?cid=preguntas-frecuentes">Preguntas frecuentes</a>
                    <a href="http://cms.cocha.com/terminos-y-condiciones">Términos y Condiciones Generales</a>
                    <a href="http://internet.cocha.com/_DisenoWeb/check-in/check-in.html?cid=check-in-on-line">Check-in en línea </a>
                    <a href="http://www.cocha.com/ibe/bookingManagement/retrieveBookingForm.do">Consultar reserva</a>
                    <a href="http://internet.cocha.com/manual-del-viajero.pdf" target="_blank">Manual del viajero</a>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="foot-header">
                    Medios de pago <img src="http://200.27.156.170/ean_default/img/cocha/card-icon.png">
                  </div>
                  <div class="foot-links">
                    <p>
                      <i class="fa fa-check text-success"></i> Tarjetas de crédito<br>
                      <img src="http://200.27.156.170/ean_default/img/cocha/visa-card.png">
                      <img src="http://200.27.156.170/ean_default/img/cocha/master-card.png">
                      <img src="http://200.27.156.170/ean_default/img/cocha/dinner-club-card.png">
                    </p>
                    <p>
                      <i class="fa fa-check text-success"></i> Transferencias bancarias<br>
                      <img src="http://200.27.156.170/ean_default/img/cocha/banco-santander-card-1.png">
                      <img src="http://200.27.156.170/ean_default/img/cocha/banco-de-chile-card-1.png">
                    </p>
                    <p>
                      <i class="fa fa-check text-success"></i> Tarjeta Ripley<br>
                      <img src="http://200.27.156.170/ean_default/img/cocha/ripley-card.png">
                    </p>
                  </div>
                </div><!--/col-sm-3-->
                <div class="col-sm-3">
                  <img src="http://200.27.156.170/ean_default/img/cocha/tripadvisor-logo.jpg" class="img-responsive img-thumbnail">
                  <br><br>
                  <a href="http://internet.cocha.com/especiales/sello-de-calidad-turistica.html" style="float: left;">
                    <img src="http://200.27.156.170/ean_default/img/cocha/sello_de_calidad_turistica.png" alt="sello de calidad turistica" height="70" width="121">
                  </a>
                  <a href="http://www.chileestuyo.cl/" target="_blanck" style="float: left; margin-left: 20px;">
                    <img src="http://200.27.156.170/ean_default/img/cocha/Logo_Chileestuyo.png" alt="Logo Chileestuyo" height="70">
                  </a>
                </div>
                
                </div><!--/row-->
              <div class="row">
                <center><img src="http://200.27.156.170/ean_default/img/cocha/footer-bg.png"></center>
                <div id="bottom-footer">
                  <div class="row">
                    <div class="col-md-8">
                    <a href="http://www.cocha.com/ibe/common/home.do">Inicio</a>
                    <a href="http://cms.cocha.com/vuelos.html">Vuelos</a>
                    <a href="http://cms.cocha.com/hoteles?cid=HOTELES">Hoteles</a>
                    <a href="http://cms.cocha.com/paquetes.html">Paquetes</a>
                    <a href="http://cms.cocha.com/cruceros.html">Cruceros</a>
                    <a href="http://autos.cocha.com/">Autos</a>
                    <a href="http://cms.cocha.com/otros-productos.html">Otros productos</a>
                    <a href="http://cms.cocha.com/destinos.html">Destinos</a>
                    <a href="http://internet.cocha.com/_DisenoWeb/minisitios/sitio/viajes-corporativos.html?cid=viajes-corporativos">Empresas</a>
                    </div>
                    <div class="col-md-4 phone">
                      <img src="http://200.27.156.170/ean_default/img/cocha/phone-icon.png" class="pull-left">
                      <div class="pull-left">
                        <span class="red">2 2464 1300 <small>Atencion al pasajero</small></span>
                      </div>
                      <div class="pull-right">
                        <span class="red">(56) 2 2464 1200 <small>Emergencia 24 hrs.</small></span>
                      </div>
                      </div>
                </div>
              </div><!--/row 2-->
                  <div class="row" id="final-footer">
                    <div class="col-sm-4">
                      <img src="http://200.27.156.170/ean_default/img/cocha/RapidSSL_SEAL-90x50.gif">
                    </div>
                    <div class="col-sm-4 text-center">
                        Copyright © 2015 Cocha. All Rights Reserved
                        El Bosque Norte 0430, Las Condes, Santiago - Chile
                    </div>
                    <div class="col-sm-4 text-right">
                        <span class="fa-stack fa-lg">
                          <i class="fa fa-circle text-primary fa-stack-2x"></i>
                          <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                        </span>
                      <span class="fa-stack fa-lg">
                          <i class="fa fa-circle text-info fa-stack-2x"></i>
                          <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                        </span>
                      <span class="fa-stack fa-lg">
                          <i class="fa fa-circle text-danger fa-stack-2x"></i>
                          <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                  </div>
              </div><!--/container-->
            </div><!--/footer-->
        </div>


        <div id="push"></div>
        
        <!-- Modal -->
        <div name="modalbox" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Login</h4>
                    </div>
                    <form role="form">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="usernameOrEmailField" class="sr-only">Username or Email</label>
                                <div class="input-group">
                                  <span class="input-group-addon "><span class="glyphicon glyphicon-user"></span></span>
                                  <input type="email" class="form-control" id="usernameOrEmailField" placeholder="Enter username or email">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="passwordField" class="sr-only">Password</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                    <input type="password" class="form-control" id="passwordField" placeholder="Password">
                                </div>
                                <a href="#" class="pull-right small">Forgot password?</a>
                            </div>
                            
                            <div class="checkbox">
                                <label><input type="checkbox"> Stay signed in</label>
                            </div>
                        </div>
                       
                        <div class="modal-footer">
                            <a href="<#ROOT#>/login" class="btn btn-primary btn-sm pull-left">Login with Facebook</a>
                            <button type="button" class="btn btn-success btn-sm">Sign in</button>
                            <button type="button" class="btn btn-primary btn-sm">Create account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>      
        
        <!--Modal large-->
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tạo câu hỏi mới</h4>
              </div>      	<form class="form-horizontal" role="form" method="POST" action="/xuly.php">
              <div class="modal-body">

            <div class="form-group">
                  <label class="col-lg-1 control-label">Tiêu đề:</label>
                  <div class="col-lg-10">
                    <input class="form-control" value="" type="text" name="tieu-de">
                  </div></div>

            <div class="form-group">
                  <label class="col-lg-1 control-label">Nội dung:</label>
                  <div class="col-lg-10">
                    <textarea class="form-control" rows="3" name="noi-dung"></textarea> </div>
                  </div>
            <div class="form-group">
                  <label class="col-lg-1 control-label">Thẻ:</label>
                  <div class="col-lg-10">
                    <input class="form-control" value="" type="text" name="the">
                  </div></div>


                    <input value="create-question" type="hidden" name="request">      				
                    <input value="cau-hoi" type="hidden" name="loai">      				


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary">Tạo câu hỏi</button>

              </div>
                      </form>
            </div>
          </div>
        </div>
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->

        <script src="<#ROOT#>/bootstrap/dist/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="<#ROOT#>/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
        
    </body>
</html>
