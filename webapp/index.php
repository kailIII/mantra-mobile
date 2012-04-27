<?php session_start(); ?>
<?php 

include("./config/siteconfig.php");

?>
<body>
      <script>
        function onSuccess(data)
        {
            data = $.trim(data);

            if(data==1){
                $(location).attr('href','modules/lobi.php');
            }else{
              alert('<?php echo LANG_nologin  ?>');
          
          }
        }
 
        function onError(data, status)
        {
            // handle an error
        }        
 
  
        $(document).ready(function() {
            
                
            $("#submit").click(function(){
 
                               
                var formData = $("#form1").serialize();
 
                $.ajax({
                    type: "POST",
                    url: "modules/controller/validar.php",
                    cache: false,
                    data: formData,
                    success: onSuccess,
                    error: onError
                });
 
                return false;
            });
        });
    </script>
    
    
    
<!--div de login-->
	<div data-role="page" id="login">
		<div data-role="header">
                    <img  src="css/images/mantralogo.png" width="145" height="34" style="matralogo"/>

		</div>
		<div data-role="content">
                    
           <form id="form1" action="modules/lobi.php" data-transition="slide" method="post">
            <?php echo LANG_adlogin ?>           
            
              <div data-role="fieldcontain">
                  
             <label style="font-weight:bold" for="user"><?php echo LANG_user ?></label>
             <input type="text" data-mini="true" id="user" name="user" />

	     <label style="font-weight:bold" for="clave"><?php echo LANG_pass ?></label>
             <input type="password" data-mini="true" id="clave" name="clave" />
             
             
              </div>
             
             <button type="submit" data-theme="b" id="submit" value="submit-value" data-inline="true"><?php echo LANG_enter ?></button>
           </form>
           
		</div>
		<div data-role="footer">
			<h4>Footer</h4>
		</div>
             
	</div>
<!--div de login-->    
   
 
</body>
</html>