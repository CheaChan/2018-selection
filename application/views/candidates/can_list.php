<br>
<div class="container myContainer">
    <div class="row">
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="card bg-primary p-20">
                <div class="media widget-ten" id="myCard">
                    <div class="card-body text-left text-white">
                        <h1 class="mdi mdi-account-outline text-default" style="font-size: 50px;"></h1>
                    </div>
                    <div class="card-body text-right text-white">
                        <h2 class="color-white">11</h2>
                        <p class="m-b-0">All candidates</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="card bg-warning p-20">
                <div class="media widget-ten" id="myCard">
                    <div class="card-body text-left text-white">
                        <h1 class="mdi mdi-account-outline text-default" style="font-size: 50px;"></h1>
                        </div>
                        <div class="card-body text-right text-white">
                            <h2 class="color-white">9</h2>
                            <p class="m-b-0">Selected candidates</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <div class="card bg-success p-20">
                    <div class="media widget-ten" id="myCard">
                        <div class="card-body text-left text-white">
                            <h1 class="mdi mdi-map-marker text-default" style="font-size: 50px;"></h1>
                        </div>
                        <div class="card-body text-right text-white">
                            <h2 class="color-white">3</h2>
                            <p class="m-b-0">Provinces of selected candidates</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    
    <br>
    
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-8">
                <h1 class="text-center">List of candidates</h1>
                <br>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                      <a href="<?php echo base_url() ?>c_student/allCandidate"><button class="btn btn-primary clearfix">All candidates</button></a>
                      <a href="<?php echo base_url() ?>c_student/selectedCandidate"><button class="btn btn-default clearfix">Selected candidates</button></a>
                    </div>
                </div>
                <br>
                <div class="row">
                  <div class="table-responsive-sm">
                    <table id="students" class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Action</th>
                                <th>Full name</th>
                                <th>Provinces</th>
                                <th>Gender</th>
                                <th>Global grade</th>
                                <th>Selected</th>
                            </tr>
                        </thead>
                        <tbody id="showdata">
                            
                        </tbody>
                        </table>
                  </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="<?php echo base_url() ?>c_student/view_candidate_info"">
                            <button id="addButton" class="btn btn-primary clearfix">
                                <i class="mdi mdi-account-plus"></i>
                            &nbsp;New candidate
                            </button>
                        </a>
                        <a href="<?php echo base_url() ?>c_student/map">
                            <button id="mapButton" class="btn btn-primary clearfix"><i class="mdi mdi-map"></i>
                          &nbsp;Province distribution</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-4">
                <h1 class="text-center">Distribution</h1>
                <br>
                <canvas id="pie-chart" width="900" height="800"></canvas>
                <br>
                <h1 class="text-center">Selected candidate</h1>
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="pie-chart1" width="900" height="800"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="pie-chart2" width="900" height="800"></canvas>
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- pop up delete -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Confirm Delete</h4>
      </div>
      <div class="modal-body">
            Do you want to delete this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<br><br>
 <link href="<?php echo base_url();?>assets/DataTable/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
 <script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url();?>assets/DataTable//DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
 <!--We just need a JS file //-->
 <script src="<?php echo base_url();?>assets/js/Chart-2.7.1.min.js"></script>


 <script type="text/javascript">
    $(function() {
    showAllCandidates();
    //Transform the HTML table in a fancy datatable
    $('#students').dataTable({
        stateSave: true,
    });

    //delete- 
        $('#showdata').on('click', '.item-delete', function(){
            var id = $(this).attr('data');
            $('#deleteModal').modal('show');
            //prevent previous handler - unbind()
            $('#btnDelete').unbind().click(function(){
                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    async: false,
                    url: '<?php echo base_url() ?>C_candidates/deleteCandidate',
                    data:{id:id},
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#deleteModal').modal('hide');
                            $('.alert-success').html('Candidate deleted successfully').fadeIn().delay(4000).fadeOut('slow');
                            showAllEmployee();
                        }else{
                            alert('Error');
                        }
                    },
                    error: function(){
                        alert('Error deleting');
                    }
                });
            });
        });

    //function
    function showAllCandidates(){
        $.ajax({
            type: 'ajax',
            url: '<?php echo base_url() ?>C_candidates/showAllCandidates',
            async: false,
            dataType: 'json',
            success: function(data){
                var html = '';
                var id=1;
                var selected = "";
                for(i=0; i<data.length; i++){
                    if (data[i].can_global_grade ==="Failed") {
                        selected ="No";
                    }else{
                        selected = "Yes";
                    }
                    html +='<tr>'+
                                '<td>'+id+'</td>'+
                                '<td>'+
                                    '<a href="javascript:;" class="mdi mdi-eye text-info" title="View candidate information" data="'+data[i].can_id+'"></a>&nbsp;'+
                                    '<a href="javascript:;" class="mdi mdi-pencil-box-outline text-success" title="Edit candidate information" data="'+data[i].can_id+'"></a>&nbsp;'+
                                    '<a href="javascript:;" class="mdi mdi-delete text-danger" title="Delete candidate information" data="'+data[i].can_id+'"></a>'+
                                '</td>'+
                                '<td>'+data[i].can_name+'</td>'+
                                '<td>'+data[i].province+'</td>'+
                                '<td>'+data[i].can_gender+'</td>'+
                                '<td>'+data[i].can_global_grade+'</td>'+
                                '<td>'+ selected +'</td>'+

                            '</tr>';
                        id++;
                }
                $('#showdata').html(html);
                
            },
            error: function(){
                alert('Could not get Data from Database');
            }
        });
    }

    $('#showdata').on('click', '.mdi-eye', function(){
            <?php echo "View Candidate Information"; ?>
        });


    //Display a modal pop-up so as to confirm if a user has to be deleted or not
    //We build a complex selector because datatable does horrible things on DOM...
    //a simplier selector doesn't work when the delete is on page >1
    $("#users tbody").on('click', '.confirm-delete',  function(){
        var id = $(this).parent().data('id');
        var link = "<?php echo base_url();?>users/delete/" + id;
        $("#lnkDeleteUser").attr('href', link);
        $('#frmConfirmDelete').modal('show');
    });

    $("#users tbody").on('click', '.reset-password',  function(){
        var id = $(this).parent().data('id');
        var link = "<?php echo base_url();?>users/reset/" + id;
        $("#formResetPwd").prop("action", link);
        $('#frmResetPwd').modal('show');
    });
   
});

//pie chart of grade
new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["A+", "A", "A-", "B+", "B","B-","Failed"],
      datasets: [{
        label: "Grade (distribution)",
        backgroundColor: ["#3cba9f","#3e95cd","#8e5ea2","#1565c0","#e8c3b9","#ffc107","#c45850"],
        data: [85 ,1267,100,784,433,200,1380]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Grade distribution'
      }
    }
});
// pie chart1 of gender
new Chart(document.getElementById("pie-chart1"), {
    type: 'pie',
    data: {
      labels: ["Male", "Female"],
      datasets: [{
        label: "Gender (distribution)",
        backgroundColor: ["#3cba9f","#ffc107"],
        data: [60,40]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Gender distribution'
      }
    }
});
// pie chart2 of ngo provenance
new Chart(document.getElementById("pie-chart2"), {
    type: 'pie',
    data: {
      labels: ["Yes", "No"],
      datasets: [{
        label: "NGO (provenance)",
        backgroundColor: ["#3e95cd","#c45850"],
        data: [88,12]
      }]
    },
    options: {
      title: {
        display: true,
        text: 'NGO provenance'
      }
    }
});

</script>
