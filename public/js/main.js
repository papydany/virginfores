   
     
$("#department").change( function() {
 

  $("#myModal").modal();  
var id =$(this).val();

   $.getJSON("getdepartment/"+id, function(data, status){
    var $staff_id= $("#staff_id");
    $staff_id.empty();
    $staff_id.append('<option value="">Select staff</option>');
   $.each(data, function(index, value) {
   $staff_id.append('<option value="' +value.id +'">' + value.name + '</option>');
  });
  $("#myModal").modal("hide");
    });


});

