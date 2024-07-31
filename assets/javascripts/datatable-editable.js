function restoreRow ( oTable, nRow )
{
  
  var aData = oTable.fnGetData(nRow);
  var jqTds = $('>td', nRow);
  
  for ( var i=0, iLen=jqTds.length ; i<iLen ; i++ ) {
    oTable.fnUpdate( aData[i], nRow, i, false );
  }
  
  oTable.fnDraw();
} 

function editRow ( oTable, nRow )
{  
  var aData = oTable.fnGetData(nRow);
  var campaign_title = $('#campaign_title');
  var campaign_budget = $('#campaign_budget');
  var campaign_ads_count = $('#campaign_ads_count');
  var jqstatus = $('#campaign_status');
  
  if(aData[2]=='active'){
    var select= "selected";
  } else if(aData[2]=='inactive') {
    var select_inactive= "selected";
  } else {
    console.log('nothing')
  } 
  var input_id = $('#campaign_id');
  var jqTds = $('>td', nRow);
  jqTds[0].innerHTML = '<input id="campaign_id" type="text" value="'+ aData[0] +'"> <br> <label class="error campaign_error"></label>';
  jqTds[1].innerHTML = '<input id="budget" type="text" value="'+ aData[1] +'"> <br> <label class="error budget_error"></label>';
  jqTds[2].innerHTML = '<select id="status"> <option value="active" '+ select +'> Active </option>  <option value="inactive" '+ select_inactive +'> Inactive </option> </select> <br> <label class="error status_error"></label>';
  jqTds[3].innerHTML = '<input id="total_ads" type="text" value="'+aData[3]+'" disabled>';
  jqTds[4].innerHTML = '<input id="total_ads" type="hidden" value="'+aData[4]+'" disabled>';
  //jqTds[4].innerHTML = '<input type="text" value="'+aData[4]+'">';
  jqTds[5].innerHTML = '<a class="edit-row" href="javascript:void(0)"><i class="fa fa-save">  </i></a>';
  jqTds[6].innerHTML = '<a class="edits-row" href=""><i class="fa fa-save"></i></a>';
}

function saveRow ( oTable, nRow )
{
  
  var jqCampaign = $('#campaign_id');
  var jqbudget = $('#budget');
  var jqstatus = $('#status');
  var jqtotal_ads = $('#total_ads');
  var id_alert = $('#campaign_id_edits').val();
  
  oTable.fnUpdate( jqCampaign.val(), nRow, 0, false );
  oTable.fnUpdate( jqbudget.val(), nRow, 1, false );
  oTable.fnUpdate( jqstatus.val(), nRow, 2, false );
  oTable.fnUpdate( jqtotal_ads.val(), nRow, 3, false );
  //oTable.fnUpdate( jqInputs[1].value, nRow, 1, false );
  //oTable.fnUpdate( jqInputs[2].value, nRow, 2, false );
  //oTable.fnUpdate( jqInputs[3].value, nRow, 3, false );
  oTable.fnUpdate( jqtotal_ads.val(), nRow, 4, false );
  oTable.fnUpdate( '<a class="edit-row" href="javascript:void(0)"><i class="fa fa-pencil"> </i></a>', nRow, 5, false );
  oTable.fnDraw();
}

$(document).ready(function() {
  var oTable = $("#datatable-editable").dataTable({
    "sPaginationType": "full_numbers",
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: [-3, -2,-1]
      }
    ]    
  });
  var nEditing = null;

  $('#add-row').click( function (e) {
    e.preventDefault();

    var aiNew = oTable.fnAddData( [ '', '', '', '', '',
      '<a class="edit-row" href="javascript:void(0)">Edit</a>', '<a class="delete-row" href="javascript:void(0)">Delete</a>' ] );
    var nRow = oTable.fnGetNodes( aiNew[0] );
    editRow( oTable, nRow );
    nEditing = nRow;
  } );

  $('#datatable-editable').on('click', 'a.delete-row', function (e) {
    e.preventDefault();
    var deleted_id = $('#deleted_id').val();
    swal({
      title: 'Are you sure?',
      text: "You won't delete this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then(function () {
        $.ajax({
                type: "POST",        
                url: base_url+"media_admin/delete_campaign_detail/",
                data:{
                  campaign_id : deleted_id
                },
                dataType:"text",            
                cache: true,
                success : function(data) { 
                  if(data.status == 1){
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow( nRow );
                    swal('Deleted!','Your file has been deleted.','success');
                  } else {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow( nRow );
                    swal('Deleted!','Your file has been deleted.','success');
                  }
               }
          });   
      })
  });

  $('#datatable-editable').on('click', 'a.edit-row', function (e) {
    e.preventDefault();
    var jqCampaign = $('#campaign_id');
    var jqbudget = $('#budget');
    var jqstatus = $('#status');
    var jqtotal_ads = $('#total_ads');
    var campaign_id = $('#campaign_id_edit');
    var id_alert = $('#campaign_id_edits').val();
    alert(id_alert);
    /* Get the row as a parent of the link that was clicked on */
    var nRow = $(this).parents('tr')[0];

    if ( nEditing !== null && nEditing != nRow ) {
      /* Currently editing - but not this row - restore the old before continuing to edit mode */
      //restoreRow( oTable, nEditing );

      editRow( oTable, nRow );
      nEditing = nRow;
    }
    else if ( nEditing == nRow) {
      
      /* Editing this row and want to save it */
      var check_valid = 0;
      if(jqCampaign.val() == '' || jqbudget.val() =='' || jqstatus.val() == '' || jqtotal_ads.val() == '') {
          if(jqCampaign.val()==''){
            $('label.campaign_error').text('Please enter Campaingn ');
            check_valid = 1; 
          }
          if(jqbudget.val()==''){
            $('label.budget_error').text('Please enter Budget');
            check_valid = 1;
          }
          if(jqstatus.val()==''){
            $('label.status_error').text('Please select Status');
            check_valid = 1;
          }
      } else {
          $.ajax({
                    type: "POST",        
                    url: base_url+"media_admin/update_campaign_detail/",
                    data:{
                      campaign_title : jqCampaign.val(),
                      budget : jqbudget.val(),
                      status : jqstatus.val(),
                      campaign_id : id_alert
                    },
                    dataType:"JSON",            
                    cache: true,
                    success : function(data) { 
                      if(data.status == 1){
                        saveRow( oTable, nEditing );
                        nEditing = nRow;
                      } else {
                        saveRow( oTable, nEditing );
                        nEditing = nRow;
                      }
                   }
             }); 
          
        } if(check_valid == 1){
          return false;
        }

    } else {
      
      editRow( oTable, nRow );
      nEditing = nRow;
    }
  } );
} );