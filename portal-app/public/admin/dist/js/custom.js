$(document).ready(function(){
//  Check admin password is correct or not
$("#current_pwd").keyup(function(){
    var current_pwd = $("#current_pwd").val();
    // alert(current_pwd);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url: '/admin/check-current-password',
        data:{current_pwd:current_pwd},
        success:function(resp){
            if(resp=="false"){
                $("#verifyCurrentPwd").html("Current Password is Incorrect")
            }else if(resp=="true"){
                $("#verifyCurrentPwd").html("Current Password is Correct")
            }

        },error:function(){
           alert("Error"); 
        }


    })
})

// Update CMS Page Status
$(document).on("click",".updateCmsPageStatus", function(){
    var status = $(this).children("i").attr("status");
    var page_id = $(this).attr("page_id");
    // alert(page_id); 
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-cms-status',
        data:{status:status,page_id:page_id},
        success:function(resp){
            if(resp['status']==0){

                $("#page-"+page_id).html("<i class = 'fa fa toggle-off' style: 'color:grey'; 'font-size: 26px' status: 'Inactive'></i>");
            }else if(resp['status']==1){
                $("#page-"+page_id).html("<i class = 'fa fa toggle-on' style:'font-size:26px'; 'color:blue' status: 'Active'></i>");

            }
           
        },error:function(){
            alert("Error");
        }
    })
})

// Update Sub admin status
$(document).on("click",".updateSubAdminStatus", function(){
    var status = $(this).children("i").attr("status");
    var subadmin_id = $(this).attr("subadmin_id");
    // alert(page_id); 
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        url:'/admin/update-subadmin-status',
        data:{status:status,subadmin_id:subadmin_id},
        success:function(resp){
            if(resp['status']==0){

                $("#subadmin-"+subadmin_id).html("<i class = 'fas fa-toggle-off' style: 'color:grey'; 'font-size: 26px' status: 'Inactive'></i>");
            }else if(resp['status']==1){
                $("#subadmin-"+subadmin_id).html("<i class = 'fas fa-toggle-on' style:'font-size:26px'; 'color:blue' status: 'Active'></i>");

            }
           
        },error:function(){
            alert("Error");
        }
    })
})

$(document).on("click", ".confirmDelete", function(){
    var record = $(this).attr("record");
    var recordid = $(this).attr("recordid");
    
   Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!"
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire({
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success"
      });
      window.location.href = "/admin/delete-"+record+"/"+recordid;
    }
  });
})



});