<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard - Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- PRINCIPAL -->
    <link rel="stylesheet" href="css/vendor.0116245c9091bc64b241b0a0fab9c567.css">
    <link rel="stylesheet" href="css/login.8e4a97ee0a781547b5667ea7d71e52ce.css">
    <!-- VENDOR -->

    <!-- END VENDOR -->
    <!-- FIM PRINCIPAL -->
    <script>
        jQuery(function($){
            // JQUERY MASK INPUT
            $('[data-mask="date"]').mask('00/00/0000');
            $('[data-mask="time"]').mask('00:00:00');
            $('[data-mask="date_time"]').mask('00/00/0000 00:00:00');
            $('[data-mask="zip"]').mask('00000-000');
            $('[data-mask="money"]').mask('000.000.000.000.000,00', {reverse: true});
            $('[data-mask="phone"]').mask('0000-0000');
            $('[data-mask="phone_with_ddd"]').mask('(00) 0000-0000');
            $('[data-mask="phone_us"]').mask('(000) 000-0000');
            $('[data-mask="cpf"]').mask('000.000.000-00', {reverse: true});
            $('[data-mask="ip_address"]').mask('099.099.099.099');
            $('[data-mask="percent"]').mask('##0,00%', {reverse: true});
            // END JQUERY MASK INPUT
        });
    </script>

</head>
<body>

<div class="root">
    <div class="styles__main__1MBmB">
        <div class="styles__container__2KCEh">
            <div class="styles__wrapper__2rsTd">
                <div>
                    <div class="styles__banner__3h8ZQ">
                        <img src="imagens/login.png">
                        <h1>Bem vindo a Minha Prefeitura</h1>
                        <p>Inicie sessão com o seu
                        <strong>Email</strong></p>
                    </div>
                    <div class="styles__form__qcayU">
                        <form action="validacao.php" method="post">
                            <div class="styles__main__3FA57 loginForm__input__295P0" style="font-size: 16px; line-height: 24px; width: 100%; height: 48px; display: inline-block; position: relative; background-color: transparent; font-family: Roboto,sans-serif; transition: height 200ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;">
                                <input placeholder="E-mail" value="" id="txUsuario" name="txUsuario" style="padding: 0px; position: relative; width: 100%; border: medium none; outline: medium none; background-color: rgba(0, 0, 0, 0); color: white; cursor: initial; font: inherit; height: 100%;" type="text">
                                <div>
                                    <hr style="border-width: medium medium 1px; border-style: none none solid; border-color: rgb(224, 224, 224); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; bottom: 8px; box-sizing: content-box; margin: 0px; position: absolute; width: 100%;">
                                    <hr style="border-width: medium medium 2px; border-style: none none solid; border-color: white; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; bottom: 8px; box-sizing: content-box; margin: 0px; position: absolute; width: 100%; transform: scaleX(0); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;">
                                </div>
                            </div>
                            <div class="styles__main__3FA57 loginForm__input__295P0" style="font-size: 16px; line-height: 24px; width: 100%; height: 48px; display: inline-block; position: relative; background-color: transparent; font-family: Roboto,sans-serif; transition: height 200ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;">
                                <input placeholder="Senha" value="" id="txSenha" name="txSenha" style="padding: 0px; position: relative; width: 100%; border: medium none; outline: medium none; background-color: rgba(0, 0, 0, 0); color: white; cursor: initial; font: inherit; height: 100%;" type="password">
                                <div>
                                    <hr style="border-width: medium medium 1px; border-style: none none solid; border-color: rgb(224, 224, 224); -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; bottom: 8px; box-sizing: content-box; margin: 0px; position: absolute; width: 100%;">
                                    <hr style="border-width: medium medium 2px; border-style: none none solid; border-color: white; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; bottom: 8px; box-sizing: content-box; margin: 0px; position: absolute; width: 100%; transform: scaleX(0); transition: all 450ms cubic-bezier(0.23, 1, 0.32, 1) 0ms;">
                                </div><!-- react-text: 28 --><!-- /react-text -->
                            </div>
                            <button type="submit" class="dbutton loginForm__login__3_XRs styles__button__3Yr7O styles__primary__15nU3 styles__inverted__1LcmY" id="nw_submit">Entrar</button>
                        </form>
                    </div>
                    <div class="styles__more__3Rrtw"><a href="/reset-password/?service=43f17c5f-9ba4-4f13-853d-9d0074e349a7">Resetar Senha?</a></div>
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- VENDOR -->
    <script src="lib/jquery.js"></script>
    <script src="lib/bootstrap.js"></script>
    <script src="lib/jquery-ui.js"></script>
    <script src="lib/modernizr.custom.js"></script>
    <script src="js/tempo.js"></script>
    <!-- END VENDOR -->

    <!-- PRINCIPAL -->

    <!-- FIM PRINCIPAL -->
</body>
</html>
