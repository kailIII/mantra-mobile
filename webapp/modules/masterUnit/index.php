<?php session_start();
////seguridad
$profile = "admin";
///titulo pagina y header

include("../../config/siteconfig.php");

include_once 'controller/load.php';

?>

    <?php $tituloCurrent = LANG_masterUnit; ?>    
<!--div de pagina-->
	<div data-role="page" id="mestroVendor">
		<div data-role="header">
                        <a href="../lobiMaster.php" data-icon="back"><?php echo LANG_back ?></a>
			<h1><?php echo $tituloCurrent ?></h1>
                        <a href="agregar.php" data-icon="pluss" data-ajax="false" data-theme="b"><?php echo LANG_addNew ?></a>                    
                        
		</div>
		<div data-role="content">
                    
                         <ul data-role="listview" data-inset="true" data-filter="true">
                             <?php while ($row = $tool->db_vector_nom($tool->result)) { ?>
                                <li><a class="check" data-ajax="false" href="editar.php?id=<?php echo $row["id"] ?>">
                                    
                                        <div style="color:blue"><?php echo $row["titulo"] ?><br></div>
                                    <p>
                                        <?php echo $row["descripcion"] ?>
    
                                    </p>
                                    </a></li>
                                
                              <?php } ?>  
                        </ul>
                                    
                    
		</div>
		             
	</div>
   
 
</body>
</html>
<?php $tool->cerrar(); ?>