<?php
require_once('functions.php');

?>
<!--Initialize Header section and css files-->
<?php echo get_header(); ?>

</div>
      <div class="container-fluid main-content">
      <div class="page-title"></div>
		<div class="row">
		  <div class="col-lg-12">
		    <div class="widget-container fluid-height clearfix">
         <div class="head-design"> 
		      <div class="heading">
		          <i class="fa fa-search"></i>Search Analytics
		      </div>
			      <div class="row">
			      	<div class="col-md-3"></div>
			      	<div class="col-md-7">
                    
             <!--<span style="font-weight: bold; font-size: 600; color:red"> Note : This section will be available in next phase. Sample data is shown for reference. </span>-->
			      	<div class="widget-content padded"><br>
			        	<form action="#" class="form_search_campaign_analytics form-horizontal">
				          <div class="form-group">
				            <label class="control-label col-md-2"> Select Report </label>
				            <div class="col-md-7">
				              <select class="form-control" id="select_report_analytics">
                        <option value="0">Views</option>
					              <option value="1">Impression</option>
					              <option value="2">Duration</option>
					              <option value="3">Budget</option>
				              </select>
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="control-label col-md-2"> Select Campaign </label>
				            <div class="col-md-7">
				              <select class="form-control" id="select_campaign_analytics">
                        <option value="0">All</option>
                        <?php foreach($get_advertisment_campaigns as $data) {  ?>
                          <option value="<?php echo $data['id']; ?>"> <?php echo $data['title']; ?> </option>
                        <?php } ?>
				              </select>
				            </div>
				          </div>
				          <div class="form-group">
				            <label class="control-label col-md-2"> Campaign Status </label>
				            <div class="col-md-7">
				              <label class="radio-inline"><input name="analytics_status" type="radio" value="Active" checked><span>Active</span></label>
				              <label class="radio-inline"><input name="analytics_status" type="radio" value="Inactive"><span>Inactive </span></label>
				            </div>
				          </div>
                   <?php if(isset($_SESSION['admin_login'])){ ?>
                        <div class="form-group">
                    	<label class="control-label col-md-2">  </label>
                    	<div class="col-md-7">
                     	<!--  <button type="button" class="search_campaign_name"> Search </button> -->
                     	<button type="button" id="serch2" class="search_analytics"> Search </button>
                    </div>
                  </div>

                  <?php } else if(isset($_SESSION['enterprise_account'])){ ?>                
                  <div class="form-group">
                    <label class="control-label col-md-2">  </label>
                    <div class="col-md-7">
                     <!--  <button type="button" class="search_campaign_name"> Search </button> -->
                     <button type="button" class="search_advertisements1"> Search </button>
                    </div>
                  </div>
                <?php } else if(isset($_SESSION['rydlr_admin_login'])){ ?>
                  <div class="form-group">
                    <label class="control-label col-md-2">  </label>
                    <div class="col-md-7">
                     <!--  <button type="button" class="search_campaign_name"> Search </button> -->
                     <button type="button" class="search_advertisements_for_admin1"> Search </button>
                    </div>
                  </div>
                <?php } ?>
                
			        	</form>
			      	  </div>
			        </div>
			       <div class="col-md-2"></div>
		      	  </div>
            </div> 

         
		      	  <!-- Data table section starting from here -->
		      <div class="container main-content">
          <!-- new tabel staret from hear -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container fluid-height clearfix">
               <div class="heading">
                  <span class="fa fa-file"></span>Analytics Details
                </div>
    
          <div class="col-lg-6">            
              <div class="widget-container fluid-height">            
                <div class="widget-content padded text-center" style="height: 444px !important;">
                   <?php
                 $chart_array = $ary = array();
                           foreach ($get_advertisment_details as $data => $value) {
                         
                          $ary['y'] = $value['adCount'];
                          $ary['label'] = $value['ad_name'];
                          $chart_array[] = $ary;
                        }
                        //echo "<pre>";
                       // print_r($chart_array);
                 ?>
                 <div class="xxdd">
                  <div id="chartContainer"></div><br><br><br>
                  </div>             
                </div> 
              </div>           
          </div>



          <div class="widget-content padded clearfix">
            <div class="col-lg-6">
              <div class="table-responsive">
                <table class="table table-bordered table-striped  tbl_search_campaign" id="datatable-editable">
                  <thead>
                    <th>Campaign Name</th>
                    <th> Campaign status</th>
                    <th>Ad Name</th>
                    <th class="hidden-xs">Ad Views</th>                
                  </thead>                  
                  <tbody class="append_test">
                  <?php 
                  if(count($get_advertisment_details)){

                    foreach($get_advertisment_details as $data=>$value) {
                    ?>              
                      <tr>
                        <td><?php echo  $value['campaign_name']; ?></td>
                        <td><?php echo ucfirst( $value['camp_status']); ?></td>
                        <td><?php echo $value['ad_name']; ?></td>
                        <td class="hidden-xs">
                        <?php 
                                  if($value['adCount'] >=1)
                                  {
                                  echo $value['adCount'];             
                                  }
                                  else
                                    {
                                      echo 0;
                                    }
                           ?>
                        </td>
                      </tr>
                        <?php 
                      } 
                        }?>  
                  </tbody>                  
                </table>
              </div>
            </div><!--this div close 6 -->
          </div>
 		
            </div>

             

          </div>
        </div>
        <!-- end DataTables Example -->
      </div>
          <!-- Data table ending here -->


