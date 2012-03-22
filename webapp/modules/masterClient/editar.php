<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");
include_once('controller/loadData.php');

?>
<body>
 
    
    <script>
        function onSuccess(data)
        {
            data = $.trim(data);
            
           $("#notification").text(data);
           $("#notification").css({color:"blue", fontWeight:"bold"});
           
           
           
        }
        
         
 
 
        $(document).ready(function() {
            
            
            
              ///validar
            
            $('#form1').validate({
                rules : {
                        r9codigo : {
                        required : true
                    },
                        r9nombre :  {
                         required : true
                         
                    },
                        r9rif :  {
                        required : true
                    },
                    r9email :  {
                        email : true
                    }
                     
                }
            });
           
            ///campo oculto de id
            $('#form1').append('<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />');
           
            $("#borrar").click(function(){
                
                     var answer = confirm("<?php echo LANG_confirmDelete ?>")
                    if (answer){
                        
                         
                        
                        var formData = $("#form1").serialize();
                         $.ajax({
                                type: "POST",
                                url: "controller/delete.php",
                                cache: false,
                                data: formData
                            });
                        
                        
                        $("#form1").submit();
                    }

                    return false;  
                      
            });
            
            
            
            $("#submit").click(function(){
                 
                 
                 ///validar
                 if(!$("#form1").valid()) return false; 
                    
                var formData = $("#form1").serialize();
 
                $.ajax({
                    type: "POST",
                    url: "controller/edit.php",
                    cache: false,
                    data: formData,
                    success: onSuccess
                });
 
                return false;
            });
        });
    </script>


<?php $tituloCurrent = LANG_masterClient; ?>
<div data-role="page" id="agregar">

		<div data-role="header">
                        <a href="index.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
		</div>
		<div data-role="content">
                    <div id="titulo2"><?php echo LANG_addEdit ?></div>
                        
            <form id="form1" action="index.php" data-transition="slide"  method="post">
            
                <div data-role="fieldcontain">
           <label style="font-weight:bold" for="r9codigo"><?php echo LANG_prodCode ?></label>
           <input type="text" data-mini="true" id="r9codigo" name="r9codigo" maxlength="12" value="<?php echo $datos['codigo']  ?>" />
        
             <label style="font-weight:bold" for="r9nombre"><?php echo LANG_cliName ?></label>
             <input type="text" data-mini="true" id="r9nombre" name="r9nombre" value="<?php echo $datos['nombre']  ?>"  />

        	<label style="font-weight:bold" for="r9rif"><?php echo LANG_cliRIF ?></label>
             <input type="text" data-mini="true" id="r9rif" name="r9rif" value="<?php echo $datos['rif']  ?>" />
            
             <label style="font-weight:bold" for="r9telefono1"><?php echo LANG_cliTlf ?></label>
             <input type="tel" data-mini="true" id="r9telefono1" name="r9telefono1" value="<?php echo $datos['telefono1']  ?>" />
             
              <label style="font-weight:bold" for="r9email"><?php echo LANG_email ?></label>
             <input type="email" data-mini="true" id="r9email" name="r9email"  value="<?php echo $datos['email']  ?>"/>
             
             <label style="font-weight:bold" for="r9direccion1"><?php echo LANG_cliDir ?></label>
                <textarea id="r9direccion1" name="r9direccion1"><?php echo $datos['direccion1']  ?></textarea>
            <p>
                <input type="checkbox" name="r9activo" id="r9activo" value="1" class="custom" <?php if($datos['activo']==1) echo 'checked="checked"' ?>  />
		<label for="r9activo"><?php echo LANG_cliActive ?></label>  
                
             </div>
                <div id="notification"></div>
                 <button data-role="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_save ?></button>
                 <button data-role="borrar" data-theme="c" id="borrar" value="submit-value" data-inline="true"><?php echo LANG_deleteit ?></button>
            
            </form>        
              
		</div>
</div>



    
</body>
</html>   