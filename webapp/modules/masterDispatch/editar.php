<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");
include_once('controller/loadData.php');

?>
<body>


<script>
    function onSuccess(data) {
        data = $.trim(data);

        $("#notification").text(data);
        $("#notification").css({color:"blue", fontWeight:"bold"});


    }


    $.validator.addMethod("not_blank_between", function () {

        var n = $('#r9user').val().split(" ");
        if (n.length > 1)
            return false;
        else
            return true;

    }, "<?php echo LANG_nologinBlank ?>");


     $("div[data-role*='page']").live('pageshow', function() {  


        $('#form1').validate({
            rules:{
                r9codigo:{
                    required:true
                },
                r9user:{
                    required:true,
                    not_blank_between:true
                },
                r9nombre:{
                    required:true
                },
                r9email:{
                    email:true
                }


            }
        });


        ///campo oculto de id
        $('#form1').append('<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />');

        $("#borrar").click(function () {

            var answer = confirm("<?php echo LANG_confirmDelete ?>")
            if (answer) {


                var formData = $("#form1").serialize();
                $.ajax({
                    type:"POST",
                    url:"controller/delete.php",
                    cache:false,
                    data:formData
                });


                $(location).attr('href', 'index.php');
            }

            return false;

        });


        $("#submit").click(function () {


            ///validar
            if (!$("#form1").valid()) return false;

            if ($("#clave").val() != $("#clave2").val()) {
                alert('<?php echo LANG_noPass2 ?>');
                return false;
            }


            var formData = $("#form1").serialize();

            $.ajax({
                type:"POST",
                url:"controller/edit.php",
                cache:false,
                data:formData,
                success:onSuccess
            });

            return false;
        });
    });
</script>


<?php $tituloCurrent = LANG_masterDispatch; ?>
<div data-role="page" id="agregar">

    <div data-role="header">
        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>

        <h1><?php echo $tituloCurrent ?></h1>
    </div>
    <div data-role="content">
        <div id="titulo2"><?php echo LANG_addEdit ?></div>

        <form id="form1" action="index.php" data-transition="slide" method="post">

            <div data-role="fieldcontain">
                <label style="font-weight:bold" for="r9codigo"><?php echo LANG_prodCode ?></label>
                <input type="text" data-mini="true" id="r9codigo" name="r9codigo" maxlength="12"
                       value="<?php echo $datos['codigo']  ?>"/>

                <label style="font-weight:bold" for="r9nombre"><?php echo LANG_cliName ?></label>
                <input type="text" data-mini="true" id="r9nombre" name="r9nombre"
                       value="<?php echo $datos['nombre']  ?>"/>

                <label style="font-weight:bold" for="r9email"><?php echo LANG_email ?></label>
                <input type="email" data-mini="true" id="r9email" name="r9email"
                       value="<?php echo $datos['email']  ?>"/>

                <label style="font-weight:bold" for="r9user"><?php echo LANG_venUser ?></label>
                <input type="text" data-mini="true" id="r9user" name="r9user" value="<?php echo $datos['user']  ?>"/>

                <label style="font-weight:bold" for="clave"><?php echo LANG_pass ?></label>
                <input type="password" data-mini="true" id="clave" name="clave" value="<?php echo $datos['pass']  ?>"/>

                <label style="font-weight:bold" for="clave"><?php echo LANG_pass2 ?></label>
                <input type="password" data-mini="true" id="clave2" name="clave2"
                       value="<?php echo $datos['pass']  ?>"/>

                <p>
                    <input type="checkbox" name="r9activo" id="r9activo" value="1"
                           class="custom" <?php if ($datos['activo'] == 1) echo 'checked="checked"' ?>  />
                    <label for="r9activo"><?php echo LANG_disActive ?></label>

                <div id="notification"></div>
            </div>

            <button data-role="submit" data-theme="b" id="submit" value="submit-value"
                    data-inline="true"><?php echo LANG_save ?></button>
            <button data-role="borrar" data-theme="c" id="borrar" value="submit-value"
                    data-inline="true"><?php echo LANG_deleteit ?></button>

        </form>

    </div>
</div>


</body>
</html>   