<?php echo get_footer(); ?> 

<script>
$(function () {
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title: {
    text: "",
    fontFamily: "tahoma"
  },
  axisX:{
          title: "Ad Name",
          tickColor: "#ddd",                              
          lineColor: "#ddd"
          //gridColor: "orange"
        },
        axisY:{
          title: "Ad Views",          
          tickColor: "#ddd",                             
          lineColor: "#ddd",
          gridColor: "#ddd"
        },
  data: [
  {
    type: "column",
    color:"#428bca",                
    dataPoints: <?php echo json_encode(array_values($chart_array), JSON_NUMERIC_CHECK); ?>
  }
  ]
});
chart.render();
});

		$('.search_analytics').on('click', function(){
//	alert('ok');
	//	die();
    //exit();	
		$('.loader').show();
		
		var report_id =  $('#select_report_analytics').val();
		var campaign_id =  $('#select_campaign_analytics').val();
		var status = $('form.form_search_campaign_analytics').find('input[name="analytics_status"]:checked').val();
			//alert(status);
			//exit();
		$.ajax({
				type: "POST",	
				url: base_url+"common_admin/search_campaign_analytics/",		 
				
				data:{
					report_id : report_id,
					campaign_id : campaign_id,
					campaign_status : status
				},
				dataType:"JSON",						
				cache:false,
	             success : function(data) {
	             	
	             	$('.loader').hide();
                 $('#chartContainer').empty();
          //document.getElementById("chartContainer").remove();
          // htmls+='<div class="chartContainer"></div>';
             // $(".xxdd").append(htmls);
          // alert("here");
          
            if (report_id == '3'){

              var chart_array = [];
              var chart_array2 = [];
              var chart_array3 = [];
              var i = 0;
            $.each(data, function(i, value) {
             // var array = {}; 
             // var array2 = {};
              var array3 = {};
               // array["y"] = value.adviews1;
               // array["label"] = value.ad_title;
               // array2["y"] = value.adviews2;
              //  array2["label"] = value.ad_title;
              /* changes by rxoom */
               // array3["y"] = value.adviews3;
               array3["y"] = value.adviews3;
                array3["label"] = value.ad_title;
              //  chart_array[i] = array;
              //  chart_array2[i] = array2;
                chart_array3[i] = array3;
                i++;
            });
              
            //  var abc = chart_array;
            //  var abc2 = chart_array2;
              var abc3 = chart_array3;
             // alert(abc3);
              if(abc3.length <= 0){
                var text = "No Data Found";
              }else{
                var text = " ";
              }
              //alert(abc.length);
            $(function () {
                    var chart = new CanvasJS.Chart("chartContainer", {
                      animationEnabled: true,
                      title: {
                        text: text,
                        fontFamily: "tahoma"
                      },
                      axisX:{
                              tickColor: "#ddd",                              
                              lineColor: "#ddd"
                              //gridColor: "orange"
                            },
                            axisY:{
                              tickColor: "#ddd",                             
                              lineColor: "#ddd",
                              gridColor: "#ddd"
                            },
                      data: [
                      // {
                      //   type: "column",
                      //   name:"Ad Impression Spend($)",
                      //   showInLegend: true,
                      //  // startAngle: 240,
                      //   //yValueFormatString: "##0.00\"$\"",
                      //   //indexLabel: "{label} {y}",
                      //   color:"#428bca",                                                        
                      //   dataPoints: abc
                      // },
                      // {
                      //   type: "column",
                      //   name:"Ad Count Spend($)",
                      //   showInLegend: true,                       
                      //   color:"red",                                
                      //   dataPoints: abc2
                      // },
                      {
                        type: "column",                       
                        name:"Ad Total Spend($)",
                        showInLegend: true,
                        //color:"green",  
                        color:"#428bca",                              
                        dataPoints: abc3
                      }
                      ]
                    });
                    chart.render();
                    });

            

            }else{
                var chart_array = [];
              var i = 0;
            $.each(data, function(i, value) {
              var array = {}; 
                array["y"] = Number(value.adviews);
                array["label"] = value.ad_title;
                chart_array[i] = array;
                i++;
            });
              
              var abc = chart_array;
              if(abc.length <= 0){
                var text = "No Data Found";
              }else{
                var text = " ";
              }
              //alert(abc.length);
              if(report_id == '0'){
                var ytl = "Ad Views";
              }else if(report_id == '1'){
                var ytl = "Impression";
              }else if(report_id == '2'){
                var ytl = "Duration(In Seconds)";
              }else{
                var ytl = " ";
              }

            $(function () {
                    var chart = new CanvasJS.Chart("chartContainer", {
                      animationEnabled: true,
                      title: {
                        text: text,
                        fontFamily: "tahoma"
                      },
                      axisX:{
                              title: "Ad Name",                              
                              tickColor: "#ddd",                              
                              lineColor: "#ddd"
                              //gridColor: "orange"
                            },
                            axisY:{
                              title: ytl,
                              tickColor: "#ddd",                             
                              lineColor: "#ddd",
                              gridColor: "#ddd"
                            },
                      data: [
                      {
                        type: "column",
                        color:"#428bca",                
                        dataPoints: abc
                      }
                      ]
                    });
                    chart.render();
                    });

            }

     					$(".dataTables_wrapper").remove();

     					if(data.status == 0){
              var htmls = '';
     					htmls +='<table class="table table-bordered table-striped  tbl_search_campaign_advertise" id="datatable-editable">';
							htmls += '<thead><tr>';
							htmls += '<th> Campaign Name </th>';
							htmls += '<th> Campaign status </th>';
							htmls += '<th> Ad Name </th>';
							if(report_id == '0')
							{
								htmls += '<th> Ad Views </th>';
							}
							else if (report_id == '1') 
							{
								htmls += '<th> Impression </th>';
							}
							else if (report_id == '2') 
							{
								htmls += '<th> Duration(In Seconds) </th>';
							}
							else if(report_id == '3') 
							{
								htmls += '<th> adImpression Spend($) CPM </th>';
								htmls += '<th> adImpression Spend($) CPV </th>';
								htmls += '<th> adtotal Spend($) </th>';
							}
							else
							{
								htmls += '<th> dfdfdf </th>';
							}
							htmls += '</tr></thead><tbody>';		            
							if(report_id == '3')
							{
							htmls += '<tr><td>' + '</td>' +
							'<td>' + ' </td>' +
							'<td>' + '<center> no data found </center></td>' + 
							'<td>' + ' </td>' +
							'<td>' + ' </td>' +
							'<td>' + ' </td>' +
							//'</td>'+ ''+
							'</tr>';
							}
							else
							{
							htmls += '<tr><td>' + '</td>' +
							'<td>' + '<center> no data found </center></td>' + 
							'<td>' + ' </td>' +
							'<td>' + ' </td>' +
							
							//'</td>'+ ''+
							'</tr>';
							}
							htmls +='</thead></tbody>';	
							
							$(".table-responsive").append(htmls);
							$('.loader-search').addClass('hide');
							$('#datatable-editable').dataTable({
								columnDefs: [{
									orderable: false, targets: -1
								}],
								stateSave: true
							});
							$('[data-toggle="tooltip"]').tooltip();	
     					} 
              else{

     					var htmls = '';
								htmls +='<table class="table table-bordered table-striped  tbl_search_campaign_advertise" id="datatable-editable">';
								htmls += '<thead><tr>';
								htmls += '<th> Campaign Name </th>';
								htmls += '<th> Campaign status </th>';
								htmls += '<th> Ad Name </th>';
								if(report_id == '0')
								{
									htmls += '<th> Ad Views </th>';
								}
								else if (report_id == '1') 
								{
									htmls += '<th> Impression </th>';
								}
								else if (report_id == '2') 
								{
									htmls += '<th> Duration(In Seconds) </th>';
								}
								else if(report_id == '3')
								{
									htmls += '<th> Ad Impression Spend($) CPM </th>';
									/*htmls += '<th> Ad Count Spend($) </th>';*/
                  htmls += '<th> Ad View Spend($) CPV </th>';
									htmls += '<th> Ad Total Spend($) </th>';	
								}
								
								htmls += '</tr></thead><tbody>';		            
								// htmls += '<input type="hidden" name="campaign_id" id="campaign_id_edit" value="'+data.id+'"><input type="hidden" name="campaign_title" id="campaign_title" value="'+data.title+'"><input type="hidden" name="campaign_budget" id="campaign_budget" value="'+data.budget+'"><input type="hidden" name="campaign_status" id="campaign_status" value="'+data.status+'"><input type="hidden" name="campaign_ads_count" id="campaign_ads_count" value="'+data.ad_title+'">';
								// edit = '<td> <a class="edit_campaign" href="#" data-toggle="modal" data-target="#myModal1" onclick="edit_campaign()" ><i class="fa fa-pencil"><span class="hidden" name="campaign_id" id="campaign_id"> '+data.id+' </span> <span class="hidden" name="campaign_title" id="campaign_title"> '+data.title+' </span> <span class="hidden" name="campaign_budget" id="campaign_budget"> '+data.budget+' </span> <span class="hidden" name="campaign_status" id="campaign_status"> '+data.status+' </span> </i> </a></td>';
								// deletes = '<td> <a class="delete_campaign" href="#" onclick="delete_campaigns()"><i class="fa fa-trash-o"> <span class="hidden" name="campaign_id" id="deleted_id"> '+data.id+' </span>  </i></a> </td>';
								// view  = '<td> <a class="" href="#"><i class="fa fa-eye"></i></a> </td>';
								// foreach($get_advertisment_details as $data=>$value){
								//$.each(data, function(i, value) {
									//if ( value.adviews == null){
     								 //  delete sjonObj[key];
     								// value.adviews == '0';
    							//}
							  //	var approval_status_var = '';
                                //hear change for approvel color 
                if (report_id == '3'){
                $.each(data, function(i, value) {  
               // console.log(value.adviews2);      
								htmls +=
								'</td><td>' + value.title + 
								'</td><td>' + value.camp_status+	
								'</td><td>' + value.ad_title +
								//'</td><td>' + value.adviews+
								'</td><td>' + value.adviews1+		
								'</td><td>' + value.adviews2+
								'</td><td>' + value.adviews3+
								'</tr>';
								});
                }
                else
                {
                		 $.each(data, function(i, value) {        
								htmls +=
								'</td><td>' + value.title + 
								'</td><td>' + value.camp_status+	
								'</td><td>' + value.ad_title +
								'</td><td>' + value.adviews+
								//'</td><td>' + value.adviews1+		
								//'</td><td>' + value.adviews2+
								//'</td><td>' + value.adviews3+
								'</tr>';
								});
                            }
								htmls +='</thead></tbody>';	
                            
							


							$(".table-responsive").append(htmls);
							$('.loader-search').addClass('hide');
							$('#datatable-editable').dataTable({
								columnDefs: [{
									orderable: false, targets: -1
								}],
								stateSave: true
							});
							$('[data-toggle="tooltip"]').tooltip();	
							// '</td><td> <a href="'+base_url+'admin/view_fixer_details/'+value.id+'"><span data-toggle="tooltip" data-placement="top" title="View" data-original-title="View"><i class="fa fa-eye edit-icon"></i></span></a>'+edit+deletes+ approve
							// '</td></tr>';
	
						}	
	             }
	         });

	});	


				</script>

<!--$this->db->select('*');
                $this->db->from('advertise');
                $this->db->where('campaign_id',$result_query['campaign_id']);
                $query = $this->db->get();
                $query_count = $query->num_rows();
            	$ary['ads_count'] = $query_count;-->