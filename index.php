

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
    <link rel="stylesheet" type="text/css" href="css/css.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	
<div style="margin: auto;width: 60%;">
	<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
	  <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
	</div>
	<form id="addForm" name="form1" method="post">
		<div class="form-group">
			<label for="email">First Name:</label>
			<input type="text" class="form-control" id="fname" placeholder="First Name" name="fname">
		</div>
		<div class="form-group">
			<label for="email">Name:</label>
			<input type="text" class="form-control" id="lname" placeholder="Last Name" name="lname">
		</div>
		<div class="form-group">
			<label for="pwd">Email:</label>
			<input type="email" class="form-control" id="email" placeholder="Email" name="email">
		</div>
		<div class="form-group">
			<label for="pwd">Phone:</label>
			<input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
		</div>

		<input type="button" name="save" class="btn btn-primary" value="Save to database" id="save-button">
	</form>

</div>
<div class="col-sm-8">
                    <h4 class="section-subtitle"><b>Students</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="main" border="0" cellspacing="0" class="table" >
                                    <thead>
                                    <tr>
                                      
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td id="table-data">
                                            
                                        </td>
                                  
                                    </tr>
                                   
                                    </tbody>
                                </table>
                                <div id="error-message"></div>
                                <div id="success-message"></div>
                             <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close-btn">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal-edit">  
      </div>

    
    </div>
  </div>
</div>
                            </div>
                        </div>
                    </div>
                </div>

<script>
    //load data from database
    $(document).ready(function(){
        function loadTable(){
            $.ajax({
                url : "load-ajax.php",
                type : "POST",
                success : function(data){
                    $("#table-data").html(data);

             }

            });

        }
          loadTable();
          //insert new record.

          $('#save-button').on("click",function(e){
            e.preventDefault();
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var phone = $("#phone").val();
            var email = $("#email").val();
            if (fname =="" || lname=="" || phone=="" || email=="") {
                $("#error-message").html("All field ar required.").slideDown();
                 $("#success-message").slideUp();

            }
            else{
                 $.ajax({
                url : "save.php",
                type : "POST",
                data : {fname:fname,lname:lname,phone:phone,email:email},
                success : function(data){
                   if(data==1){
                     loadTable();
                     $("#addForm").trigger("reset");
                      $("#success-message").html("Data Updated successfully.").slideDown();
                     $("#error-message").slideUp();

                   }
                   else{
                     $("#error-message").html("Can not save.").slideDown();
                     $("#success-message").slideUp();
                    
                   }

                }


            });

            }

        
          })

          $(document).on("click",".delete-btn", function(){

    if(confirm("want to delete? ")){
                
                    var studentId = $(this).data("id");
                    var element = this;
                 $.ajax({
                    url :" delete.php",
                    type : "POST",
                    data :{id :studentId},
                    success : function(data){
                        if(data==1){
                            $(element).closest("tr").fadeOut();
                        }
                        else{
                            $("#error-message").html("cant delete record").slideDown();
                         $("#success-message").slideUp();
                        }

                    }
                 });
    }

          });
//show modal
         $(document).on("click",".edit-btn", function(){
            $("#modal").show();

            var studentId = $(this).data("eid");
           $.ajax({
            url : "update.php",
            type : "POST",
            data : {id: studentId},
            success: function(data){
                $("#modal-edit").html(data);

            }
           })

         });
         //hide modal box
              $("#close-btn").on("click", function(){
            $("#modal").hide();
        });
              //Save update form
               $(document).on("click","#edit-submit", function(){
                var stuId = $("#edit-id").val();
                 var fname = $("#edit-fname").val();
                  var lname = $("#edit-lname").val();
                   var email = $("#edit-email").val();
                    var phone = $("#edit-phone").val();
                    $.ajax({
                        url :"ajax-update-form.php",
                        type : "POST",
                        data :{id:stuId, fname:fname, lname:lname, email:email, phone:phone},
                        success : function(data){
                            if(data==1){
                                $("#modal").hide();
                                loadTable();
                            }
                        }
                    })

               });


    });


    /*
$(document).ready(function() {
	$('#butsave').on('click', function() {
		$("#butsave").attr("disabled", "disabled");
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var email = $('#email').val();
		var phone = $('#phone').val();
		if(fname!="" &&lname!="" && email!="" && phone!=""){
			$.ajax({
				url: "save.php",
				type: "POST",
				data: {
					fname: fname,
					lname: lname,
					email: email,
					phone: phone,
				},
				cache: false,
				success: function(dataResult){
					var dataResult = JSON.parse(dataResult);
					if(dataResult.statusCode==200){
						$("#butsave").removeAttr("disabled");
						$('#fupForm').find('input:text').val('');
						$("#success").show();
						$('#success').html('Data added successfully !'); 						
					}
					else if(dataResult.statusCode==201){
					   alert("Error occured !");
					}
					
				}
			});
		}
		else{
			alert('Please fill all the field !');
		}
	});
});*/
</script>

</body>
</html>